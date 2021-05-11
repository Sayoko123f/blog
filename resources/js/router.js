import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import example from './components/ExampleComponent.vue';
import ArticleIndex from './components/ArticleIndex.vue';
import ArticleCreate from './components/admin_ArticleCreate.vue';
import ArticleShow from './components/ArticleShow.vue';
import admin_ArticleIndex from './components/admin_ArticleIndex.vue';
import admin_ArticleEdit from './components/admin_ArticleEdit.vue';
import rct from './components/RedirectComponent.vue';
import Login from './components/LoginComponent.vue';
import Register from './components/RegisterComponent.vue';



const routes = [
    //{ path: '/example', component: example, name: 'example', redirect: '/', meta: { auth: false } },
    { path: '/test', component: example, name: 'test', },
    { path: '/login', component: Login, name: 'login', },
    { path: '/register', component: Register, name: 'register', },
    { path: '/redirect', component: rct, name: 'redirect', },
    { path: '/', component: ArticleIndex, name: 'articleIndex', },
    { path: '/article/:id', component: ArticleShow, name: 'articleShow', },
    { path: '/admin/article/create', component: ArticleCreate, name: 'articleCreate', },
    { path: '/admin/article', component: admin_ArticleIndex, name: 'admin_articleIndex', },
    { path: '/admin/article/edit/:id', component: admin_ArticleEdit, name: 'articleEdit', },
]

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

export default router;