<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Iniciar Sesión con tus datos</p>

<?php include_once __DIR__."/../templates/alertas.php";?>


<form class="formulario" method="POST" novalidate action="/">
    <div class="campo">

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="Tu Email" value="<?php echo s($auth->email); ?>">
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Tu Password">
    </div>

    <input class="boton" type="submit" value="Iniciar Sesión">
</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes una Cuenta? Crear Una</a>
    <a href="/olvide-password">¿Olvidaste tu Password?</a>
</div>