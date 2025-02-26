<?php

namespace Database\Factories;

use App\Models\Contrato;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContratoFactory extends Factory
{
    protected $model = Contrato::class;

    public function definition()
    {
        return [
            'propiedad_id' => \App\Models\Propiedad::factory(),
            'cliente_id' => \App\Models\Cliente::factory(),
            'agente_id' => \App\Models\AgenteInmobiliario::factory(),
            'tipo_contrato' => $this->faker->randomElement(['compra', 'venta', 'alquiler']),
            'fecha_inicio' => $this->faker->date(),
            'fecha_finalizacion' => $this->faker->optional()->date(),
            'condiciones' => $this->faker->text(),
        ];
    }
}
