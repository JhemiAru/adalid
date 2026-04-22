<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Ingreso;
use App\Models\Egreso;

class DashboardController extends Controller
{
    //  OBTENER PRODUCTOS
    public function obtenerProductos(){
        $productos = Producto::all();
        return response()->json($productos);
    }

    //  GUARDAR PRODUCTO
    public function guardarProducto(Request $request)
    {
        $producto = Producto::create([
            'nombre' => $request->nombre,
            'stock' => $request->stock,
            'precio' => $request->precio,
        ]);

        return response()->json($producto);
    }

    // GUARDAR INGRESO
    public function guardarIngreso(Request $request)
    {
        $ingreso = Ingreso::create([
            'monto' => $request->monto
        ]);

        return response()->json($ingreso);
    }

    // GUARDAR EGRESO
    public function guardarEgreso(Request $request)
    {
        $egreso = Egreso::create([
            'monto' => $request->monto
        ]);

        return response()->json($egreso);
    }

    //resumen
    public function resumen()
{
    $ingresos = Ingreso::sum('monto');
    $egresos = Egreso::sum('monto');

    return response()->json([
        'ingresos' => $ingresos,
        'egresos' => $egresos,
        'caja' => $ingresos - $egresos
    ]);
}

}