<x-guest-layout>
    <div class="register">
        <img src="{{ asset('img/registro-user.jpg') }}" alt="">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h3>Registro de Usuario</h3>
            <!-- Name -->
            <div class="mt-2">
                <x-input-label for="name" :value="__('Nombre: ')" /> <br>
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <!-- Apellido -->
            <div class="mt-2">
                <x-input-label for="apellido" :value="__('Apellido: ')" /> <br>
                <x-text-input id="apellido" class="block mt-1 w-full" type="text" name="apellido" :value="old('apellido')"
                    required autocomplete="apellido" />
                <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
            </div>
            <!-- Email Address -->
            <div class="mt-2">
                <x-input-label for="email" :value="__('Correo Electrónico: ')" /> <br>
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <!-- Teléfono -->
            <div class="mt-2">
                <x-input-label for="telefono" :value="__('Teléfono: ')" /> <br>
                <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')"
                    required autocomplete="telefono" />
                <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
            </div>
            <!-- Dirección -->
            <div class="mt-2">
                <x-input-label for="direccion" :value="__('Dirección: ')" /> <br>
                <x-text-input id="direccion" class="block mt-1 w-full" type="text" name="direccion"
                    :value="old('direccion')" required autocomplete="direccion" />
                <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
            </div>
            <!-- Password -->
            <div class="mt-2">
                <x-input-label for="password" :value="__('Contraseña: ')" /> <br>
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <!-- Confirm Password -->
            <div class="mt-2">
                <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña: ')" /> <br>
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <!-- Botón de Registro -->
            <div class="flex items-center justify-end mt-2">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    {{ __('¿Ya estás registrado?') }}
                </a>
                <x-primary-button class="ms-4 iniciar-sesion">
                    {{ __('Registrar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
