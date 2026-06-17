<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Add estado_actual to guias
        Schema::table('guias', function (Blueprint $table) {
            if (!Schema::hasColumn('guias', 'estado_actual')) {
                $table->string('estado_actual')->nullable()->after('observacion');
            }
        });

        // 2. Add vehiculo_id to planillas
        Schema::table('planillas', function (Blueprint $table) {
            if (!Schema::hasColumn('planillas', 'vehiculo_id')) {
                $table->foreignId('vehiculo_id')->nullable()->constrained('vehiculos')->onDelete('cascade')->after('id_ruta');
            }
        });

        // 3. Create historial_estados_guias table
        Schema::create('historial_estados_guias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guia_id')->constrained('guias')->onDelete('cascade');
            $table->string('estado'); // 'Bodega', 'En Transito', 'Entregado', 'Novedad'
            $table->text('observaciones')->nullable();
            $table->foreignId('user_id')->constrained('users'); // Auditoria automática
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_estados_guias');

        Schema::table('planillas', function (Blueprint $table) {
            if (Schema::hasColumn('planillas', 'vehiculo_id')) {
                $table->dropForeign(['vehiculo_id']);
                $table->dropColumn('vehiculo_id');
            }
        });

        Schema::table('guias', function (Blueprint $table) {
            if (Schema::hasColumn('guias', 'estado_actual')) {
                $table->dropColumn('estado_actual');
            }
        });
    }
};
