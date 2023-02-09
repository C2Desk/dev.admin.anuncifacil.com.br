<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\PubController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostsController::class, 'index']);
Route::get('/posts/create', [PostsController::class, 'create']);
Route::post('/posts/save', [PostsController::class, 'store'])->name('posts.save');

Route::get('/posts/edit/{id}', [PostsController::class, 'edit'])->name('posts.edit');
Route::put('/posts/update', [PostsController::class, 'update'])->name('posts.update');

Route::get('/publicidade', [PubController::class, 'index']);
