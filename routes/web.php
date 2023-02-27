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

Route::get('/', [App\Http\Controllers\ProductoController::class, 'index'])->name('productos.index');
Route::get('productos/create', [App\Http\Controllers\ProductoController::class, 'create'])->name('productos.create');
Route::post('productos', [App\Http\Controllers\ProductoController::class, 'store'])->name('productos.store');
Route::get('productos/{id}/edit', [App\Http\Controllers\ProductoController::class, 'edit'])->name('productos.edit');
Route::delete('productos/{id}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('productos.destroy');
Route::put('productos/{id}', [App\Http\Controllers\ProductoController::class, 'update'])->name('productos.update');
