<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Propiedad;

class PropiedadSeeder extends Seeder
{
    public function run(): void
    {
        Propiedad::factory()->count(10)->create();
    }
}
