<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Oficina;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Oficina>
 */
class OficinaFactory extends Factory
{

    protected $oficina = Oficina::class;

    public function definition(): array
    {
        return [
            'nombre' => 'Oficina ' . $this->faker->city,
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->phoneNumber,
            'fax' => $this->faker->phoneNumber,
        ];
    }
}
