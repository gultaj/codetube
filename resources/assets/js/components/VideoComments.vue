<template>
    <div>
        <p>{{ commentsCount }}</p>

        <div class="video-comment clearfix" v-show="$root.user.authenticated">
            <textarea v-model="body" class="form-control video-comment__input"></textarea>
            <div class="pull-right">
                <button type="submit" class="btn btn-default" @click="createComment">Post</button>
            </div>
        </div>

        <ul class="media-list">
            <li class="media" v-for="comment in comments" :key="comment.id">
                <div class="media-left">
                    <a :href="comment.channel.data.url">
                        <img :src="comment.channel.data.image" :alt="comment.channel.data.name + ' image'" class="media-object">
                    </a>
                </div>
                <div class="media-body">
                    <a :href="comment.channel.data.url">{{ comment.channel.data.name }}</a> {{ comment.created_at_human }}
                    <p>{{ comment.body }}</p>
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
                comments: [],
                body: null
            };
        },
        computed: {
            commentsCount() {
                return pluralize('comment', this.comments.length, true);
            },
            apiUrl() {
                return '/videos/' + this.videoUid + '/comments';
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
            },
            createComment() {
                this.$http.post(this.apiUrl, {body: this.body}).then(res => res.json())
                    .then(result => {
                        this.comments.unshift(result.data);
                        this.body = null;
                    });
            }
        },
        mounted() {
            this.loadComments();
        }
    }
</script>