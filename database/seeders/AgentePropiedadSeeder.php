<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AgentePropiedad;

class AgentePropiedadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AgentePropiedad::factory()->count(10)->create();
    }
}