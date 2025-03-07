<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentePropiedadTable extends Migration
{
    public function up()
    {
        Schema::create('agente_propiedad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agente_inmobiliario_id')->constrained('agentes_inmobiliarios')->onDelete('cascade');
            $table->foreignId('propiedad_id')->constrained('propiedades')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agente_propiedad');
    }
};
