<?php

use App\Http\Controllers\Admin\DistributorController;
use App\Http\Controllers\Auth\AuthController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController; 
use App\Http\Controllers\Admin\ProductController; 
use App\Http\Controllers\User\UserController; 
use App\Http\Controllers\Admin\FlashsaleController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\UserController as UserUserController;
use App\Http\Controllers\Admin\HistoryController;

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
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

    // Distributor Route
    Route::get('/distributor', [DistributorController::class, 'index'])->name('admin.distributor');
    Route::get('/distributor/create', [DistributorController::class, 'create'])->name('admin.distributor.create');
    Route::post('/distributor/store', [DistributorController::class, 'store'])->name('admin.distributor.store');
    Route::get('/distributor/detail/{id}', [DistributorController::class, 'detail'])->name('admin.distributor.detail');
    Route::get('/distributor/edit/{id}', [DistributorController::class, 'edit'])->name('admin.distributor.edit');
    Route::patch('/distributor/update/{id}', [DistributorController::class, 'update'])->name('admin.distributor.update');
    Route::delete('/distributor/delete/{id}', [DistributorController::class, 'delete'])->name('admin.distributor.delete');
    
    // Distributor Route Import/Eksport
    Route::post('/distributor/import', [DistributorController::class, 'import'])->name('distributor.import');
    Route::get('/distributor/export', [DistributorController::class, 'export'])->name('distributor.export');

    // Flashsale Route
    Route::get('/flashsale', [FlashsaleController::class, 'index'])->name('admin.flashsale');
    Route::get('/flashsale/create', [FlashSaleController::class, 'create'])->name('admin.flashsale.create');
    Route::post('/flashsale/store', [FlashSaleController::class, 'store'])->name('flashsale.store');
    Route::get('/flashsale/edit/{id}', [FlashSaleController::class, 'edit'])->name('flashsale.edit');
    Route::post('/flashsale/update{id}', [FlashsaleController::class, 'update'])->name('flashsale.update');
    Route::get('/flashsale/detail/{id}', [FlashsaleController::class, 'detail'])->name('flashsale.detail');
    Route::delete('/flashsale/delete/{id}', [FlashsaleController::class, 'delete'])->name('flashsale.delete');

    //Admin
    Route::resource('admin/users', AdminUserController::class);
    Route::get('/admins', [AdminController::class, 'index'])->name('admin.index'); // Menampilkan daftar admin
    Route::get('/admins/create', [AdminController::class, 'create'])->name('admin.create'); // Form tambah admin
    Route::post('/admins', [AdminController::class, 'store'])->name('admin.store'); // Simpan admin baru
    Route::get('/admins/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit'); // Form edit admin
    Route::put('/admins/{id}', [AdminController::class, 'update'])->name('admin.update'); // Update admin
    Route::delete('/admins/{id}', [AdminController::class, 'destroy'])->name('admin.destroy'); // Hapus admin
    Route::get('admin/{id}/detail', [AdminController::class, 'detail'])->name('admin.detail');
    // Route::get('/admins/detail/{id}', [AdminController::class, 'detail'])->name('admins.detail'); // Rute untuk detail
    //  Route::post('/admins/update{id}', [AdminController::class, 'update'])->name('admin.update');
    // // Route::delete('/admins/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');

    Route::get('/history', [HistoryController::class, 'index'])->name('admin.history');
    Route::get('/history/detail/{id}', [HistoryController::class, 'detail'])->name('history.detail');

    //User
    Route::get('admin/user', [AdminUserController::class, 'index'])->name('admin.user.index');

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
    
    // History
    Route::get('/user/history/{id}', [UserController::class, 'history'])->name('user.history');
})->middleware('web');
