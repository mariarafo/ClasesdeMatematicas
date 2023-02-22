<?php
//include_once __DIR__.'/../templates/barra.php'; //para agregar el nombre y el boton de cerra sesion
include_once __DIR__.'/../templates/alertas.php';
?>

<h1 class="nombre-pagina">Nueva Clase</h1>
<p class="descripcion-pagina">LLena todos los campos para añadir una Nueva Clase</p>


<form class="formulario" method="POST" action="/servicios/crear">
    <?php include_once __DIR__.'/formulario.php'; ?>


    <input class="boton" type="submit" value="Guardar Servicio">
</form>


