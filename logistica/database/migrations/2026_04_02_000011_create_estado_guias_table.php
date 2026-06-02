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
        Schema::create('estado_guias', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_estado');
            $table->string('estado');
            $table->string('descripcion');

            // CORREGIDO: Nombres bajo el estándar de Laravel (tablaSingular_id)
            $table->foreignId('guia_id')->constrained('guias')->onDelete('cascade');
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado_guias');
    }
};