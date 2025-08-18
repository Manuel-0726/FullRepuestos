<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFacturaCompra extends Model
{
    use HasFactory;

    protected $fillable = [
        'factura_compra_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
    ];

    // Un detalle pertenece a una factura de compra
    public function facturaCompra()
    {
        return $this->belongsTo(FacturaCompra::class);
    }

    // Un detalle se refiere a un producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}