<?php

namespace App\Http\Controllers;

use App\Exports\TransaccionesExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export()
    {
        return Excel::download(new TransaccionesExport, 'transacciones.xlsx');
    }
}
