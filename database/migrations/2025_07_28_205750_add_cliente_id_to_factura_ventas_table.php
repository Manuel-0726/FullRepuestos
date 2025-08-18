<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClienteIdToFacturaVentasTable extends Migration
{
    public function up()
    {
        Schema::table('factura_ventas', function (Blueprint $table) {
            $table->unsignedBigInteger('cliente_id')->nullable()->after('codigo');

            // Si quieres crear la relación (clave foránea):
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('factura_ventas', function (Blueprint $table) {
            $table->dropForeign(['cliente_id']);
            $table->dropColumn('cliente_id');
        });
    }
}
