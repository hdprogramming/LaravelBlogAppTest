<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImgUploadController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // GET Routes
    Route::get('/userposts', [PostsController::class, 'index'])->name('userposts');
    Route::get('/getposts', [PostsController::class, 'index'])->name('posts.all');
    Route::get('/postview', [PostsController::class, 'viewpost'])->name('postview');
    // POST Routes
    Route::post('/userposts', [PostsController::class, 'search'])->name('posts.search');
    Route::post('/addpost', [PostsController::class, 'store'])->name('posts.add');
    Route::post('/updpost', [PostsController::class, 'update'])->name('posts.update');
    Route::post('/delpost', [PostsController::class, 'deletepost'])->name('posts.delete');
    Route::post('/savepost', [PostsController::class, 'savepost'])->name('posts.save');
    Route::post('/uploadimage', [PostsController::class, 'uploadimage'])->name('posts.uploadimage');
   
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
