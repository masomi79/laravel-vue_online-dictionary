require('./bootstrap');
window.Vue = require('vue');

import VueRouter from 'vue-router';
import router from './router';

import common from './common'
Vue.mixin(common)

Vue.use(VueRouter);
Vue.component('mainapp', require('./components/mainapp.vue').default)

const app = new Vue({
  el: '#app',
  router
});

