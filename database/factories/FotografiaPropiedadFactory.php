<?php

namespace Database\Factories;

use App\Models\FotografiaPropiedad;
use App\Models\Propiedad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FotografiaPropiedad>
 */
class FotografiaPropiedadFactory extends Factory
{
    protected $model = FotografiaPropiedad::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'propiedad_id' => Propiedad::factory(),
            'url_fotografia' => $this->faker->imageUrl(),
            'descripcion' => $this->faker->sentence(),
        ];
    }
}