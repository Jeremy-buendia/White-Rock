<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_solicitudes_visitas_table.php

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
            $table->foreignId('cliente_id')->constrained('users')->onDelete('cascade');
            $table->date('fecha_solicitud');
            $table->enum('estado_solicitud', ['pendiente', 'aprobada', 'rechazada']);
            $table->date('fecha_propuesta')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('solicitudes_visitas');
    }
};
