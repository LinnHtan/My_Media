<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrendPostController;
use App\Models\Category;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    //admin
    Route::get('dashboard',[ProfileController::class,'index'])->name('dashboard');
    Route::post('admin/update',[ProfileController::class,'updateAdminAccount'])->name('admin#update');
    Route::get('admin/changePasswordPage',[ProfileController::class,'changeAdminPasswordPage'])->name('admin#changePasswordPage');
    Route::post('admin/changePassword',[ProfileController::class,'changeAdminPassword'])->name('admin#changePassword');

    //admin list
    Route::get('admin/list',[ListController::class,'index'])->name('admin#list');
    Route::get('admin/delete/{id}',[ListController::class,'deleteAccount'])->name('admin#deleteAccount');
    Route::post('admin/list',[ListController::class,'adminListSearch'])->name('admin#listSearch');

    //category
    Route::get('category',[CategoryController::class,'index'])->name("admin#category");
    Route::post('category/create',[CategoryController::class,'createCategory'])->name('admin#createCategory');
    Route::get('category/delete/{id}',[CategoryController::class,'deleteCategory'])->name('admin#deleteCategory');
    Route::post('category',[CategoryController::class,'categorySearch'])->name('admin#categorySearch');
    Route::get('category/editPage/{id}',[CategoryController::class,'editCategory'])->name('admin#categoryEditPage');
    Route::post('category/update/{id}',[CategoryController::class,'categoryUpdate'])->name('admin#categoryUpdate');

    //post
    Route::get('post',[PostController::class,'index'])->name('admin#post');
    Route::post('admin/createPost',[PostController::class,'createPost'])->name('admin#createPost');
    Route::get('admin/deletePost/{id}',[PostController::class,'deletePost'])->name('admin#deletePost');
    Route::get('admin/update/{id}',[PostController::class,'postUpdatePage'])->name('admin#postUpdatePage');
    Route::post('admin/updatePost/{id}',[PostController::class,'updatePost'])->name('admin#updatePost');

    //trend post
    Route::get('trendPost',[TrendPostController::class,'index'])->name('admin#trendPost');
    Route::get('trendPost/details/{id}',[TrendPostController::class,'trendPostDetails'])->name('admin#trendPostDetails');
});
