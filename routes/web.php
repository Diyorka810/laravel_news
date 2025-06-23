<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [UserController::class, 'showRegisterForm'])->name('user.register');
Route::post('/register', [UserController::class, 'register'])->name('user.register.store');
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('user.login.store');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');

Route::get('/', [PostController::class, 'index'])->name('post.index');
Route::group(['prefix' => '/posts', 'as' => 'post.', 'middleware' => 'auth'], function() {
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/', [PostController::class, 'store'])->name('store');
    Route::get('/{post}', [PostController::class, 'show'])->name('show');
    Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
    Route::put('/{post}', [PostController::class, 'update'])->name('update');
    Route::delete('/{post}', [PostController::class, 'destroy'])->middleware('is_admin')->name('destroy');
});

Route::get('/lang/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'ru'])) {
        session(['locale' => $lang]);
    }
    return redirect()->back();
})->name('lang.switch');