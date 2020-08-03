<?php
session_start();
include("../cliente/barraCliente.php");
include('../modelo/conexion.php');
include('../modelo/clases.php');
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    $obj= new ConexionMySQL("root",""); 
    $obj2 = new Cliente();
    $obj2=$obj->getClienteInfo($_SESSION['usuario'],$obj2);
?>
<script src="../javascript/validaciones.js"></script>
<script src="../javascript/funcionesExtra.js"></script>
<div class="container">
    <!--<img src="../img/contactoAgenda.png"> deberia tener una imagen-->
    <?php        
            if(isset($_GET['action'])){
              if ($_GET['action'] == 'Ixcorreo') {
     ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> El correo que intento actualizar ya existe.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../cliente/perfilModifica.php');">
                <span aria-hidden="true">&times;</span>
              </button>
             </div>  

    <?php        
              }
            }
     ?>
</div>
<form action="../controlador/modificaPerfil.php" method="POST" enctype="multipart/form-data">    
<div class="container">
    <div class="card bg-light">
        <div class="row mt-4">
            <div class="col-sm-12 col-md-2 col-lg-2 mb-3" align = center>
                <img src="<?php echo  $obj2->getFoto() != "" ? $obj2->getFoto() : '../img/contactoAgenda.png' ; ?>" style="max-width:100%;" alt="">
                <div id="formFoto">
               <button type="button"
                   name="btnActFoto"
                   class="btn btn-primary form-control"
                   onclick="mostrarFormFoto('formFoto')"
               >
                  Cambiar Foto
               </button>
            </div>   
            </div>   
            <div class='col-sm-12 col-md-3 col-lg-3 mx-2'> 
                <label>Nombre</label>          
                <input class="form-control" name ='nombre' value='<?php echo $obj2->getNombre(); ?>'>
                <label class="mt-2">Teléfono</label>
                <input class="form-control" name ='telefono' value='<?php echo $obj2->getTel(); ?>'>
            </div> 
            <div class="col-sm-12 col-md-3 col-lg-3  mx-2">
                <label>Apellido Paterno</label>  
                <input class="form-control" name ='apellidop' value='<?php echo $obj2->getApellidoP(); ?>'>
                <label class="mt-2">Fecha de Nacimiento</label>
                <input type="date" class="form-control" name ='fechnac' value='<?php echo $obj2->getFechaNac(); ?>'>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3  mx-2">
                <label>Apellido Materno</label>  
                <input class="form-control" name ='apellidom' value='<?php echo $obj2->getApellidoM(); ?>'>
                <label class="mt-2">Correo</label>
                <input class="form-control" name ='correo' value='<?php echo $obj2->getCorreo(); ?>'>
            </div>
        </div>

        <div class="row my-4">
        <div class='col-sm-12 col-md-12 col-lg-12'>
            <div class="text-right mr-4">            
             <a href='perfil.php' class='btn btn-secondary '>Cancelar</a>
             <button name='btn' value='guardar' type='submit' class='btn btn-success '>Guardar</button>
             </div>
        </div>
    </div>

    </div >
</div>
     
</form>
<?php }else{
   echo "<script>window.location.replace('../index.php?action=fail')</script>";
}?> 