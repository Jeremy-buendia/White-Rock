@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $propiedad->nombre }}</h3>
                </div>
                <div class="card-body">
                    <p><strong>Descripción:</strong> {{ $propiedad->descripcion }}</p>
                    <p><strong>Precio:</strong> {{ number_format($propiedad->precio, 2) }} €</p>
                    <p><strong>Tipo de Propiedad:</strong> {{ ucfirst($propiedad->tipo_propiedad) }}</p>
                    @if($propiedad->fotografias->count() > 0)
                        <div id="carousel-{{ $propiedad->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($propiedad->fotografias as $key => $imagen)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/imagenes/propiedad/' . $propiedad->id . '/' . basename($imagen->url_fotografia)) }}" 
                                             class="d-block w-100" 
                                             alt="{{ $imagen->descripcion }}" 
                                             style="height: 400px; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $propiedad->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-dark p-2 rounded-circle"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $propiedad->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-dark p-2 rounded-circle"></span>
                            </button>
                        </div>
                    @else
                        <p>No hay imágenes disponibles para esta propiedad.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection