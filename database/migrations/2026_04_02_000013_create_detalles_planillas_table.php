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
        Schema::create('detalles_planillas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_planilla')->constrained('planillas');
            $table->foreignId('id_guia')->constrained('guias');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_planillas');
    }
};
