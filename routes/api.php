<?php

use App\Http\Controllers\API\DisplayProductController;
use App\Http\Controllers\API\CategoryProductController;
use App\Http\Controllers\API\ProductController;

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

Route::resource('display', DisplayProductController::class);
Route::resource('category', CategoryProductController::class);
Route::resource('product', ProductController::class);
