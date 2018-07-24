<template>
    <div>
        <input v-if="repliableId !== 0" type="hidden" name="repliable_id" :value="repliableId">
        <div class="field">
            <div class="control">
                <textarea
                    class="textarea"
                    :class="{ 'is-danger': validationError }"
                    name="body"
                    placeholder="Post your message..."
                    ref="textarea"
                    v-model="currentContent"></textarea>
            </div>

            <p v-if="validationError" class="help is-danger has-text-weight-bold">{{ validationError }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            content: {
                type: String,
                default: ''
            },
            validationError: {
                type: String,
                default: ''
            }
        },

        data() {
            return {
                currentContent: '',
                repliableId: 0
            }
        },

        methods: {
            prefixUsername(username) {
                return this.currentContent.startsWith('@')
                    ? `@${username}, ${this.currentContent.split(' ').pop()}`
                    : `@${username}, ${this.currentContent}`
            }
        },

        created () {
            this.currentContent = this.content
        },

        mounted () {
            let self = this
            window.events.$on('replyTo', function(username, id) {
                self.currentContent = self.prefixUsername(username)
                self.$refs.textarea.focus()
                self.repliableId = id
            })
        }
    }
</script>
