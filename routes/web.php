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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/peers', [App\Http\Controllers\HomeController::class, 'peers'])->name('peers');
Route::get('/messages', [App\Http\Controllers\HomeController::class, 'messages'])->name('messages');
Route::get('/category/{id}', [App\Http\Controllers\HomeController::class, 'category'])->name('category');
Route::get('/feed/{id}', [App\Http\Controllers\HomeController::class, 'feed'])->name('feed');

Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');

Route::get('/my-feeds', [App\Http\Controllers\FeedController::class, 'myFeeds'])->name('my-feeds');
Route::post('/like', [App\Http\Controllers\FeedController::class, 'likeFeed'])->name('like');
Route::post('/comment-like', [App\Http\Controllers\FeedController::class, 'commentLikeFeed'])->name('comment-like');
Route::post('/agree', [App\Http\Controllers\FeedController::class, 'agreeFeed'])->name('agree');
Route::post('/repost', [App\Http\Controllers\FeedController::class, 'repostFeed'])->name('repost');
Route::post('feed/store', [App\Http\Controllers\FeedController::class, 'store'])->name('feed.store');
Route::post('feed/comment', [App\Http\Controllers\FeedController::class, 'comment'])->name('feed.comment');

Route::get('auth/facebook', [App\Http\Controllers\Auth\FacebookController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [App\Http\Controllers\Auth\FacebookController::class, 'facebookCallback']);

Route::get('auth/google', [App\Http\Controllers\Auth\GoogleController::class, 'googleRedirect']);
Route::get('auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'googleCallback']);

