<template>
    <div><slot :on-reply="onReply"></slot>
        <div v-show="replyOnComment">

        <form @submit.prevent="sendReply()" id="replayForm">
<!--            <button type="button" class="btn-close float-right  btn-sm" aria-label="Close"-->
<!--                    @click="closeReply()"></button>-->

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" v-model="ReplyUserName">
            </div>
            <div class="mb-3">
                <label class="form-label">Comment</label>
                <textarea class="form-control" v-model="ReplyCommentText" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
    </div>
</template>
<script>

export default {

    data() {
        return {
            ReplyUserName: '',
            ReplyCommentText: '',
            replyOnComment: false,

        }
    },
    props: {
        sub_comment: {}
    },

    methods: {
        onReply() {
            if (this.replyOnComment){
                this.replyOnComment = false;

            }else{
                this.replyOnComment = true;

            }
        },
        sendReply() {

            let reply = {name: this.ReplyUserName, comment: this.ReplyCommentText, comment_id: this.sub_comment.id};
            axios.post('/api/Comments/add-reply', reply)
                .then(this.$emit('getComment'));
            this.ReplyUserName = '';
            this.ReplyCommentText = '';
            this.onReply();
        },
    }
}
</script>
