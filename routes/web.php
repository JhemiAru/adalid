<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});

// 🔥 LISTA DE PRODUCTOS
Route::get('/productos', [ProductoController::class, 'index']);

// 🔥 FORMULARIO (AÑADIR PRODUCTO)
Route::get('/productos/create', [ProductoController::class, 'create']);

// 🔥 GUARDAR PRODUCTO
Route::post('/productos', [ProductoController::class, 'store']);


Route::get('/catalogo', function () {
    return view('catalogo');
});
