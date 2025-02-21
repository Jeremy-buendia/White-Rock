<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_fotografias_propiedades_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotografiasPropiedadesTable extends Migration
{
    public function up()
    {
        Schema::create('fotografias_propiedades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('propiedad_id')->constrained('propiedades')->onDelete('cascade');
            $table->string('url');
            $table->string('descripcion');
            $table->timestamp('fecha_subida');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fotografias_propiedades');
    }
};
