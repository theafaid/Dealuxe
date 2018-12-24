window.Vue = require('vue');

import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
Vue.use(Toaster, {timeout: 3000})

Vue.component('shop-page', require('./pages/Shop.vue'));

const app = new Vue({
    el: '#dealuxe'
});
