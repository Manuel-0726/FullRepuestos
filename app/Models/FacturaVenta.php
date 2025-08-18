<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaVenta extends Model
{
    use HasFactory;

    protected $fillable = ['codigo', 'fecha', 'cliente_id', 'subtotal', 'iva', 'total'];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');

    }

    public function detalles()
    {
        return $this->hasMany(DetalleFacturaVenta::class, 'factura_venta_id')
            ->with('producto'); // esto es clave
    }
}
