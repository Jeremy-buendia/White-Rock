<?php

namespace Database\Factories;

use App\Models\SolicitudVisita;
use Illuminate\Database\Eloquent\Factories\Factory;

class SolicitudVisitaFactory extends Factory
{
    protected $model = SolicitudVisita::class;

    public function definition()
    {
        return [
            'propiedad_id' => \App\Models\Propiedad::factory(),
            'cliente_id' => \App\Models\Cliente::factory(),
            'fecha_solicitud' => $this->faker->date(),
            'estado' => $this->faker->randomElement(['pendiente', 'aprobada', 'rechazada']),
            'fecha_propuesta' => $this->faker->optional()->date(),
        ];
    }
}
