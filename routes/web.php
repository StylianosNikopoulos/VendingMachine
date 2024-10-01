<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authenticated routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
  
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Deposit-related routes
    Route::get('/deposit', [UserController::class, 'showDepositForm'])->name('Buyers.deposit');
    Route::post('/deposit', [UserController::class, 'deposit'])->name('deposit'); 
    Route::post('/reset', [UserController::class, 'resetDeposit'])->name('resetDeposit');
    
    // Buying products
    Route::get('/buy', [UserController::class, 'buyProducts'])->name('Buyers.buyproducts');
    Route::post('/buy', [UserController::class, 'buy'])->name('buy');

    //See other products 
    Route::get('/buy', [UserController::class, 'otherProducts'])->name('Sellers.otherProducts');


    // Product routes
    Route::get('/product', [ProductController::class, 'create'])->name('Sellers.addproducts'); 
    Route::post('/product', [ProductController::class, 'store']); 
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('Sellers.editproducts'); 
    Route::any('/product/{id}', [ProductController::class, 'update'])->name('Sellers.updateproducts'); 
    Route::get('/my-products', [ProductController::class, 'myProducts'])->name('Sellers.myproducts');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('Sellers.deleteProduct');

    //Logout from all devices 
    Route::post('/logout/all', [SessionController::class, 'logoutAll'])->name('logout.all');

    
});


