<x-agente-layout>
    <main class="container-md">
        <ul class="listado-items">
            <li class="item lista-header">
                <h2>Cliente</h2>
                <br>
                <h2>Propiedad</h2>
                <h2></h2>
            </li>
            @foreach ($contratos as $contrato)
                <li class="item">
                    <h2>{{ $contrato->user->name }} {{ $contrato->user->apellido }}</h2>

                    <br>

                    <p>{{ $contrato->propiedad->nombre }}</p>

                    <a href="{{ route('contrato.index', $contrato->id) }}">Ver Contrato</a>
                </li>
            @endforeach
        </ul>
    </main>
</x-agente-layout>
