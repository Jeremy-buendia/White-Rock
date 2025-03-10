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
    // Método para mostrar la vista de creación de una nueva propiedad
    public function create()
    {
        try {
            return view('agente.crearInmueble');
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', 'Error al mostrar el formulario de creación de propiedad. Por favor, inténtalo de nuevo.');
        }
    }

    // Método para almacenar una nueva propiedad en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos recibidos
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
            // Iniciamos una transacción para asegurar la consistencia de los datos
            DB::transaction(function () use ($request) {
                // Creamos la propiedad con los datos recibidos, excepto las imágenes
                $propiedad = Propiedad::create($request->except('imagenes'));

                // Obtenemos el agente autenticado y su ID
                $agente = Auth::user();
                $agenteId = $agente->id;
                // Asociamos la propiedad con el agente
                $propiedad->agentes()->attach($agenteId);

                // Definimos la carpeta donde se guardarán las imágenes de la propiedad
                $carpetaPropiedad = 'imagenes/propiedad/' . $propiedad->id;

                // Verificamos si se subieron archivos
                if ($request->hasFile('imagenes')) {
                    foreach ($request->file('imagenes') as $imagen) {
                        // Guardamos el archivo y obtenemos la ruta completa
                        $imagePath = $imagen->store($carpetaPropiedad, 'public');

                        // Creamos un registro en la base de datos para cada imagen
                        FotografiaPropiedad::create([
                            'propiedad_id' => $propiedad->id,
                            'url_fotografia' => $imagePath,
                            'descripcion' => $imagen->getClientOriginalName()
                        ]);
                    }
                }
            });

            // Redirigimos al dashboard del agente con un mensaje de éxito
            return redirect()->route('agente.dashboard')->with('success', 'La propiedad ha sido añadida');
        } catch (\Exception $e) {
            // Registramos el error en el log y redirigimos con un mensaje de error
            Log::error('Error al crear la propiedad y subir imágenes: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al crear la propiedad.  Por favor, inténtelo de nuevo. ' . $e->getMessage())->withInput();
        }
    }

    // Método para mostrar una propiedad específica por su ID
    public function index($id)
    {
        try {
            // Recuperamos la propiedad por su ID o lanzamos un error 404 si no se encuentra
            $propiedad = Propiedad::findOrFail($id);
            // Obtenemos las imágenes asociadas a la propiedad
            $imagenes = $propiedad->fotografias;
            // Mostramos la vista con los datos de la propiedad y sus imágenes
            return view('propiedad.view', compact('propiedad', 'imagenes'));
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', 'Error al mostrar la propiedad. Por favor, inténtalo de nuevo.');
        }
    }

    public function index_clientes(Request $request)
    {
        try {
            $query = Propiedad::query()->where('estado', 'disponible');

            if ($request->has('categoria')) {
                $query->where('tipo_propiedad', $request->input('categoria'));
            }

            if ($request->has('orden')) {
                switch ($request->input('orden')) {
                    case 'mas_grande':
                        $query->orderBy('tamano', 'desc');
                        break;
                    case 'mas_chica':
                        $query->orderBy('tamano', 'asc');
                        break;
                    case 'mas_cara':
                        $query->orderBy('precio', 'desc');
                        break;
                    case 'mas_barata':
                        $query->orderBy('precio', 'asc');
                        break;
                    case 'recientes':
                        $query->orderBy('created_at', 'desc')->take(3);
                        break;
                }
            }

            $inmuebles = $query->get();
            $categorias = Propiedad::select('tipo_propiedad')->distinct()->get();

            // Obtener las tres propiedades más recientes
            $recientes = Propiedad::where('estado', 'disponible')->orderBy('created_at', 'desc')->take(3)->get();

            // Marcar las propiedades recientes
            foreach ($inmuebles as $inmueble) {
                $inmueble->es_reciente = $recientes->contains($inmueble);
            }

            return view('propiedades.index', compact('inmuebles', 'categorias', 'recientes'));
        } catch (\Exception $e) {
            Log::error('Error al obtener las propiedades: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al obtener las propiedades. Por favor, inténtelo de nuevo.');
        }
    }

    // Método para mostrar la vista de edición de una propiedad específica
    public function edit($id)
    {
        try {
            // Recuperamos la propiedad por su ID o lanzamos un error 404 si no se encuentra
            $inmueble = Propiedad::findOrFail($id);
            // Obtenemos las imágenes asociadas a la propiedad
            $imagenes = $inmueble->fotografias;
            // Mostramos la vista de edición con los datos de la propiedad y sus imágenes
            return view('propiedad.update', compact('inmueble', 'imagenes'));
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', 'Error al mostrar el formulario de edición de propiedad. Por favor, inténtalo de nuevo.');
        }
    }

    // Método para actualizar una propiedad específica
    public function update(Request $request, $id)
    {
        // Validación de los datos recibidos
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
            // Iniciamos una transacción para asegurar la consistencia de los datos
            DB::transaction(function () use ($request, $id) {
                // Recuperamos la propiedad por su ID o lanzamos un error 404 si no se encuentra
                $propiedad = Propiedad::findOrFail($id);

                // Obtenemos las imágenes asociadas a la propiedad
                $imagenes = FotografiaPropiedad::where('propiedad_id', $id)->get();

                // Definimos la carpeta donde se guardarán las imágenes de la propiedad
                $carpetaPropiedad = 'imagenes/propiedad/' . $propiedad->id;

                // Verificamos si se subieron archivos
                if ($request->hasFile('imagenes')) {
                    // Eliminamos las imágenes existentes
                    foreach ($imagenes as $imagen) {
                        Storage::disk('public')->delete($imagen->url_fotografia);
                        $imagen->delete();
                    }

                    // Guardamos las nuevas imágenes
                    foreach ($request->file('imagenes') as $imagen) {
                        // Guardamos el archivo y obtenemos la ruta completa
                        $imagePath = $imagen->store($carpetaPropiedad, 'public');

                        // Creamos un registro en la base de datos para cada imagen
                        FotografiaPropiedad::create([
                            'propiedad_id' => $propiedad->id,
                            'url_fotografia' => $imagePath,
                            'descripcion' => $imagen->getClientOriginalName()
                        ]);
                    }
                }
                // Actualizamos la propiedad con los datos recibidos, excepto las imágenes
                $propiedad->update($request->except('imagenes'));
            });

            // Redirigimos al dashboard del agente con un mensaje de éxito
            return redirect()->route('agente.dashboard')->with('success', 'La propiedad ha sido actualizada');
        } catch (\Exception $e) {
            // Registramos el error en el log y redirigimos con un mensaje de error
            Log::error('Error al actualizar la propiedad: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al actualizar la propiedad.  Por favor, inténtelo de nuevo. ' . $e->getMessage())->withInput();
        }
    }

    // Método para eliminar una propiedad específica
    public function destroy($id)
    {
        try {
            // Recuperamos la propiedad por su ID o lanzamos un error 404 si no se encuentra
            $inmueble = Propiedad::findOrFail($id);
            // Eliminamos la propiedad
            $inmueble->delete();
            // Redirigimos al dashboard del agente con un mensaje de éxito
            return redirect()->route('agente.dashboard')->with('success', 'La propiedad ha sido eliminada');
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', 'Error al eliminar la propiedad. Por favor, inténtalo de nuevo.');
        }
    }

    // Método para mostrar una propiedad específica
    public function show(Propiedad $propiedad)
    {
        try {
            // Verificamos si ya se ha solicitado una visita para esta propiedad
            $propiedad->visita_solicitada = SolicitudVisita::where('propiedad_id', $propiedad->id)
                ->where('user_id', Auth::id())
                ->exists();
            // Mostramos la vista con los datos de la propiedad
            return view('propiedades.show', compact('propiedad'));
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', 'Error al mostrar la propiedad. Por favor, inténtalo de nuevo.');
        }
    }

    // Método para solicitar una visita a una propiedad específica
    public function solicitarVisita(Request $request, $id)
    {
        // Asegurarse de que haya un usuario autenticado
        if (Auth::check()) {
            $user = Auth::user();
            $userModel = get_class($user);

            //Usuario es agente
            if ($userModel === AgenteInmobiliario::class) {
                return redirect()->route('login');
            }
        } else {
            // No hay ningún usuario autenticado
            return redirect()->route('login');
        }

        $request->validate([
            'fecha_propuesta' => 'required|date|after:today',
        ]);

        try {
            // Verificamos si ya se ha solicitado una visita para esta propiedad
            if (SolicitudVisita::where('propiedad_id', $id)
                ->where('user_id', Auth::id())
                ->exists()
            ) {
                return redirect()->back()->with('error', 'Visita ya solicitada');
            }

            $propiedad = Propiedad::findOrFail($id);

            $agente = $propiedad->agentes->first();

            // Obtenemos un agente aleatorio
            //$agente = AgenteInmobiliario::inRandomOrder()->first();
            if (!$agente) {
                Log::error('No se encontró un agente inmobiliario.');
                return redirect()->back()->with('error', 'No se encontró un agente inmobiliario.');
            }

            // Creamos la solicitud de visita
            $pruebita = SolicitudVisita::create([
                'propiedad_id' => $id,
                'user_id' => Auth::user()->id,
                'agente_id' => $agente->id,
                'estado' => 'pendiente',
                'fecha_solicitud' => now(),
                'fecha_propuesta' => $request->fecha_propuesta,
            ]);


            // Redirigimos con un mensaje de éxito en la sesión
            return redirect()->back()->with('success', 'Visita solicitada correctamente');
        } catch (\Exception $e) {
            Log::error('Error al solicitar la visita: ' . $e->getMessage());
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Error al solicitar la visita. Por favor, inténtalo de nuevo.');
        }
    }

    // Método para mostrar las propiedades en la página de inicio
    public function index_home()
    {
        try {
            // Obtenemos las propiedades más recientes
            $recientes = Propiedad::where('estado', 'disponible')->orderBy('created_at', 'desc')->take(3)->get();
            // Mostramos la vista de inicio con las propiedades obtenidas
            return view('home', compact('recientes'));
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', 'Error al mostrar la página de inicio. Por favor, inténtalo de nuevo.');
        }
    }
}
