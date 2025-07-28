<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposExtraToProveedoresTable extends Migration
{
    public function up()
    {
        Schema::table('proveedores', function (Blueprint $table) {
            $table->string('pais')->nullable()->after('email');
            $table->string('categoria')->nullable()->after('pais');
            $table->timestamp('fecha_registro')->nullable()->after('categoria');
        });
    }

    public function down()
    {
        Schema::table('proveedores', function (Blueprint $table) {
            $table->dropColumn(['pais', 'categoria', 'fecha_registro']);
        });
    }
}
