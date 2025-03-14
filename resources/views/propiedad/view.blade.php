<x-agente-layout>
    <main class="">

        <div class="d-flex justify-content-between container-lg">
            <h1>{{ $propiedad->nombre }}</h1>
            <a href=" {{ route('solicitud.index_all_propiedad', $propiedad->id) }}" class="mt-3">Ver Solicitudes
                Adheridas</a>
        </div>

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
            <div class="table-responsive w-50" style="overflow-y:hidden;">
                <table class="table table-secondary" style="height: 100%;">
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
                            <td>{{ $propiedad->tamano }} m²</td>
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
