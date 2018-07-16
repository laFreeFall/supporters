<template>
    <div class="card">
        <div class="card-header">
            <div class="card-header-title space-between">
                <a class="is-pulled-left" :href="`/campaign/${campaignSlug}/goals`">
                    Goals
                </a>
                <p>{{ currentIndex }} of {{ goalsAmount }}</p>
                <div class="buttons has-addons">
                    <button class="button" :disabled="!prevAvailable" @click="prev">
                    <span class="icon is-small">
                        <i class="fas fa-caret-left"></i>
                    </span>
                    </button>
                    <button class="button" :disabled="!nextAvailable" @click="next">
                    <span class="icon is-small">
                        <i class="fas fa-caret-right"></i>
                    </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-content">
            <div class="content">
                <p>
                    <span class="is-pulled-left">
                        ${{ currentGoal.amount }} per month
                    </span>
                    <span class="is-pulled-right has-text-grey" v-if="currentGoal.progress === 100">
                        reached
                    </span>
                </p>
                <progress class="progress" :class="colors.color_class" :value="currentGoal.progress" max="100">{{ currentGoal.progress }}%</progress>
                <p class="has-text-weight-bold">{{ currentGoal.title }}</p>
                <p>{{ currentGoal.description}}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            goals: {
                type: Array,
                required: false,
                default: []
            },
            colors: {
                type: Object,
                required: true
            },
            campaignSlug: {
                type: String,
                required: true
            }
        },

        data() {
            return {
                currentGoal: {},
                currentIndex: 0
            }
        },

        methods: {
            next () {
                if(this.nextAvailable) {
                    this.currentIndex++;
                    this.currentGoal = this.goals[this.currentIndex - 1]
                }
            },
            prev () {
                if(this.prevAvailable) {
                    this.currentIndex--;
                    this.currentGoal = this.goals[this.currentIndex - 1]
                }
            }
        },

        computed: {
            goalsAmount () {
                return this.goals.length
            },

            prevAvailable () {
                return this.currentIndex > 1
            },

            nextAvailable () {
                return this.currentIndex < this.goalsAmount
            }
        },

        created () {
            if(this.goals.length) {
                for (const[index, goal] of this.goals.entries()) {
                    if (goal.progress < 100) {
                        this.currentGoal = goal
                        this.currentIndex = index + 1
                        break
                    }
                }
            }
        }
    }
</script>
