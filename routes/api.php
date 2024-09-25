<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

//Public route create user
Route::post('/user', [UserController::class, 'store']); 

// Authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    // Routes for user
    Route::get('/user', [UserController::class, 'index']); 
    Route::get('/user/{id}', [UserController::class, 'show']); 
    Route::put('/user/{id}', [UserController::class, 'update']); 
    Route::delete('/user/{id}', [UserController::class, 'destroy']); 
    
    // Routes for deposit amount
    Route::post('/deposit', [UserController::class, 'deposit']); 
    Route::get('/user-amount', [UserController::class, 'getUserAmount']); 
    Route::post('/reset', [UserController::class, 'resetDeposit']);
    
    // Routes for products
    Route::post('/product', [ProductController::class, 'store']); 
    Route::put('/product/{id}', [ProductController::class, 'update']); 
    Route::delete('/product/{id}', [ProductController::class, 'destroy']); 
});

// Public routes for products
Route::get('/products', [ProductController::class, 'index']); 
Route::get('/products/{id}', [ProductController::class, 'show']); 




