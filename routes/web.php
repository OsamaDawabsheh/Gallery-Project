<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
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


Route::get('/signup', [UserController::class, 'signup'])->name('gallery.signup');
Route::post('/signup', [UserController::class, 'insertUser'])->name('gallery.insertUser');
Route::get('/login', [UserController::class, 'login'])->name('gallery.login');
Route::post('/login', [UserController::class, 'extractUser'])->name('gallery.extractUser');
Route::get('/create', [PostController::class, 'newPost'])->name('gallery.newPost');
Route::post('/insert', [PostController::class, 'insertPost'])->name('gallery.insertPost');
Route::get('/post/{id}', [PostController::class, 'post'])->name('gallery.post');
Route::get('/edit/{id}', [PostController::class, 'edit'])->name('gallery.edit');
Route::patch('/post/{id}', [PostController::class, 'update'])->name('gallery.update');
Route::get('/user/{id}', [PostController::class, 'user'])->name('gallery.user');
Route::get('/signout', [UserController::class, 'signout'])->name('gallery.signout');
Route::get('/home', [PostController::class, 'home'])->name('gallery.home');
Route::delete('/remove/{id}', [PostController::class, 'remove'])->name('gallery.remove');
Route::get('/download/{id}', [PostController::class, 'download'])->name('gallery.download');
Route::post('/rate/{id}', [RateController::class, 'evaluate'])->name('gallery.evaluate');
