<template>
    <vue-snotify></vue-snotify>
</template>

<script>
    export default {
        props: ['type', 'body'],

        mounted () {
            if (this.body) {
                const type = type ? type : 'success'
                this.$snotify[type](this.body)
            }
            window.events.$on('flash', function(body, type = 'success') {
                this.$snotify[type](body)
            })
        }
    }
</script>
