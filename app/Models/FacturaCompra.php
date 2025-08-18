<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaCompra extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'fecha',
        'empleado_id',
        'proveedor_id',
        'subtotal',
        'iva',
        'total',
        'descuento',
        'observaciones',
    ];
    protected $casts = [
        'fecha' => 'datetime',
    ];
    // Relación con Empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    // Relación con Proveedor
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    // Relación con los detalles de la factura de compra (muchos detalles por una factura)
    public function detalles()
    {
        return $this->hasMany(DetalleFacturaCompra::class);
    }
}