<?php

use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

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

@include('backend.php');

Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {

    Route::controller(AuthController::class)->as('auth.')->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::get('/logout', 'logout')->name('logout');
        Route::post('/login', 'loginProcess')->name('login_process');
        Route::get('/signup', 'signup')->name('signup');
        Route::post('/signup', 'signupProcess')->name('signup_process');
        Route::get('forgot-password', 'forgotPassword')->name('forgot_password');
        Route::post('forgot-password', 'forgotPasswordProcess')->name('forgot_password_process');
    });

    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'home')->name('home');
        Route::get('listing', 'listing')->name('listing');
        Route::get('load-more', 'loadMore')->name('load.more');
    });

    Route::controller(ProductController::class)->prefix('product')->group(function () {
        Route::get('{slug}', 'detail')->name('detail');
        Route::get('/get/sizes', 'getSizes')->name('get.sizes');
        Route::post('add-to-cart', 'addToCart')->name('add-to-cart');
    });

    Route::controller(PageController::class)->prefix('page')->as('page.')->group(function () {
        Route::get('contact', 'contact')->name('contact');
        Route::post('contact', 'saveEnquiry')->name('save.enquiry');
        Route::get('term-service', 'termService')->name('term-service');
        Route::get('privacy', 'privacy')->name('privacy');
        Route::get('about', 'about')->name('about');
        Route::get('shipping-policy', 'shippingPolicy')->name('shipping-policy');
        Route::get('refund-return', 'refundReturn')->name('refund-return');
    });

    Route::get('/test', [OrderController::class, 'init']);

    Route::middleware(['auth:user'])->group(function () {

        Route::controller(UserController::class)->prefix('user')->as('user.')->group(function () {
            Route::post('add-to-wishlist', 'addToWishList')->name('add-to-wishList');
            Route::get('cart', 'cart')->name('cart');
            Route::delete('remove-item', 'removeItemFromCart')->name('remove-item');
            Route::delete('remove-item-wishlist', 'removeItemFromWishlist')->name('remove-item-wishlist');
            Route::delete('clear-cart', 'clearCart')->name('clear-cart');
            Route::get('wish-list', 'wishList')->name('wish-list');
            Route::get('profile', 'profile')->name('profile');
            Route::post('profile', 'updateProfile')->name('update-profile');
            Route::get('refer-a-friend', 'referAFriend')->name('refer-a-friend');
        });

        Route::controller(OrderController::class)->prefix('order')->as('order.')->group(function () {
            Route::get('/', 'index')->name('listing');
            Route::get('checkout', 'checkout')->name('checkout');
            Route::get('checkout-process', 'checkoutProcess')->name('checkout-process');
        });
    });
});