<?php

namespace Database\Factories;

use App\Models\Visita;
use App\Models\Propiedad;
use App\Models\User;
use App\Models\AgenteInmobiliario;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Visita::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fechaVisita = $this->faker->dateTimeBetween('now', '+1 month');
        $horaVisita = $this->faker->time('H:i');

        return [
            'propiedad_id' => function () {
                return Propiedad::factory()->create()->id;
            },
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'agente_id' => function () {
                return AgenteInmobiliario::factory()->create()->id;
            },
            'fecha_visita' => $fechaVisita->format('Y-m-d'),
            'hora_visita' => $horaVisita,
            'observaciones' => $this->faker->paragraph,
        ];
    }
}
