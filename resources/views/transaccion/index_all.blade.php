<x-agente-layout>
    <main class="">
        <ul>
            @foreach ($transacciones as $transaccion)
                <li>
                    {{ $transaccion->user->name }} {{ $transaccion->user->apellido }}

                    <br>

                    {{ $transaccion->precio_transaccion }}
                </li>
                <a href="{{ route('transaccion.index', $transaccion->id) }}">Ver Transacción</a>
            @endforeach
        </ul>
    </main>
</x-agente-layout>
