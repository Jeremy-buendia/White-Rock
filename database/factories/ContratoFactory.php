<?php

namespace Database\Factories;

use App\Models\Contrato;
use App\Models\Propiedad;
use App\Models\User;
use App\Models\AgenteInmobiliario;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContratoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contrato::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tipoContrato = $this->faker->randomElement(['compra', 'venta', 'alquiler']);
        $fechaInicio = $this->faker->date();
        $fechaFinalizacion = ($tipoContrato === 'alquiler') ? $this->faker->dateTimeBetween($fechaInicio, '+1 year')->format('Y-m-d') : null;

        return [
            'propiedad_id' => function () {
                return Propiedad::factory()->create()->id; // Crea una Propiedad si no existe
            },
            'user_id' => function () {
                return User::factory()->create()->id; // Crea un Usuario si no existe
            },
            'agente_id' => function () {
                return AgenteInmobiliario::factory()->create()->id; // Crea un AgenteInmobiliario si no existe
            },
            'tipo_contrato' => $tipoContrato,
            'fecha_inicio' => $fechaInicio,
            'fecha_finalizacion' => $fechaFinalizacion,
            'condiciones' => $this->faker->text(),
        ];
    }
}
