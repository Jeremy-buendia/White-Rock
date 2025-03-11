<?php

namespace Database\Factories;

use App\Models\FotografiaPropiedad;
use App\Models\Propiedad;
use Illuminate\Database\Eloquent\Factories\Factory;

class FotografiaPropiedadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FotografiaPropiedad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'propiedad_id' => function () {
                return Propiedad::factory()->create()->id; // Crea una Propiedad si no existe
            },
            'url_fotografia' => $this->faker->imageUrl(640, 480, 'property', true), // Genera una URL de imagen aleatoria
            'descripcion' => $this->faker->sentence,
        ];
    }
}
