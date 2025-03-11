<?php

namespace Database\Seeders;

use App\Models\AgenteInmobiliario;
use Illuminate\Database\Seeder;

class AgenteInmobiliarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear algunos agentes inmobiliarios de ejemplo
        AgenteInmobiliario::factory()->count(5)->create();
    }
}
