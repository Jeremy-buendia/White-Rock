<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentesInmobiliariosTable extends Migration
{
    public function up()
    {
        Schema::create('agentes_inmobiliarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('telefono');
            $table->string('correo_electronico')->unique();
            $table->string('direccion')->nullable(); //nullable
            $table->date('fecha_contratacion');
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('oficina_id')->nullable()->constrained('oficinas')->onDelete('set null'); //nullable
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agentes_inmobiliarios');
    }
};
