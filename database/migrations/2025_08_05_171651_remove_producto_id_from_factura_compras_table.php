<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('factura_compras', function (Blueprint $table) {
            $table->dropForeign(['producto_id']); // si existe restricción
            $table->dropColumn('producto_id');
        });
    }

    public function down(): void
    {
        Schema::table('factura_compras', function (Blueprint $table) {
            $table->foreignId('producto_id')->constrained('productos');
        });
    }
};