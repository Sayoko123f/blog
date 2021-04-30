require('./bootstrap');
require('alpinejs');
import Vue from 'vue';
import router from './router';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
Vue.use(Vuetify);

const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify()
});
