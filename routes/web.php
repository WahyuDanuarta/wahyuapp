<?php

use App\Http\Controllers\Admin\DistributorController;
use App\Http\Controllers\Auth\AuthController; 
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Admin\AdminController; 
use App\Http\Controllers\Admin\ProductController; 
use App\Http\Controllers\User\UserController; 
use App\Http\Controllers\Admin\FlashsaleController;

// Guest Route 
Route::group(['middleware' => 'guest'], function() { 
    Route::get('/', function () { 
        return view('welcome'); 
    }); 
 
    Route::get('/register', [AuthController::class, 'register'])->name('register'); 
    Route::post('/post-register', [AuthController::class, 'post_register'])->name('post.register'); 
 
    Route::post('/post-login', [AuthController::class, 'login']); 
})->middleware('guest'); 
 
// Admin Route 
Route::group(['middleware' => 'admin'], function() { 
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard'); 

    // Product Route 
    Route::get('/product', [ProductController::class, 'index'])->name('admin.product');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/admin/product/detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

    // Distributor Route
    Route::get('/distributor', [DistributorController::class, 'index'])->name('admin.distributor');
    Route::get('/distributor/create', [DistributorController::class, 'create'])->name('admin.distributor.create');
    Route::post('/distributor/store', [DistributorController::class, 'store'])->name('admin.distributor.store');
    Route::get('/distributor/detail/{id}', [DistributorController::class, 'detail'])->name('admin.distributor.detail');
    Route::get('/distributor/edit/{id}', [DistributorController::class, 'edit'])->name('admin.distributor.edit');
    Route::patch('/distributor/update/{id}', [DistributorController::class, 'update'])->name('admin.distributor.update');
    Route::delete('/distributor/delete/{id}', [DistributorController::class, 'delete'])->name('admin.distributor.delete');

    // Flashsale Route
    Route::get('/flashsale', [FlashsaleController::class, 'index'])->name('admin.flashsale');
    Route::get('/flashsale/create', [FlashSaleController::class, 'create'])->name('admin.flashsale.create');
    Route::post('/flashsale/store', [FlashSaleController::class, 'store'])->name('flashsale.store');
    Route::get('/flashsale/edit/{id}', [FlashSaleController::class, 'edit'])->name('flashsale.edit');
    Route::post('/flashsale/update{id}', [FlashsaleController::class, 'update'])->name('flashsale.update');
    Route::get('/flashsale/detail/{id}', [FlashsaleController::class, 'detail'])->name('flashsale.detail');
    Route::delete('/flashsale/delete/{id}', [FlashsaleController::class, 'delete'])->name('flashsale.delete');

    // Route::delete('/flashsale/delete/{id}', [FlashsaleController::class, 'delete'])->name('flashsale.delete');
    // Route::delete('/flashsale/delete/{id}', [FlashsaleController::class, 'destroy'])->name('flashsale.delete');


    Route::get('/admin-logout', [AuthController::class, 'admin_logout'])->name('admin.logout'); 
})->middleware('admin'); 
    
// User Route 
Route::group(['middleware' => 'web'], function() { 
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard'); 
    Route::get('/user/product/detail/{id}', [UserController::class, 'detail_product'])->name('user.detail.product');
    Route::get('/product/purchase/{productId}/{userId}', [UserController::class, 'purchase']);
    Route::get('/user-logout', [AuthController::class, 'user_logout'])->name('user.logout');     
    Route::get('/user/flashsale/detailFlash/{flashId}', [UserController::class, 'detail_flashsale'])->name('user.detailFlash.flashsale');
    Route::get('/flashsale/purchaseCash/{flashId}/{userId}', [UserController::class, 'purchaseCash']);
    
})->middleware('web');
