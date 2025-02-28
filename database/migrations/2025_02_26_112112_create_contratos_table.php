<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('propiedad_id')->constrained('propiedades')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('agente_id')->constrained('agentes_inmobiliarios')->onDelete('cascade');
            $table->enum('tipo_contrato', ['compra', 'venta', 'alquiler']);
            $table->date('fecha_inicio');
            $table->date('fecha_finalizacion')->nullable();
            $table->text('condiciones')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contratos');
    }
}
