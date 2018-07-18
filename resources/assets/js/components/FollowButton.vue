<template>
    <button class="button is-rounded is-outlined is-link" @click="toggleFollow">
    <!-- Removed dynamic 'is-loading' button bulma class because during ajax request spinner is not visible -->
    <!--<button class="button is-rounded is-outlined is-link" :class="{ 'is-loading': isLoading }" @click="toggleFollow">-->
        <span class="icon">
            <i class="fas" :class="isFollowed ? 'fa-user-times' : 'fa-user-check'"></i>
        </span>
        <span>{{ isFollowed ? 'Unfollow' : 'Follow' }}</span>
    </button>
</template>

<script>
    export default {
        props: {
            follow: {
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
                isFollowed: false,
                isLoading: false
            }
        },

        methods: {
            toggleFollow () {
                this.isLoading = true
                const requestType = this.isFollowed ? 'delete' : 'post'
                axios[requestType](this.requestUrl)
                    .then(response => {
                        flash(response.data.flash)
                        this.isFollowed = response.data.value
                        this.isLoading = false
                    })
                    .catch(error => {
                        console.log(error)
                        this.isLoading = false
                    })
            }
        },

        created () {
            this.isFollowed = this.follow
        }
    }
</script>
