@extends('layouts.app')

@section('title', 'Todas las Solicitudes de Visitas')

@section('content')
<h1>Todas las Solicitudes de Visitas</h1>

<div id="solicitudes">
    @foreach ($solicitudes as $solicitud)
        <div class="solicitud">
            <p>Cliente: {{ $solicitud->cliente_id }}</p>
            <p>Fecha Propuesta: {{ $solicitud->fecha_propuesta }}</p>
            <p>Estado: {{ $solicitud->estado }}</p>
            <form action="{{ url('/notificar-cliente/' . $solicitud->id . '/aprobada') }}" method="POST">
                @csrf
                <button type="submit">Aprobar</button>
            </form>
            <form action="{{ url('/notificar-cliente/' . $solicitud->id . '/rechazada') }}" method="POST">
                @csrf
                <button type="submit">Rechazar</button>
            </form>
        </div>
    @endforeach
</div>
@endsection