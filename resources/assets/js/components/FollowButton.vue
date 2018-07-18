<template>
    <button class="button is-rounded is-outlined is-link" @click="toggleFollow">
        <span class="icon">
            <i class="fas" :class="isCampaignFollowed ? 'fa-user-times' : 'fa-user-check'"></i>
        </span>
        <span>{{ isCampaignFollowed ? 'Unfollow' : 'Follow' }}</span>
    </button>
</template>

<script>
    export default {
        props: {
            isFollowed: {
                type: Boolean,
                required: true
            },
            requestUrl: {
                type: String,
                required: true
            }
        },

        data () {
            return {
                isCampaignFollowed: false
            }
        },

        methods: {
            toggleFollow () {
                const requestType = this.isCampaignFollowed ? 'delete' : 'post'
                const actionType = this.isCampaignFollowed ? 'unfollowed from the' : 'followed to the'
                axios[requestType](this.requestUrl)
                    .then(response => {
                        flash(`You have been ${actionType} campaign`)
                        this.isCampaignFollowed = !this.isCampaignFollowed
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }
        },

        created () {
            this.isCampaignFollowed = this.isFollowed
        }
    }
</script>
