<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&display=swap" rel="stylesheet">
</head>

<body>
    <div class="login">
        <img src="{{ asset('img/trabajador.png') }}" alt="" class="imagen-login">
        <form method="POST" action="{{ route('agente.login') }}">
            @csrf
            <h3>Iniciar Sesión Agente</h3>
            <br>
            <!-- Correo Electrónico -->
            <div class="mt-4">
                <x-input-label for="correo_electronico" :value="__('Correo Electrónico:')" /> <br>
                <x-text-input id="correo_electronico" class="block mt-1 w-full" type="email" name="correo_electronico"
                    :value="old('correo_electronico')" required autocomplete="email" />
                <x-input-error :messages="$errors->get('correo_electronico')" class="mt-2" />
            </div>
            <br>
            <!-- Contraseña -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contraseña:')" /> <br>
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <br>
            <!-- Botón de inicio -->
            <div class="flex items-center justify-end boton-login">
                <x-primary-button class="ms-4 iniciar-sesion">
                    {{ __('Iniciar Sesión') }}
                </x-primary-button>
            </div>
        </form>
    </div>

</body>

</html>
