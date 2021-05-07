require('./bootstrap');
require('alpinejs');
require('./myfunc');
import Vue from 'vue';
import router from './router';
import Vuetify from 'vuetify';
Vue.use(Vuetify);
// for markdown
import markdown from './markdown';
window.markdown = markdown;

Vue.component('app-navbar', require('./components/AppNavbar.vue').default);

const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify(),
    data: () => ({
        sidebarMenu: false,

    }),
    methods: {
        menuToggle(val) {
            this.sidebarMenu = val;
        }
    }
});
