<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FotografiaPropiedad;

class FotografiaPropiedadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FotografiaPropiedad::factory()->count(10)->create();
    }
}