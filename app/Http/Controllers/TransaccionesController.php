<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfertaCompra;
use App\Models\Transaccion;

class TransaccionesController extends Controller
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
}