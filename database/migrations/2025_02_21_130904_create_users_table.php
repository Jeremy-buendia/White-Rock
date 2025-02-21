<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('telefono');
            $table->string('correo_electronico')->unique();
            $table->string('direccion');
            $table->enum('tipo', ['cliente', 'agente']); // tipo de usuario (cliente o agente)
            $table->date('fecha_contratacion')->nullable(); // solo para agentes
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
