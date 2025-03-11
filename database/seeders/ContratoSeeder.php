<?php

namespace Database\Seeders;

use App\Models\Contrato;
use App\Models\Propiedad;
use App\Models\User;
use App\Models\AgenteInmobiliario;
use Illuminate\Database\Seeder;

class ContratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear algunos contratos de ejemplo
        //  Asegúrate de que existan Propiedades, Usuarios y Agentes Inmobiliarios
        //  antes de ejecutar este Seeder.
        //  Si no existen, puedes crearlos aquí o en sus respectivos Seeders.

        $propiedades = Propiedad::all();
        $users = User::all();
        $agentes = AgenteInmobiliario::all();

        if ($propiedades->isEmpty() || $users->isEmpty() || $agentes->isEmpty()) {
            Propiedad::factory(3)->create();
            User::factory(3)->create();
            AgenteInmobiliario::factory(3)->create();

            $propiedades = Propiedad::all();
            $users = User::all();
            $agentes = AgenteInmobiliario::all();
        }

        // Crear 5 contratos, asignándolos a registros existentes
        Contrato::factory()->count(5)->create([
            'propiedad_id' => $propiedades->random()->id,
            'user_id' => $users->random()->id,
            'agente_id' => $agentes->random()->id,
        ]);
    }
}
