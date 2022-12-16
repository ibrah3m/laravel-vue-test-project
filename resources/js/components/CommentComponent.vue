<template>
    <div>


        <div v-for="(comment, index ) in comments" :key="comment.id">
            
            <div class="card">
                <div class="card-body">


                    <h4 class="card-title text-black">{{ comment.name }}</h4>
                    <br>
                    <p class="card-text">
                        {{ comment.comment_text }}

                    </p>


                    <reply-comment-component  :sub_comment="comment" v-slot="{ onReply }">
                        <a href="#!" class="float-right m-2 card-link"><span class="small" @click="onReply">reply</span></a>
                    </reply-comment-component>
                    <br>
                    <div v-for="reply in comment.comment_replies" :key="reply.id">
                        
                        <nested-comment-component :nested_level="1" :reply="reply">

                        </nested-comment-component>
                        <br>

                    </div>

                </div>
            </div>

        </div>


        <new-comment-component :comments="comments"></new-comment-component>
    </div>
</template>

<script>

export default {

    data() {
        return {
            comments: {},
        }
    },
    provide: function () {
        return {
            getComment: this.getComment
        }
    },
    methods: {
        getComment() {
            axios.get('api/Comments/show')
                .then((response) => {
                    this.comments = response.data.comments;
                })
        },

    },
    created() {
        this.getComment()

    },

}
</script>
