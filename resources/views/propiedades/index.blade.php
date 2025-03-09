@extends('layouts.app')

@section('content')
<!-- Contenedor principal -->
<div class="container-fluid mt-0" style="margin-top: 0 !important;">
    <div class="row">
        <!-- Sección de Categorías -->
        <div class="col-lg-3" style="padding-left: 0;">
            <h3 class="fw-bold text-white text-center p-3 rounded" style="background: #222;">Categorías</h3>
            <div class="d-flex flex-column gap-2">
                <a href="{{ route('inmuebles.index') }}" class="btn {{ request('categoria') ? 'btn-outline-dark' : 'btn-dark' }}">Todas</a>
                @foreach($categorias as $categoriaOption)
                    <a href="{{ route('inmuebles.index', ['categoria' => $categoriaOption->tipo_propiedad]) }}" 
                       class="btn {{ request('categoria') == $categoriaOption->tipo_propiedad ? 'btn-dark' : 'btn-outline-dark' }}">
                        {{ ucfirst($categoriaOption->tipo_propiedad) }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Sección de Inmuebles -->
        <div class="col-lg-9">
            <h3 class="fw-bold text-white text-center p-3 rounded mb-3" style="background: #333;">Inmuebles Disponibles</h3>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach($inmuebles as $inmueble)
                    <div class="col">
                        <div class="card border-0 shadow-sm rounded overflow-hidden" style="background: #111; color: #fff;">
                            @if($inmueble->fotografias->count() > 1)
                                <div id="carousel-{{ $inmueble->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($inmueble->fotografias as $key => $imagen)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/imagenes/propiedad/' . $inmueble->id . '/' . basename($imagen->url_fotografia)) }}" 
                                                     class="d-block w-100" 
                                                     alt="{{ $imagen->descripcion }}" 
                                                     style="height: 250px; object-fit: cover;">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $inmueble->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon bg-dark p-2 rounded-circle"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $inmueble->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon bg-dark p-2 rounded-circle"></span>
                                    </button>
                                </div>
                            @else
                                <img src="{{ $inmueble->fotografias->first() ? asset('storage/imagenes/propiedad/' . $inmueble->id . '/' . basename($inmueble->fotografias->first()->url_fotografia)) : asset('path/to/default-image.jpg') }}" 
                                     class="card-img-top" 
                                     alt="{{ $inmueble->nombre }}" 
                                     style="height: 250px; object-fit: cover;">
                            @endif

                            <div class="card-body text-center">
                                <h5 class="fw-bold">{{ $inmueble->nombre }}</h5>
                                <p class="text-secondary">{{ Str::limit($inmueble->descripcion, 100) }}</p>
                                <p class="fw-bold fs-5 text-light">{{ number_format($inmueble->precio, 2) }} €</p>
                                <p class="text-secondary">{{ ucfirst($inmueble->tipo_propiedad) }}</p>
                                
                                <!-- Botón para solicitar una visita -->
                                @inject('solicitudVisita', 'App\Models\SolicitudVisita')
                                @if(!$solicitudVisita::where('propiedad_id', $inmueble->id)->where('user_id', Auth::id())->exists())
                                    <button type="button" class="btn btn-outline-light w-100 mb-1 btn-hover-green" style="padding: 0.5rem;" onclick="solicitarVisita({{ $inmueble->id }})">Solicitar Visita</button>
                                @else
                                    <p class="text-success mb-1">Visita solicitada</p>
                                @endif

                                <!-- Botón para ver detalles -->
                                @if(Route::has('propiedades.show'))
                                    <a href="{{ route('propiedades.show', ['propiedad' => $inmueble->id]) }}" class="btn btn-outline-light w-100 btn-hover-green" style="padding: 0.5rem;">Ver Detalles</a>
                                @else
                                    <button class="btn btn-outline-secondary w-100" disabled>Detalles no disponibles</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Formulario oculto para solicitar visita -->
<form id="solicitarVisitaForm" action="" method="POST" style="display: none;">
    @csrf
</form>

<!-- Modal de confirmación -->
<div class="modal fade" id="visitaModal" tabindex="-1" aria-labelledby="visitaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="visitaModalLabel">Solicitud de Visita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="location.reload();"></button>
            </div>
            <div class="modal-body">
                Se ha solicitado la visita correctamente. Uno de nuestros agentes se pondrá en contacto contigo para concretar día y hora.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.reload();">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Estilos personalizados -->
<style>
    .btn-hover-green:hover {
        background-color: #28a745 !important;
        color: white !important;
        border-color: #28a745 !important;
    }
</style>

<script>
    function solicitarVisita(propiedadId) {
        var form = document.getElementById('solicitarVisitaForm');
        var actionUrl = '/propiedades/' + propiedadId + '/solicitar-visita';
        var token = document.querySelector('input[name="_token"]').value;

        fetch(actionUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Visita solicitada correctamente') {
                var visitaModal = new bootstrap.Modal(document.getElementById('visitaModal'));
                visitaModal.show();
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    document.addEventListener('DOMContentLoaded', function() {
        @if(session('visita_solicitada'))
            var visitaModal = new bootstrap.Modal(document.getElementById('visitaModal'));
            visitaModal.show();
        @endif
    });
</script>

@endsection
