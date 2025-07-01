<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/user', function (Request $request){
    return $request->user();
})->middleware('auth:sanctum');

//login
Route::post('/login', [AuthController::class,'login']);

//logout
Route::post('/logout', [AuthController::class,'logout'])->middleware('auth:sanctum');

//product
Route::resource('api-product', ProductController::class)->middleware('auth:sanctum');

//categories
Route::resource('api-categories', CategoryController::class)->middleware('auth:sanctum');


