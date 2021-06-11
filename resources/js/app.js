require('./bootstrap');
require('./myfunc');
import Vue from 'vue';
import router from './router';
import Vuetify from 'vuetify';
Vue.use(Vuetify);
// for markdown
import markdown from './markdown';
window.markdown = markdown;

Vue.component('app-navbar', require('./components/AppNavbar.vue').default);
Vue.component('search-bar', require('./components/SearchBar.vue').default);

const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify(),
    data: () => ({
        titleSuffix: ' |網頁開發筆記',
        sidebarMenu: false,
        user: null,
    }),
    mounted() {
        this.checkAuth();
    },
    methods: {
        menuToggle(val) {
            this.sidebarMenu = val;
        },
        checkAuth() {
            axios
                .get("/api/getuser")
                .then((res) => {
                    this.user = res.data;
                })
                .catch((err) => {
                    this.user = null;
                });
        }
    }
});
window.app = app;