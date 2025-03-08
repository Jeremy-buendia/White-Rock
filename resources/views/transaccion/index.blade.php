<x-agente-layout>
    <main class="">
        <nav>
            <ul>
                <li> {{ $usuario->name }}</li>
                <li> {{ $usuario->email }}</li>
                <li> {{ $usuario->telefono }}</li>
            </ul>
        </nav>

        <div class="transaccion">
            {{ $transaccion->precio_transaccion }}
        </div>
    </main>
</x-agente-layout>
