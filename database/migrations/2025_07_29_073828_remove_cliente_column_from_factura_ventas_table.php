<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveClienteColumnFromFacturaVentasTable extends Migration
{
    public function up()
    {
        Schema::table('factura_ventas', function (Blueprint $table) {
            // Verifica si la columna existe antes de eliminar para evitar errores
            if (Schema::hasColumn('factura_ventas', 'cliente')) {
                $table->dropColumn('cliente');
            }
        });
    }

    public function down()
    {
        Schema::table('factura_ventas', function (Blueprint $table) {
            // Volver a agregar la columna cliente si es necesario (nullable para evitar problemas)
            $table->string('cliente')->nullable()->after('cliente_id');
        });
    }
}
