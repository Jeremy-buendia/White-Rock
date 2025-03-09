<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Propiedad;
use App\Models\FotografiaPropiedad;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\SolicitudVisita;
use App\Models\AgenteInmobiliario;

class PropiedadController extends Controller
{
    public function create()
    {
        return view('agente.crearInmueble');
    }

    public function store(Request $request)
    {
        // Comprobamos que los datos sean correctos
        $request->validate([
            'nombre' => 'required|string|max:255|min:3',
            'direccion' => 'required|string|max:255',
            'tipo_propiedad' => 'required|in:casa,apartamento,terreno',
            'precio' => 'required|numeric',
            'tamano' => 'required|integer',
            'descripcion' => 'required|string',
            'estado' => 'required|in:disponible,vendido,alquilado',
            'imagenes' => 'required|array',
            'imagenes.*' => 'required|file|mimes:jpeg,jpg,png,svg|max:2048'
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Creamos la propiedad
                $propiedad = Propiedad::create($request->except('imagenes'));

                $agente = Auth::user();
                $agenteId = $agente->id;
                $propiedad->agentes()->attach($agenteId);

                $carpetaPropiedad = 'imagenes/propiedad/' . $propiedad->id;

                // Verifica si se subieron archivos
                if ($request->hasFile('imagenes')) {
                    foreach ($request->file('imagenes') as $imagen) {
                        // Guardamos el archivo y obtenemos la ruta completa
                        $imagePath = $imagen->store($carpetaPropiedad, 'public');

                        // Actualizamos la base de datos con la nueva imagen
                        FotografiaPropiedad::create([
                            'propiedad_id' => $propiedad->id,
                            'url_fotografia' => $imagePath,
                            'descripcion' => $imagen->getClientOriginalName()
                        ]);
                    }
                }
            });

            return redirect()->route('agente.dashboard')->with('success', 'La propiedad ha sido añadida');
        } catch (\Exception $e) {
            Log::error('Error al crear la propiedad y subir imágenes: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al crear la propiedad.  Por favor, inténtelo de nuevo. ' . $e->getMessage())->withInput();
        }
    }

    public function index($id)
    {
        try {
            //FindOrFail nos permite recuperar un cliente por su id y si no lo encuentra nos devuelve un error 404
            $propiedad = Propiedad::findOrFail($id);
            $imagenes = $propiedad->fotografias;
            return view('propiedad.view', compact('propiedad', 'imagenes'));
        } catch (\Exception $e) {
            Log::error('Error en propiedad.index (ID ' . $id . '): ' . $e->getMessage());
            return redirect()->route('propiedades.index_clientes')->with('error', 'No se pudo encontrar la propiedad.');
        }
    }

    public function index_clientes()
    {
        try {
            $inmuebles = Propiedad::where('estado', 'disponible')->get();
            $categorias = Propiedad::select('tipo_propiedad')->distinct()->get();

            return view('propiedades.index', compact('inmuebles', 'categorias'));
        } catch (\Exception $e) {
            Log::error('Error en propiedad.index_clientes: ' . $e->getMessage());
            return redirect()->route('alguna.ruta.de.error')->with('error', 'Ocurrió un error al cargar la lista de propiedades.');
        }
    }

    public function edit($id)
    {
        try {
            $inmueble = Propiedad::findOrFail($id);
            $imagenes = $inmueble->fotografias;
            return view('propiedad.update', compact('inmueble', 'imagenes'));
        } catch (\Exception $e) {
            Log::error('Error en propiedad.edit (ID ' . $id . '): ' . $e->getMessage());
            return redirect()->route('propiedades.index_clientes')->with('error', 'No se pudo encontrar la propiedad para editar.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|min:3',
            'direccion' => 'required|string|max:255',
            'tipo_propiedad' => 'required|in:casa,apartamento,terreno',
            'precio' => 'required|numeric',
            'tamano' => 'required|integer',
            'descripcion' => 'required|string',
            'estado' => 'required|in:disponible,vendido,alquilado',
            'imagenes' => 'array',
            'imagenes.*' => 'file|mimes:jpeg,jpg,png,svg|max:2048'
        ]);

        try {
            DB::transaction(function () use ($request, $id) {
                $propiedad = Propiedad::findOrFail($id);

                //Traspaso de agente futuro ?¿
                // $agente = Auth::user();
                // $agenteId = $agente->id;
                // $propiedad->agentes()->attach($agenteId);

                $imagenes = FotografiaPropiedad::where('propiedad_id', $id)->get();

                $carpetaPropiedad = 'imagenes/propiedad/' . $propiedad->id;

                if ($request->hasFile('imagenes')) { // Verifica si se subieron archivos

                    foreach ($imagenes as $imagen) {
                        Storage::disk('public')->delete($imagen->url_fotografia);
                        $imagen->delete();
                    }

                    foreach ($request->file('imagenes') as $imagen) {
                        // Guardamos el archivo y obtenemos la ruta completa
                        $imagePath = $imagen->store($carpetaPropiedad, 'public');

                        // Actualizamos la base de datos con la nueva imagen
                        FotografiaPropiedad::create([
                            'propiedad_id' => $propiedad->id,
                            'url_fotografia' => $imagePath,
                            'descripcion' => $imagen->getClientOriginalName()
                        ]);
                    }
                }
                $propiedad->update($request->except('imagenes'));
            });

            return redirect()->route('agente.dashboard')->with('success', 'La propiedad ha sido actualizada');
        } catch (\Exception $e) {
        }
    }

    public function destroy($id)
    {
        try {
            $inmueble = Propiedad::findOrFail($id);
            $inmueble->delete();
            return redirect()->route('agente.dashboard')->with('success', 'La propiedad ha sido eliminada');
        } catch (\Exception $e) {
            Log::error('Error al eliminar propiedad (ID ' . $id . '): ' . $e->getMessage());
            return redirect()->route('agente.dashboard')->with('error', 'Ocurrió un error al eliminar la propiedad. Por favor, inténtalo de nuevo.');
        }
    }

    public function show(Propiedad $propiedad)
    {
        // Verificar si ya se ha solicitado una visita para esta propiedad
        $propiedad->visita_solicitada = SolicitudVisita::where('propiedad_id', $propiedad->id)
            ->where('user_id', Auth::id())
            ->exists();
        return view('propiedades.show', compact('propiedad'));
    }

    public function solicitarVisita(Request $request, Propiedad $propiedad)
    {
        // Verificar si ya se ha solicitado una visita para esta propiedad
        if (SolicitudVisita::where('propiedad_id', $propiedad->id)
            ->where('user_id', Auth::id())
            ->exists()
        ) {
            return response()->json(['message' => 'Visita ya solicitada'], 400);
        }

        // Obtener un agente aleatorio
        $agente = AgenteInmobiliario::inRandomOrder()->first();

        // Crear la solicitud de visita
        SolicitudVisita::create([
            'propiedad_id' => $propiedad->id,
            'user_id' => Auth::id(),
            'agente_id' => $agente->id,
            'estado' => 'pendiente',
            'fecha_solicitud' => now(),
        ]);

        return response()->json(['message' => 'Visita solicitada correctamente']);
    }

    public function index_home()
    {
        $recientes = Propiedad::orderBy('created_at', 'desc')->take(5)->get();
        $masCaras = Propiedad::orderBy('precio', 'desc')->take(5)->get();
        $masBaratas = Propiedad::orderBy('precio', 'asc')->take(5)->get();

        return view('home', compact('recientes', 'masCaras', 'masBaratas'));
    }
}
