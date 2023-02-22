<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Restablece tu Password escribiendo tu E-mail a continuación </p>

<?php include_once __DIR__."/../templates/alertas.php";?>


<form class="formulario" method="POST" novalidate action="/olvide-password">

    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="Tu Email">
    </div>
  

    <input class="boton" type="submit" value="Enviar ">

</form>


<div class="acciones">
    <a href="/">¿Tienes una cuenta? Iniciar Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una Cuenta? Crear Una</a>
    
</div>