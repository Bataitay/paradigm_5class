<?php

use App\Http\Controllers\ProductController;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\Product\ProductServiceInterface;
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
    return $request->user();
});
Route::get('/index', [ProductController::class,'index']);
Route::post('/store', [ProductController::class,'store']);
Route::get('/show/{id}', [ProductController::class,'show']);
Route::put('/update/{id}', [ProductController::class,'update']);
Route::delete('/destroy/{id}', [ProductController::class,'destroy']);

Route::get('getall', function(ProductServiceInterface $productService){
    return $productService->find(5);
});
