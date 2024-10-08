<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [PostController::class, 'show'])->name('blog.show');

Route::prefix('/dashboard')->group(function () {
    Route::get('/', [UserPostController::class, 'dashboard'])->name('dashboard');

    // Post links
    Route::resource('/post', UserPostController::class)->names('user.post');

    // Profile links
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
})->middleware(['auth']);


// Comment
Route::resource('/comment', CommentController::class)
    ->only(['store', 'destroy'])
    ->middleware('auth');


require __DIR__ . '/auth.php';
