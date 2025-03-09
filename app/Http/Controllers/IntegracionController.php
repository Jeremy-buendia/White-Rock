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
use Illuminate\Container\Attributes\Log;

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
        try{
        // Obtenemos todas las visitas confirmadas del agente especificado por su ID
        $visitas = Visita::where('agente_id', $idAgente)->where('estado', 'confirmada')->get();
    
        // Mostramos la vista de visitas programadas con los datos obtenidos
        return view('agente.visitas_programadas', compact('visitas'));
        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error al obtener las visitas programadas'], 500);
        }
    }

    // Permite a clientes y agentes ver transacciones de una propiedad.
    public function verTransaccionesPropiedad($idPropiedad)
    {
        try{
        // Obtenemos todas las transacciones de la propiedad especificada por su ID
        $transacciones = Transaccion::where('propiedad_id', $idPropiedad)->get();
    
        // Mostramos la vista de transacciones de la propiedad con los datos obtenidos
        return view('propiedades.transacciones', compact('transacciones'));
    } catch (\Exception $e) {
        return response()->json(['mensaje' => 'Error al obtener las visitas programadas'], 500);
    }
    }

    // Permite a clientes y agentes acceder al contrato de una transacción.
    public function verContrato($idContrato)
    {
        try{
        // Obtenemos el contrato especificado por su ID o lanzamos un error 404 si no se encuentra
        $contrato = Contrato::findOrFail($idContrato);
    
        // Mostramos la vista de detalles del contrato con los datos obtenidos
        return view('contratos.detalles', compact('contrato'));
    } catch (\Exception $e) {
        return response()->json(['mensaje' => 'Error al obtener las visitas programadas'], 500);
    }
    }
}