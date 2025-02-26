<?php

namespace Database\Factories;

use App\Models\Visita;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitaFactory extends Factory
{
    protected $model = Visita::class;

    public function definition()
    {
        return [
            'propiedad_id' => \App\Models\Propiedad::factory(),
            'cliente_id' => \App\Models\Cliente::factory(),
            'agente_id' => \App\Models\AgenteInmobiliario::factory(),
            'fecha_visita' => $this->faker->date(),
            'hora_visita' => $this->faker->time(),
            'observaciones' => $this->faker->text(),
        ];
    }
}
