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
        Schema::create('guias', function (Blueprint $table) {
            $table->id();
            
            $table->integer('num_guias');
            $table->decimal('volumen', 10, 2);
            $table->decimal('peso', 10, 2);
            $table->decimal('precio', 10, 2);
            $table->string('observacion');
            $table->dateTime('fecha_admision');
            $table->integer('unidades');

            $table->foreignId('id_cliente_origen')->constrained('clientes');
            $table->foreignId('id_cliente_destino')->constrained('clientes');
            $table->foreignId('id_tipo_entrega')->constrained('tipo_entregas');



            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guias');
    }
};
