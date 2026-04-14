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
    Producto::create($request->all());
    return redirect('/productos');
}
}