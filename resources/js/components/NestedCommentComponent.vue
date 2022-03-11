<template>
    <div>
        <div style="background-color: #f7f6f6;">
            <div class="d-flex flex-start mt-4">
                <div class="flex-grow-1 flex-shrink-1">
                    <div class="p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-1">

                                {{ reply.name }}
                            </h5>
                        </div>
                        <p class="small card-text">

                            {{ reply.comment_text }}

                        </p>
                        <reply-comment-component v-if="nested_level <= 2" :sub_comment="reply" v-slot="{ onReply }">
                            <a href="#!" class="float-right m-2 card-link"><span class="small" @click="onReply">reply</span></a>
                        </reply-comment-component>                        <br>
                    </div>
                </div>

            </div>


        </div>

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
    methods: {

    }
}


</script>
