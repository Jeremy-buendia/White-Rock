<?php

namespace Database\Factories;

use App\Models\AgentePropiedad;
use App\Models\AgenteInmobiliario;
use App\Models\Propiedad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AgentePropiedad>
 */
class AgentePropiedadFactory extends Factory
{
    protected $model = AgentePropiedad::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'agente_id' => AgenteInmobiliario::factory(),
            'propiedad_id' => Propiedad::factory(),
        ];
    }
}