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
            <p><strong>Correo Electrónico:</strong> {{ $user->email }}</p>
            <!-- Añadir más campos según sea necesario -->
        </div>
    </div>
</div>
@endsection