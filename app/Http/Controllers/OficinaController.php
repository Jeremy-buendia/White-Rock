<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OficinaController extends Controller
{
    public function index()
    {
        $agente = Auth::user();

        /** @var \App\Models\Agente $agente */
        $oficina = $agente->oficina()->where(['id' => $agente->oficina_id])->first();

        return view('oficina.index', compact('oficina'));
    }
}
