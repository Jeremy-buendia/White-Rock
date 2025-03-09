{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="container-fluid mt-0" style="margin-top: 0 !important;">
    <h1 class="text-center text-white p-3 rounded" style="background: #333;">Bienvenido a White Rock</h1>
    <p class="text-center text-white">Esta es la página de inicio.</p>

    <!-- Sección de propiedades recientemente creadas -->
    <h2 class="text-center text-white p-3 rounded mb-3" style="background: #444;">Propiedades Recientemente Creadas</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($recientes as $propiedad)
            <div class="col">
                <div class="card border-0 shadow-sm rounded overflow-hidden" style="background: #111; color: #fff;">
                    @if($propiedad->fotografias->count() > 0)
                        <img src="{{ asset('storage/imagenes/propiedad/' . $propiedad->id . '/' . basename($propiedad->fotografias->first()->url_fotografia)) }}" 
                             class="card-img-top" 
                             alt="{{ $propiedad->nombre }}" 
                             style="height: 250px; object-fit: cover;">
                    @else
                        <img src="{{ asset('path/to/default-image.jpg') }}" 
                             class="card-img-top" 
                             alt="{{ $propiedad->nombre }}" 
                             style="height: 250px; object-fit: cover;">
                    @endif
                    <div class="card-body text-center">
                        <h5 class="fw-bold">{{ $propiedad->nombre }}</h5>
                        <p class="text-secondary">{{ Str::limit($propiedad->descripcion, 100) }}</p>
                        <p class="fw-bold fs-5 text-light">{{ number_format($propiedad->precio, 2) }} €</p>
                        <a href="{{ route('propiedades.show', ['propiedad' => $propiedad->id]) }}" class="btn btn-outline-light w-100 btn-hover-green" style="padding: 0.5rem;">Ver Detalles</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Sección de propiedades más caras -->
    <h2 class="text-center text-white p-3 rounded mb-3" style="background: #444;">Propiedades Más Caras</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($masCaras as $propiedad)
            <div class="col">
                <div class="card border-0 shadow-sm rounded overflow-hidden" style="background: #111; color: #fff;">
                    @if($propiedad->fotografias->count() > 0)
                        <img src="{{ asset('storage/imagenes/propiedad/' . $propiedad->id . '/' . basename($propiedad->fotografias->first()->url_fotografia)) }}" 
                             class="card-img-top" 
                             alt="{{ $propiedad->nombre }}" 
                             style="height: 250px; object-fit: cover;">
                    @else
                        <img src="{{ asset('path/to/default-image.jpg') }}" 
                             class="card-img-top" 
                             alt="{{ $propiedad->nombre }}" 
                             style="height: 250px; object-fit: cover;">
                    @endif
                    <div class="card-body text-center">
                        <h5 class="fw-bold">{{ $propiedad->nombre }}</h5>
                        <p class="text-secondary">{{ Str::limit($propiedad->descripcion, 100) }}</p>
                        <p class="fw-bold fs-5 text-light">{{ number_format($propiedad->precio, 2) }} €</p>
                        <a href="{{ route('propiedades.show', ['propiedad' => $propiedad->id]) }}" class="btn btn-outline-light w-100 btn-hover-green" style="padding: 0.5rem;">Ver Detalles</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Sección de propiedades más baratas -->
    <h2 class="text-center text-white p-3 rounded mb-3" style="background: #444;">Propiedades Más Baratas</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($masBaratas as $propiedad)
            <div class="col">
                <div class="card border-0 shadow-sm rounded overflow-hidden" style="background: #111; color: #fff;">
                    @if($propiedad->fotografias->count() > 0)
                        <img src="{{ asset('storage/imagenes/propiedad/' . $propiedad->id . '/' . basename($propiedad->fotografias->first()->url_fotografia)) }}" 
                             class="card-img-top" 
                             alt="{{ $propiedad->nombre }}" 
                             style="height: 250px; object-fit: cover;">
                    @else
                        <img src="{{ asset('path/to/default-image.jpg') }}" 
                             class="card-img-top" 
                             alt="{{ $propiedad->nombre }}" 
                             style="height: 250px; object-fit: cover;">
                    @endif
                    <div class="card-body text-center">
                        <h5 class="fw-bold">{{ $propiedad->nombre }}</h5>
                        <p class="text-secondary">{{ Str::limit($propiedad->descripcion, 100) }}</p>
                        <p class="fw-bold fs-5 text-light">{{ number_format($propiedad->precio, 2) }} €</p>
                        <a href="{{ route('propiedades.show', ['propiedad' => $propiedad->id]) }}" class="btn btn-outline-light w-100 btn-hover-green" style="padding: 0.5rem;">Ver Detalles</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection