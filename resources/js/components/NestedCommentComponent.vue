<template>
    <div>
    <div style="background-color: #f7f6f6;">
    <div class="d-flex flex-start mt-4">
        <div class="flex-grow-1 flex-shrink-1">
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-1">

                        {{ reply.name }}
                    </p>
                </div>
                <p class="small mb-0">

                    {{ reply.comment_text }}

                </p>
            </div>
        </div>

    </div>
        <br><br>
        <reply-comment-component :sub_comment="reply" v-slot="{ onReply }">
            <a href="#!"><i class="fas fa-reply fa-xs"></i><span class="small" @click="onReply">reply</span></a>

        </reply-comment-component>
    </div>

        <div class="pl-4" v-for="nested in reply.comment_replys" :key="nested.id">

            <nested-comment-component :reply="nested"></nested-comment-component>
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
        reply:{}
    },
    methods: {



    }
}


</script>
