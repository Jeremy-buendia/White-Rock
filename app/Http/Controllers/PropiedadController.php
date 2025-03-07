<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Propiedad;

class PropiedadController extends Controller
{


    public function create()
    {
        return view('agente.crearInmueble');
    }

    public function store(Request $request)
    {
        //Comprobamos que los datos sean correctos
        $request->validate([
            'nombre' => 'required|string|max:255|min:3',
            'direccion' => 'required|string|max:255',
            'tipo_propiedad' => 'required|in:casa,apartamento,terreno',
            'precio' => 'required|numeric',
            'tamano' => 'required|integer',
            'descripcion' => 'required|string',
            'estado' => 'required|in:disponible,vendido,alquilado',
        ]);

        //Creamos la propiedad
        $propiedad = Propiedad::create($request->all());

        $agente = Auth::user();
        $agenteId = $agente->id;
        $propiedad->agentes()->attach($agenteId);

        return redirect()->route('agente.dashboard')->with('info', 'La propiedad ha sido añadida');
    }
}
