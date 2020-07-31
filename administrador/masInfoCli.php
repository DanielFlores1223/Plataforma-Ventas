<?php 
session_start();
include('barraAdmin.php');

//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    $cli = $_SESSION['cliente'];
?>
 <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item mr-1">
                        <a href="clientes.php?pagina=1" class="btn btn-light">Regresar</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="#">Más detalles</a>
                    </li>
                </ul>
            </div>
            
            <div class="row mt-3 mb-3">
                <div class="col-4 text-center">
                    <img src="<?php echo $cli[8] != "" ? $cli[8] : '../img/contactoAgenda.png' ; ?>" style="max-width:100%;" alt="">
                    <p class="mt-2"><?php echo $cli[1]." ".$cli[2]." ".$cli[3]; ?></p>
                </div>
                <div class="col-8">
                    <h5 class="font-weight-light">Información Personal</h5>
                    <p><b class="text-primary font-weight-normal">Id del Cliente:</b> <?php echo $cli[0]; ?></p>
                    <p><b class="text-primary font-weight-normal">Teléfono:</b> <?php echo $cli[4] ?></p>
                    <p><b class="text-primary font-weight-normal">Fecha de nacimiento:</b> <?php echo $cli[5]?></p>
                    <p><b class="text-primary font-weight-normal">Correo electrónico:</b> <?php echo $cli[6]; ?></p>
                    <p><b class="text-primary font-weight-normal">Estatus:</b> <?php echo $cli[7]; ?></p>
                
                <?php    if($cli[7] == "Inactivo"){
                        //encryptar
                        $encrypt1 = (($cli[0] * 123456789 * 5678) / 956783);
                        $linkAct = "../controlador/clienteController.php?pagina=1&idAct=".urlencode(base64_encode($encrypt1));
                ?> 
                    <a href="<?=$linkAct?>" class="btn btn-primary">Reactivar al cliente</a>
                
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