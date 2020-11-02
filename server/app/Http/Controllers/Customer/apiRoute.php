<?php

use App\Http\Controllers\Customer\AuthController;
use App\Http\Controllers\Customer\BrandController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CategoryController;
use App\Http\Controllers\Customer\PriceController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Resources\Admin\AuthResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Admin\TestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return new AuthResource($request->user());
});

Route::post('/login',[AuthController::class, 'login']);
Route::post('/register',[AuthController::class, 'register']);



Route::get('/categories',[CategoryController::class, 'index']);
Route::get('/categories/{category}',[CategoryController::class, 'show']);
Route::get('/brands',[BrandController::class, 'index']);
Route::get('/products',[ProductController::class,'index']);







Route::middleware('auth:sanctum')->group(function(){
    Route::put('/update-profile',[AuthController::class, 'update']);
    Route::put('/update-password',[AuthController::class, 'updatePassword']);
    Route::put('/update-thumb',[AuthController::class, 'updateThumb']);



// cart
Route::apiResource('/carts',CartController::class);
    // Route::get('/carts',[CartController::class,'index']);
    // Route::Post('/carts',[CartController::class,'store']);
    // Route::Put('/carts/{cart}',[CartController::class,'update']);






});
