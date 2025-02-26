<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create(); //para crear datos de prueba

        $this->call([
            OficinaSeeder::class,
            ClienteSeeder::class,
            AgenteInmobiliarioSeeder::class,
            PropiedadSeeder::class,
            AgentePropiedadSeeder::class,
            FotografiaPropiedadSeeder::class,
            TransaccionSeeder::class,
            VisitaSeeder::class,
            SolicitudVisitaSeeder::class,
            ContratoSeeder::class,
        ]);
    }
}
