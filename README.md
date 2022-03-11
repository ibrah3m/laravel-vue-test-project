to try this test project click here

[![Open in Gitpod](https://gitpod.io/button/open-in-gitpod.svg)](https://gitpod.io/#https://github.com/ibrah3m/laravel-vue-test-project)





<!-- GETTING STARTED -->

## Getting Started

this is small documentation define the project parts that I worked in so let's start and enjoy while reading.

### Route

* first we have Web route .

```php
//this one for auto redirect to blog 

Route::get('/', function () {
    return redirect('/blog');
});


//this route made to return  fake blog template and contains the comments box component 

Route::get('/blog', function () {
    return view('blog');
});
```

* second we have Api route .

```php

//here we made an api to use it inside the vue component in order to get/set the new comments without  refresh

Route::prefix('Comments')->group(function () {

    Route::controller(CommentsController::class)->group(function () {
        Route::post('/add', 'create');
        Route::post('/add-reply', 'addReply');
        Route::get('/show', 'show');
    });
});

//  we use prefix because we have many sub routes use the same directory and "Route::controller"  to group the routes that uses the same controller 
```

### controller

* we have one controller called "CommentsController" has 3 functions as explained below.

```php 
    
    //here we insert new comment row
    public function create(Request $request)
    {
    .......
    }

    //here we return all the comments with their replys(until 3rd layer) as json to the request
    public function show()
    {
    //in this part of the code, we control the query responsible to  get the comment and his replies just until the 3rd layer of replies using 'with' method
    
    'comments' => Comment::with('comment_replys.comment_replys.comment_replys').......
    
    .......
    }
    //here we insert new reply for specific comment/reply
    public function addReply(Request $request)
    {
    .......
    }

```

### model

* we relay on one model called "Comment" has 1 method.

```php
//this method made to manage the relationships in the model between the comment and his replies
   public function comment_replys()
    {
    .......
    }

  ```

### components

* The comment section divides into 4 components each one having its functionality as we will see below.

1.CommentComponent

```vue
//this is the parent component of  all other comopnents, this component responsible to get the comments and the template of comment box

<template>
    
    <div v-for="(comment, index ) in comments" :key="comment.id">
        //here where we print the stored comments 
        <h4 class="card-title text-black">{{ comment.name }}</h4>
        <p class="card-text">{{ comment.comment_text }}</p>
        
        //here  we include the reply button
        <reply-comment-component :sub_comment="comment" v-slot="{ onReply }">
            <a href="#!" class="float-right m-2 card-link"><span class="small" @click="onReply">reply</span></a>
        </reply-comment-component>

        //here  we attach the replies(nested comments) for the comment
        <div v-for="reply in comment.comment_replys" :key="reply.id">
            <nested-comment-component :nested_level="1" :reply="reply">
            </nested-comment-component>
        </div>

        //here we insert the form of adding new comment 
        <new-comment-component :comments="comments"></new-comment-component>
    </div>
</template>

<script>
export default {
  //we use 'provide'  in order to make sure that all child /grandchild components can reach the 'getComment' method 
    provide: function () {
        return {
            getComment: this.getComment
        }
    },
    methods: {
        //this method gets the comments from our backend using the api route
        getComment() {
            axios.get('api/Comments/show')
                .then((response) => {
                    this.comments = response.data.comments;
                })
        },
    },
    created() {
      //this will call the method once it loading . 
        this.getComment()

    },
}
</script>


  ```
2.NewCommentComponent
```vue
<template>
    <div  style="background-color: #626262;">
        <form @submit.prevent="sendComment()" id="CommentForm">
            ..........
        </form>
    </div>
</template>
<script>
export default {
        props:{
        comments:{}
    },
    methods: {
// we assign new comment using 'sendComment' 
        sendComment(){
            let comment = { name: this.CommentUserName ,comment: this.CommentUserText};
            axios.post('/api/Comments/add', comment)
                .then(this.$parent.getComment());
            this.CommentUserName=''
            this.CommentUserText=''
        }
    }
}
</script>
```
4. ReplyCommentComponent
```vue
<template>
    <div>
        <slot :on-reply="onReply"></slot>
        <div v-show="replyOnComment">
            <form @submit.prevent="sendReply()" id="replayForm">
            </form>
        </div>
    </div>
</template>
<script>


export default {
//here we import 'getcomment' method from the parent component    
    inject: ['getComment'],

    methods: {
//this an boolean method to show and hide the reply box 
        onReply() {
            if (this.replyOnComment) {
                this.replyOnComment = false;

            } else {
                this.replyOnComment = true;

            }
        },
//this method triggered when the form submitted to post the fields 
        sendReply() {

            let reply = {name: this.ReplyUserName, comment: this.ReplyCommentText, comment_id: this.sub_comment.id};
            axios.post('/api/Comments/add-reply', reply)
                .then(this.getComment);
            this.ReplyUserName = '';
            this.ReplyCommentText = '';
            this.onReply();
        },
    }
}
</script>


```
4.NestedCommentComponent
```vue
//this component responsible to print all nested comments until third level 
<template>
    <div>
        ..........
        
        <div class="pl-4" v-if="nested_level <= 3" v-for="nested in reply.comment_replys" :key="nested.id">
            <nested-comment-component :nested_level="nested_level + 1" :reply="nested"></nested-comment-component>
            <br>

        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
        }
    },
    props: {
        reply: {},
        nested_level:0,

    },
}
</script>

```
