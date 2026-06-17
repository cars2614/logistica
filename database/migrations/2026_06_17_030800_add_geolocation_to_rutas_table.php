<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('rutas', function (Blueprint $table) {
            // Coordenadas de alta precisión
            $table->decimal('latitud', 10, 8)->nullable()->after('ciudad');
            $table->decimal('longitud', 11, 8)->nullable()->after('latitud');
            // Personalización visual del mapa premium
            $table->string('color_hex', 7)->default('#17a2b8')->after('longitud'); 
        });
    }

    public function down(): void
    {
        Schema::table('rutas', function (Blueprint $table) {
            $table->dropColumn(['latitud', 'longitud', 'color_hex']);
        });
    }
};
