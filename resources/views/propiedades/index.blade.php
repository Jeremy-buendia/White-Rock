@extends('layouts.app')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-3">
            <h3>Categorías</h3>
            <form method="GET" action="{{ route('inmuebles.index') }}">
                <select name="categoria" class="form-control" onchange="this.form.submit()">
                    <option value="">Todas</option>
                    @foreach($categorias as $categoriaOption)
                        <option value="{{ $categoriaOption->tipo_propiedad }}" {{ $categoria == $categoriaOption->tipo_propiedad ? 'selected' : '' }}>
                            {{ ucfirst($categoriaOption->tipo_propiedad) }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="col-md-9">
            <h3>Inmuebles</h3>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="inmuebles-list">
                @foreach($inmuebles as $inmueble)
                    <div class="col mb-4">
                        <div class="card h-100 shadow-sm rounded">
                            @if($inmueble->fotografias->count() > 1)
                                <div id="carousel-{{ $inmueble->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($inmueble->fotografias as $key => $imagen)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/imagenes/propiedad/' . $inmueble->id . '/' . basename($imagen->url_fotografia)) }}" class="d-block w-100" alt="{{ $imagen->descripcion }}" style="height: 300px; object-fit: contain;">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev custom-carousel-control bg-dark" type="button" data-bs-target="#carousel-{{ $inmueble->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next custom-carousel-control bg-dark" type="button" data-bs-target="#carousel-{{ $inmueble->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            @elseif($inmueble->fotografias->count() == 1)
                                <img src="{{ asset('storage/imagenes/propiedad/' . $inmueble->id . '/' . basename($inmueble->fotografias->first()->url_fotografia)) }}" class="card-img-top" alt="{{ $inmueble->fotografias->first()->descripcion }}" style="height: 300px; object-fit: contain;">
                            @else
                                <img src="{{ asset('path/to/default-image.jpg') }}" class="card-img-top" alt="{{ $inmueble->nombre }}" style="height: 300px; object-fit: contain;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $inmueble->nombre }}</h5>
                                <p class="card-text">{{ Str::limit($inmueble->descripcion, 100) }}</p>
                                <p class="card-text"><strong>Precio:</strong> {{ number_format($inmueble->precio, 2) }} €</p>
                                <p class="card-text"><strong>Tipo:</strong> {{ ucfirst($inmueble->tipo_propiedad) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
