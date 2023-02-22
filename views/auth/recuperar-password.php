<h1 class="nombre-pagina">Reestablece tu Password</h1>
<p class="descripcion-pagina"> Escribe tu nuevo Password a continuación </p>


<?php include_once __DIR__."/../templates/alertas.php";?>

<?php if($error) return ;?>
<form class="formulario" method="POST" novalidate>
  
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Tu Nuevo Password">
    </div>
    
    <input class="boton" type="submit" value="Guardar ">
    
</form>


<div class="acciones">
    <a href="/">¿Tienes una cuenta? Iniciar Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una Cuenta? Crear Una</a>
</div>