<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\VariantController;
use App\Http\Controllers\Admin\VariantOptionController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Resources\Admin\AuthResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/test',[TestController::class, 'test']);


Route::middleware('auth:sanctum')->group(function(){
    Route::put('/update-profile',[AuthController::class, 'update']);
    Route::put('/update-password',[AuthController::class, 'updatePassword']);
    Route::put('/update-thumb',[AuthController::class, 'updateThumb']);
    Route::apiResource('/variant-options',VariantOptionController::class);
    Route::apiResource('/categories',CategoryController::class);
    Route::apiResource('/brands',BrandController::class);
    Route::apiResource('/products',ProductController::class);
     Route::put('/products/{product}/rule',[ProductController::class, 'ruleUpdate']);

    Route::apiResource('/prices',PriceController::class);

    Route::apiResource('/warehouses',WarehouseController::class);

});

Route::apiResource('/variants',VariantController::class);



