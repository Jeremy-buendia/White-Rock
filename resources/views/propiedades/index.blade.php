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
                    <div class="col">
                        <div class="card h-100 shadow-sm rounded">
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
