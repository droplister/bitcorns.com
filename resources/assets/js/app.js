
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

import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue);
Vue.use(require('vue-moment'));

Vue.component('calculator', require('./components/Calculator.vue'));
Vue.component('forecast', require('./components/Forecast.vue'));
Vue.component('forecast-chart', require('./components/ForecastChart.vue'));

const app = new Vue({
    el: '#app'
});
