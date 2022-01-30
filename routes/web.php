<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;


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

Route::group(['middleware' => ['auth']], function () {
    //「ajaxlike.jsファイルのurl:'ルーティング'」に書くものと合わせる。
    Route::post('/ajaxlike', [LikeController::class , 'ajaxlike'])->name('posts.ajaxlike');
});

Route::get('/', function () {
    return view('user.welcome');
});

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::post('', [LikeController::class, 'like_post']);

// 一時停止
// Route::get('/posts/{post_id}/likes', [LikeController::class, 'store'])->name('likes.store');

// Route::get('/likes/{post_id}', [LikeController::class, 'destroy'])->name('likes.destroy');

Route::post('/posts/{post_id}/comments', [CommentController::class, 'store'])->middleware(['auth'])->name('comments.store');

Route::delete('/comments/{comment_id}', [CommentController::class, 'destroy'])->middleware(['auth'])->name('comments.destroy');

Route::resource('posts', PostController::class)->middleware(['auth'])->except('show');

Route::resource('users', UserController::class)->only([
    'show', 'edit', 'update', 'destroy'
]);




require __DIR__.'/auth.php';

