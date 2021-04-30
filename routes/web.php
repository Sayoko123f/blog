<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::fallback(function(){
    return view('index');
});

/*
laravel new blog --jet
npm install && npm run dev
php artisan migrate
composer require --dev barryvdh/laravel-ide-helper
php artisan clear-compiled && php artisan ide-helper:generate
npm install vue
npm install vue-router
npm install vuetify && npm install sass sass-loader deepmerge -D
https://github.com/Nothing-Works/vuetifyjs-mix-extension/blob/master/readme.md
*/