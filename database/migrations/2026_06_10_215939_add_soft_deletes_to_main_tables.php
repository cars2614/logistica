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
        Schema::table('clientes', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('guias', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('rutas', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('planillas', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('guias', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('rutas', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('planillas', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
