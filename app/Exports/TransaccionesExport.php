<?php

namespace App\Exports;

use App\Models\Transaccion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Carbon\Carbon;

class TransaccionesExport implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Transaccion::with(['propiedad', 'user', 'agente'])
            ->select('propiedad_id', 'user_id', 'agente_id', 'tipo_transaccion', 'fecha_transaccion', 'precio_transaccion')
            ->get()
            ->map(function ($transaccion) {
                return [
                    'propiedad' => $transaccion->propiedad->nombre,
                    'usuario_nombre' => $transaccion->user->name,
                    'usuario_apellido' => $transaccion->user->apellido,
                    'agente_nombre' => $transaccion->agente->nombre,
                    'tipo_transaccion' => $transaccion->tipo_transaccion,
                    'fecha_transaccion' => Carbon::parse($transaccion->fecha_transaccion)->format('Y-m-d'),
                    'precio_transaccion' => $transaccion->precio_transaccion,
                ];
            });
    }


    public function headings(): array
    {
        return [
            'Propiedad',
            'Usuario (Nombre)',
            'Usuario (Apellido)',
            'Agente (Nombre)',
            'Tipo de Transacción',
            'Fecha de Transacción',
            'Precio de Transacción',
        ];
    }

    public function styles($sheet)
    {
        // Estilos para la fila de encabezado
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'],
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => '4CAF50'],
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Estilo de las celdas de datos
        $sheet->getStyle('A2:G' . $sheet->getHighestRow())->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Ajuste automático del tamaño de las columnas
        foreach (range('A', 'G') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }


    public function columnFormats()
    {
        return [
            // Formato de fecha
            'F' => 'yyyy-mm-dd',
            // Formato de precio
            'G' => '#,##0.00',
        ];
    }
}
