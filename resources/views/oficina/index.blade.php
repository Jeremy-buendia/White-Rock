<x-agente-layout>
    <main class="container-lg">
        <img src=" {{ asset('img/ofice.jpg') }}" alt="" class="img-ofice">
        <h1>Datos de la oficina</h1>
        <nav>
            <ul>
                <li><b>Nombre: </b> {{ $oficina->nombre }}</li>
                <hr>
                <li><b>Dirección: </b> {{ $oficina->direccion }}</li>
                <hr>
                <li><b>Teléfono: </b> {{ $oficina->telefono }}</li>
                <hr>
                <li><b>Fax: </b> {{ $oficina->fax }}</li>
            </ul>
        </nav>
        <div class="d-flex justify-content-between">
            <div>
                <a href="{{ route('oficina.crear') }}">Crear Oficina</a>
                <a href="{{ route('oficina.editar', $oficina->id) }}">Editar Oficina</a>
            </div>
            <a href="{{ route('agente.registro') }}">Crear Agente</a>
        </div>
    </main>
</x-agente-layout>
