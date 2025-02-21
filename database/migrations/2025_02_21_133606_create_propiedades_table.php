<?php

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
            $table->decimal('precio', 10, 2);
            $table->integer('tamano');
            $table->text('descripcion')->nullable();
            $table->enum('estado', ['disponible', 'vendido', 'alquilado']);
            $table->date('fecha_publicacion');
            $table->foreignId('oficina_id')->nullable()->constrained('oficinas')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('propiedades');
    }
};
