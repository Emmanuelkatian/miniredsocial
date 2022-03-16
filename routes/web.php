<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConnectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;


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

// Router Auth
Route::get('/login', [ConnectController::class, 'getLogin'])->name('login');
Route::post('/login', [ConnectController::class, 'postLogin'])->name('login');
Route::get('/logout', [ConnectController::class, 'getLogout'])->name('logout');
Route::get('/register', [ConnectController::class, 'getRegister'])->name('register');
Route::post('/register', [ConnectController::class, 'postRegister'])->name('register');

//Module User Actions
Route::get('/account/edit', [UserController::class, 'getAccountEdit'])->name('account_edit');
Route::post('/account/edit/avatar', [UserController::class, 'postAccountAvatar'])->name('account_avatar_edit');
Route::post('/account/edit/password', [UserController::class, 'postAccountPassword'])->name('account_password_edit');
Route::post('/account/edit/info', [UserController::class, 'postAccountInfo'])->name('account_info_edit');


//Module Apis Countries
Route::get('/api/country', [CountryController::class, 'getCountries'])->name('country');

//Module Posts
Route::get('/feeds', [PostsController::class, 'getFeedPost'])->name('feedpost');
Route::post('/newpost', [PostsController::class, 'postNewPost'])->name('newpost');
Route::get('/post/{id}/edit', [PostsController::class, 'getPostEdit'])->name('post_edit');
Route::post('/post/{id}/edit', [PostsController::class, 'postPostEdit'])->name('post_edit');
Route::get('/post/{id}/delete', [PostsController::class, 'getDeletePost'])->name('deletepost');

//Module Comments
Route::post('/new/comment/{param}', [CommentsController::class, 'postNewComment'])->name('newcomment');
Route::get('/comment/{id}/edit', [CommentsController::class, 'getPostComment'])->name('comment_edit');
Route::post('/comment/{id}/edit', [CommentsController::class, 'postPostComment'])->name('comment_edit');
Route::get('/comment/{id}/delete', [CommentsController::class, 'getDeleteComment'])->name('comment_delete');

