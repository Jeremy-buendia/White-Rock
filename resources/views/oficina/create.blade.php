<x-agente-layout>
    <div class="container-lg">
        <br>
        <h1 class="mt-4 mb-4">Crear Oficina</h1>
        <form method="POST" action="{{ route('oficina.crear') }}" class="row g-3">
            @csrf

            <!-- Nombre -->
            <div class="col-md-6">
                <x-input-label for="nombre" class="form-label" :value="__('Nombre')" />
                <x-text-input id="nombre" class="form-control" type="text" name="nombre" :value="old('nombre')" required
                    autofocus autocomplete="nombre" />
                <x-input-error :messages="$errors->get('nombre')" class="invalid-feedback d-block" />
            </div>

            <!-- Dirección -->
            <div class="col-md-6">
                <x-input-label for="direccion" class="form-label" :value="__('Dirección')" />
                <x-text-input id="direccion" class="form-control" type="text" name="direccion" :value="old('direccion')"
                    required autocomplete="direccion" />
                <x-input-error :messages="$errors->get('direccion')" class="invalid-feedback d-block" />
            </div>

            <!-- Teléfono -->
            <div class="col-md-6">
                <x-input-label for="telefono" class="form-label" :value="__('Teléfono')" />
                <x-text-input id="telefono" class="form-control" type="text" name="telefono" :value="old('telefono')"
                    required autocomplete="telefono" />
                <x-input-error :messages="$errors->get('telefono')" class="invalid-feedback d-block" />
            </div>

            <!-- Fax -->
            <div class="col-md-6">
                <x-input-label for="fax" class="form-label" :value="__('Fax: ')" />
                <x-text-input id="fax" class="form-control" type="text" name="fax" :value="old('fax')"
                    required autocomplete="fax" />
                <x-input-error :messages="$errors->get('fax')" class="invalid-feedback d-block" />
            </div>

            <!-- Botón de Registro -->
            <div class="col-12">
                <x-primary-button class="btn btn-primary">
                    {{ __('Crear') }}
                </x-primary-button>
                <a href="{{ route('agente.dashboard') }}" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>
</x-agente-layout>
