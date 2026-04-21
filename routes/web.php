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

// EDITAR (mostrar formulario)
Route::get('/productos/{id}/edit', [ProductoController::class, 'edit']);

// ACTUALIZAR
Route::put('/productos/{id}', [ProductoController::class, 'update']);

// ELIMINAR
Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);