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
            <tr><td><label>Nombre</label></td><td><input name ='nombre' value='<?php echo $obj2->getNombre(); ?>'></input></td></tr>
            <tr><td><label>Apellido Paterno</label></td><td><input name ='apellidop' value='<?php echo $obj2->getApellidoP(); ?>'></input></td></tr>
            <tr><td><label>Apellido Materno</label></td><td><input name ='apellidom' value='<?php echo $obj2->getApellidoM(); ?>'></input></td></tr>
            <tr><td><label>Telefono</label></td><td><input name ='telefono' value='<?php echo $obj2->getTel(); ?>'></input></td></tr>
            <tr><td><label>Fecha de Nacimiento</label></td><td><input name ='fechnac' value='<?php echo $obj2->getFechaNac(); ?>'></input></td></tr>
        </table>
    </div>
    <div class='col-5'>
        <table>
            <tr><td><label>Contraseña</label></td><td><input name ='contra' value='<?php echo $obj2->getContra(); ?>'></input></td></tr>
            <tr><td><label>Correo</label></td><td><input name ='correo' value='<?php echo $obj2->getCorreo(); ?>'></input></td></tr>
        </table>
    </div>
</div>
</div >
<div class=" card bg-light">
    <div class="row">
        <div class='col-12'>
            <table>
                <tr><td><a href='perfil.php' class='btn btn-danger btn-sm'>CANCELAR</a></td>
                <td><button name='btn' value='guardar' type='submit' class='btn btn-info btn-sm' >GUARDAR</button></td></tr>
            </table>
        </div>
    </div>
</div>
</div>     
</form>
<?php }else{
   echo "<script>window.location.replace('../index.php?action=fail')</script>";
}?>