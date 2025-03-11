<?php

namespace Database\Seeders;

use App\Models\AgentePropiedad;
use App\Models\AgenteInmobiliario;
use App\Models\Propiedad;
use Illuminate\Database\Seeder;

class AgentePropiedadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear algunas relaciones aleatorias entre agentes y propiedades
        $agentes = AgenteInmobiliario::all();
        $propiedades = Propiedad::all();

        foreach ($agentes as $agente) {
            // Asignar entre 1 y 3 propiedades a cada agente (puedes ajustar este rango)
            $numPropiedades = rand(1, 3);

            // Seleccionar propiedades aleatorias (asegurándonos de que existan suficientes propiedades)
            $propiedadesAsignadas = $propiedades->random($numPropiedades > $propiedades->count() ? $propiedades->count() : $numPropiedades);

            foreach ($propiedadesAsignadas as $propiedad) {
                AgentePropiedad::create([
                    'agente_inmobiliario_id' => $agente->id,
                    'propiedad_id' => $propiedad->id,
                ]);
            }
        }
    }
}
