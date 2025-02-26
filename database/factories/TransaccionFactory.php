<?php

namespace Database\Factories;

use App\Models\Transaccion;
use App\Models\Propiedad;
use App\Models\Cliente;
use App\Models\AgenteInmobiliario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaccion>
 */
class TransaccionFactory extends Factory
{
    protected $model = Transaccion::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'propiedad_id' => Propiedad::factory(),
            'cliente_id' => Cliente::factory(),
            'agente_id' => AgenteInmobiliario::factory(),
            'tipo_transaccion' => $this->faker->randomElement(['compra', 'venta', 'alquiler']),
            'fecha_transaccion' => $this->faker->date(),
            'precio_transaccion' => $this->faker->randomFloat(2, 10000, 1000000),
        ];
    }
}