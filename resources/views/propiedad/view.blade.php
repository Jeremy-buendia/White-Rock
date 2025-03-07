<x-agente-layout>
    <main class="">

        <h1>{{ $propiedad->nombre }}</h1>
        <div class="d-flex">
            <div id="carouselExampleAutoplaying" class="carousel slide w-50" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($imagenes as $key => $imagen)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img src="{{ Storage::url($imagen->url_fotografia) }}" class="d-block w-100"
                                alt="{{ $imagen->descripcion }}">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            {{-- @foreach ($imagenes as $imagen)
            <img src="{{ Storage::url($imagen->url_fotografia) }}" alt="{{ $imagen->descripcion }}">
        @endforeach --}}
            <br>

            <div class="table-responsive w-50 d-flex align-items-center justify-content-center">
                <table class="table table-secondary">
                    <tbody>
                        <tr class="">
                            <td scope="row"><b>Precio</b></td>
                            <td>{{ $propiedad->precio }} €</td>
                        </tr>
                        <tr class="">
                            <td scope="row"><b>Dirección</b></td>
                            <td>{{ $propiedad->direccion }}</td>
                        </tr>
                        <tr class="">
                            <td scope="row"><b>Tipo de propiedad</b></td>
                            <td>{{ $propiedad->tipo_propiedad }}</td>
                        </tr>
                        <tr class="">
                            <td scope="row"><b>Tamaño</b></td>
                            <td>{{ $propiedad->tamano }} metros cuadrados</td>
                        </tr>
                        <tr class="">
                            <td scope="row"><b>Descripción</b></td>
                            <td>{{ $propiedad->descripcion }}</td>
                        </tr>
                        <tr class="">
                            <td scope="row"><b>Estado</b></td>
                            <td>{{ $propiedad->estado }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</x-agente-layout>
