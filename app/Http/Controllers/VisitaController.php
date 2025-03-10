<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudVisita;
use App\Models\Visita;
use Illuminate\Support\Facades\Auth;
use App\Models\Propiedad;
use App\Models\AgenteInmobiliario;
use App\Models\User;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class VisitaController extends Controller
{
    public function formularioSolicitarVisita()
    {
        try {
            $agente = Auth::user();

            if (!$agente) {
                // Manejar el caso donde no hay un usuario autenticado
                return redirect()->route('login')->with('error', 'Por favor, inicia sesión.');
            }

            /** @var \App\Models\Agente $agente */
            $propiedades = $agente->propiedades()->where(['estado' => 'disponible'])->get();
            return view('visita.crearSolicitudVisita', compact('propiedades'));
        } catch (\Exception $e) {
            Log::error('Error en formularioSolicitarVisita: ' . $e->getMessage());
            return redirect()->route('agente.dashboard')->with('error', 'Ocurrió un error al cargar el formulario de solicitud de visita.');
        }
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
        $request->validate([
            'propiedad_id' => ['required', 'integer', 'exists:propiedades,id'],
            'correo_electronico' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::exists('users', 'email'),
            ],
            'fecha_propuesta' => ['required', 'date', 'after:now'],
        ]);

        try {
            $idCliente = User::findByEmail($request->input('correo_electronico'))->id;
            $agenteId = Auth::user()->id;

            SolicitudVisita::create([
                'propiedad_id' => $request->input('propiedad_id'),
                'user_id' => $idCliente,
                'agente_id' => $agenteId,
                'estado' => 'aprobada',
                'fecha_solicitud' => now(),
                'fecha_propuesta' => $request->input('fecha_propuesta')
            ]);

            return redirect()->route('agente.dashboard')->with('success', 'La visita ha sido añadida');
        } catch (\Exception $e) {
            Log::error('Error en solicitarVisitaAgente: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al solicitar la visita. Por favor, inténtalo de nuevo.')->withInput();
        }
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

    public function edit($id)
    {
        try {
            $solicitudVisita = SolicitudVisita::findOrFail($id);

            /** @var \App\Models\Agente $agente */
            $agente = Auth::user();

            if (!$agente) {
                return redirect()->route('login')->with('error', 'Por favor, inicia sesión.');
            }

            $propiedades = $agente->propiedades()->get();

            $emailCliente = User::findByid($solicitudVisita->user_id)->email;
            $propiedadVisita = Propiedad::findOrFail($solicitudVisita->propiedad_id);

            return view('visita.update', compact('solicitudVisita', 'propiedades', 'emailCliente', 'propiedadVisita'));
        } catch (\Exception $e) {
            Log::error('Error en visita.edit (ID ' . $id . '): ' . $e->getMessage());
            return redirect()->route('agente.dashboard')->with('error', 'No se pudo cargar el formulario de edición de la solicitud de visita.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $solicitudVisita = SolicitudVisita::findOrFail($id);

            $request->validate([
                'propiedad_id' => ['required', 'integer', 'exists:propiedades,id'],
                'correo_electronico' => [
                    'required',
                    'string',
                    'lowercase',
                    'email',
                    'max:255',
                    Rule::exists('users', 'email'),
                ],
                'fecha_propuesta' => ['required', 'date', 'after:now'],
            ]);

            $solicitudVisita->update($request->all());
            return redirect()->route('agente.dashboard')->with('success', 'La solicitud de visita ha sido actualizada');
        } catch (\Exception $e) {
            Log::error('Error en visita.update (ID ' . $id . '): ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar la solicitud de visita. Por favor, inténtalo de nuevo.')->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $solicitudVisita = SolicitudVisita::findOrFail($id);
            $solicitudVisita->delete();
            return redirect()->route('agente.dashboard')->with('success', 'La solicitud ha sido eliminada');
        } catch (\Exception $e) {
            Log::error('Error en visita.destroy (ID ' . $id . '): ' . $e->getMessage());
            return redirect()->route('agente.dashboard')->with('error', 'Ocurrió un error al eliminar la solicitud.');
        }
    }

    public function aceptar($id)
    {
        try {
            $solicitudVisita = SolicitudVisita::findOrFail($id);
            $solicitudVisita->update(['estado' => 'aprobada']);
            return redirect()->route('agente.dashboard')->with('success', 'La solicitud ha sido aceptada');
        } catch (\Exception $e) {
            Log::error('Error en visita.aceptar (ID ' . $id . '): ' . $e->getMessage());
            return redirect()->route('agente.dashboard')->with('error', 'Ocurrió un error al aceptar la solicitud.');
        }
    }

    public function cancelar($id)
    {
        try {
            $solicitudVisita = SolicitudVisita::findOrFail($id);
            $solicitudVisita->delete();

            return redirect()->back()->with('success', 'Solicitud de visita cancelada correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al cancelar la solicitud de visita: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al cancelar la solicitud de visita. Por favor, inténtalo de nuevo.');
        }
    }

    public function index_all()
    {
        try {
            $agente = Auth::user();
            $agenteId = $agente->id;

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
                ->get();

            return view('visita.index_all', compact('visitas'));
        } catch (\Exception $e) {
            Log::error('Error en visita.index_all: ' . $e->getMessage());
            return redirect()->route('agente.dashboard')->with('error', 'Ocurrió un error al cargar la lista de solicitudes de visita.');
        }
    }

    public function index_all_propiedad($id)
    {
        try {
            $visitas = SolicitudVisita::where('propiedad_id', $id)->get();
            $propiedad = Propiedad::findOrFail($id);

            return view('visita.index_all_propiedad', compact('visitas', 'propiedad'));
        } catch (\Exception $e) {
            Log::error('Error en visita.index_all: ' . $e->getMessage());
            return redirect()->route('agente.dashboard')->with('error', 'Ocurrió un error al cargar la lista de solicitudes de visita.');
        }
    }
}
