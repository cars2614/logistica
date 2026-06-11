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
           
            $table->foreignId('id_tipo_entrega')->constrained('tipo_entregas');

            $table->foreignId('id_cliente_origen')->constrained('clientes');
            $table->foreignId('id_cliente_destino')->constrained('clientes');

            $table->integer('unidades')->default(1);
            $table->decimal('peso', 10, 2)->default(1);

            $table->decimal('largo', 10, 2)->default(1);
            $table->decimal('ancho', 10, 2)->default(1);
            $table->decimal('alto', 10, 2)->default(1);            

            $table->decimal('precio_envio', 10, 2)->default(9800);
            $table->decimal('valor_declarado', 10, 2)->default(20000);

            $table->string('observacion')->nullable();
            $table->boolean('activo')->default(true);

            

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
