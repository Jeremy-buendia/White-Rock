<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Propiedad;
use App\Models\FotografiaPropiedad;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            DB::transaction(function () use ($request) { // Corregido: usa 'use ($request)' para acceder a $request
                // Creamos la propiedad
                $propiedad = Propiedad::create($request->except('imagenes'));

                $agente = Auth::user();
                $agenteId = $agente->id;
                $propiedad->agentes()->attach($agenteId);

                $carpetaPropiedad = 'imagenes/propiedad/' . $propiedad->id;

                if ($request->hasFile('imagenes')) { // Verifica si se subieron archivos

                    foreach ($request->file('imagenes') as $imagen) { // Itera sobre cada archivo
                        // Guardamos el archivo y obtenemos la ruta completa
                        $imagePath = $imagen->store($carpetaPropiedad, 'public');

                        // Actualizamos la base de datos con la nueva imagen
                        FotografiaPropiedad::create([
                            'propiedad_id' => $propiedad->id,
                            'url_fotografia' => $imagePath,
                            'descripcion' => 'si'
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
        //FindOrFail nos permite recuperar un cliente por su id y si no lo encuentra nos devuelve un error 404
        $propiedad = Propiedad::findOrFail($id);
        return view('propiedad.view', compact('propiedad'));
    }

    public function index_clientes()
    {
        $inmuebles = Propiedad::all();
        $categorias = Propiedad::select('tipo_propiedad')->distinct()->get();

        return view('propiedades.index', compact('inmuebles', 'categorias'));
    }
}
