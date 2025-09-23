<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos_moto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->year('anio')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('categoria')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos_moto');
    }
};
