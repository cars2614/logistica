<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('estado_guias', function (Blueprint $table) {
            $table->decimal('latitud', 10, 7)->nullable()->after('id_usuario');
            $table->decimal('longitud', 10, 7)->nullable()->after('latitud');
            $table->unsignedBigInteger('guia_id')->nullable()->after('id_guia');
        });
    }

    public function down(): void
    {
        Schema::table('estado_guias', function (Blueprint $table) {
            $table->dropColumn(['latitud', 'longitud', 'guia_id']);
        });
    }
};