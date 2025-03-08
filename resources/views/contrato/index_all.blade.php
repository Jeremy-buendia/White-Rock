<x-agente-layout>
    <main class="">
        <ul>
            @foreach ($contratos as $contrato)
                <li>
                    {{ $contrato->user->name }} {{ $contrato->user->apellido }}

                    <br>

                    {{ $contrato->propiedad->nombre }}
                </li>
                <a href="{{ route('contrato.index', $contrato->id) }}">Ver Contrato</a>
            @endforeach
        </ul>
    </main>
</x-agente-layout>
