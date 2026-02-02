<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Pages\PagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'index'])->name('index');

Route::get('/login', [PagesController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [PagesController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
