import Vue from 'vue';
import VTooltip from 'v-tooltip';
Vue.use(VTooltip);
//import store from './store'

import router from './routes';
import App from './components/App.vue';

const app = new Vue({
  el: '#app',
  render: h => h(App),
  router
});
