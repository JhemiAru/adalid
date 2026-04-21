<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/productos', [DashboardController::class, 'obtenerProductos']);
Route::post('/productos', [DashboardController::class, 'guardarProducto']);
Route::post('/ingresos', [DashboardController::class, 'guardarIngreso']);
Route::post('/egresos', [DashboardController::class, 'guardarEgreso']);