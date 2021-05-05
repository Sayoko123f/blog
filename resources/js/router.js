import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import example from './components/ExampleComponent.vue';
import ArticleIndex from './components/ArticleIndex.vue';
import ArticleCreate from './components/admin_ArticleCreate.vue';
import ArticleShow from './components/ArticleShow.vue';


const routes = [
    //{ path: '/example', component: example, name: 'example', redirect: '/', meta: { auth: false } },
    { path: '/test', component: example, name: 'test', },
    { path: '/', component: ArticleIndex, name: 'articleIndex', },
    { path: '/article/:id', component: ArticleShow, name: 'articleShow', },
    { path: '/admin/article/create', component: ArticleCreate, name: 'articleCreate', },
]

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

export default router;