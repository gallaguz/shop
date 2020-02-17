import Vue from 'vue';
import Axios from 'axios';
import VueAxios from 'vue-axios';
import VTooltip from 'v-tooltip';

Vue.use(VueAxios, Axios);
Vue.use(VTooltip);

import store from './store'

import router from './routes';
import App from './components/App.vue';

const app = new Vue({
  el: '#app',
  render: h => h(App),
  router,
  store
});
