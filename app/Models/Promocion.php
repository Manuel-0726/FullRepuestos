<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    use HasFactory;
    protected $table = 'promociones';
    protected $fillable = [
        'nombre',
        // El nombre de la columna ya ha sido corregido en la base de datos
        'descripcion',
        'descuento',
        'fecha_inicio',
        'imagen',
        'fecha_fin'

    ];

    // Relación con productos
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'promocion_producto');
    }

    // Relación con clientes
    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'cliente_promocion');
    }
}
