<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_propiedades_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropiedadesTable extends Migration
{
    public function up()
    {
        Schema::create('propiedades', function (Blueprint $table) {
            $table->id();
            $table->string('direccion');
            $table->string('tipo_propiedad');
            $table->decimal('precio', 15, 2);
            $table->decimal('tamano', 10, 2);
            $table->text('descripcion');
            $table->enum('estado', ['disponible', 'vendido', 'alquilado']);
            $table->date('fecha_publicacion');
            $table->foreignId('agente_id')->constrained('users')->onDelete('cascade'); // Agente responsable
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('propiedades');
    }
};
