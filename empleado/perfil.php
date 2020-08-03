<?php
session_start();
include("barraEmpleado.php");
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
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../empleado/perfil.php');">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                    
                <?php }else{
                    echo "NO SE PUDO ACTUALIZAR";
                }
            } ?>
                <?php
                $obj2=$obj->getEmpleadoInfo($_SESSION['usuario'],$obj2);
                $_SESSION['idE']=$obj2->getIdEmpl();
                ?>
<div class="card bg-light">
    <div class="row">
        <div class="col-2" align = right>
        <img src="<?php echo  $obj2->getFoto() != "" ? $obj2->getFoto() : '../img/empDefault.png' ; ?>" style="max-width:100%;" alt="">
            
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
      <div class="modal-header bg-light">
      <img src="../img/config.png" alt="">
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
            <button type="button" class="btn btn-primary form-control" data-dismiss="modal"  data-toggle="modal" data-target="#passModal">Cambiar contraseña</button>
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

<!-- modal cambio de contraseña -->
<div class="modal fade" id="passModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-light">
      <img src="../img/pass_icono.png" alt="">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
      <div class="col-12">
            <h5 class="text-center font-weight-light ">Cambio de contraseña</h5>
            <div id="alerta"></div>      
      </div>
      </div>
            <form action="../controlador/modificaPerfil.php?cam=si" method="post" onsubmit="return validaPass(pass1, pass2, 'alerta')">
                <input type="password" 
                       name="pass1" 
                       class="form-control mt-1" 
                       placeholder="Ingrese su nueva contraseña"
                       required 
                       minlength='6' 
                       title='minimo 6 caracteres'
                >
                <input type="password" 
                       name="pass2" 
                       class="form-control mt-2" 
                       placeholder="Ingrese de nuevo la nueva contraseña"
                       required 
                       minlength='6' 
                       title='minimo 6 caracteres'
                >
                <button type="submit" name="btn" value="guardar" class="btn btn-primary form-control mt-2">Cambiar contraseña</button>
                <button type="button" class="btn btn-secondary form-control mt-2" data-dismiss="modal">Cerrar</button>
            </form>
    </div>
  </div>
</div>
<!--cierra modal config pass-->

  <!-- Cierra el contenido de la pagina con la barra de navegacion-->    
  </div>
</div>
<?php 
}else{
   echo "<script>window.location.replace('../index.php?action=fail')</script>";
}
?>