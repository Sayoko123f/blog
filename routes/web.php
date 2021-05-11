<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController as Article;
use App\Http\Controllers\UploadController as Upload;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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
    return view('index');
})->name('dashboard');

Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {

    $limiter = config('fortify.limiters.login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware(array_filter([
            'guest:' . config('fortify.guard'),
            $limiter ? 'throttle:' . $limiter : null,
        ]));

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware(['guest:' . config('fortify.guard')]);
});
Route::get('/islogin', function () {
    return auth()->check() ? response('Login!', 200) : response('Not login:(', 403);
});

Route::get('/getuser', function () {
    return auth()->check() ? response()->json(auth()->user(), 200) : response()->json('Not login:(', 403);;
});

Route::prefix('api')->group(function () {
    Route::prefix('article')->group(function () {
        Route::get('/', [Article::class, 'index']);
        Route::post('/', [Article::class, 'store']);
        Route::get('/{id}', [Article::class, 'show']);
        Route::put('/{id}', [Article::class, 'update']);
        Route::delete('/{id}', [Article::class, 'destroy']);
        Route::get('/edit/{id}', [Article::class, 'edit']);
    });

    Route::prefix('upload')->group(function () {
        Route::post('/image', [Upload::class, 'image']);
    });
});

Route::fallback(function () {
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
npm i vuetifyjs-mix-extension@0.0.20 -D
composer require mews/purifier
https://github.com/Nothing-Works/vuetifyjs-mix-extension/blob/master/readme.md
https://github.com/nhn/tui.editor
*/