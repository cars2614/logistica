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
            $table->string('destinatario');
            $table->string('direccion');
            $table->string('comentario');
            $table->string('destino');
            $table->string('departamento');
            $table->string('entidad');
             $table->string('servicio');
             $table->integer('piezas');
             $table->decimal('kilos');
             $table->string('opedor');

                 // ✅ Primero declaras las columnas aquí
    $table->unsignedBigInteger('vehiculos_id');
    $table->unsignedBigInteger('rutas_id');

            $table->timestamps();


        });
        Schema::table('planillas', function (Blueprint $table) {
    $table->foreign('vehiculos_id')->references('id')->on('vehiculos');
    $table->foreign('rutas_id')->references('id')->on('rutas');
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
