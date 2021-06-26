# 實作個人部落格
## 功能
前台
  - 瀏覽文章
  - 依標題、標籤搜尋文章

後台(提供一顆測試帳號登入按鈕，老師可自由測試後台功能)
  - 文章管理
    + 支援 Markdown 
    + 新增、編輯、刪除文章
    + 文章標籤
  - 上傳圖片
    + 支援多張同時上傳
    + 對單檔大小作限制(2MB以下)

> 開發中/預計開發
>- 相簿功能
>- 外人留言功能(會員分級權限)


## 基於
- Server: Apache
- Database: MYSQL
- Backend: PHP Laravel 8 
- Frontend: Vue.js 2 + v-router + vuetify
- Markdown editor: [tui.editor](https://github.com/nhn/tui.editor)
- demo/chart: chartjs
- demo/map: openstreetmap

## 技術細節
MVC架構前後端分離，前端負責畫面呈現與使用者互動，後端負責傳送資料與業務邏輯，增加可維護性。
### 後端
http 重導向至 https

RESTful API 風格，使 API 語義化前端更容易介接。

方法|API|功能|
---|---|---|
GET|/article|文章列表
GET|/article/:id|檢視文章
POST|/article|新增文章
PUT|/article/:id|編輯文章
DELETE|/article/:id|刪除文章

使用 [HTML Purifier](http://htmlpurifier.org/) 防禦 XSS 攻擊(為了留言功能)。

phpunit 單元測試，自動測試文章 CRUD 功能
```
PASS  Tests\Unit\ArticleTest
  ✓ store
  ✓ update
  ✓ show
  ✓ index
  ✓ destroy
  ✓ search

  Tests:  6 passed
  Time:   6.90s
```

### 前端
使用 webpack 打包前端資源，壓縮程式碼減少載入時間。
```js
require('./bootstrap');
require('./myfunc');
import Vue from 'vue';
import router from './router';
import Vuetify from 'vuetify';
Vue.use(Vuetify);
import markdown from './markdown';
```

Vue.js 將頁面拆分成組件，增加可維護性
```js
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
import Demo from './components/demoComponent.vue';
import Todolist from './components/TodolistComponent.vue';
```

使用 v-router 前端路由，以 ajax 方式載入資料，加快頁面載入速度
```js
const titleSuffix = ' |網頁開發筆記';

const routes = [
    { path: '/test', component: example, name: 'test', meta: { title: `Testing${titleSuffix}` } },
    { path: '/about', component: About, name: 'about', meta: { title: `關於本站${titleSuffix}` } },
    { path: '/demo', component: Demo, name: 'demo', meta: { title: `Demo${titleSuffix}` } },
    { path: '/demo/todolist', component: Todolist, name: 'todolist', meta: { title: `Todolist${titleSuffix}` } },
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
```
