<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Admin\ProductController as ProductAdmin;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get("/home", [HomeController::class, "redirectTo"]);


Route::controller(ProductAdmin::class)->middleware("is_admin")->group(function () {
    Route::get("products/create", "create");
    Route::post("products/", "store")->name("store");
    Route::get("products/", "allProducts");
    Route::get("products/show/{id}", "show");
    Route::get("products/edit/{id}", "edit");
    Route::put("products/{id}", "update");
    Route::delete("products/{id}", "delete");

});

Route::get("change/{lang}", function ($lang) {
    if ($lang == "ar") {
        session()->put("lang", "ar");
    } else {
        session()->put("lang", "en");
    }
    return redirect()->back();
});

Route::controller(ProductController::class)->group(function () {
    Route::get("", "all");
    Route::get("show/{id}", "show");
    Route::get("search", "search");
    /*Route::post("addToCart/{id}", "addToCart");
    Route::get("mycart", "mycart");
    Route::post("makeOrder", "makeOrder");*/
});

Route::controller(CartController::class)->group(function () {
    Route::post("addToCart/{id}", "addToCart");
    Route::get("mycart", "mycart");
});

Route::controller(OrderController::class)->group(function () {
    Route::post("makeOrder", "makeOrder");
});