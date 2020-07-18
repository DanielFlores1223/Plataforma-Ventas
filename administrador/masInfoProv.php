<?php  
session_start();
include("barraAdmin.php"); 
$infoProv = $_SESSION['arregloProv'];
?>
    <div class="container bg-info">
        <h2 class="my-4 text-light">Proveedor: <?php echo $infoProv[0] ?></h2>
        <div class="row">
            <div class="col-3">
                <p class="text-light">Nombre del Proveedor: <?php echo $infoProv[1] ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <p class="text-light">Nombre del Agente: <?php echo $infoProv[2] ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <p class="text-light">Teléfono: <?php echo $infoProv[3] ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <p class="text-light">Horario: <?php echo $infoProv[4] ?></p>
                
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <p class="text-light">Categoria: <?php echo $infoProv[5] ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <p class="text-light">Dirección: <?php echo $infoProv[6] ?></p>
            </div>
        </div>
    </div>


<!-- Cierra el contenido de la pagina con la barra de navegacion-->    
</div>
</div> 