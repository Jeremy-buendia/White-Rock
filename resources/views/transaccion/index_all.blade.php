<x-agente-layout>
    <main class="container-md">
        <a href="{{ route('transaccion.export') }}">Descargar transacciones</a>
        <ul class="listado-items">
            <li class="item lista-header">
                <h2>Cliente</h2>

                <h2>Cantidad</h2>
                <h2></h2>
            </li>
            @foreach ($transacciones as $transaccion)
                <li class="item">
                    <h2>{{ $transaccion->user->name }} {{ $transaccion->user->apellido }}</h2>



                    <p>{{ $transaccion->precio_transaccion }}</p>
                    <a href="{{ route('transaccion.index', $transaccion->id) }}">Ver Transacción</a>
                </li>
            @endforeach
        </ul>
    </main>
</x-agente-layout>
