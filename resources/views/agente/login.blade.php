<form method="POST" action="{{ route('agente.login') }}">
    @csrf
    <input type="email" name="correo_electronico" placeholder="Email">
    <input type="password" name="password" placeholder="Contraseña">
    <button type="submit">Iniciar sesión</button>
</form>