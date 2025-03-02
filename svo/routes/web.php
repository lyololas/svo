<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CharityController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
Route::redirect('/', '/dashboard');



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/charity', [CharityController::class, 'index'])->name('charity.index');
Route::get('/charity/{charity}', [CharityController::class, 'show'])->name('charity.show');
Route::post('/charity/{charity}/donate', [DonationController::class, 'store'])
    ->name('charity.donate');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::middleware('auth')->group(function () {
    Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
    Route::post('/posts/{post}/comments', [PostController::class, 'storeComment'])->name('posts.comment.store');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::post('/shop/purchase', [ShopController::class, 'purchase'])->name('shop.purchase');

Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
Route::get('/quizzes/{quiz}/take', [QuizController::class, 'take'])->name('quizzes.take');
Route::post('/quizzes/{quiz}/complete', [QuizController::class, 'complete'])->name('quizzes.complete');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
    Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');
});


Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::post('/news/{news}/like', [NewsController::class, 'like'])->name('news.like');


Route::get('/history', [HistoryController::class, 'index'])->name('history');
require __DIR__.'/auth.php';
require __DIR__.'/settings.php';