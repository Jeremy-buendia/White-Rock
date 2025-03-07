<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesVisitasTable extends Migration
{
    public function up()
    {
        Schema::create('solicitudes_visitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('propiedad_id')->constrained('propiedades')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->dateTime('fecha_solicitud');
            $table->enum('estado', ['pendiente', 'aprobada', 'rechazada']);
            $table->foreignId('agente_id')->constrained('agentes_inmobiliarios')->onDelete('cascade');
            $table->dateTime('fecha_propuesta')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('solicitudes_visitas');
    }
};
