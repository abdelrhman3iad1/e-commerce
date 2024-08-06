<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController as ApiProduct;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(ApiProduct::class)->middleware("api_auth")->group(function () {
    Route::get("/products", "all");
    Route::get("/products/{id}", "show");
    Route::post("/products", "store");
    Route::put("/products/{id}", "update");
    Route::delete("/products/{id}", "delete");
});

Route::controller(AuthController::class)->group(function () {
    Route::post("register", "register");
    Route::post("login","login");
    Route::post("logout","logout")->middleware("api_auth");
});
