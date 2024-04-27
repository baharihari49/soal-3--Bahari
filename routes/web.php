<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;


Route::resource('/', ProductController::class)->middleware('auth');

Route::get('/detail/{id}', [ProductController::class, 'show'])->middleware('auth');
Route::post('/update/{id}', [ProductController::class, 'update'])->middleware('auth');
Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->middleware('auth');



Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'logout']);
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register', [RegisterController::class, 'store']);

