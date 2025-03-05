<x-guest-layout>
    <div class="login">
        <img src="{{ asset('img/trabajador.png') }}" alt="">
        <form method="POST" action="{{ route('agente.login') }}">
            @csrf
            <h3>Iniciar Sesión Agente</h3>
            <br>
            <!-- Correo Electrónico -->
            <div class="mt-4">
                <x-input-label for="correo_electronico" :value="__('Correo Electrónico:')" />
                <x-text-input id="correo_electronico" class="block mt-1 w-full" type="email" name="correo_electronico"
                    :value="old('correo_electronico')" required autocomplete="email" />
                <x-input-error :messages="$errors->get('correo_electronico')" class="mt-2" />
            </div>
            <br>
            <!-- Contraseña -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contraseña:')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <br>
            <!-- Botón de Registro -->
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4 iniciar-sesion">
                    {{ __('Iniciar Sesión') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
