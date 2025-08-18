<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
        'telefono',
        'sexo',
        'identidad',
        'direccion',
    ];

    public function facturas()
    {
        return $this->hasMany(FacturaVenta::class);
    }
}
