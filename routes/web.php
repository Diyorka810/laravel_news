<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPostController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [UserController::class, 'showRegisterForm'])->name('user.register');
Route::post('/register', [UserController::class, 'register'])->name('user.register.store');
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('user.login.store');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');

Route::get('/', [UserPostController::class, 'index'])->name('userPost.index');
Route::group(['prefix' => '/posts', 'as' => 'userPost.', 'middleware' => 'auth'], function() {
    Route::get('/create', [UserPostController::class, 'create'])->name('create');
    Route::post('/', [UserPostController::class, 'store'])->name('store');
    Route::get('/{userPost}', [UserPostController::class, 'show'])->name('show');
    Route::get('/{userPost}/edit', [UserPostController::class, 'edit'])->name('edit');
    Route::put('/{userPost}', [UserPostController::class, 'update'])->name('update');
    Route::delete('/{userPost}', [UserPostController::class, 'destroy'])->middleware('is_admin')->name('destroy');
});

Route::get('/lang/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'ru'])) {
        session(['locale' => $lang]);
    }
    return redirect()->back();
})->name('lang.switch');