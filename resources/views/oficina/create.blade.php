<x-guest-layout>
    <form method="POST" action="{{ route('oficina.crear') }}">
        @csrf

        <!-- Nombre -->
        <div>
            <x-input-label for="nombre" :value="__('Nombre')" />
            <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required
                autofocus autocomplete="nombre" />
            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
        </div>


        <!-- Dirección -->
        <div class="mt-4">
            <x-input-label for="direccion" :value="__('Dirección')" />
            <x-text-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" :value="old('direccion')"
                required autocomplete="direccion" />
            <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
        </div>

        <!-- Teléfono -->
        <div class="mt-4">
            <x-input-label for="telefono" :value="__('Teléfono')" />
            <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')"
                required autocomplete="telefono" />
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>

        <!-- Fax -->
        <div class="mt-4">
            <x-input-label for="fax" :value="__('Fax: ')" />
            <x-text-input id="fax" class="block mt-1 w-full" type="text" name="fax" :value="old('fax')"
                required autocomplete="fax" />
            <x-input-error :messages="$errors->get('fax')" class="mt-2" />
        </div>

        <!-- Botón de Registro -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Crear') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
