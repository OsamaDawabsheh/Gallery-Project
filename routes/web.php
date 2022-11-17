<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\UserController;
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


Route::get('/', [UserController::class, 'goToHome'])->name('gallery');
Route::get('/signup', [UserController::class, 'signup'])->name('gallery.signup');
Route::post('/signup', [UserController::class, 'insertUser'])->name('gallery.insertUser');
Route::get('/login', [UserController::class, 'login'])->name('gallery.login');
Route::post('/login', [UserController::class, 'extractUser'])->name('gallery.extractUser');
Route::get('/create', [PostController::class, 'newPost'])->name('gallery.newPost');
Route::post('/insert', [PostController::class, 'insertPost'])->name('gallery.insertPost');
Route::get('/post/{id}', [PostController::class, 'post'])->name('gallery.post');
Route::get('/edit/{id}', [PostController::class, 'edit'])->name('gallery.edit');
Route::patch('/post/{id}', [PostController::class, 'update'])->name('gallery.update');
Route::get('/user/{id}/{state?}', [PostController::class, 'user'])->name('gallery.user');
Route::get('/signout', [UserController::class, 'signout'])->name('gallery.signout');
Route::get('/home', [PostController::class, 'home'])->name('gallery.home');
Route::delete('/remove/{id}', [PostController::class, 'remove'])->name('gallery.remove');
Route::get('/download/{id}', [PostController::class, 'download'])->name('gallery.download');
Route::post('/rate/{id}', [RateController::class, 'evaluate'])->name('gallery.evaluate');
Route::post('/comment/{id}', [CommentController::class, 'comment'])->name('gallery.comment');
Route::delete('/delete/{id}', [CommentController::class, 'delete'])->name('gallery.deleteComment');
Route::get('/editComment/{id}', [CommentController::class, 'editComment'])->name('gallery.editComment');
Route::patch('/updateComment/{id}', [CommentController::class, 'updateComment'])->name('gallery.updateComment');
Route::get('/search', [PostController::class, 'search'])->name('gallery.search');

Route::get('/admin', [AdminController::class, 'admin'])->name('gallery.admin');
Route::get('/admin/table/{table?}', [AdminController::class, 'tables'])->name('gallery.Tables');
Route::delete('/deleteUser/{id}', [UserController::class, 'deleteUser'])->name('gallery.deleteUser');
Route::get('/table/search/{table?}', [AdminController::class, 'tableSearch'])->name('gallery.tableSearch');
Route::delete('/deleteRate/{id}', [RateController::class, 'deleteRate'])->name('gallery.deleteRate');

Route::get('/contact', [UserController::class, 'contact'])->name('gallery.contact');
Route::post('/send', [UserController::class, 'send'])->name('gallery.send');
