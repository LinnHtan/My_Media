<?php

use App\Http\Controllers\Api\ActionLogController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\CategoryController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/login',[AuthController::class,'login'])->name('Login');
Route::post('user/register',[AuthController::class,'register']);



Route::get('category',[AuthController::class,'category'])->middleware('auth:sanctum');
//post
Route::get('allPostList',[PostController::class,'getAllPost']);
Route::post('post/search',[PostController::class,'postSearch']);
Route::post('post/details',[PostController::class,'postDetails']);


//category
Route::get('allCategory',[CategoryController::class,'getAllCategory']);
Route::post('category/search',[CategoryController::class,'categorySearch']);


//action log
Route::post('post/actionLog',[ActionLogController::class,'setActionLog']);


