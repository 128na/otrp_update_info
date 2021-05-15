
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'Vue';
/**
 * import dependencies
 */
import {
  BootstrapVue,
  BIcon,
  BIconBoxArrowUpRight,
  BIconCaretUpFill,
  BIconCaretDownFill
} from 'bootstrap-vue'
Vue.use(BootstrapVue);
Vue.use(BootstrapVue);
Vue.component('BIcon', BIcon);
Vue.component('BIconBoxArrowUpRight', BIconBoxArrowUpRight);
Vue.component('BIconCaretUpFill', BIconCaretUpFill);
Vue.component('BIconCaretDownFill', BIconCaretDownFill);

import VueGtm from 'vue-gtm';
Vue.use(VueGtm, {
  id: 'GTM-PWX7Q7S',
  enabled: true,
  debug: false,
});

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * run app
 */
import App from './App.vue';
const app = new Vue({
  el: '#app',
  render: h => h(App)
});
