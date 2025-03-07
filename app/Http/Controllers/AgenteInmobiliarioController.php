<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\AgenteInmobiliario;

class AgenteInmobiliarioController extends Controller
{
    public function dashboard()
    {
        $agente = Auth::user();
        $agenteId = $agente->id;

        //$visitasProximas = Visita::where('agente_id', $agenteId)->where('fecha_visita', '>=', now())->orderBy('fecha', 'asc')->take(3)->get();

        //$inmuebles = $agente->load('propiedades')->propiedades()->paginate(10);

        // Cargar el agente y las propiedades en la misma consulta
        $inmuebles = $agente->propiedades()->paginate(3);

        // Paginación de las propiedades
        //$inmuebles = $agente->propiedades()->paginate(10);

        return view('agente.dashboard', compact('inmuebles'));

        //return view('agente.dashboard');
    }
}
