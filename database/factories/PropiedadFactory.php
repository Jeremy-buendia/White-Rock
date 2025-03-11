<?php

namespace Database\Factories;

use App\Models\Propiedad;
use App\Models\Oficina;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropiedadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Propiedad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tiposPropiedad = ['casa', 'apartamento', 'terreno'];
        $estados = ['disponible', 'vendido', 'alquilado'];

        return [
            'nombre' => $this->faker->sentence(3),
            'descripcion' => $this->faker->paragraph,
            'precio' => $this->faker->numberBetween(50000, 1000000),
            'tipo_propiedad' => $this->faker->randomElement($tiposPropiedad),
            'direccion' => $this->faker->address,
            'tamano' => $this->faker->numberBetween(50, 500),
            'estado' => $this->faker->randomElement($estados),
            'oficina_id' => function () {
                return Oficina::factory()->create()->id;
            },
        ];
    }
}
