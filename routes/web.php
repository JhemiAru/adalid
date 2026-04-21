<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

///Route::get('/dashboard', function () {
   // return view('usuario'); // 👈 así directo
//});

// FORMULARIO
Route::get('/register', function () {
    return view('usuario');
});

// GUARDAR Y REDIRIGIR
Route::post('/register', function (Request $request) {

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect('/dashboard');
});

// DASHBOARD REAL
Route::get('/dashboard', function () {
    return view('catalogo'); // 👈 AQUÍ CAMBIA
});