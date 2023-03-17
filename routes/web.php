<?php


use App\Http\Controllers\MainController as MainC;

use App\Http\Controllers\Auth\LoginController as LoginC;

use App\Http\Controllers\Admin\OrderController as OrderCA;
use App\Http\Controllers\Person\OrderController as OrderCP;
use App\Http\Controllers\BasketController as BasketC;

use App\Http\Controllers\Admin\CategoryController as CatC;
use App\Http\Controllers\Admin\ProductController as ProdC;
use App\Http\Controllers\Admin\PropertyController as PropC;
use App\Http\Controllers\Admin\PropertyOptionController as PropOpC;
use App\Http\Controllers\Admin\SkuController as SkuC;

use App\Http\Controllers\ResetController as ResetC;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Models\Category;

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



Route::middleware(['middleware' => 'set_locale'])->group(callback: function () {
    Auth::routes(['reset' => false, 'confirm' => false, 'verify' => false]);

    Route::get(uri: 'locale/{locale}', action: [MainC::class, 'changeLocale'])->name(name: 'locale');
    Route::get(uri: 'currency/{currencyCode}', action: [MainC::class, 'changeCurrency'])->name(name: 'currency');
    Route::get(uri: 'reset', action: [ResetC::class, 'reset'])->name(name: 'reset');
    Route::get(uri: '/logout', action: [LoginC::class, 'logout'])->name(name: 'get-logout');

//    Route::middleware(['middleware' => 'auth'])->group(callback: function () {
        Route::group(
            attributes: ['prefix' => 'person/orders', 'as' => 'person.'],
            routes: function () {
            Route::get(uri: '/', action: [OrderCP::class, 'index'])->name(name: 'orders.index');
            Route::get(uri: '/{order}', action: [OrderCP::class, 'show'])->name(name: 'orders.show');
        });

        Route::group(
            attributes: ['prefix' => 'admin'],
            routes: function () {
            Route::group(
                attributes: ['middleware' => 'is_admin', 'prefix' => 'orders'],
                routes: function () {
                Route::get(uri: '/', action: [OrderCA::class, 'index'])->name(name: 'home');
                Route::get(uri: '/{order}', action: [OrderCA::class, 'show'])->name(name: 'orders.show');
            });

            Route::resource(name: 'categories', controller: CatC::class);
            Route::resource(name: 'products', controller: ProdC::class);
            Route::resource(name: 'products/{product}/skus', controller: SkuC::class);
            Route::resource(name: 'properties', controller: PropC::class);
            Route::resource(name: 'properties/{property}/property-options', controller: PropOpC::class);
        });
//    });

    Route::get(uri: '/', action: [MainC::class, 'index'])->name(name: 'index');
    Route::get(uri: '/categories', action: [MainC::class, 'categories'])->name(name: 'categories');
    Route::post(uri: 'subscription/{product}', action: [MainC::class, 'subscribe'])->name(name: 'subscription');

    Route::group(
        attributes: ['prefix' => 'basket'],
        routes: function () {
        Route::post(uri: '/add/{product}', action: [BasketC::class, 'basketAdd'])->name(name: 'basket-add');

        Route::group(
            attributes: ['middleware' => 'basket_not_empty'],
            routes: function () {
            Route::get(uri: '/', action: [BasketC::class, 'basket'])->name(name: 'basket');
            Route::get(uri: '/place', action: [BasketC::class, 'basketPlace'])->name(name: 'basket-place');
            Route::post(uri: '/remove/{product}', action:[BasketC::class, 'basketRemove'])->name(name: 'basket-remove');
            Route::post(uri: '/place', action: [BasketC::class, 'basketConfirm'])->name(name: 'basket-confirm');
        });
    });

    Route::get(uri: '/{category}', action: [MainC::class, 'category'])->name(name: 'category');
    Route::get(uri: '/{category?}/{product?}', action: [MainC::class, 'product'])->name(name: 'product');
});
