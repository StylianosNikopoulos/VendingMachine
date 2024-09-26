<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

//Public route create user
Route::post('/user', [UserController::class, 'store'])->name('createUser'); 

// Authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    // Routes for user
    Route::get('/user', [UserController::class, 'index'])->name('showUsers'); 
    Route::get('/user/{id}', [UserController::class, 'show'])->name('showAnUser'); 
    Route::put('/user/{id}', [UserController::class, 'update'])->name('updateUser'); 
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('deleteUser'); 
    
    // Routes for deposit amount
    Route::post('/deposit', [UserController::class, 'deposit'])->name('deposit'); 
    Route::get('/user-amount', [UserController::class, 'getUserAmount'])->name('user-amount'); 
    Route::post('/reset', [UserController::class, 'resetDeposit'])->name('reset');  
    
    // Routes for products
    Route::post('/product', [ProductController::class, 'store'])->name('addProduct');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('updateProduct'); 
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('deleteProduct'); 
});

// Public routes for products
Route::get('/products', [ProductController::class, 'index'])->name('showProducts'); 
Route::get('/products/{id}', [ProductController::class, 'show'])->name('showAProduct');




