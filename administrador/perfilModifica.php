<?php
session_start();
include("../administrador/barraAdmin.php");
include('../modelo/conexion.php');
include('../modelo/clases.php');
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    $obj= new ConexionMySQL("root",""); 
    $obj2 = new Empleado();
    $obj2=$obj->getEmpleadoInfo($_SESSION['usuario'],$obj2);
    $_SESSION['idAdmin'] = $obj2->getIdEmpl();
?>
<div class="container">
    <!--<img src="../img/contactoAgenda.png"> deberia tener una imagen-->
</div>
<form action="../controlador/modificaPerfil.php" method="POST">    
<div class="container">
<div class="card bg-light">
<div class="row">
    <div class="col-2" align = right>
        <img src="../img/contactoAgenda.png" class="" style="max-width: 100%">
    </div>
    <div class='col-5'>
        <table>
            <tr><td><label>ID</label></td><td><input class="form-control" disabled name ='id' value='<?php echo $obj2->getIdEmpl(); ?>'></input></td></tr>
            <tr><td><label>Nombre</label></td><td><input class="form-control" name ='nombre' value='<?php echo $obj2->getNombre(); ?>'></input></td></tr>
            <tr><td><label>Apellido Paterno</label></td><td><input class="form-control" name ='apellidop' value='<?php echo $obj2->getApellidoP(); ?>'></input></td></tr>
            <tr><td><label>Apellido Materno</label></td><td><input class="form-control" name ='apellidom' value='<?php echo $obj2->getApellidoM(); ?>'></input></td></tr>
            <tr><td><label>Telefono</label></td><td><input class="form-control" name ='telefono' value='<?php echo $obj2->getTel(); ?>'></input></td></tr>
            <tr><td><label>Fecha de Nacimiento</label></td><td><input type="date" class="form-control" name ='fechnac' value='<?php echo $obj2->getFechaNac(); ?>'></input></td></tr>
        </table>
    </div>
    <div class='col-5'>
        <table>
            <tr><td><label>Contraseña</label></td><td><input class="form-control" name ='contra' value='<?php echo $obj2->getContra(); ?>'></input></td></tr>
            <tr><td><label>Correo</label></td><td><input class="form-control" name ='correo' value='<?php echo $obj2->getCorreo(); ?>'></input></td></tr>
            <tr><td><label>Sueldo</label></td><td><input class="form-control" name ='sueldo' value='<?php echo $obj2->getSueldo() ?>'></input></td></tr>
            <tr><td><label>Tipo</label></td><td><input class="form-control" name ='tipo' value='<?php echo $obj2->getTipo() ?>'></input></td></tr>
            <tr><td><label>Estatus</label></td><td><input class="form-control" name ='estatus' value='<?php echo $obj2->getEstatus(); ?>'></input></td></tr>
        </table>
    </div>
</div>
</div >
<div class=" card bg-light">
    <div class="row">
        <div class='col-12'>
            <div class="text-right mr-4">            
             <a href='perfil.php' class='btn btn-secondary '>Cancelar</a>
             <button name='btn' value='guardar' type='submit' class='btn btn-success ' >Guardar</button>
             </div>
        </div>
    </div>
</div>
</div>     
</form>
<?php }else{
   echo "<script>window.location.replace('../index.php')</script>";
}?>
