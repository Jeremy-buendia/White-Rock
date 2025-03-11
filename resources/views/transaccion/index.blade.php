<x-agente-layout>
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="bg-light p-4 rounded shadow-sm">
                    <h4 class="mb-4 text-center">Información de Transacción</h4>

                    <h6 class="mb-3">Detalles del Usuario:</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <strong>Nombre:</strong> {{ $usuario->name }}
                        </li>
                        <li class="mb-2">
                            <strong>Email:</strong> {{ $usuario->email }}
                        </li>
                        <li class="mb-2">
                            <strong>Teléfono:</strong> {{ $usuario->telefono }}
                        </li>
                    </ul>

                    <hr class="my-4">

                    <h6 class="mb-3">Detalles de la Transacción:</h6>
                    <p class="mb-0">
                        <strong>Precio:</strong> {{ $transaccion->precio_transaccion }} €
                    </p>
                </div>
            </div>
        </div>
    </main>
</x-agente-layout>
