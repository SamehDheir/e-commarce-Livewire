<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



Route::prefix('/admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login_form'])->name('admin.login_form');
    Route::post('/login/owner', [AdminController::class, 'login'])->name('admin.login');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('admin');
    Route::get('/contact', [ContactController::class, 'index'])->name('admin.contact')->middleware('admin');
});

// Site Route
Route::prefix('/')->group(function () {
    Route::get('/', [SiteController::class, 'home'])->name('site.home');
    Route::get('/cart', [SiteController::class, 'cart'])->name('site.cart');
    Route::get('/blog', [SiteController::class, 'blog'])->name('site.blog');
    Route::get('/checkout', [SiteController::class, 'checkout'])->name('site.checkout');
    Route::get('/contact', [SiteController::class, 'contact'])->name('site.contact');
    Route::get('/blog_details', [SiteController::class, 'blog_details'])->name('site.blog_details');
    Route::get('/shop_details', [SiteController::class, 'shop_details'])->name('site.blog_details');
    Route::get('/404', [SiteController::class, 'error_404'])->name('site.error_404');
    Route::get('/500', [SiteController::class, 'error_500'])->name('site.error_500');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
