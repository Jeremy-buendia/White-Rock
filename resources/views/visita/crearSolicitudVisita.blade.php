<x-agente-layout>
    <main class="container-lg">
        <h1 class="mt-4 mb-4">Crear Visita</h1>
        <form method="POST" action="{{ route('agente.solicitar_visita') }}" class="row g-3">
            @csrf

            <!-- Correo Electrónico -->
            <div class="col-12">
                <x-input-label for="correo_electronico" class="form-label" :value="__('Correo Electrónico: ')" />
                <x-text-input id="correo_electronico" class="form-control" type="email" name="correo_electronico"
                    :value="old('correo_electronico')" required autofocus autocomplete="correo_electronico" />
                <x-input-error :messages="$errors->get('correo_electronico')" class="invalid-feedback d-block" />
            </div>

            <!-- Propiedad -->
            <div class="col-md-6">
                <x-input-label for="propiedad_id" class="form-label" :value="__('Propiedad: ')" />
                <select id="propiedad_id" name="propiedad_id" class="form-select">
                    @foreach ($propiedades as $propiedad)
                        <option value="{{ $propiedad->id }}">{{ $propiedad->nombre }}</option>
                    @endforeach
                </select>

                <x-input-error :messages="$errors->get('propiedad_id')" class="invalid-feedback d-block" />
            </div>

            <!-- Fecha Propuesta -->
            <div class="col-md-6">
                <x-input-label for="fecha_propuesta" class="form-label" :value="__('Fecha y Hora: ')" />
                <x-text-input id="fecha_propuesta" class="form-control" type="datetime-local" name="fecha_propuesta"
                    :value="old('fecha_propuesta')" required autocomplete="fecha_propuesta" />
                <x-input-error :messages="$errors->get('fecha_propuesta')" class="invalid-feedback d-block" />
            </div>

            <div class="col-12 d-flex">
                <x-primary-button class="btn btn-primary">
                    {{ __('Establecer Visita') }}
                </x-primary-button>
                <a href="{{ route('agente.dashboard') }}" class="btn btn-secondary mx-2">Volver</a>
            </div>
        </form>
    </main>
</x-agente-layout>
