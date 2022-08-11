<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('/login', 'login')->name('login')->middleware('guest'); // si hay un usuario lo redirige a / ó /home
Route::view('/dashboard', 'dashboard')->middleware('auth'); //si no hay un usuario logueado redirecciona a login

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);