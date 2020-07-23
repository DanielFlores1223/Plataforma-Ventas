<?php
session_start();
include("barraAdmin.php");
include('../modelo/conexion.php');
include('../modelo/clases.php');
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    $obj= new ConexionMySQL("root",""); 
    $obj2 = new Empleado();
?>
<script src="../javascript/validaciones.js"></script>
<script src="../javascript/funcionesExtra.js"></script>
<!-- miperfil -->
<div class="container">
<?php if(isset($_GET['action'])){
                if($_GET['action']=='Actualizado'){?>
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                Se Actualizaron los datos <strong>Correctamente!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/perfil.php');">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                    
                <?php }else{
                    echo "NO SE PUDO ACTUALIZAR";
                }
            } ?>
                    <?php
                    $obj2=$obj->getEmpleadoInfo($_SESSION['usuario'],$obj2);
                    //$nombre = $obj2->getNombre();
                    ?>
    <div class="card bg-light">
    <div class="row">
        <div class="col-2" align = right>
            <img src="../img/contactoAgenda.png" class="" style="max-width: 100%">
            
        </div>
        <div class="col-4">
            <h5 class="card-title mb-4"><?php echo $obj2->getNombre()." ".$obj2->getApellidoP()." ".$obj2->getApellidoM(); ?></h5>
            <p>Fecha de Nacimiento: <?php echo $obj2->getFechaNac(); ?> </p>
            <p>Telefono: <?php echo $obj2->getTel(); ?></p>
            <p>Correo: <?php echo $obj2->getCorreo(); ?></p>
        </div>
        <div class="col-4">
            <h5 class="card-title mb-5"></h5>
            <p >Tipo de Empleado: <?php echo $obj2->getTipo(); ?> </p>
            <p>Sueldo: <?php echo $obj2->getSueldo(); ?></p>
            <p>Estatus: <?php echo $obj2->getEstatus(); ?></p>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-secondary ml-5 mt-1" data-toggle="modal" data-target="#configModal"> <img src="../img/config.png" alt=""></button>
        </div>
    </div>
    </div>
 </div>
<!--cierra miperfil -->
<!-- modal config -->
<div class="modal fade" id="configModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
      <div class="col-12">
            <h5 class="text-center font-weight-light ">Configuraciones</h5>
            </div>
      </div>
        <div class="form-row">
            <div class="col-12 mt-2">
            <form action="perfilModifica.php" method="POST">
            <button type="submit" class="btn btn-primary form-control">Modificar Información</button>
            </form>
            </div>        
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <button type="button" class="btn btn-primary form-control" data-dismiss="modal">Cambiar contraseña</button>
            </div>        
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Cerrar</button>
            </div>        
        </div>
      </div>
    </div>
  </div>
</div>
<!--cierra modal config-->

  <!-- Cierra el contenido de la pagina con la barra de navegacion-->    
  </div>
</div>
<?php 
}else{
   echo "<script>window.location.replace('../index.php?action=fail')</script>";
}
?>
