<?php

use App\Http\Controllers\MerchantController;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Route::get('/merchant', function () {
    //     return Inertia::render('Merchant');
    // })->name('merchant');

    // Route::get('/product', function () {
    //     return Inertia::render('Product');
    // })->name('product');

    Route::group(["prefix" => "merchants"], function () {
        Route::middleware(["admin"])->group(function() {
            Route::get("", [MerchantController::class, "index"])->name("merchant.get");
            Route::post("", [MerchantController::class, "store"])->name("merchant.create");
            Route::put("{uuid}", [MerchantController::class, "update"])->name("merchant.update");
            Route::delete("{uuid}", [MerchantController::class, "destroy"])->name("merchant.delete");
            Route::get("{uuid}", [MerchantController::class, "show"])->name("merchant.select");
            Route::post("{uuid}/register", [MerchantController::class, "register"])->name("merchant.register");
        });

        Route::group(["middleware" => "validmerchantuuid", "prefix" => "{merchant_uuid}/products"], function() {
            Route::get("", [ProductController::class, "index"])->name("product.get");
            Route::post("", [ProductController::class, "store"])->name("product.create");
            Route::put("{uuid}", [ProductController::class, "update"])->name("product.update");
            Route::delete("{uuid}", [ProductController::class, "destroy"])->name("product.delete");
            Route::get("{uuid}", [ProductController::class, "show"])->name("product.select");
        });
    });
});
