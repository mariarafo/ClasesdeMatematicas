<?php
include_once __DIR__.'/../templates/barra.php'; //para agregar el nombre y el boton de cerra sesion
include_once __DIR__.'/../templates/alertas.php';
?>

<h1 class="nombre-pagina">Actualizar Clases</h1>
<p class="descripcion-pagina">Modificar los Valores del Formulario</p>

<form class="formulario" method="POST">
    <?php include_once __DIR__.'/formulario.php'; ?>


    <input class="boton" type="submit" value="Actualizar">
</form>


