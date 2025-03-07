<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudVisita;
use App\Models\Visita;
use Illuminate\Support\Facades\Auth;
use App\Models\Propiedad;
use App\Models\AgenteInmobiliario;
use App\Models\User;

class VisitaController extends Controller
{
    public function formularioSolicitarVisita()
    {
        $agente = Auth::user();
        $propiedades = $agente->propiedades()->get();
        return view('agente.crearSolicitudVisita', compact('propiedades'));
    }

    // Envía una solicitud de visita a un agente
    public function solicitarVisita($idCliente, $idPropiedad, $fechaPropuesta)
    {
        $solicitud = new SolicitudVisita();
        $solicitud->id_cliente = $idCliente;
        $solicitud->id_propiedad = $idPropiedad;
        $solicitud->fecha_propuesta = $fechaPropuesta;
        $solicitud->estado = 'pendiente';
        $solicitud->save();

        return response()->json(['mensaje' => 'Solicitud de visita enviada']);
    }

    public function solicitarVisitaAgente(Request $request)
    {
        //Validar

        $idCliente = User::findByEmail($request->input('correo_electronico'))->id;
        $agenteId = Auth::user()->id;

        SolicitudVisita::create([
            'propiedad_id' => $request->input('propiedad_id'),
            'user_id' => $idCliente,
            'agente_id' => $agenteId,
            'fecha_solicitud' => now(),
            'fecha_propuesta' => $request->input('fecha_propuesta')
        ]);

        return redirect()->route('agente.dashboard')->with('success', 'La visita ha sido añadida');
    }

    // Consulta el estado de una solicitud de visita
    public function verEstadoSolicitudVisita($idSolicitud)
    {
        $solicitud = SolicitudVisita::find($idSolicitud);
        return response()->json($solicitud);
    }

    // Lista visitas realizadas y pendientes de un cliente
    public function verHistorialVisitasCliente($idCliente)
    {
        $visitas = Visita::where('cliente_id', $idCliente)->get();
        return response()->json($visitas);
    }
}
