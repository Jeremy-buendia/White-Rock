<?php

namespace Database\Factories;

use App\Models\Transaccion;
use App\Models\Propiedad;
use App\Models\User;
use App\Models\AgenteInmobiliario;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransaccionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaccion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tiposTransaccion = ['compra', 'venta', 'alquiler'];
        $fechaTransaccion = $this->faker->dateTimeBetween('-1 year', 'now');

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
            'tipo_transaccion' => $this->faker->randomElement($tiposTransaccion),
            'fecha_transaccion' => $fechaTransaccion,
            'precio_transaccion' => $this->faker->numberBetween(50000, 1000000),
        ];
    }
}
