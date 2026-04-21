<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $categoria_id = $request->categoria_id;

        if ($categoria_id) {
            $productos = Producto::where('categoria_id', $categoria_id)->get();
        } else {
            $productos = Producto::all();
        }

        $categorias = Categoria::all();

        return view('productos.index', compact('productos','categorias'));
    }

    public function create()
{
    $categorias = \App\Models\Categoria::all();
    return view('productos.create', compact('categorias'));
}

public function store(Request $request)
{
    $request->validate([
        'codigo' => 'required',
        'nombre' => 'required',
        'stock' => 'required|integer|min:0',
        'precio' => 'required|numeric|min:0',
        'categoria_id' => 'required'
    ]);

    Producto::create($request->all());

    return redirect('/productos');
}
// 🔹 FORMULARIO EDITAR
public function edit($id)
{
    $producto = Producto::findOrFail($id);
    $categorias = Categoria::all();

    return view('productos.edit', compact('producto','categorias'));
}

// 🔹 ACTUALIZAR
public function update(Request $request, $id)
{
    $request->validate([
        'stock' => 'required|integer|min:0',
        'precio' => 'required|numeric|min:0',
        'categoria_id' => 'required'
    ]);

    $producto = Producto::findOrFail($id);
    $producto->update($request->all());

    return redirect('/productos');
}

// 🔹 ELIMINAR
public function destroy($id)
{
    $producto = Producto::findOrFail($id);
    $producto->delete();

    return redirect('/productos');
}
}