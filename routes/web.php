<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


Route::get('/', [AuthenticatedSessionController::class, 'create'])->middleware('guest');

Route::group(['as'=>'app.','prefix'=>'app','namespace'=>'Backend','middleware'=>['auth','verified']],function(){
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::group(['as'=>'post.','prefix'=>'post'],function(){

        Route::group(['as'=>'category.','prefix'=>'category'],function(){

            Route::get('index',[CategoryController::class,'index'])->name('index');
            Route::get('create',[CategoryController::class,'create'])->name('create');
            Route::post('store',[CategoryController::class,'store'])->name('store');
            Route::get('/{id}/edit',[CategoryController::class,'edit'])->name('edit');
            Route::put('/{id}/update',[CategoryController::class,'update'])->name('update');
            Route::post('/{id}/delete',[CategoryController::class,'destroy'])->name('delete');

        });

        Route::group(['as'=>'tag.','prefix'=>'tag'],function(){

            Route::get('index',[TagController::class,'index'])->name('index');
            Route::get('create',[TagController::class,'create'])->name('create');
            Route::post('store',[TagController::class,'store'])->name('store');
            Route::get('/{id}/edit',[TagController::class,'edit'])->name('edit');
            Route::put('/{id}/update',[TagController::class,'update'])->name('update');
            Route::post('/{id}/delete',[TagController::class,'destroy'])->name('delete');

        });

        Route::group(['as'=>'post.','prefix'=>'post'],function(){

            Route::get('index',[PostController::class,'index'])->name('index');
            Route::get('create',[PostController::class,'create'])->name('create');
            Route::post('store',[PostController::class,'store'])->name('store');
            Route::get('/{id}/edit',[PostController::class,'edit'])->name('edit');
            Route::put('/{id}/update',[PostController::class,'update'])->name('update');
            Route::post('/{id}/delete',[PostController::class,'destroy'])->name('delete');

            //ajax route
            Route::get('/show/{id}',[PostController::class,'show']);

        });

    });


});

require __DIR__.'/auth.php';
