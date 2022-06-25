
require('./bootstrap');

//importa solo axios
/* window.axios = require('axios');
Vue.prototype.$http = window.axios; */

window.Vue = require('vue');

import App from './components/App.vue'

const app = new Vue({
    el: '#root',
    render: h => h(App)
});
