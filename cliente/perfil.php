<?php session_start();
include('barraCliente.php');
include('../modelo/conexion.php');
include('../modelo/clases.php');
if(isset($_SESSION['usuario']) && isset($_SESSION['contra'])){ 
  $obj= new ConexionMySQL("root",""); 
  $obj2 = new Cliente();
  ?>
<script src="../javascript/validaciones.js"></script>
<script src="../javascript/funcionesExtra.js"></script>
<!-- miperfil -->
<div class="container">
            <?php if(isset($_GET['action'])){
                if($_GET['action']=='Actualizado'){?>
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                Se Actualizaron los datos <strong>Correctamente!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../cliente/perfil.php');">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                    
                <?php }else{
                    echo "NO SE PUDO ACTUALIZAR";
                }
            } ?>
                <?php
                $obj2=$obj->getClienteInfo($_SESSION['usuario'],$obj2);
                $_SESSION['id']=$obj2->getIdCli();
                ?>
<div class="card bg-light">
    <div class="row">
    <div class="col-sm-2 col-md-2 col-lg-2 text-center">
        <p class="ml-2 mt-2 text-info font-weight-bold">Bienvenid@ </p>
    </div>
    <div class="col-sm-10 col-md-10 col-lg-10 text-right">
            <button type="button" class="btn btn-secondary mr-2 mt-1 mb-1" data-toggle="modal" data-target="#configModal"> <img src="../img/config.png" alt="" ></button>
    </div>
    
    </div>
    <div class="row align-items-center text-center">
        <div class="col-sm-12 col-md-2 col-lg-2 mb-2 pb-2" align = center>
        <img src="<?php echo  $obj2->getFoto() != "" ? $obj2->getFoto() : '../img/contactoAgenda.png' ; ?>" style="max-width:100%; height:10rem;" alt="" class="ml-2">
            
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 mb-3">
        <img src="../img/usario_header.png" alt=""> <h5 class="card-title mb-1"><?php echo $obj2->getNombre()." ".$obj2->getApellidoP()." ".$obj2->getApellidoM(); ?></h5>                     
        </div>
        <div  class="col-sm-12 col-md-3 col-lg-3 mb-3">
          <img src="../img/phone_icon.png" alt=""> 
          <p class="mt-1"><?php echo $obj2->getTel(); ?></p> 
        </div>
        <div  class="col-sm-12 col-md-3 col-lg-3 mb-3">
          <img src="../img/email_iconC.png" alt=""> 
          <p class="mt-1"><?php echo $obj2->getCorreo(); ?></p>
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