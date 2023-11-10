<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;  
use App\Http\Controllers\UserController;  
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RoomController;

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






Route::middleware('auth')->group(function () {
    
    Route::get('/config', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/config', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/config', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/posts/create', [PostController::class, 'create']);
    
    Route::get('/posts/myposts', [PostController::class, 'show_myposts']);
    
    Route::get('/posts/mybookmark', [PostController::class, 'show_mybookmark']);
    
    Route::get('/posts/{post}/edit', [PostController::class, 'edit']);
    
    Route::post('/posts/bookmark', [PostController::class, 'bookmark'])->name('posts.bookmark');
    
    Route::post('/posts', [PostController::class, 'store']);
    
    Route::put('/posts/{post}', [PostController::class, 'update']);
    
    Route::delete('/posts/{post}', [PostController::class,'delete']);
    
    Route::get('/users/edit', [UserController::class ,'edit']);
    
    Route::get('/users/{user}', [UserController::class ,'show']);
    
    Route::put('/users/{user}', [UserController::class, 'update']);
    
    Route::get('/DM',  [RoomController::class, 'index']);
    
    Route::get('/DM/{user}',  [RoomController::class, 'show']);
    
    Route::post('/DM/{user}',  [MessageController::class, 'store']);
});


Route::get('/posts', [PostController::class, 'index']);

Route::get('/posts/{post}', [PostController::class ,'show']);



Route::get('/', function () {
    return view('home');
    });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

require __DIR__.'/auth.php';




