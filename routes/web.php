<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TweetsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FavoritesController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function() {

    // ユーザ関連
    Route::resource('/users', UsersController::class)->only(['index', 'show', 'edit', 'update']);
    
    // フォロー/フォロー解除を追加
    Route::post('users/{user}/follow', [App\Http\Controllers\UsersController::class , 'follow'])->name('follow');
    Route::delete('users/{user}/unfollow', [App\Http\Controllers\UsersController::class , 'unfollow'])->name('unfollow');
    
    //投稿関連
    Route::resource('/tweets', TweetsController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);

    // コメント関連
    Route::resource('/comments', CommentsController::class)->only(['store']);

    //いいね機能
    Route::resource('/favorites', FavoritesController::class)->only(['store', 'destroy']);
});