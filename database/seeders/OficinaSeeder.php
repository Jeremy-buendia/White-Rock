<?php

namespace Database\Seeders;

use App\Models\Oficina;
use Illuminate\Database\Seeder;

class OficinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear algunas oficinas de ejemplo
        Oficina::factory()->count(5)->create();
    }
}
