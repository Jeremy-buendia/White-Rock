@extends('layouts.app')

@section('title', 'Perfil de Usuario')

@section('content')
<div class="container">
    <h1>Perfil de Usuario</h1>
    <div class="card">
        <div class="card-header">
            Información del Usuario
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Apellido:</strong> {{ $user->apellido }}</p>
            <p><strong>Correo Electrónico:</strong> {{ $user->email }}</p>
            <p><strong>Teléfono:</strong> {{ $user->telefono }}</p>
            <p><strong>Dirección:</strong> {{ $user->direccion }}</p>
            @if($user->imagen)
                <p><strong>Imagen:</strong></p>
                <img src="{{ asset('storage/' . $user->imagen) }}" alt="Imagen de perfil" style="max-width: 150px;">
            @endif
            <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3">Editar</a>
            <a href="#" class="btn btn-danger mt-3" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Solicitudes de Visita
        </div>
        <div class="card-body">
            @if($user->solicitudesVisitas->isEmpty())
                <p>No hay solicitudes de visita.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Propiedad</th>
                            <th>Fecha de Solicitud</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user->solicitudesVisitas as $solicitud)
                            <tr>
                                <td><a href="{{ route('propiedad.show', $solicitud->propiedad->id) }}">{{ $solicitud->propiedad->nombre }}</a></td>
                                <td>{{ $solicitud->created_at->format('d/m/Y') }}</td>
                                <td>{{ ucfirst($solicitud->estado) }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas cancelar esta solicitud?')) { document.getElementById('cancel-form-{{ $solicitud->id }}').submit(); }">Cancelar</button>
                                    <form id="cancel-form-{{ $solicitud->id }}" action="{{ route('solicitud.cancelar', $solicitud->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection