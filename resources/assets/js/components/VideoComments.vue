<template>
    <div>
        <p>{{ commentsCount }}</p>
        <ul class="media-list">
            <li class="media" v-for="comment in comments" :key="comment.id">
                <div class="media-left">
                    <a :href="comment.channel.data.url">
                        <img :src="comment.channel.data.image" :alt="comment.channel.data.name + ' image'" class="media-object">
                    </a>
                </div>
                <div class="media-body">
                    <a :href="comment.channel.data.url">{{ comment.channel.data.name }}</a> {{ comment.created_at_human }}
                    <p>{{ comment.body }} {{ comment.replies.data.length }}</p>
                    <ul class="media-list">
                        <li class="media" v-for="reply in comment.replies.data" :key="reply.id">
                            <div class="media-left">
                                <a :href="reply.channel.data.url">
                                    <img :src="reply.channel.data.image" :alt="reply.channel.data.name + ' image'" class="media-object">
                                </a>
                            </div>
                            <div class="media-body">
                                <a :href="reply.channel.data.url">{{ reply.channel.data.name }}</a> {{ reply.created_at_human }}
                                <p>{{ reply.body }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    import pluralize from 'pluralize';

    export default {
        data() {
            return {
                comments: []
            };
        },
        computed: {
            commentsCount() {
                return pluralize('comment', this.comments.length, true);
            }
        },
        props: {
            videoUid: null
        },
        methods: {
            loadComments() {
                this.$http.get('/videos/' + this.videoUid + '/comments')
                    .then(response => response.json())
                    .then(result => {
                        this.comments = result.data;
                    });
            }
        },
        mounted() {
            this.loadComments();
        }
    }
</script>