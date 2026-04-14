<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Producto extends Model
{
    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'stock',
        'categoria_id',
        'imagen'
    ];

    // 🔗 RELACIÓN CON CATEGORÍA
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}