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
import About from './components/About.vue';
import Demo from './components/demoComponent.vue';
import Todolist from './components/TodolistComponent.vue';
import UploadImages from './components/UploadImages.vue';
import ImageShow from './components/ImageShow.vue';
import admin_ImageEdit from './components/admin_ImageEdit.vue';
import admin_index from './components/admin_Index.vue';
import demo_Chart from './components/demo_Chart.vue';
import demo_OSM from './components/demo_OpenStreetMap.vue';

const titleSuffix = ' |網頁開發筆記';

const routes = [
    //{ path: '/example', component: example, name: 'example', redirect: '/', meta: { auth: false } },
    { path: '/test', component: example, name: 'test', meta: { title: `Testing${titleSuffix}` } },
    { path: '/about', component: About, name: 'about', meta: { title: `關於本站${titleSuffix}` } },
    { path: '/demo', component: Demo, name: 'demo', meta: { title: `Demo${titleSuffix}` } },
    { path: '/demo/todolist', component: Todolist, name: 'todolist', meta: { title: `Todolist${titleSuffix}` } },
    { path: '/demo/chart', component: demo_Chart, name: 'demoChart', meta: { title: `Chart${titleSuffix}` } },
    { path: '/demo/osm', component: demo_OSM, name: 'demoOSM', meta: { title: `OpenStreetMap${titleSuffix}` } },
    { path: '/login', component: Login, name: 'login', meta: { title: `登入${titleSuffix}` } },
    { path: '/redirect', component: rct, name: 'redirect', },
    { path: '/', component: ArticleIndex, name: 'articleIndex', meta: { title: `筆記列表${titleSuffix}` } },
    { path: '/article/:id', component: ArticleShow, name: 'articleShow', },
    { path: '/admin/article/create', component: ArticleCreate, name: 'articleCreate', },
    { path: '/admin/article', component: admin_ArticleIndex, name: 'admin_articleIndex', },
    { path: '/admin/article/edit/:id', component: admin_ArticleEdit, name: 'articleEdit', },
    { path: '/admin/image/upload', component: UploadImages, name: 'adminImageUpload', meta: { title: `Upload${titleSuffix}` } },
    { path: '/image', component: ImageShow, name: 'ImageShow', meta: { title: `ImageShow` } },
    { path: '/admin/image', component: admin_ImageEdit, name: 'ImageEdit', meta: { title: `ImageEdit` } },
    { path: '/admin', component: admin_index, name: 'admin_index', meta: { title: `admin_index` } },
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