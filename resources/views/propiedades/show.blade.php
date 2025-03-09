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

                    <!-- Botón para solicitar una visita -->
                    @if(!$propiedad->visita_solicitada)
                        <button type="button" class="btn btn-primary mt-3" onclick="solicitarVisita({{ $propiedad->id }})">Solicitar Visita</button>
                    @else
                        <p class="text-success mt-3">Ya has solicitado una visita para esta propiedad.</p>
                    @endif
                </div>
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