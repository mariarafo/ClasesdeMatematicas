<?php
include_once __DIR__.'/../templates/barra.php'; //para agregar el nombre y el boton de cerra sesion
?>

<h1 class="nombre-pagina">Clases</h1>
<p class="descripcion-pagina">Administración de Clases</p>

<ul class="servicios">
    <?php foreach($servicios as $servicio){?>
        <li>
            <p>Nombre: <span><?php echo $servicio->nombre; ?></span></p>
            <p class="total">Precio: <span> $ <?php echo $servicio->precio; ?></span></p>
            <div class="acciones">
                <a class="boton" href="/servicios/actualizar?id=<?php echo $servicio->id; ?>">Actualizar</a>
                
                <form method="POST" action="/servicios/eliminar">
                    <input 
                      type="hidden" 
                      name="id"
                      value="<?php echo $servicio->id; ?>"
                    >
                    <input class="boton-eliminar" type="submit" value="Borrar">
                </form>
                
            </div>
           
        </li>

    <?php } ?>

</ul>
