<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\TestController;
use App\Http\Controllers\backend\ProductsController;
use App\Http\Controllers\backend\MyDashboardController;

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

Route::get('/my-dashboard', [MyDashboardController::class, 'index'])->name('my-dashboard')->middleware(['auth','verified']);
Route::group(['prefix'=>'/my-dashboard', 'as'=> 'my-dashboard','middleware'=>['auth','verified']],function(){
    Route::group(['as'=>'.products.'], function(){
        Route::get('/all-products', [ProductsController::class, 'index'])->name('index');
        Route::get('/create-product', [ProductsController::class, 'create'])->name('create');
        Route::post('/store-product', [ProductsController::class, 'store'])->name('store');
        Route::get('/edit-product/{id}', [ProductsController::class,'edit'])->name('edit');
        Route::put('/update-product', [ProductsController::class,'update'])->name('update');
        Route::delete('/delete-product/{id}', [ProductsController::class,'destroy'])->name('destroy');
        //delete, put, patch -->post
    });
});  
// Route::get('/', function(){
//     return view('welcome');
// });
Route::get('/',[MyDashboardController::class,'welcome']);

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
