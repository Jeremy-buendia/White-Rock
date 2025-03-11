<?php

namespace Database\Seeders;

use App\Models\Propiedad;
use App\Models\Oficina;
use Illuminate\Database\Seeder;

class PropiedadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Asegurarse de que existan oficinas
        if (Oficina::count() == 0) {
            echo "No hay oficinas. Creando algunas...\n";
            Oficina::factory(3)->create();
        }

        // Crear algunas propiedades de ejemplo
        Propiedad::factory()->count(10)->create();
    }
}
