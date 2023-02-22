<?php
    foreach($alertas as $key => $mensajes):
        foreach($mensajes as $mensaje):
?>

<div class="alerta <?php echo $key; ?>"> <!-- no se sanitiza key porq viene del codigo no lo escribe el usuario-->
   <?php echo $mensaje; ?>
</div>

<?php
          endforeach;


    endforeach;
?>