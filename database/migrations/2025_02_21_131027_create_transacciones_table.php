<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_transacciones_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaccionesTable extends Migration
{
    public function up()
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('propiedad_id')->constrained('propiedades')->onDelete('cascade');
            $table->foreignId('cliente_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('agente_id')->constrained('users')->onDelete('cascade');
            $table->enum('tipo_transaccion', ['compra', 'venta', 'alquiler']);
            $table->date('fecha_transaccion');
            $table->decimal('precio_transaccion', 15, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transacciones');
    }
};
