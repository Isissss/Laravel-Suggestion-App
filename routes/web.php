<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'show'])->name('about');

// Posts
Route::resource('posts', PostController::class);

// User
Route::resource('users', UserController::class)->only('edit', 'update', 'show', 'destroy');

Route::middleware('auth')->group(function () {
    // Comments
    Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/posts/{comment}/comment/delete', [CommentController::class, 'destroy'])->name('comment.destroy');

    //Like
    Route::post('posts/{post}/like', [LikeController::class, 'likeHandler'])->name('like.handler');
});

// Admin
Route::group(['prefix' => 'admin', 'name' => 'admin.', 'middleware' => 'admin'], function () {
    Route::resource('categories', CategoryController::class);
    Route::patch('categories/{category}/update-visibility', [CategoryController::class, 'updateVisibility'])->name('category.update-visibility');

    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('users/{user}/update', [AdminUserController::class, 'update'])->name('admin.users.update');

    Route::get('posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
    Route::patch('posts/{post}/update', [AdminPostController::class, 'changeStatus'])->name('admin.posts.update');
});

Auth::routes();


