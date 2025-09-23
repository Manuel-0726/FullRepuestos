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
        Schema::create('lubricantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50)->unique();
            $table->string('codigo', 20)->unique();
            $table->text('descripcion');
            $table->string('marca', 30);
            $table->unsignedSmallInteger('stock')->default(0);
            $table->string('tipo_producto', 50)->default('Lubricante' );
            $table->string('imagen', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lubricantes');
    }
};
