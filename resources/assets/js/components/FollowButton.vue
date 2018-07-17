<template>
    <a href="#" class="button is-rounded is-outlined is-link" @click="toggleFollow">
        <span class="icon">
            <i class="fas" :class="isCampaignFollowed ? 'fa-user-times' : 'fa-user-check'"></i>
        </span>
        <span>{{ isCampaignFollowed ? 'Unfollow' : 'Follow' }}</span>
    </a>
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
                axios[requestType](this.requestUrl)
                    .then(response => {
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
