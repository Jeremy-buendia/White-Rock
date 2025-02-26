<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaccion;

class TransaccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaccion::factory()->count(10)->create();
    }
}