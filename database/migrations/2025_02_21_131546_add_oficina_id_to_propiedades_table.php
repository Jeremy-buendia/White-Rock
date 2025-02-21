<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_oficina_id_to_propiedades_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOficinaIdToPropiedadesTable extends Migration
{
    public function up()
    {
        Schema::table('propiedades', function (Blueprint $table) {
            $table->foreignId('oficina_id')->nullable()->constrained('oficinas')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('propiedades', function (Blueprint $table) {
            $table->dropColumn('oficina_id');
        });
    }
};
