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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('cedula')->unique();  /* este campo actua como una llave primearia pero no lo es. */
            $table->string('nombre');
            $table->string('telefono');
            $table->string('correo');
            $table->string('direccion');
            $table->string('descripcion');

            $table->foreignId('id_ciudad')->constrained('ciudades');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
