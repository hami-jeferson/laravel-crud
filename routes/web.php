<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index']);

Route::get('customer', [\App\Http\Controllers\FormController::class, 'create'])->name('customer-create');
Route::post('customer', [\App\Http\Controllers\FormController::class, 'store'])->name('customer-store');
Route::get('customer/{id}', [\App\Http\Controllers\FormController::class, 'update'])->name('customer-update');
Route::put('customer/{id}', [\App\Http\Controllers\FormController::class, 'edit'])->name('customer-edit');
Route::delete('customer/{id}', [\App\Http\Controllers\FormController::class, 'destroy'])->name('customer-destroy');

