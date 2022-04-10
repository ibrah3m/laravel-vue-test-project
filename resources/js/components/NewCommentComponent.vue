<template>
    <div  style="background-color: #626262;">
        <form @submit.prevent="sendComment()" id="CommentForm">
            <div class="mb-3">
                <label  class="form-label ">Name</label>
                <input type="text" class="form-control"  v-model="CommentUserName" >
            </div>
            <div class="mb-3">
                <label class="form-label">Comment</label>
                <textarea class="form-control" v-model="CommentUserText" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>

</template>
<script>
export default {
    data() {
        return {
            CommentUserName:'',
            CommentUserText:'',
        }
    },
    props:{
        comments:{}
    },
    methods: {
        sendComment(){

            let comment = { name: this.CommentUserName ,comment: this.CommentUserText};

            axios.post('/api/Comments/add', comment)
                .then(this.$parent.getComment());
            this.CommentUserName=''

            this.CommentUserText=''
            // this.comments.push({id: this.comments.length + 1 ,name: this.CommentUserName,text: this.CommentUserText ,comment_reply:[]});

        }
    }

}

</script>




