<?php

namespace App\Http\Controllers;

use App\Models\SolicitudVisita;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SolicitudVisitaEstadoChanged;
use App\Notifications\NuevaSolicitudVisita;

class IntegracionController extends Controller
{
    // Permite a un agente ver solicitudes de visita de su propiedad
    public function verSolicitudesVisitasPorPropiedad($idPropiedad)
    {
        $solicitudes = SolicitudVisita::where('propiedad_id', $idPropiedad)->get();
        return view('agente.solicitudes_visitas', compact('solicitudes', 'idPropiedad'));
    }

    // Envía notificación al cliente cuando su solicitud cambia de estado
    public function notificarClienteCambioEstadoSolicitud($idSolicitud, $estado)
    {
        $solicitud = SolicitudVisita::find($idSolicitud);
        if ($solicitud) {
            $solicitud->estado = $estado;
            $solicitud->save();

            $cliente = $solicitud->user;
            Notification::send($cliente, new SolicitudVisitaEstadoChanged($solicitud));

            return response()->json(['mensaje' => 'Estado de la solicitud actualizado y notificación enviada']);
        }

        return response()->json(['mensaje' => 'Solicitud no encontrada'], 404);
    }

    // Informa a un agente cuando recibe una solicitud de visita
    public function notificarAgenteNuevaSolicitudVisita($idAgente, $idSolicitud)
    {
        $agente = User::find($idAgente);
        $solicitud = SolicitudVisita::find($idSolicitud);

        if ($agente && $solicitud) {
            Notification::send($agente, new NuevaSolicitudVisita($solicitud));

            return response()->json(['mensaje' => 'Notificación enviada al agente']);
        }

        return response()->json(['mensaje' => 'Agente o solicitud no encontrados'], 404);
    }

    // Permite ver todas las solicitudes de visita
    public function verTodasSolicitudesVisitas()
    {
        $solicitudes = SolicitudVisita::all();
        return view('agente.todas_solicitudes_visitas', compact('solicitudes'));
    }
}