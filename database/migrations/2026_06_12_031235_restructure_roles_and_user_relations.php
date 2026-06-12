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
        // 1. Crear los 3 roles requeridos
        \Illuminate\Support\Facades\DB::table('rols')->insert([
            ['nombreRol' => 'Administrador', 'created_at' => now(), 'updated_at' => now()],
            ['nombreRol' => 'Repartidor', 'created_at' => now(), 'updated_at' => now()],
            ['nombreRol' => 'Cliente', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 2. Agregar id_rol a la tabla users
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('id_rol')->nullable()->after('password')->constrained('rols')->onDelete('set null');
        });

        // 3. Asignar el rol de Administrador (id: 1) a los usuarios existentes
        \Illuminate\Support\Facades\DB::table('users')->update(['id_rol' => 1]);

        // 4. Cambiar la restricción de id_usuario en planillas de 'usuarios' a 'users'
        Schema::table('planillas', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
        });
        Schema::table('planillas', function (Blueprint $table) {
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });

        // 5. Cambiar la restricción de id_usuario en estado_guias de 'usuarios' a 'users'
        Schema::table('estado_guias', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
        });
        Schema::table('estado_guias', function (Blueprint $table) {
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir estado_guias
        Schema::table('estado_guias', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
        });
        Schema::table('estado_guias', function (Blueprint $table) {
            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
        });

        // Revertir planillas
        Schema::table('planillas', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
        });
        Schema::table('planillas', function (Blueprint $table) {
            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
        });

        // Eliminar columna id_rol en users
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_rol']);
            $table->dropColumn('id_rol');
        });

        // Eliminar los roles insertados
        \Illuminate\Support\Facades\DB::table('rols')
            ->whereIn('nombreRol', ['Administrador', 'Repartidor', 'Cliente'])
            ->delete();
    }
};
