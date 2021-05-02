require('./bootstrap');
require('alpinejs');
import Vue from 'vue';
import router from './router';
import Vuetify from 'vuetify';
Vue.use(Vuetify);

Vue.component('app-navbar', require('./components/AppNavbar.vue').default);

const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify(),
    data: () => ({
        sidebarMenu: false,
        
    })
});
