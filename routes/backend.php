<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductTypeController;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\OrderDetailController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\UserController;
use App\Models\ProductVariant;

Route::group(['prefix' => 'control', 'namespace' => 'Backend', 'as' => 'backend.'], function () {


    Route::controller(AuthController::class)->group(function () {
        Route::get('/', 'showLoginForm')->name('show_login_form');
        Route::post('/', 'loginProcess')->name('login_process');
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [HomeController::class, 'home'])->name('home');

        Route::controller(AdminController::class)->prefix('admin')->as('admin.')->group(function () {
            Route::get('/create',  'create')->name('add');
            Route::post('/store',  'store')->name('store');
            Route::get('/{id}/show', 'show')->name('show');
            Route::post('/{id}', 'edit')->name('edit');
            Route::delete('/{id}/delete', 'destroy')->name('delete');
            Route::get('/', 'index')->name('listing');
        });

        Route::resource('product', ProductController::class);
        Route::get('/get-product-variants', [ProductController::class, 'getProductVariants'])->name('product.variant');
        Route::get('/get-products', [ProductController::class, 'getProducts'])->name('get.product');
        Route::post('upload-image', [ProductController::class, 'uploadImage'])->name('upload.product.image');
        Route::post('add-product-color', [ProductController::class, 'addColor'])->name('add.product.color');
        Route::get('delete-image', [ProductController::class, 'destroyImage'])->name('delete.product.image');
        Route::get('delete-color', [ProductController::class, 'destroyColor'])->name('delete.product.color');

        Route::get('product/{product_id}/variant', [ProductVariantController::class, 'index'])->name('variant.index');
        Route::get('product/{product_id}/variant/add', [ProductVariantController::class, 'create'])->name('variant.create');
        Route::post('product/{product_id}/variant/store', [ProductVariantController::class, 'store'])->name('variant.store');
        Route::post('product/{product_id}/variant/{variant_id}/update', [ProductVariantController::class, 'update'])->name('variant.update');
        Route::get('product/{product_id}/variant/{variant_id}/edit', [ProductVariantController::class, 'edit'])->name('variant.edit');
        Route::delete('product/{product_id}/variant/{variant_id}/destroy', [ProductVariantController::class, 'destroy'])->name('variant.destroy');

        Route::get('/variant/get-varints', [ProductVariantController::class, 'getVariants'])->name('product.get.variant');

        Route::resource('user', UserController::class);
        Route::resource('order', OrderController::class);
        Route::resource('order-detail', OrderDetail::class);

        Route::get('/get-user', [UserController::class, 'getUser'])->name('get-users');

        Route::prefix('location')->group(function () {
            Route::resource('city', CityController::class);
            Route::resource('state', StateController::class);
            Route::resource('country', CountryController::class);
            Route::get('get-states', [StateController::class, 'getState'])->name('get.states');
            Route::get('get-cities', [CityController::class, 'getCity'])->name('get.city');
        });

        Route::prefix('master')->group(function () {
            Route::resource('color', ColorController::class);
            Route::get('get-color', [ColorController::class, 'getColor'])->name('get.color');
            Route::resource('size', SizeController::class);
            Route::get('get-size', [SizeController::class, 'getSize'])->name('get.size');
            Route::resource('product-type', ProductTypeController::class);
            Route::get('get-product-type', [ProductTypeController::class, 'getProductType'])->name('get.product.type');
        });

        Route::controller(OrderDetailController::class)->prefix('order-detail')->as('order-detail.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{order_item_id}/show', 'show')->name('show');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::put('/{order_item_id}/update', 'update')->name('update');
        });
    });
});
