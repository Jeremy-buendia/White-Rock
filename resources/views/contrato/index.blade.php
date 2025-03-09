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

        <a href=" {{ route('contrato.index_all') }}">Volver</a>
    </main>
</x-agente-layout>
