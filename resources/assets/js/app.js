
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

import VueSession from 'vue-session'
import BootstrapVue from 'bootstrap-vue'

Vue.use(VueSession)
Vue.use(BootstrapVue);
Vue.use(require('vue-moment'));

Vue.component('forecast', require('./components/Forecast.vue'));
Vue.component('calculator', require('./components/Calculator.vue'));
Vue.component('cornfetti', require('./components/Cornfetti.vue'));
Vue.component('countdown', require('./components/Countdown.vue'));
Vue.component('google-map', require('./components/GoogleMap.vue'));

const app = new Vue({
    el: '#app'
});
