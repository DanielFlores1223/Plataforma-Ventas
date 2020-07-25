<?php 
session_start();
include('barraAdmin.php');

//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    $emp = $_SESSION['empleado'];
?>

    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item mr-1">
                        <a href="empleados.php?pagina=1" class="btn btn-light">Regresar</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="#">Más detalles</a>
                    </li>
                </ul>
            </div>
            
            <div class="row mt-3 mb-3">
                <div class="col-4 text-center">
                    <img src="<?php echo $emp[11] != "" ? $emp[11] : '../img/empDefault.png' ; ?>" style="max-width:100%;" alt="">
                    
                    <p class="mt-2"><?php echo $emp[1]." ".$emp[2]." ".$emp[3]; ?></p>
                </div>
                <div class="col-8">
                    <h5 class="font-weight-light">Información Personal</h5>
                    <p><b class="text-primary font-weight-normal">Id de empleado:</b> <?php echo $emp[0]; ?></p>
                    <p><b class="text-primary font-weight-normal">Teléfono:</b> <?php echo $emp[4] ?></p>
                    <p><b class="text-primary font-weight-normal">Fecha de nacimiento:</b> <?php echo $emp[5]?></p>
                    <hr>
                    <h5 class="font-weight-light">Infomación Laboral</h5>
                    <p><b class="text-primary font-weight-normal">Correo:</b> <?php echo $emp[6]; ?></p>
                    <p><b class="text-primary font-weight-normal">Sueldo:</b> <?php echo $emp[8] ?></p>
                    <p><b class="text-primary font-weight-normal">Tipo:</b> <?php echo $emp[9]?></p>
                    <p><b class="text-primary font-weight-normal">Estatus:</b> <?php echo $emp[10]?></p>
                    <?php
                    if($emp[10] == "Inactivo"){
                        //encryptar
                        $encrypt1 = (($emp[0] * 123456789 * 5678) / 956783);
                        $linkAct = "../controlador/empleadoController.php?pagina=1&idAct=".urlencode(base64_encode($encrypt1));
                ?> 
                    <a href="<?=$linkAct?>" class="btn btn-primary">Reactivar al empleado</a>
                
                <?php    
                    }             
                ?>
                </div>

            </div>

        </div>    
    </div>

  <!-- Cierra el contenido de la pagina con la barra de navegacion-->    
  </div>
</div>
<?php 
}else{
    echo "<script>window.location.replace('../index.php')</script>";

}//cierra validacion de un inicio de sesion previo
?>