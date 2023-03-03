<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\OrderController as OrderCA;
use App\Http\Controllers\Person\OrderController as OrderCP;
use App\Http\Controllers\Admin\CategoryController as CategoryCA;
use App\Http\Controllers\Admin\ProductController as ProductCA;
use App\Http\Controllers\ResetController as ResetC;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Http\Controllers\BasketController as BasketC;

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


Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false,
]);

Route::get(uri: 'reset', action: [ResetC::class, 'reset'])->name(name: 'reset');

Route::get(uri: '/logout', action: [LoginController::class, 'logout'])->name(name: 'get-logout');

Route::middleware(['middleware' => 'auth'])->group(callback: function () {
    Route::group(
        attributes: [
            'prefix' => 'person',
            'as' => 'person.'
        ],
        routes: function () {
            Route::get(uri: '/orders', action: [OrderCP::class, 'index'])->name(name: 'orders.index');
            Route::get(uri: '/orders/{order}', action: [OrderCP::class, 'show'])->name(name: 'orders.show');
    });

    Route::group(
        attributes: [
            'prefix' => 'admin'
        ],
        routes: function () {
            Route::group(
                attributes: ['middleware' => 'is_admin'],
                routes: function () {
                    Route::get(uri: '/orders', action: [OrderCA::class, 'index'])->name(name: 'home');
                    Route::get(uri: '/orders/{order}', action: [OrderCA::class, 'show'])->name(name: 'orders.show');
            });

            Route::resource(name: 'categories', controller: CategoryCA::class);
            Route::resource(name: 'products', controller: ProductCA::class);
    });
});

Route::get(uri: '/', action: [MainController::class, 'index'])->name(name: 'index');
Route::get(uri: '/categories', action: [MainController::class, 'categories'])->name(name: 'categories');
Route::post(uri: 'subscription/{product}', action: [MainController::class, 'subscribe'])->name(name: 'subscription');


Route::group(
    attributes: ['prefix' => 'basket'],
    routes: function () {
    Route::post(uri: '/add/{product}', action: [BasketC::class, 'basketAdd'])->name(name: 'basket-add');

    Route::group(
        attributes: ['middleware' => 'basket_not_empty'],
        routes: function () {
        Route::get(uri: '/', action: [BasketC::class, 'basket'])->name(name: 'basket');
        Route::get(uri: '/place', action: [BasketC::class, 'basketPlace'])->name(name: 'basket-place');
        Route::post(uri: '/remove/{product}', action: [BasketC::class, 'basketRemove'])->name(name: 'basket-remove');
        Route::post(uri: '/place', action: [BasketC::class, 'basketConfirm'])->name(name: 'basket-confirm');
    });
});

Route::get(uri: '/{category}', action: [MainController::class, 'category'])->name(name: 'category');
Route::get(uri: '/{category?}/{product?}', action: [MainController::class, 'product'])->name(name: 'product');
