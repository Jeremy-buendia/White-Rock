<x-agente-layout>
    <main class="container-lg">
        <h1 class="mt-4 mb-4">Registrar Agente</h1>
        <form method="POST" action="{{ route('agente.registro') }}" class="row g-3">
            @csrf

            <!-- ID oficina -->
            <div class="col-md-6">
                <x-input-label for="id_oficina" class="form-label" :value="__('ID Oficina: ')" />
                <x-text-input id="id_oficina" class="form-control" type="text" name="id_oficina" :value="old('id_oficina')"
                    required autofocus autocomplete="id_oficina" />
                <x-input-error :messages="$errors->get('id_oficina')" class="invalid-feedback d-block" />
            </div>

            <!-- Nombre -->
            <div class="col-md-6">
                <x-input-label for="nombre" class="form-label" :value="__('Nombre')" />
                <x-text-input id="nombre" class="form-control" type="text" name="nombre" :value="old('nombre')"
                    required autocomplete="nombre" />
                <x-input-error :messages="$errors->get('nombre')" class="invalid-feedback d-block" />
            </div>

            <!-- Apellido -->
            <div class="col-md-6">
                <x-input-label for="apellido" class="form-label" :value="__('Apellido')" />
                <x-text-input id="apellido" class="form-control" type="text" name="apellido" :value="old('apellido')"
                    required autocomplete="apellido" />
                <x-input-error :messages="$errors->get('apellido')" class="invalid-feedback d-block" />
            </div>

            <!-- Correo Electrónico -->
            <div class="col-md-6">
                <x-input-label for="correo_electronico" class="form-label" :value="__('Correo Electrónico')" />
                <x-text-input id="correo_electronico" class="form-control" type="email" name="correo_electronico"
                    :value="old('correo_electronico')" required autocomplete="email" />
                <x-input-error :messages="$errors->get('correo_electronico')" class="invalid-feedback d-block" />
            </div>

            <!-- Teléfono -->
            <div class="col-md-6">
                <x-input-label for="telefono" class="form-label" :value="__('Teléfono')" />
                <x-text-input id="telefono" class="form-control" type="text" name="telefono" :value="old('telefono')"
                    required autocomplete="telefono" />
                <x-input-error :messages="$errors->get('telefono')" class="invalid-feedback d-block" />
            </div>

            <!-- Dirección -->
            <div class="col-md-6">
                <x-input-label for="direccion" class="form-label" :value="__('Dirección')" />
                <x-text-input id="direccion" class="form-control" type="text" name="direccion" :value="old('direccion')"
                    required autocomplete="direccion" />
                <x-input-error :messages="$errors->get('direccion')" class="invalid-feedback d-block" />
            </div>

            <!-- Contraseña -->
            <div class="col-md-6">
                <x-input-label for="password" class="form-label" :value="__('Contraseña')" />
                <x-text-input id="password" class="form-control" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="invalid-feedback d-block" />
            </div>

            <!-- Confirmar Contraseña -->
            <div class="col-md-6">
                <x-input-label for="password_confirmation" class="form-label" :value="__('Confirmar Contraseña')" />
                <x-text-input id="password_confirmation" class="form-control" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="invalid-feedback d-block" />
            </div>

            <!-- Botón de Registro -->
            <div class="col-12">
                <x-primary-button class="btn btn-primary">
                    {{ __('Registrar') }}
                </x-primary-button>
            </div>
        </form>
    </main>
</x-agente-layout>
