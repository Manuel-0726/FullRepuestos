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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('marca', 50);
            $table->string('modelo', 50);
            $table->year('anio');
            $table->string('categoria', 30);
            $table->text('descripcion')->nullable();

            // --- ¡CAMBIOS AQUÍ! ---
            // Reemplazamos 'precio' por 'precio_compra' y 'precio_venta'
            $table->decimal('precio_compra', 10, 2)->default(0)->comment('Costo de adquisición del producto');
            $table->decimal('precio_venta', 10, 2)->default(0)->comment('Precio al que se vende el producto');
            $table->integer('stock')->default(0)->comment('Cantidad de unidades en inventario');
            // ---------------------

            // La columna 'impuesto' se añadió en una migración posterior (2025_07_29_062347_add_impuesto_to_productos_table),
            // así que no debe estar aquí.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
