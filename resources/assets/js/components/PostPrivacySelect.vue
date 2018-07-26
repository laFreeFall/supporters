<template>
    <div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label" for="privacy_id">Post Privacy</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="control has-icons-left">
                        <div class="select is-fullwidth" :class="{ 'is-danger': privacyError }">
                            <select name="privacy_id" id="privacy_id" v-model="privacy" @change="privacyChanged" required>
                                <option
                                    v-for="privacy in privacies"
                                    :key="privacy.id"
                                    :value="privacy.id"
                                    :disabled="privacy.disabled !== undefined"
                                >
                                    {{ privacy.title }}
                                </option>
                            </select>
                        </div>
                        <div class="icon is-small is-left">
                            <i class="fas fa-globe"></i>
                        </div>
                    </div>
                    <p v-if="privacyError" class="help is-danger has-text-weight-bold">{{ privacyError }}</p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal" v-show="privacy === toggleableSelect && pledges.length > 1">
            <div class="field-label is-normal">
                <label class="label" for="pledge_id">Pledge level</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="control has-icons-left">
                        <div class="select is-fullwidth" :class="{ 'is-danger': pledgeError }">
                            <select name="pledge_id" id="pledge_id" v-model="pledge" required>
                                <option
                                    v-for="pledge in pledges"
                                    :key="pledge.id"
                                    :value="pledge.id"
                                    :disabled="pledge.disabled !== undefined"
                                >
                                    {{ `${pledge.title} ($${pledge.amount}+)` }}
                                </option>
                            </select>
                        </div>
                        <div class="icon is-small is-left">
                            <i class="fas fa-globe"></i>
                        </div>
                    </div>
                    <p v-if="pledgeError" class="help is-danger has-text-weight-bold">{{ pledgeError }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            initialPrivacies: {
                type: Array
            },
            initialPrivacy: {
                type: Number
            },
            privacyError: {
                type: String
            },
            initialPledges: {
                type: Array
            },
            initialPledge: {
                type: Number
            },
            pledgeError: {
                type: String
            }
        },

        data () {
            return {
                privacies: [],
                pledges: [],
                privacy: 0,
                pledge: 0,
                toggleableSelect: 0
            }
        },

        methods: {
            privacyChanged () {
                if (this.privacy !== this.toggleableSelect) {
                    this.pledge = 0
                } else {
                    this.pledge = 1
                }
            },
        },

        created () {
            if (this.initialPledges.length) {
                this.toggleableSelect = this.initialPrivacies.find(privacy => privacy.value === 'supporters').id

                this.pledges = this.initialPledges
                this.pledges.unshift({
                    id: 0,
                    value: '',
                    title: 'Choose Minimal Pledge Level',
                    amount: '?',
                    disabled: true
                })
                this.pledge = this.initialPledge
            }
            this.privacies = this.initialPrivacies
            this.privacies.unshift({
                id: 0,
                value: '',
                title: 'Choose Post Privacy Level',
                disabled: true
            })
            this.privacy = this.initialPrivacy
        }
    }
</script>