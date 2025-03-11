<x-agente-layout>
    <main class="container-lg">
        <h1 class="mt-4 mb-4">Editar Solicitud de Visita</h1>
        <form method="POST" action="{{ route('visita.editar', $solicitudVisita->id) }}" class="row g-3">
            @csrf
            @method('PUT')

            <!-- Correo Electrónico -->
            <div class="col-md-6">
                <x-input-label for="correo_electronico" class="form-label" :value="__('Correo Electrónico: ')" />
                <x-text-input id="correo_electronico" class="form-control" type="email" name="correo_electronico"
                    value="{{ $emailCliente }}" required autofocus autocomplete="correo_electronico" />
                <x-input-error :messages="$errors->get('correo_electronico')" class="invalid-feedback d-block" />
            </div>

            <!-- Propiedad -->
            <div class="col-md-6">
                <x-input-label for="propiedad_id" class="form-label" :value="__('Propiedad: ')" />
                <select id="propiedad_id" name="propiedad_id" class="form-select">
                    @foreach ($propiedades as $propiedad)
                        <option value="{{ $propiedad->id }}" @if ($propiedad->id == $propiedadVisita->id) selected @endif>
                            {{ $propiedad->nombre }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('propiedad_id')" class="invalid-feedback d-block" />
            </div>

            <!-- Fecha Propuesta -->
            <div class="col-md-6">
                <x-input-label for="fecha_propuesta" class="form-label" :value="__('Fecha y Hora: ')" />
                <x-text-input id="fecha_propuesta" class="form-control" type="datetime-local" name="fecha_propuesta"
                    value="{{ $solicitudVisita->fecha_propuesta }}" required autocomplete="fecha_propuesta" />
                <x-input-error :messages="$errors->get('fecha_propuesta')" class="invalid-feedback d-block" />
            </div>

            <!-- Estado -->
            <div class="col-md-6">
                <x-input-label for="estado" class="form-label" :value="__('Estado: ')" />
                <select id="estado" name="estado" class="form-select">
                    <option value="pendiente" @if ($solicitudVisita->estado == 'pendiente') selected @endif>Pendiente</option>
                    <option value="aprobada" @if ($solicitudVisita->estado == 'aprobada') selected @endif>Aprobada</option>
                    <option value="rechazada" @if ($solicitudVisita->estado == 'rechazada') selected @endif>Rechazada</option>
                </select>
                <x-input-error :messages="$errors->get('estado')" class="invalid-feedback d-block" />
            </div>

            <!-- Botones -->
            <div class="col-12">
                <x-primary-button class="btn btn-primary">
                    {{ __('Guardar Cambios') }}
                </x-primary-button>

                <a href="{{ route('agente.dashboard') }}" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </main>
</x-agente-layout>
