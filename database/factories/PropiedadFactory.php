<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Propiedad;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Propiedad>
 */
class PropiedadFactory extends Factory
{

    protected $propiedad = Propiedad::class;
    public function definition(): array
    {
        return [
            'direccion' => $this->faker->streetAddress,
            'tipo_propiedad' => $this->faker->randomElement(['Casa', 'Departamento', 'Terreno', 'Local Comercial']),
            'precio' => $this->faker->numberBetween(50000, 500000),
            'tamano' => $this->faker->numberBetween(50, 500),
            'descripcion' => $this->faker->sentence(10),
            'estado' => $this->faker->randomElement(['disponible', 'vendido', 'alquilado']),
            'fecha_publicacion' => $this->faker->date(),
        ];
    }
}
