<template>
    <div class="card">
        <div class="card-body p-4">
            <div class="row">

                <div class="col">
                    <div v-for="(comment, index ) in comments" :key="comment.id">
                        <div class="d-flex flex-start">
                            <div class="flex-grow-1 flex-shrink-1">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="mb-1">
                                            {{ comment.name }}
                                        </p>
                                    </div>
                                    <p class="small mb-0">
                                        {{ comment.comment_text }}
                                    </p>
                                </div>
                                <br>
                                <br>
                                <reply-comment-component @getComment="getComment" :sub_comment="comment" v-slot="{ onReply }">
                                    <a href="#!"><i class="fas fa-reply fa-xs"></i><span class="small" @click="onReply">reply</span></a>

                                </reply-comment-component>



                                <div class="pl-3" v-for="reply in comment.comment_replys" :key="reply.id">

                                    <nested-comment-component :reply="reply"></nested-comment-component>
                                    <br>

                                </div>
                            </div>
                        </div>
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
