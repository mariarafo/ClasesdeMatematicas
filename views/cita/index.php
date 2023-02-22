<?php
include_once __DIR__.'/../templates/barra.php'; //para agregar el nombre y el boton de cerra sesion
?>

<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina">Elige tus clases y coloca tus datos</p>



<div id="app">
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Clases</button>
        <button type="button" data-paso="2">Información de  Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>



    <div class="seccion" id="paso-1">
       <h2>Clases</h2>
       <p class="text-center">Elige tus clases a continuación</p>
       <div class="listado-servicios" id="servicios"></div> <!--estes es vacio porq se usara con javascript-->
    </div>

    <div class="seccion" id="paso-2">
        <h2>Informacion de Cita</h2>
        <p class="text-center">Coloca tus datos y fecha de tu Clase</p>

        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input 
                    id="nombre"
                    type="text"
                    placeholder="Tu Nombre"
                    value="<?php echo $nombre; ?>"
                    disabled 
                > <!--disabled= es para que no se modifique el nombre-->

            </div>
        </form>

        <form class="formulario">
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input 
                    id="fecha"
                    type="date"
                    min="<?php echo date('Y-m-d', strtotime('+1 day'))?>"
                >

            </div>
        </form>

        <form class="formulario">
            <div class="campo">
                <label for="hora">Hora</label>
                <input 
                    id="hora"
                    type="time"
                >

            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>"> <!--type hidden es oculto no se puede ver-->
        </form>
        
    </div>

    <div class="seccion contenido-resumen" id="paso-3">
        <h2>Resumen</h2>
        <p class="text-center">Verificar que la información sea correcta</p>
        
    </div>

    <div class="paginacion">
        <button class="boton" id="anterior">&laquo; Anterior</button>
        <button class="boton" id="siguiente"> Siguiente &raquo;</button>
    </div>

</div>


<?php
    $script="
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>, 
    <script src='build/js/app.js'></script>
    "; 
?>


