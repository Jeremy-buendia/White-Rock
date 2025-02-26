<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SolicitudVisita;

class SolicitudVisitaSeeder extends Seeder
{
    public function run()
    {
        SolicitudVisita::factory()->count(10)->create();
    }
}
