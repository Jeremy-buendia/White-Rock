<x-agente-layout>
    <main class="">
        <nav class="header-datos">
            <ul>
                <li> <b>Cliente: </b>{{ $usuario->name }}</li>
                <li> <b>Email: </b> {{ $usuario->email }}</li>
                <li> <b>Teléfono: </b> {{ $usuario->telefono }}</li>
                <li> <b>Propiedad: </b>{{ $propiedad->nombre }}</li>
            </ul>
        </nav>

        <div class="centrado">
            <div class="contrato">
                <?php
                $condicionesConSaltosDeLinea = str_replace('¬', '<br>', $contrato->condiciones);
                echo $condicionesConSaltosDeLinea;
                ?>
            </div>

        </div>
    </main>
</x-agente-layout>
