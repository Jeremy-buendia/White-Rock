<?php

namespace App\Exports;

use App\Models\Transaccion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class TransaccionesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Transaccion::with(['propiedad', 'user', 'agente']) // Obtén las relaciones de la transacción
            ->select('propiedad_id', 'user_id', 'agente_id', 'tipo_transaccion', 'fecha_transaccion', 'precio_transaccion') // Selecciona las columnas necesarias
            ->get()
            ->map(function ($transaccion) {
                return [
                    'propiedad' => $transaccion->propiedad->nombre, // Asegúrate de tener el nombre de la propiedad o cualquier campo relevante
                    'usuario' => $transaccion->user->nombre, // Asegúrate de tener el nombre del usuario
                    'agente' => $transaccion->agente->nombre, // Asegúrate de tener el nombre del agente
                    'tipo_transaccion' => $transaccion->tipo_transaccion,
                    'fecha_transaccion' => Carbon::parse($transaccion->fecha_transaccion)->format('Y-m-d'), // Formatea la fecha
                    'precio_transaccion' => $transaccion->precio_transaccion,
                ];
            });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Propiedad',
            'Usuario',
            'Agente',
            'Tipo de Transacción',
            'Fecha de Transacción',
            'Precio de Transacción',
        ];
    }
}
