@extends('layouts.app')
@vite(['resources/js/confirmar_eliminar.js'])
@section('content')
    <!-- Contenedor principal -->
    <div class="container-lg mt-0" style="margin-top: 0 !important;">
        <div class="row">
            <!-- Sección de Categorías -->
            <div class="col-md-3" style="padding-left: 0; position: sticky; top: 100px; height: fit-content;">
                <h3 class="fw-bold text-white text-center p-3 rounded" style="background: #222;">Categorías</h3>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('inmuebles.index') }}"
                        class="btn {{ request('categoria') ? 'btn-outline-dark' : 'btn-dark' }}">Todas</a>
                    @foreach ($categorias as $categoriaOption)
                        <a href="{{ route('inmuebles.index', ['categoria' => $categoriaOption->tipo_propiedad]) }}"
                            class="btn {{ request('categoria') == $categoriaOption->tipo_propiedad ? 'btn-dark' : 'btn-outline-dark' }}">
                            {{ ucfirst($categoriaOption->tipo_propiedad) }}
                        </a>
                    @endforeach
                </div>
                <h4 class="fw-bold text-white text-center p-3 rounded mt-4" style="background: #222;">Subcategorías</h4>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('inmuebles.index', ['orden' => 'mas_grande']) }}"
                        class="btn {{ request('orden') == 'mas_grande' ? 'btn-dark' : 'btn-outline-dark' }}">Mayor
                        Tamaño</a>
                    <a href="{{ route('inmuebles.index', ['orden' => 'mas_chica']) }}"
                        class="btn {{ request('orden') == 'mas_chica' ? 'btn-dark' : 'btn-outline-dark' }}">Menor Tamaño</a>
                    <a href="{{ route('inmuebles.index', ['orden' => 'mas_cara']) }}"
                        class="btn {{ request('orden') == 'mas_cara' ? 'btn-dark' : 'btn-outline-dark' }}">Mayor Precio</a>
                    <a href="{{ route('inmuebles.index', ['orden' => 'mas_barata']) }}"
                        class="btn {{ request('orden') == 'mas_barata' ? 'btn-dark' : 'btn-outline-dark' }}">Menor
                        Precio</a>
                    <a href="{{ route('inmuebles.index', ['orden' => 'recientes']) }}"
                        class="btn {{ request('orden') == 'recientes' ? 'btn-dark' : 'btn-outline-dark' }}">Recientes</a>
                </div>
            </div>

            <!-- Sección de Inmuebles -->
            <div class="col-lg-9">
                <h3 class="fw-bold text-white text-center p-3 rounded mb-3" style="background: #333;">Inmuebles Disponibles
                </h3>

                <div class="row row-cols-1 g-4">
                    @foreach ($inmuebles as $inmueble)
                        <div class="row g-4 align-items-center mb-4">
                            <div class="col-md-5">

                                @if ($inmueble->fotografias->count() > 1)
                                    <div id="carousel-{{ $inmueble->id }}" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @if ($inmueble->es_reciente)
                                                <span
                                                    class="badge bg-success position-absolute top-0 start-0 m-2">Nueva</span>
                                            @endif
                                            @foreach ($inmueble->fotografias as $key => $imagen)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/imagenes/propiedad/' . $inmueble->id . '/' . basename($imagen->url_fotografia)) }}"
                                                        class="d-block w-100 rounded" alt="{{ $imagen->descripcion }}"
                                                        style="height: 250px; object-fit: cover;">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carousel-{{ $inmueble->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon bg-dark p-2 rounded-circle"></span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carousel-{{ $inmueble->id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon bg-dark p-2 rounded-circle"></span>
                                        </button>
                                    </div>
                                @else
                                    <img src="{{ $inmueble->fotografias->first() ? asset('storage/imagenes/propiedad/' . $inmueble->id . '/' . basename($inmueble->fotografias->first()->url_fotografia)) : asset('path/to/default-image.jpg') }}"
                                        class="img-fluid rounded" alt="{{ $inmueble->nombre }}"
                                        style="height: 250px; object-fit: cover; width: 100%;">
                                @endif
                            </div>
                            <div class="col-md-7">
                                <div class="card border-0 shadow-sm rounded p-3" style="background: #111; color: #fff;">

                                    <h5 class="fw-bold">{{ $inmueble->nombre }}</h5>
                                    <p class="text-secondary">{{ ucfirst($inmueble->tipo_propiedad) }} -
                                        {{ $inmueble->tamano }} m²</p>
                                    <p class="fw-bold fs-5 text-light">{{ number_format($inmueble->precio, 2) }} €</p>

                                    @inject('solicitudVisita', 'App\Models\SolicitudVisita')
                                    @if (!$solicitudVisita::where('propiedad_id', $inmueble->id)->where('user_id', Auth::id())->exists())
                                        <button type="button" class="btn btn-outline-light w-100 mb-2 btn-hover-green"
                                            data-bs-toggle="modal"
                                            data-bs-target="#solicitarVisitaModal-{{ $inmueble->id }}">
                                            Solicitar Visita
                                        </button>
                                    @else
                                        <p class="text-success mb-2">Visita solicitada</p>
                                    @endif

                                    @if (Route::has('propiedades.show'))
                                        <a href="{{ route('propiedades.show', ['propiedad' => $inmueble->id]) }}"
                                            class="btn btn-outline-light w-100 btn-hover-green">Ver Detalles</a>
                                    @else
                                        <button class="btn btn-outline-secondary w-100" disabled>Detalles no
                                            disponibles</button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Modal para solicitar visita -->
                        <div class="modal fade" id="solicitarVisitaModal-{{ $inmueble->id }}" tabindex="-1"
                            aria-labelledby="solicitarVisitaModalLabel-{{ $inmueble->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="solicitarVisitaModalLabel-{{ $inmueble->id }}">
                                            Solicitar Visita</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="solicitarVisitaForm-{{ $inmueble->id }}"
                                            action="{{ route('propiedades.solicitar-visita', ['id' => $inmueble->id]) }}"
                                            method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="fecha_propuesta-{{ $inmueble->id }}" class="form-label">Fecha
                                                    Propuesta</label>
                                                <input type="date" class="form-control"
                                                    id="fecha_propuesta-{{ $inmueble->id }}" name="fecha_propuesta"
                                                    required>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100">Enviar Solicitud</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación -->
    @if (session('success'))
        <div class="modal fade show" id="visitaModal" tabindex="-1" aria-labelledby="visitaModalLabel" aria-hidden="true"
            style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="visitaModalLabel">Solicitud de Visita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            onclick="location.reload();"></button>
                    </div>
                    <div class="modal-body">
                        {{ session('success') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            onclick="location.reload();">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
