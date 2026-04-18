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
        Schema::create('planillas', function (Blueprint $table) {
            $table->id();

            $table->string('numero_planilla')->unique()->autoIncrement();

            $table->foreignId('id_ciudad')->constrained('ciudades');
            $table->foreignId('id_usuario')->constrained('usuarios');
            $table->foreignId('id_ruta')->constrained('rutas');
            
            $table->integer('piezas');
            $table->decimal('kilos', 10, 2);         

            
            $table->timestamps();
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planillas');
    }
};
