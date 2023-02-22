<?php
include_once __DIR__ . '/../templates/barra.php'; //para agregar el nombre y el boton de cerra sesion
?>

<h1 class="nombre-pagina">Panel de Administración</h1>
<p class="descripcion-pagina">Buscar Citas</p>

<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value= <?php echo $fecha; ?>>

        </div>

    </form>

</div>

<?php
if (count($citas) === 0){
    echo "<h2> No hay Citas en esta Fecha</h2>";
}
?>


<div id="citas-admin">
    <ul class="citas">
        <?php
        //debuguear($citas);
        $idCita = 0;
        foreach ($citas as $key => $cita) { //con key registraremos el indice que es la posicion que tiene el registro en el arreglo
            if ($idCita !== $cita->id) {
                $total=0;
                $idCita = $cita->id;
        ?>
                <li>
                    <p>ID: <span><?php echo $cita->id; ?></span></p>
                    <p>Hora: <span><?php echo $cita->hora; ?></span></p>
                    <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
                    <p>E-mail: <span><?php echo $cita->email; ?></span></p>
                    <p>Teléfono: <span><?php echo $cita->telefono; ?></span></p>

                    <h3>Servicios</h3>

                <?php } //fin de if

                $total+= $cita->precio; //sumando para obtener el total

                ?>

                <p class="servicio"><?php echo $cita->servicio . " : $ " . $cita->precio; ?></p>

                <?php
                $actual = $cita->id; //elemtno actual
                $proximo = $citas[$key + 1]->id ?? 0; //elemtno proximo

                if (esULtimo($actual, $proximo)) { ?>
                   <p class="total">Total: <span>$ <?php echo $total; ?> </span></p>

                   <form action="/api/eliminar" method="POST">
                       <input type="hidden" name="id" value="<?php echo $cita->id?>;">
                       <input class="boton-eliminar" type="submit" value="Eliminar">
                   </form>
                <?php } //fin de if ?>

            <?php } //fin del forech 
            ?>
    </ul>



</div>



<?php
    $script="
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>, 
    <script src='build/js/buscador.js'></script> 
    "; 
?>

