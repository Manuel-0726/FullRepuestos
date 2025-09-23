<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoMoto extends Model
{
    use HasFactory;

    protected $table = 'productos_moto';

    protected $fillable = [
        'nombre', 'marca', 'modelo', 'anio', 'descripcion', 'categoria','imagen'
    ];
}
