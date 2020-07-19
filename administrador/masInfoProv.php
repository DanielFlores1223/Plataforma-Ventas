<?php  
session_start();
include("barraAdmin.php"); 
//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){

$infoProv = $_SESSION['arregloProv'];
?>
    <div class="container bg-info"> 
        <div class="row mt-5">
            <div class="col-3">
                <a href="proveedores.php?pagina=1" class="btn btn-light mt-2">Regresar</a>                          
                <div class="text-center">
                    <h2 class="my-4 text-light">Proveedor: #<?php echo $infoProv[0] ?></h2>
                    <img src="../img/contactoAgenda.png" alt="">
                </div> 
            </div>
            <div class="col-3 pt-5">
                <h4 class="my-4 text-light">Informacion Personal</h4>
                <p class="text-light"><b>Nombre del Proveedor:</b> <?php echo $infoProv[1] ?></p>
                <p class="text-light"><b>Nombre del Agente:</b> <?php echo $infoProv[2] ?></p>
                <p class="text-light"><b>Estatus:</b> <?php echo $infoProv[7] ?></p>
            </div>
            <div class="col-3 pt-5">
                <h4 class="my-4 text-light">Informacion laboral</h4>
                <p class="text-light"><b>Teléfono:</b> <?php echo $infoProv[3] ?></p>
                <p class="text-light"><b>Horario:</b> <?php echo $infoProv[4] ?></p>
                <p class="text-light"><b>Dirección:</b> <?php echo $infoProv[6] ?></p>
            </div>
            <div class="col-3 pt-5">
                <h4 class="my-4 text-light">Categoria</h4>
                <p class="text-light"><?php echo $infoProv[5] ?></p>

                <?php 
                    if($infoProv[5] == "Alimentos"){                
                ?>
                        <img src="../img/alimentos.jpg" style="max-width: 100%" alt="">
                <?php 
                    }elseif ($infoProv[5] == "Abarrotes") {
                ?>
                    
                        <img src="../img/abarrotes.jpg" style="max-width: 100%" alt="">
                    
                <?php 
                    }elseif ($infoProv[5] == "Servicios") {
                ?>  
                        <img src="../img/servicios.jpg"  style="max-width: 100%" alt="">
                
                <?php 
                    }
                ?>
            </div>
        </div>
<!-- Cierra el contenido de la pagina con la barra de navegacion-->    
</div>
</div> 
<?php 
}else{
   echo "<script>window.location.replace('../index.php')</script>";
}
?>