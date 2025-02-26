<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AgenteInmobiliario;

class AgenteInmobiliarioSeeder extends Seeder
{
    public function run(): void
    {
        AgenteInmobiliario::factory()->count(10)->create();
    }
}
