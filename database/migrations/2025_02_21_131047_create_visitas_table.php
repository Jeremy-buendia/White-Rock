<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_visitas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitasTable extends Migration
{
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('propiedad_id')->constrained('propiedades')->onDelete('cascade');
            $table->foreignId('cliente_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('agente_id')->constrained('users')->onDelete('cascade');
            $table->date('fecha_visita');
            $table->time('hora_visita');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitas');
    }
};
