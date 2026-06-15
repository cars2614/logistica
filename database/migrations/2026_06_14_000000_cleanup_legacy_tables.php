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
        // 1. Drop foreign key in users and the column
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'id_rol')) {
                // Drop foreign key first
                $table->dropForeign(['id_rol']);
                // Drop the column
                $table->dropColumn('id_rol');
            }
        });

        // 2. Drop usuarios table FIRST (because it has a foreign key to rols)
        Schema::dropIfExists('usuarios');

        // 3. Drop rols table NOW that nothing depends on it
        Schema::dropIfExists('rols');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recrear tabla usuarios (versión muy básica para revertir)
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        // Recrear tabla rols
        Schema::create('rols', function (Blueprint $table) {
            $table->id();
            $table->string('nombreRol');
            $table->timestamps();
        });

        // Restaurar columna id_rol
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('id_rol')->nullable()->after('password')->constrained('rols')->onDelete('set null');
        });
    }
};
