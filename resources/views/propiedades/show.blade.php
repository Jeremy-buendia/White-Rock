@extends('layouts.app')

@section('content')
    <div class="container-lg mt-0" style="margin-top: 0 !important;">
        <div class="card border-0 shadow-sm rounded overflow-hidden position-relative">
            <div class="card-header text-center">
                <h1 class="fw-bold">{{ $propiedad->nombre }}</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if ($propiedad->fotografias->count() > 0)
                            @if ($propiedad->fotografias->count() > 1)
                                <div id="carousel-{{ $propiedad->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($propiedad->fotografias as $key => $imagen)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/imagenes/propiedad/' . $propiedad->id . '/' . basename($imagen->url_fotografia)) }}"
                                                    class="d-block w-100" alt="{{ $imagen->descripcion }}"
                                                    style="height: 400px; object-fit: cover;">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carousel-{{ $propiedad->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon bg-dark p-2 rounded-circle"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carousel-{{ $propiedad->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon bg-dark p-2 rounded-circle"></span>
                                    </button>
                                </div>
                            @else
                                <img src="{{ asset('storage/imagenes/propiedad/' . $propiedad->id . '/' . basename($propiedad->fotografias->first()->url_fotografia)) }}"
                                    class="d-block w-100" alt="{{ $propiedad->fotografias->first()->descripcion }}"
                                    style="height: 400px; object-fit: cover;">
                            @endif
                        @else
                            <p>No hay imágenes disponibles para esta propiedad.</p>
                        @endif
                    </div>
                    <div class="col-md-8 d-flex justify-content-center flex-column">
                        <p class="fw-bold fs-3"><strong>Precio:</strong>
                            {{ number_format($propiedad->precio, 2) }} €</p>
                        <p><strong>Tipo de Propiedad:</strong> {{ ucfirst($propiedad->tipo_propiedad) }}
                        </p>
                        <p><strong>Tamaño:</strong> {{ $propiedad->tamano }} m²</p>
                        <p><strong>Dirección:</strong> {{ $propiedad->direccion }}</p>
                        @inject('solicitudVisita', 'App\Models\SolicitudVisita')
                        @if (!$solicitudVisita::where('propiedad_id', $propiedad->id)->where('user_id', Auth::id())->exists())
                            <button type="button" class="btn btn-dark w-50 mt-3 btn-hover-green" data-bs-toggle="modal"
                                data-bs-target="#solicitarVisitaModal-{{ $propiedad->id }}">Solicitar Visita</button>
                        @else
                            <p class="text-success mt-3">Ya has solicitado una visita para esta propiedad.</p>
                        @endif
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <p><strong>Descripción:</strong></p>
                        <p>{{ $propiedad->descripcion }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para solicitar visita -->
    <div class="modal fade" id="solicitarVisitaModal-{{ $propiedad->id }}" tabindex="-1"
        aria-labelledby="solicitarVisitaModalLabel-{{ $propiedad->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="solicitarVisitaModalLabel-{{ $propiedad->id }}">Solicitar Visita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="solicitarVisitaForm-{{ $propiedad->id }}"
                        action="{{ route('propiedades.solicitar-visita', ['id' => $propiedad->id]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="fecha_propuesta-{{ $propiedad->id }}" class="form-label">Fecha Propuesta</label>
                            <input type="datetime-local" class="form-control" id="fecha_propuesta-{{ $propiedad->id }}"
                                name="fecha_propuesta" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Enviar Solicitud</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="modal fade show" id="visitaModal" tabindex="-1" aria-labelledby="visitaModalLabel" aria-hidden="true"
            style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="visitaModalLabel">Solicitud de Visita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            onclick="window.location.href='{{ route('inmuebles.index') }}';"></button>
                    </div>
                    <div class="modal-body">
                        {{ session('success') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            onclick="window.location.href='{{ route('inmuebles.index') }}';">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
