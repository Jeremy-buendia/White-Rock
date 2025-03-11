<?php

namespace Database\Seeders;

use App\Models\Visita;
use App\Models\Propiedad;
use App\Models\User;
use App\Models\AgenteInmobiliario;
use Illuminate\Database\Seeder;

class VisitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Verificar si existen propiedades, usuarios y agentes
        $propiedades = Propiedad::all();
        $users = User::all();
        $agentes = AgenteInmobiliario::all();

        if ($propiedades->isEmpty() || $users->isEmpty() || $agentes->isEmpty()) {
            echo "No hay Propiedades, Usuarios o Agentes Inmobiliarios disponibles. Creando algunos...\n";
            Propiedad::factory(3)->create();
            User::factory(3)->create();
            AgenteInmobiliario::factory(3)->create();

            $propiedades = Propiedad::all();
            $users = User::all();
            $agentes = AgenteInmobiliario::all();
        }

        // Crear visitas
        Visita::factory()->count(10)->create([
            'propiedad_id' => $propiedades->random()->id,
            'user_id' => $users->random()->id,
            'agente_id' => $agentes->random()->id,
        ]);
    }
}
