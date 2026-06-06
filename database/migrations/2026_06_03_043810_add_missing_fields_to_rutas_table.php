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
        Schema::table('rutas', function (Blueprint $table) {
            // Añadimos las columnas después del campo 'zona'
            $table->string('guia')->after('zona');
            $table->string('direccion')->after('guia');
            $table->string('sector')->after('direccion');
            $table->string('ciudad')->after('sector');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rutas', function (Blueprint $table) {
            // Por si necesitamos revertir el cambio
            $table->dropColumn(['guia', 'direccion', 'sector', 'ciudad']);
        });
    }
};
