<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RaveController;
use App\Http\Controllers\SigninWithSocialController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use function Composer\Autoload\includeFile;

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


Route::get('/', [PageController::class, 'index']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/blog', [PageController::class, 'blog']);
Route::get('/blog/{slug}', [PageController::class, 'blogDetail']);
Route::get('/gallery', [PageController::class, 'gallery']);
Route::get('/videos', [PageController::class, 'videos']);
Route::get('/store', [PageController::class, 'store']);
Route::get('/store-search', [PageController::class, 'storesearch']);
Route::get('/contact', [PageController::class, 'contact']);
Route::get('/login', [PageController::class, 'login']);
Route::get('/signup', [PageController::class, 'signup']);
Route::get('/forgot-password', [PageController::class, 'forgotPassword']);
Route::get('/my-account/login', [PageController::class, 'login']);
Route::get('/privacy-policy', [PageController::class, 'privacy']);
Route::get('/my-books', [PageController::class, 'account']);
Route::get('/account', [PageController::class, 'account']);

// -----------------------------------------------------------------

Route::get('/admin/login', [PageController::class, 'adminLogin']);

Route::get('auth/google', [SigninWithSocialController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SigninWithSocialController::class, 'handleGoogleCallback']);

Route::get('/setSession/Admin/{token}', [AdminController::class, 'setSession']);
Route::get('/setSession/User/{token}', [UserController::class, 'setSession']);

// ---------------------------------------------------------------------

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/dashboard', [AdminController::class, 'index']);
Route::get('/admin/profile', [AdminController::class, 'profile']);
Route::get('/admin/users', [AdminController::class, 'users']);
Route::get('/admin/settings', [AdminController::class, 'settings']);
Route::get('/admin/admins', [AdminController::class, 'admins']);
Route::get('/admin/gallery', [AdminController::class, 'gallery']);
Route::get('/admin/adverts', [AdminController::class, 'adverts']);
Route::get('/admin/books', [AdminController::class, 'books']);
Route::get('/admin/blog', [AdminController::class, 'blog']);
Route::get('/admin/videos', [AdminController::class, 'videos']);
Route::get('/admin/blog-topics', [AdminController::class, 'blogTopic']);


Route::get('/admin/logout', [AdminController::class, 'logout']);
// Route::get('/user/logout', [UserController::class, 'logout']);
// ---------------------------------------------------------------------------

// --------------------------------------------------------------------
Route::get('/payment/redirect/registration', [PageController::class, 'paymentRedirectReg']);
Route::get('/payment/redirect', [PageController::class, 'paymentRedirect']);
Route::post('/proceedPaymemt', [RaveController::class, 'processPayment']);

// --------------------------------------------------------------------


Route::get('checkout', [PageController::class, 'checkout'])->name('checkout');
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('cart-remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('cart-clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
