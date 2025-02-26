<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cliente;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'telefono' => $this->faker->phoneNumber,
            'correo_electronico' => $this->faker->unique()->safeEmail,
            'direccion' => $this->faker->address,
            'tipo_cliente' => $this->faker->randomElement(['comprador', 'vendedor', 'arrendatario', 'arrendador']),
        ];
    }
}
