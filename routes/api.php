<?php

use App\Http\Controllers\Api\Merchant\CreateMerchantController;
use App\Http\Controllers\Api\Merchant\GetMerchantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post("/auth/login", [AuthController::class, 'login'])->name("api.auth.login");

Route::middleware(["auth:sanctum"])->group(function() {
    Route::group(["prefix" => "merchants"], function () {
        Route::middleware(["admin"])->group(function() {
            Route::get("", GetMerchantController::class)->name("api.merchant.get");
            Route::post("", CreateMerchantController::class)->name("api.merchant.create");
            // Route::put("{uuid}", [MerchantController::class, "update"])->name("api.merchant.update");
            // Route::delete("{uuid}", [MerchantController::class, "destroy"])->name("api.merchant.delete");
            // Route::get("{uuid}", [MerchantController::class, "show"])->name("api.merchant.select");
        });

        // Route::group(["middleware" => "validmerchantuuid", "prefix" => "{merchant_uuid}/products"], function() {
        //     Route::get("", [ProductController::class, "index"])->name("product.get");
        //     Route::post("", [ProductController::class, "store"])->name("product.create");
        //     Route::put("{uuid}", [ProductController::class, "update"])->name("product.update");
        //     Route::delete("{uuid}", [ProductController::class, "destroy"])->name("product.delete");
        //     Route::get("{uuid}", [ProductController::class, "show"])->name("product.select");
        // });
    });
});
