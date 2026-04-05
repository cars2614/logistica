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
            $table->timestamps();

    $table->unsignedBigInteger('guias_id'); // Creas la columna

$table->foreign('guias_id')           // La conviertes en foránea
      ->references('id_guias')         // <--- AQUÍ: Pon el nombre exacto de la primaria de Guías
      ->on('guias')                   // Nombre de la tabla
      ->onDelete('cascade');
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
