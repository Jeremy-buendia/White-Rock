<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfertaCompra;
use App\Models\Transaccion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Carbon\Carbon;

class TransaccionController extends Controller
{
    // Envía una oferta de compra para una propiedad
    public function enviarOfertaCompra($idPropiedad, $montoOferta)
    {
        $oferta = new OfertaCompra();
        $oferta->id_propiedad = $idPropiedad;
        $oferta->monto_oferta = $montoOferta;
        $oferta->estado = 'pendiente';
        $oferta->save();

        return response()->json(['mensaje' => 'Oferta de compra enviada']);
    }

    // Muestra compras, ventas o alquileres realizadas por un cliente.

    public function verHistorialTransaccionesCliente($idCliente)
    {
        $transacciones = Transaccion::where('cliente_id', $idCliente)->get();
        return view('transacciones.historial', compact('transacciones'));
    }

    public function index_all()
    {
        $agente = Auth::user();
        $agenteId = $agente->id;

        /** @var \App\Models\Agente $agente */
        $transacciones = $agente->transacciones()->with('user')->get();

        return view('transaccion.index_all', compact('transacciones'));
    }

    public function index($id)
    {
        $transaccion = Transaccion::findOrFail($id);

        $usuario = $transaccion->user()->first();

        return view('transaccion.index', compact('transaccion', 'usuario'));
    }

    public function create()
    {
        $agente = Auth::user();
        /** @var \App\Models\Agente $agente */
        $propiedades = $agente->propiedades()->get();
        return view('transaccion.create', compact('propiedades'));
    }

    public function store(Request $request)
    {
        //Validar

        $idCliente = User::findByEmail($request->input('correo_electronico'))->id;
        $agenteId = Auth::user()->id;

        try {

            Transaccion::create([
                'propiedad_id' => $request->input('propiedad_id'),
                'user_id' => $idCliente,
                'agente_id' => $agenteId,
                'tipo_transaccion' => $request->input('tipo_transaccion'),
                'fecha_transaccion' => Carbon::now()->toDateString(),
                'precio_transaccion' => $request->input('precio_transaccion')
            ]);

            return redirect()->route('agente.dashboard')->with('success', 'Transacción registrada');
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', 'Error al crear la transacción. Por favor, inténtalo de nuevo.')->withInput();
        }
    }
}
