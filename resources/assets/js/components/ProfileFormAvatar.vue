<template>
    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label" for="avatar">Avatar</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="file has-name is-fullwidth">
                    <label class="file-label">
                        <input class="file-input" type="file" name="avatar" id="avatar" accept="image/*" @change="onChange">
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Choose a file…
                            </span>
                        </span>
                        <span class="file-name" id="avatar-name">{{ currentAvatar ? 'Avatar is set' : 'Avatar hasn\'t been chosen yet' }}</span>
                    </label>
                </div>
                <figure class="image is-64x64">
                    <img :src="currentAvatar"/>
                </figure>
                <p class="help is-danger has-text-weight-bold" v-if="validationError">{{ validationError }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            avatar: {
                type: String
            },
            validationError: {
                type: String,
                default: ''
            }
        },

        data() {
            return {
                currentAvatar: ''
            }
        },

        methods: {
            onChange(e) {
                if (! e.target.files.length) {
                    return
                }
                const file = e.target.files[0]
                const reader = new FileReader()
                reader.readAsDataURL(file)

                reader.onload = e => { this.currentAvatar = e.target.result }
            }
        },

        created () {
            this.currentAvatar = this.avatar
        }
    }
</script>
