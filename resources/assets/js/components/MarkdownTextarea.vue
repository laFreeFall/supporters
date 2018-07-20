<template>
    <div class="field is-horizontal m-b-md">
        <div class="field-label is-normal">
            <label class="label" :for="name">{{ label }}</label>
        </div>
        <div class="field-body">

            <div class="field">
                <div class="tabs is-boxed">
                    <ul>
                        <li @click="changeTab('raw')" :class="{ 'is-active': activeTab === 'raw' }">
                            <a>
                                <span class="icon is-small">
                                    <i class="fas fa-code" aria-hidden="true"></i>
                                </span>
                                <span>Raw content</span>
                            </a>
                        </li>
                        <li @click="changeTab('preview')" :class="{ 'is-active': activeTab === 'preview' }">
                            <a>
                                <span class="icon is-small">
                                    <i class="far fa-eye" aria-hidden="true"></i>
                                </span>
                                <span>Preview</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="control">
                    <textarea
                        v-show="activeTab === 'raw'"
                        class="textarea overflow-scroll"
                        :class="{ 'is-danger': validationError }"
                        :name="name"
                        :id="name"
                        type="text"
                        :placeholder="placeholder"
                        v-model="currentContent"
                    ></textarea>
                    <div
                        v-show="activeTab === 'preview'"
                        class="textarea overflow-scroll"
                        :class="{ 'is-danger': validationError }"
                        v-html="previewContent"
                    ></div>
                </div>
                <p class="help">Markdown is available</p>
                <p v-if="validationError" class="help is-danger has-text-weight-bold">{{ validationError }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    import marked from 'marked'

    export default {
        props: {
            content: {
                type: String
            },
            label: {
                type: String
            },
            placeholder: {
                type: String
            },
            name: {
                type: String
            },
            validationError: {
                type: String,
                default: ''
            }
        },

        data() {
            return {
                currentContent: '',
                activeTab: 'raw'
            }
        },

        methods: {
            changeTab(tabName) {
                if (this.activeTab !== tabName) {
                    this.activeTab = tabName
                }
            }
        },

        computed: {
            previewContent () {
                marked.setOptions({
                    renderer: new marked.Renderer(),
                    gfm: true,
                    tables: true,
                    breaks: true,
                    pedantic: false,
                    sanitize: true,
                    smartLists: true,
                    smartypants: false
                });
                return marked(this.currentContent)
            }
        },

        created () {
            this.currentContent = this.content
        }
    }
</script>