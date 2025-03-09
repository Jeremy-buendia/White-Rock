{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="container-fluid mt-0" style="margin-top: 0 !important;">
    <h1 class="text-center text-white p-3 rounded" style="background: #333;">Bienvenido a White Rock</h1>
    <p class="text-center text-white">Esta es la página de inicio.</p>

    <!-- Breve descripción de la inmobiliaria -->
    <div class="d-flex justify-content-between align-items-center text-dark mb-4 p-4 rounded" style="background: #f8f9fa;">
        <div>
            <p>White Rock es una inmobiliaria dedicada a ofrecer las mejores propiedades del mercado. Nuestro objetivo es ayudarte a encontrar la casa de tus sueños con el mejor servicio y atención personalizada.</p>
            <p>Con años de experiencia en el sector, contamos con un equipo de profesionales altamente capacitados y apasionados por el mundo inmobiliario. Nos especializamos en la compra, venta y alquiler de propiedades residenciales y comerciales, brindando asesoramiento personalizado y acompañamiento en cada paso del proceso.</p>
            <p>Nuestra misión es ofrecerte un servicio de alta calidad, con transparencia, innovación y compromiso. Nos esforzamos por mantener altos estándares de calidad en cada una de nuestras transacciones, asegurando la satisfacción de nuestros clientes.</p>
        </div>
        <div>
            <img src="{{ asset('favicon.ico') }}" alt="White Rock Logo" style="width: 200px; height: 200px;">
        </div>
    </div>

    <!-- Sección de propiedades recientemente creadas -->
    <h2 class="text-center text-white p-3 rounded mb-3" style="background: #444;">Propiedades Recientes</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($recientes as $propiedad)
            <div class="col">
                <div class="card border-0 shadow-sm rounded overflow-hidden position-relative" style="background: #111; color: #fff;">
                    <span class="badge bg-success position-absolute top-0 start-0 m-2">Nueva</span>
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
                        <p class="text-secondary">{{ $propiedad->tamano }} m²</p>
                        <a href="{{ route('propiedades.show', ['propiedad' => $propiedad->id]) }}" class="btn btn-outline-light w-100 btn-hover-green" style="padding: 0.5rem;">Ver Detalles</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection