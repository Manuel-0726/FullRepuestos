<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('factura_compras', function (Blueprint $table) {
            $table->id(); // Columna 'id' como clave primaria automática

            $table->string('codigo')->nullable(); // Campo de código, puede ser nulo
            $table->date('fecha'); // Campo de fecha

            // CLAVES FORÁNEAS - ¡MUY IMPORTANTE!
            // Estas líneas crean las columnas y sus restricciones de clave foránea automáticamente.

            // Columna para el empleado que hizo la compra
            $table->foreignId('empleado_id')
                ->constrained('empleados') // Referencia a la tabla 'empleados'
                ->onDelete('cascade');     // Si se borra un empleado, se borran sus facturas de compra

            // Columna para el proveedor de la compra
            $table->foreignId('proveedor_id')
                ->constrained('proveedores') // Referencia a la tabla 'proveedores'
                ->onDelete('cascade');       // Si se borra un proveedor, se borran sus facturas de compra

            // Columna para el producto específico de la compra (si aplica, si es una factura por un solo producto)
            // Si 'factura_compras' es la CABECERA y hay una tabla 'detalle_factura_compras' para los productos,
            // entonces 'producto_id' NO debería ir aquí, sino en 'detalle_factura_compras'.
            // Por ahora la incluyo aquí como la pediste, pero si tienes una tabla de detalle, me lo dices.
            $table->foreignId('producto_id')
                ->constrained('productos')   // Referencia a la tabla 'productos'
                ->onDelete('cascade');       // Si se borra un producto, se borran sus facturas de compra

            // CAMPOS ADICIONALES
            $table->decimal('subtotal', 10, 2)->default(0); // Subtotal de la factura
            $table->decimal('iva', 10, 2)->default(0);      // IVA de la factura
            $table->decimal('total', 10, 2)->default(0);    // Total de la factura

            // Nuevos campos 'descuento' y 'observaciones'
            $table->decimal('descuento', 8, 2)->default(0); // Campo para descuento
            $table->text('observaciones')->nullable();      // Campo de texto para observaciones, puede ser nulo

            $table->timestamps(); // Columnas 'created_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura_compras');
    }
};