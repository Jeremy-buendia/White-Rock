@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h3>Categorías</h3>
            <select id="categoria" class="form-control">
                <option value="">Todas</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->tipo_propiedad }}">{{ $categoria->tipo_propiedad }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-9">
            <h3>Inmuebles</h3>
            <div class="row" id="inmuebles-list">
                @foreach($inmuebles as $inmueble)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">{{ $inmueble->nombre }}</h5>
                                <p class="card-text">{{ $inmueble->descripcion }}</p>
                                <p class="card-text"><strong>Precio:</strong> {{ $inmueble->precio }}</p>
                                <p class="card-text"><strong>Tipo:</strong> {{ $inmueble->tipo_propiedad }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('categoria').addEventListener('change', function() {
        var categoria = this.value;
        var inmuebles = document.querySelectorAll('#inmuebles-list .card');
        inmuebles.forEach(function(inmueble) {
            if (categoria === '' || inmueble.querySelector('.card-text strong:nth-child(2)').textContent.includes(categoria)) {
                inmueble.parentElement.style.display = 'block';
            } else {
                inmueble.parentElement.style.display = 'none';
            }
        });
    });
</script>
@endsection
