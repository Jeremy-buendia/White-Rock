<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudVisita;
use App\Models\Visita;

class VisitaController extends Controller
{
    public function formularioSolicitarVisita()
    {
        return view('agente.crearSolicitudVisita');
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

    public function solicitarVisitaAgente($idCliente, $idPropiedad, $fechaPropuesta)
    {
        $solicitud = new SolicitudVisita();
        $solicitud->id_cliente = $idCliente;
        $solicitud->id_propiedad = $idPropiedad;
        $solicitud->fecha_propuesta = $fechaPropuesta;
        $solicitud->estado = 'aprobada';
        $solicitud->save();

        return response()->json(['mensaje' => 'Solicitud de visita enviada']);
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
