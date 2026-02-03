<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Pages\PagesController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('user', UserController::class);

Route::get('/', [PagesController::class, 'index'])->name('index');

Route::get('/profile', [UserController::class, 'profilePage'])->name('profile');

Route::get('/login', [PagesController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [PagesController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/gallery', [PagesController::class, 'gallery'])->name('gallery');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
