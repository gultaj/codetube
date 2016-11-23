<template>
    <div class="subscribe-button" v-if="subscribers != null">
        {{ subscribersCount }} &nbsp; 
        <button class="btn btn-xs btn-default" type="button" v-if="canSubscribe" @click.prevent="handle">
            {{ userSubscribed ? 'Unsubscribe' : 'Subscirbe' }}
        </button>
    </div>
</template>

<script>
    import pluralize from 'pluralize';

    export default {
        data() {
            return {
                subscribers: null,
                userSubscribed: false,
                canSubscribe: false
            }
        },
        computed: {
            subscribersCount() {
                return pluralize('subscriber', this.subscribers, true);
            }
        },
        props: {
            channelSlug: null
        },
        methods: {
            getSubscriptionStatus() {
                this.$http.get('/subscription/' + this.channelSlug).then(res => res.json())
                    .then(result => {
                        this.subscribers = result.count;
                        this.userSubscribed = result.user_subscribed;
                        this.canSubscribe = result.can_subscribe;
                    });
            },
            handle() {
                if (this.userSubscribed) {
                    this.unsubscribe();
                } else {
                    this.subscribe();
                }
            },
            subscribe() {
                this.$http.post('/subscription/' + this.channelSlug)
                    .then(res =>  {
                        this.subscribers++;
                        this.userSubscribed = true;
                    });
            },
            unsubscribe() {
                this.$http.delete('/subscription/' + this.channelSlug)
                    .then(res =>  {
                        this.subscribers--;
                        this.userSubscribed = false;
                    });
            }
        },
        mounted() {
            this.getSubscriptionStatus();
        }
    }
</script>