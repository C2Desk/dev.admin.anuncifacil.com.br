<?php

use App\Http\Controllers\DashController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PubController;
use App\Http\Controllers\AccountController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[DashController::class,'index']) ->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
Route::get('/posts/list', [PostsController::class, 'paginacao'])->name('posts.list');


Route::get('/posts/create', [PostsController::class, 'create']);
Route::get('/posts/social', [PostsController::class, 'social']);

Route::post('/posts/save', [PostsController::class, 'store'])->name('posts.save');

/*UPDATE*/
Route::get('/posts/edit/{id}', [PostsController::class, 'edit'])->name('posts.edit');
Route::post('/posts/update', [PostsController::class, 'update'])->name('posts.update');
Route::put('/posts/destaque', [PostsController::class, 'updateDestaque'])->name('posts.destaque');


Route::delete('/posts/delete/{id}',[PostsController::class, 'destroy'])->name('posts.destroy');

//Publicidade

Route::get('/publicidade', [PubController::class, 'index']);
Route::get('/publicidade/list', [PubController::class, 'paginacao'])->name('publicidade.list');



Route::get('/publicidade/create', [PubController::class, 'create']);
Route::get('/publicidade/pdf', [PubController::class, 'pdf'])->name('publicidade.pdf');
Route::post('/publicidade/save', [PubController::class, 'store'])->name('publicidade.save');


Route::get('/publicidade/edit/{id}', [PubController::class, 'edit'])->name('publicidade.edit');
Route::put('/publicidade/{id}', [PubController::class, 'update'])->name('publicidade.update');

Route::delete('/publicidade/delete/{id}',[PubController::class, 'destroy'])->name('publicidade.destroy');


Route::post('/ckeditor',[PubController::class, 'uploadimage'])->name('ckeditor.upload');


//Accouts
Route::get('/account/profile',[AccountController::class, 'profile'])->name('account.profile');
Route::get('/account/users',[AccountController::class, 'users'])->name('account.users');
Route::get('/account/list', [AccountController::class, 'paginacao'])->name('account.list');
Route::get('/account/register', [AccountController::class, 'create'])->name('account.create');

require __DIR__.'/auth.php';
