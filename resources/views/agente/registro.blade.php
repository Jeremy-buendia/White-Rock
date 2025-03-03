<form method="POST" action="{{ route('agente.registro') }}">
    @csrf
    <input type="text" name="nombre" placeholder="Nombre">
    <input type="text" name="apellido" placeholder="Apellido">
    <input type="email" name="correo_electronico" placeholder="Email">
    <input type="text" name="telefono" placeholder="Teléfono">
    <input type="text" name="direccion" placeholder="Dirección">
    <input type="password" name="password" placeholder="Contraseña">
    <button type="submit">Registro</button>
</form>