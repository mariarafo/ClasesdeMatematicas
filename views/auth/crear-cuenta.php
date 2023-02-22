<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llenar el siguiente Formulario para Crear una Cuenta</p>

<?php include_once __DIR__."/../templates/alertas.php";?>

<form class="formulario" method="POST" novalidate action="/crear-cuenta">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo s($usuario->nombre) ?>">
    </div>

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido" value="<?php echo s($usuario->apellido) ?>">
    </div>

    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="Tu Email" value="<?php echo s($usuario->email) ?>">
    </div>

    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input type="tel" id="telefono" name="telefono" placeholder="Tu número de Teléfono" value="<?php echo s($usuario->telefono) ?>">
    </div>
   

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Tu Password" >
    </div>

    <input class="boton" type="submit" value="Crear Cuenta">
</form>


<div class="acciones">
    <a href="/">¿Tienes una cuenta? Iniciar Sesión</a>
    <a href="/olvide-password">¿Olvidaste tu Password?</a>
</div>