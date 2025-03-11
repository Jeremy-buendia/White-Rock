<?php

namespace Database\Factories;

use App\Models\SolicitudVisita;
use App\Models\Propiedad;
use App\Models\User;
use App\Models\AgenteInmobiliario;
use Illuminate\Database\Eloquent\Factories\Factory;

class SolicitudVisitaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SolicitudVisita::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $estados = ['pendiente', 'aprobada', 'rechazada'];
        $fechaSolicitud = $this->faker->dateTimeBetween('-1 month', 'now');
        $fechaPropuesta = $this->faker->dateTimeBetween($fechaSolicitud, '+1 week');

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
            'fecha_solicitud' => $fechaSolicitud,
            'estado' => $this->faker->randomElement($estados),
            'fecha_propuesta' => $fechaPropuesta,
        ];
    }
}
