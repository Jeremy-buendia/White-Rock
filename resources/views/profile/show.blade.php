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
</div>
@endsection