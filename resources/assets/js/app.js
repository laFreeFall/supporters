
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Snotify, { SnotifyPosition } from 'vue-snotify'
Vue.use(Snotify, {
    toast: {
        position: SnotifyPosition.rightTop,
        bodyMaxLength: 256
    }
})

window.events = new Vue()
window.flash = function(type, body, title) {
    window.events.$emit('flash', type, body, title)
}

Vue.component('profile-form-avatar', require('./components/ProfileFormAvatar.vue'));
Vue.component('campaign-goals', require('./components/CampaignGoals.vue'));
Vue.component('follow-button', require('./components/FollowButton.vue'));
Vue.component('flash-notification', require('./components/FlashNotification.vue'));

const app = new Vue({
    el: '#app'
});

