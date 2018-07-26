<template>
    <vue-snotify></vue-snotify>
</template>

<script>
    export default {
        props: ['type', 'body'],

        mounted () {
            if (this.body) {
                console.log('type:' + this.type)
                console.log('body:' + this.body)
                const mode = this.type ? this.type : 'success'
                this.$snotify[mode](this.body)
            }
            window.events.$on('flash', function(body, type = 'success') {
                this.$snotify[type](body)
            })
        }
    }
</script>
