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
    'precio',
    'categoria_id',
    'imagen'
];

 
    
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}