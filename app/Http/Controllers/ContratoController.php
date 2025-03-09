<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AgenteInmobiliario;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Propiedad;
use App\Models\Contrato;
use Illuminate\Support\Facades\Log;

class ContratoController extends Controller
{
    public function index_all()
    {
        try {
            $agente = Auth::user();

            if (!$agente) {
                return redirect()->route('login')->with('error', 'Por favor, inicia sesión.');
            }

            $agenteId = $agente->id;

            /** @var \App\Models\Agente $agente */
            $contratos = $agente->contratos()->with(['user', 'propiedad'])->get();

            return view('contrato.index_all', compact('contratos'));
        } catch (\Exception $e) {
            Log::error('Error en index_all: ' . $e->getMessage());
            return redirect()->route('agente.dashboard')->with('error', 'Ocurrió un error al cargar los contratos.');
        }
    }

    public function index($id)
    {
        try {
            $contrato = Contrato::findOrFail($id);

            $usuario = $contrato->user()->first();
            $propiedad = $contrato->propiedad()->first();

            return view('contrato.index', compact('contrato', 'usuario', 'propiedad'));
        } catch (\Exception $e) {
            Log::error('Error en index (contrato ID ' . $id . '): ' . $e->getMessage()); // Incluye el ID en el mensaje de error
            return redirect()->route('contratos.index_all')->with('error', 'No se pudo encontrar el contrato.');
        }
    }

    public function create()
    {
        try {
            $agente = Auth::user();

            if (!$agente) {
                // Manejar el caso donde no hay un usuario autenticado
                return redirect()->route('login')->with('error', 'Por favor, inicia sesión.');
            }

            /** @var \App\Models\Agente $agente */
            $propiedades = $agente->propiedades()->where(['estado' => 'disponible'])->get();
            return view('contrato.create', compact('propiedades'));
        } catch (\Exception $e) {
            Log::error('Error en create: ' . $e->getMessage());
            return redirect()->route('agente.dashboard')->with('error', 'Ocurrió un error al cargar el formulario de creación de contrato.');
        }
    }

    public function store(Request $request)
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
            'tipo_contrato' => ['required', Rule::in(['compra', 'venta', 'alquiler'])],
            'fecha_inicio' => ['required', 'date'],
            'fecha_finalizacion' => ['date', 'after:fecha_inicio'],
            'condiciones' => ['nullable', 'string'],
        ]);

        $idCliente = User::findByEmail($request->input('correo_electronico'))->id;
        $agenteId = Auth::user()->id;

        try {

            $contrato = Contrato::create([
                'propiedad_id' => $request->input('propiedad_id'),
                'user_id' => $idCliente,
                'agente_id' => $agenteId,
                'tipo_contrato' => $request->input('tipo_contrato'),
                'fecha_inicio' => $request->input('fecha_inicio'),
                'fecha_finalizacion' => $request->input('fecha_finalizacion') ?? null,
                'condiciones' => $request->input('condiciones')
            ]);

            $propiedad = Propiedad::findOrFail($request->propiedad_id);

            if ($contrato->tipo_contrato == "venta") {
                $propiedad->update(['estado' => 'vendido']);
            } else if ($contrato->tipo_contrato == "alquiler") {
                $propiedad->update(['estado' => 'alquilado']);
            }

            return redirect()->route('agente.dashboard')->with('success', 'El contrato ha sido creado');
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', 'Error al crear el contrato. Por favor, inténtalo de nuevo.')->withInput();
        }
    }
}
