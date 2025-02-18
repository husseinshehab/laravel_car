<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;

Route::get('/',[LoginController::class,'index'])->name('logins.login');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/login', [LoginController::class, 'index'])->name('logins.index');
Route::post('/logout', [LoginController::class, 'logout'])->name('logins.logout');
Route::post('/login', [LoginController::class, 'login'])->name('logins.login');
Route::get('/create',[LoginController::class,'create'])->name('logins.create');
Route::post('/store',[LoginController::class,'store'])->name('logins.store');

Route::middleware('auth')->group(function () {
    Route::get('/customers',[CustomerController::class,'index'])->name('customers.index');
    Route::get('/customers/search',[CustomerController::class,'search'])->name('customers.search');
    Route::get('/customers/{cars}',[CustomerController::class,'show'])->name('customers.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
    Route::get('/admins/creat   2ee', [AdminController::class, 'create'])->name('admins.create');
    Route::get('/admins/search',[AdminController::class,'search'])->name('admins.search');
    Route::get('/admins/{cars}', [AdminController::class, 'show'])->name('admins.show');
    Route::post('/admins/store', [AdminController::class, 'store'])->name('admins.store');
    Route::get('/admins/{cars}/edit', [AdminController::class, 'edit'])->name('admins.edit');
    Route::put('/admins/{cars}', [AdminController::class, 'update'])->name('admins.update');
    Route::delete('admins/{cars}', [AdminController::class, 'destroy'])->name('admins.destroy');
    
});
