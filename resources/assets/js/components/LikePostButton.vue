<template>
    <a @click="toggleLike">
        <span class="icon" title="Likes amount">
            <i :class="isLiked ? 'fas fa-heart' : 'far fa-heart'"></i>
        </span>
        <span>
            {{ 'Like' | pluralize(likesAmount) }}: <strong>{{ likesAmount }} </strong>
        </span>
    </a>
</template>

<script>
    export default {
        props: {
            like: {
                type: Boolean,
                required: true
            },
            amount: {
                type: Number,
                required: true
            },
            requestUrl: {
                type: String,
                required: true
            }
        },

        data () {
            return {
                isLiked: false,
                likesAmount: 0
            }
        },

        methods: {
            toggleLike () {
                const requestType = this.isLiked ? 'delete' : 'post'
                axios[requestType](this.requestUrl)
                    .then(response => {
                        flash(response.data.flash)
                        this.isLiked = response.data.value
                        this.likesAmount = response.data.amount
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }
        },

        created () {
            this.isLiked = this.like
            this.likesAmount = this.amount
        }
    }
</script>
