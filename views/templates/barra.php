<div class="barra">
    <p>Hola: <?php echo $nombre ?? ''; ?></p> <!--para que aparezca arriba el nombre del cliente-->
    <a class="boton" href="/logout">Cerrar Sesión</a>
</div>

<?php if(isset($_SESSION['admin'])){?>
    <div class="barra-servicios">
        <a class="boton" href="/admin">Ver Citas</a>
        <a class="boton" href="/servicios">Ver Clases</a>
        <a class="boton" href="/servicios/crear">Nueva Clase</a>
    </div>
 <?php } ?>   