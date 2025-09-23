<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lubricante extends Model
{
    use HasFactory;

    protected $table = 'lubricantes';

    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion',
        'marca',
        'tipo_producto',
        'imagen',
    ];

    protected $casts = [
        'stock' => 'integer',
    ];
}
