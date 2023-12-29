<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
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


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/dashboard-user', [App\Http\Controllers\HomeController::class, 'dashboardUser'])->name('dashboard.user')->middleware('verified');
Auth::routes(['verify' => true]);



Route::prefix('/admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login_form'])->name('admin.login_form');
    Route::post('/login/owner', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('admin');
    Route::get('/users', [UserController::class, 'index'])->name('admin.tables.users')->middleware('admin');
    Route::get('/contact', [ContactController::class, 'index'])->name('admin.tables.contact')->middleware('admin');
    Route::get('/categories', [CategoriesController::class, 'index'])->name('admin.tables.categories')->middleware('admin');
    Route::get('/products', [ProductsController::class, 'index'])->name('admin.tables.products')->middleware('admin');
    Route::get('/blogs', [BlogsController::class, 'index'])->name('admin.tables.blogs')->middleware('admin');
});

// Site Route
Route::prefix('/')->group(function () {
    Route::get('/', [SiteController::class, 'home'])->name('site.home');
    Route::get('/product-details/{id}', [SiteController::class, 'product_details'])->name('site.product.details');
    Route::get('/cart', [SiteController::class, 'cart'])->name('site.cart')->middleware('auth', 'verified');
    Route::get('/blog', [SiteController::class, 'blog'])->name('site.blog');
    Route::get('/checkout', [SiteController::class, 'checkout'])->name('site.checkout')->middleware('auth', 'verified');
    Route::get('/contact', [SiteController::class, 'contact'])->name('site.contact');
    Route::get('/blog-details/{id}', [BlogsController::class, 'show'])->name('site.blog.details');
    Route::get('/shop', [SiteController::class, 'shop'])->name('site.shop');
    Route::get('/404', [SiteController::class, 'error_404'])->name('site.error.404');
    Route::get('/500', [SiteController::class, 'error_500'])->name('site.error.500');
    Route::post('/cart/store', [CartController::class, 'store'])->name('site.cart.store')->middleware('auth', 'verified');
    Route::get('/category/{id}', [CategoriesController::class, 'show'])->name('site.category');
    Route::post('/comment/{blog_id}', [CommentsController::class, 'store'])->name('site.comment.add');
    Route::get('/confirm/{token}', 'ConfirmationController@confirm');
});

// Social Login By Google
Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

// Social Login By Facebook
Route::controller(FacebookController::class)->group(function(){
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback');
});