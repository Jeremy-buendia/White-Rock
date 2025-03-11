<?php

namespace Database\Seeders;

use App\Models\FotografiaPropiedad;
use App\Models\Propiedad;
use Illuminate\Database\Seeder;

class FotografiaPropiedadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener todas las propiedades existentes
        $propiedades = Propiedad::all();

        // Si no hay propiedades, crear algunas
        if ($propiedades->isEmpty()) {
            echo "No hay propiedades disponibles. Creando algunas...\n";
            Propiedad::factory(5)->create();
            $propiedades = Propiedad::all();
        }

        // Para cada propiedad, crear entre 2 y 5 fotografías
        foreach ($propiedades as $propiedad) {
            $numFotografias = rand(2, 5);

            FotografiaPropiedad::factory()
                ->count($numFotografias)
                ->create([
                    'propiedad_id' => $propiedad->id,
                ]);
        }
    }
}
