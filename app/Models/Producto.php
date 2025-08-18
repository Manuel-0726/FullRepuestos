<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'descripcion', 'marca', 'modelo', 'anio', 'categoria',
        'stock', 'precio_venta', 'precio_compra',
    ];



    public function detallesFacturaVenta()
    {
        return $this->hasMany(DetalleFacturaVenta::class, 'producto_id');
    }
}
