<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Oficina;
use Illuminate\Support\Facades\Log;

class OficinaController extends Controller
{
    public function index()
    {
        try {
            $agente = Auth::user();

            if (!$agente) {
                return redirect()->route('login')->with('error', 'Por favor, inicia sesión.');
            }

            /** @var \App\Models\Agente $agente */
            $oficina = $agente->oficina()->where(['id' => $agente->oficina_id])->first();

            return view('oficina.index', compact('oficina'));
        } catch (\Exception $e) {
            Log::error('Error en oficina.index: ' . $e->getMessage());
            return redirect()->route('agente.dashboard')->with('error', 'Ocurrió un error al cargar la información de la oficina.');
        }
    }

    public function create()
    {
        return view('oficina.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'direccion' => ['required', 'string', 'max:255'],
                'telefono' => ['required', 'string', 'max:20'],
                'fax' => ['nullable', 'string', 'max:20']
            ]);

            Oficina::create([
                'nombre' => $request->input('nombre'),
                'direccion' => $request->input('direccion'),
                'telefono' => $request->input('telefono'),
                'fax' => $request->input('fax')
            ]);

            return redirect()->route('agente.dashboard')->with('success', 'Oficina registrada');
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', 'Error al crear la oficina. Por favor, inténtalo de nuevo.')->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $oficina = Oficina::findOrFail($id);

            return view('oficina.update', compact('oficina'));
        } catch (\Exception $e) {
            Log::error('Error en oficina.edit (ID ' . $id . '): ' . $e->getMessage());
            return redirect()->route('oficina.index')->with('error', 'No se pudo encontrar la oficina.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'direccion' => ['required', 'string', 'max:255'],
                'telefono' => ['required', 'string', 'max:20'],
                'fax' => ['nullable', 'string', 'max:20']
            ]);

            $oficina = Oficina::findOrFail($id);
            $oficina->update($request->all());

            return redirect()->route('agente.dashboard')->with('success', 'Oficina actualizada');
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', 'Error al actualizar la oficina. Por favor, inténtalo de nuevo.')->withInput();
        }
    }
}
