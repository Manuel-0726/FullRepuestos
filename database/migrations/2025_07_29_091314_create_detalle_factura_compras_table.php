<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_factura_compras', function (Blueprint $table) {
            $table->id();

            // Clave foránea a la tabla de cabecera de la factura de compra
            $table->foreignId('factura_compra_id')
                ->constrained('factura_compras')
                ->onDelete('cascade');

            // Clave foránea al producto específico
            $table->foreignId('producto_id')
                ->constrained('productos')
                ->onDelete('cascade');

            $table->integer('cantidad'); // Cantidad de este producto en la compra
            $table->decimal('precio_unitario', 10, 2); // Precio al que se compró este producto

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_factura_compras');
    }
};
