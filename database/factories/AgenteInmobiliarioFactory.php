<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Oficina;
use App\Models\AgenteInmobiliario;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AgenteInmobiliario>
 */
class AgenteInmobiliarioFactory extends Factory
{
    protected $agenteInmobiliario = AgenteInmobiliario::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'telefono' => $this->faker->phoneNumber,
            'correo_electronico' => $this->faker->unique()->safeEmail,
            'direccion' => $this->faker->address,
            'fecha_contratacion' => $this->faker->date(),
            'oficina_id' => Oficina::inRandomOrder()->first()->id ?? Oficina::factory()
        ];
    }
}
