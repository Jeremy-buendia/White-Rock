<?php

namespace Database\Factories;

use App\Models\AgentePropiedad;
use App\Models\AgenteInmobiliario;
use App\Models\Propiedad;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgentePropiedadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AgentePropiedad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'agente_inmobiliario_id' => function () {
                return AgenteInmobiliario::factory()->create()->id; // Crea un agente si no existe
            },
            'propiedad_id' => function () {
                return Propiedad::factory()->create()->id; // Crea una propiedad si no existe
            },
        ];
    }
}
