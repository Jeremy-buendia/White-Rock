<x-guest-layout>
    <div class="login">
        <img src="{{ asset('img/login-user.jpg') }}" alt="">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h3>Iniciar Sesión</h3>
            <br>
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Correo Electrónico:')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <br>
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contraseña:')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <br>
            <!-- Buttons -->
            <div class="flex items-center justify-center mt-4">
                <x-primary-button class="ms-3 iniciar-sesion"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Iniciar Sesión') }}
                </x-primary-button>
                <x-primary-button class="ms-3 iniciar-sesion" onclick="window.location='{{ route('register') }}'">
                    {{ __('Registrarse') }}
                </x-primary-button>
            </div>
            <br>
            <!-- Forgot Password -->
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('auth.google') }}">
                    {{ __('Iniciar sesión con Google') }}
                </a>
                <br>
                <br>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
</x-guest-layout>
