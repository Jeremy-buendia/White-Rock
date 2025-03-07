<?php

namespace App\Http\Controllers;

use App\Models\SolicitudVisita;
use App\Models\User;
use App\Models\Visita;
use App\Models\Transaccion;
use App\Models\Contrato;
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

    //Lista las visitas confirmadas para el agente.
    
    public function verVisitasProgramadas($idAgente)
    {
        $visitas = Visita::where('agente_id', $idAgente)->where('estado', 'confirmada')->get();
        return view('agente.visitas_programadas', compact('visitas'));
    }
    
    //Permite a clientes y agentes ver transacciones de una propiedad.
     
    public function verTransaccionesPropiedad($idPropiedad)
    {
        $transacciones = Transaccion::where('propiedad_id', $idPropiedad)->get();
        return view('propiedades.transacciones', compact('transacciones'));
    }
    
    //Permite a clientes y agentes acceder al contrato de una transacción.
     
    public function verContrato($idContrato)
    {
        $contrato = Contrato::findOrFail($idContrato);
        return view('contratos.detalles', compact('contrato'));
    }
}