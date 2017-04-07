/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */
Vue.component('inbox', require('./components/inbox.vue'));
Vue.component('attack', require('./components/attack.vue'));
Vue.component('travels', require('./components/travels.vue'));
Vue.component('fleets-view', require('./components/fleets-view.vue'));
Vue.component('global-rates', require('./components/global-rates.vue'));
Vue.component('notification', require('./components/notification.vue'));
Vue.component('user-control', require('./components/user-control.vue'));
Vue.component('building-view', require('./components/building-view.vue'));
Vue.component('fleets-overview', require('./components/fleets-view.vue'));


const app = new Vue({
    el: '#app',
});
