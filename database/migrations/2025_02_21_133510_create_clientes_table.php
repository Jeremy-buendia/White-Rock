<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('telefono')->nullable();
            $table->string('correo_electronico')->unique();
            $table->string('direccion')->nullable();
            $table->string('imagen')->nullable();
            $table->string('password');  // Campo para la contraseña
            $table->rememberToken();  // Campo para el remember_token
            $table->timestamps();  // Para los timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
