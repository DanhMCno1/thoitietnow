<?php

use App\Http\Controllers\DailyWeatherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\SignInController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Middleware\AdminMiddleware;


Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin', function () {
        return view('admins.products.index');
    });

    Route::get('admin/posts', [PostsController::class, 'index'])->name('admin.posts.index');
    Route::get('admin/posts/create', [PostsController::class, 'create'])->name('admin.posts.create');
    Route::post('admin/posts/store', [PostsController::class, 'store'])->name('admin.posts.store');
    Route::get('admin/posts/edit/{slug}', [PostsController::class, 'edit'])->name('admin.posts.edit');
    Route::put('admin/posts/{slug}', [PostsController::class, 'update'])->name('admin.posts.update');
    Route::delete('admin/posts/{id}', [PostsController::class, 'destroy'])->name('admin.posts.destroy');


});
Route::get('/admin/signin', [SignInController::class, 'create'])->name('admin.signin');
Route::post('/admin/signin', [SignInController::class, 'store'])->name('admin.signin.store');
Route::post('admin/logout', [SigninController::class, 'logout'])->name('admin.logout');

Route::get('/', [HomeController::class, 'index']);

Route::get('/daily-weather', [DailyWeatherController::class, 'index'])->name('daily.weather');
Route::get('post/{slug}', [DailyWeatherController::class, 'show'])->name('post.show');
