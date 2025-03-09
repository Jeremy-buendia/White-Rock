<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\AgenteInmobiliario;
use App\Models\Propiedad;
use App\Models\SolicitudVisita;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AgenteInmobiliarioController extends Controller
{
    public function dashboard()
    {
        try {
            $agente = Auth::user();
            $agenteId = $agente->id;

            /** @var \App\Models\Agente $agente */
            $inmuebles = $agente->propiedades()->paginate(3, ['*'], 'inmuebles');

            /** @var \App\Models\Agente $agente */
            $visitas = $agente->solicitudesVisitas()
                ->with(['user', 'propiedad'])
                ->where(
                    [
                        ['fecha_propuesta', '>=', Carbon::now()],
                        ['estado', '=', 'aprobada']
                    ]
                )
                ->orderBy('fecha_propuesta', 'asc')
                ->take(2)
                ->get();

            /** @var \App\Models\Agente $agente */
            $solicitudVisitas = $agente->solicitudesVisitas()
                ->with('user', 'propiedad')
                ->where(
                    [
                        ['fecha_propuesta', '>=', Carbon::now()],
                        ['estado', '=', 'pendiente']
                    ]
                )
                ->orderBy('fecha_propuesta', 'asc')
                ->paginate(3, ['*'], 'solicitudes');



            return view('agente.dashboard', compact('inmuebles', 'visitas', 'solicitudVisitas'));
        } catch (\Exception $e) {
            Log::error('Error en dashboard: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Ocurrió un error. Por favor, inicia sesión nuevamente.');
        }
    }
}
