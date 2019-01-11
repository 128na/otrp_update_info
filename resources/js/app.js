
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * import dependencies
 */
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import VueBus from 'vue-bus';
import VueGtm from 'vue-gtm';

Vue.use(VueGtm, {
  id: 'GTM-PWX7Q7S',
  enabled: true,
  debug: false,
});


import App from './App.vue';

Vue.use(VueBus);
Vue.use(ElementUI);

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * run app
 */
const app = new Vue({
  el: '#app',
  render: h => h(App)
});
