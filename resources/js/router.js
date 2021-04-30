import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import example from './components/ExampleComponent.vue';


const routes = [
    //{ path: '/example', component: example, name: 'example', redirect: '/', meta: { auth: false } },
    { path: '/', component: example, name: 'example', },
]

const router = new VueRouter({
    mode: 'history',
    //linkActiveClass: 'active',
    routes: routes
});

export default router;