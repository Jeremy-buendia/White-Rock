<x-agente-layout>
    <main class="">
        <nav>
            <ul>
                <li> {{ $oficina->nombre }}</li>
                <li> {{ $oficina->direccion }}</li>
                <li> {{ $oficina->telefono }}</li>
                <li> {{ $oficina->fax }}</li>
            </ul>
        </nav>
    </main>
</x-agente-layout>
