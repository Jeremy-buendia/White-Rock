<x-agente-layout>
    <main class="">
        <nav>
            <ul>
                <li> {{ $usuario->name }}</li>
                <li> {{ $usuario->email }}</li>
                <li> {{ $usuario->telefono }}</li>
                <li> {{ $propiedad->nombre }}</li>
            </ul>
        </nav>

        <div class="contrato">
            {{ $contrato->condiciones }}
        </div>
    </main>
</x-agente-layout>
