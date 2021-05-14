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
import About from './components/About.vue';

const titleSuffix = ' |網頁開發筆記';

const routes = [
    //{ path: '/example', component: example, name: 'example', redirect: '/', meta: { auth: false } },
    { path: '/test', component: example, name: 'test', meta: { title: `Testing${titleSuffix}` } },
    { path: '/about', component: About, name: 'about', meta: { title: `關於本站${titleSuffix}` } },
    { path: '/login', component: Login, name: 'login', meta: { title: `登入${titleSuffix}` } },
    { path: '/register', component: Register, name: 'register', meta: { title: `註冊${titleSuffix}` } },
    { path: '/redirect', component: rct, name: 'redirect', },
    { path: '/', component: ArticleIndex, name: 'articleIndex', meta: { title: `筆記列表${titleSuffix}` } },
    { path: '/article/:id', component: ArticleShow, name: 'articleShow', },
    { path: '/admin/article/create', component: ArticleCreate, name: 'articleCreate', },
    { path: '/admin/article', component: admin_ArticleIndex, name: 'admin_articleIndex', },
    { path: '/admin/article/edit/:id', component: admin_ArticleEdit, name: 'articleEdit', },
]

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

router.beforeEach((to, from, next) => {
    window.document.title = to.meta.title || '網頁開發筆記';
    next();
});

export default router;