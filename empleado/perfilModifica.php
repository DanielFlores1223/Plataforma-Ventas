<?php
session_start();
include("../empleado/barraEmpleado.php");
include('../modelo/conexion.php');
include('../modelo/clases.php');
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    $obj= new ConexionMySQL("root",""); 
    $obj2 = new Empleado();
?>
<div class="container">
    <img src="../img/contactoAgenda.png">
</div>
<form action="../controlador/modificaPerfil.php" method="POST">    
<div class="container">
    <div class="col-sm-8 col-md-8 col-lg-8 "><label><h3>Perfil</h3></label>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-dark">
                <?php
                if($_SESSION['tipo']=="CLIENTE"){
                    $obj2= new Cliente();
                    $obj2=$obj->getClienteInfo($_SESSION['usuario'],$obj2);
                    echo "<tr><td><label>ID</label></td><td><input name ='id' value='".$obj2->getIdCli()."'></input></td></tr>";
                    echo "<tr><td><label>Nombre</label></td><td><input name ='nombre' value='".$obj2->getNombre()."'></input></td></tr>";
                    echo "<tr><td><label>Apellido Paterno</label></td><td><input name ='apellidop' value='".$obj2->getApellidoP()."'></input></td></tr>";
                    echo"<tr><td><label>Apellido Materno</label></td><td><input name ='apellidom' value='".$obj2->getApellidoM()."'></input></td></tr>";
                    echo "<tr><td><label>Telefono</label></td><td><input name ='telefono' value='".$obj2->getTel()."'></input></td></tr>";
                    echo "<tr><td><label>Fecha de Nacimiento</label></td><td><input name ='fechnac' value='".$obj2->getFechaNac()."'></input></td></tr>";
                    echo "<tr><td><label>Correo</label></td><td><input name ='correo' value='".$obj2->getCorreo()."'></input></td></tr>";
                    echo "<tr><td><label>Contraseña</label></td><td><input name ='contra' value='".$obj2->getContra()."'></input></td></tr>";
                    echo "</table>";
                }else{
                    $obj2= new Empleado();
                    $obj2=$obj->getEmpleadoInfo($_SESSION['usuario'],$obj2);
                    echo "<tr><td><label>ID</label></td><td><input name ='id' value='".$obj2->getIdEmpl()."'></input></td></tr>";
                    echo "<tr><td><label>Nombre</label></td><td><input name ='nombre' value='".$obj2->getNombre()."'></input></td></tr>";
                    echo "<tr><td><label>Apellido Paterno</label></td><td><input name ='apellidop' value='".$obj2->getApellidoP()."'></input></td></tr>";
                    echo "<tr><td><label>Apellido Materno</label></td><td><input name ='apellidom' value='".$obj2->getApellidoM()."'></input></td></tr>";
                    echo "<tr><td><label>Telefono</label></td><td><input name ='telefono' value='".$obj2->getTel()."'></input></td></tr>";
                    echo "<tr><td><label>Fecha de Nacimiento</label></td><td><input name ='fechnac' value='".$obj2->getFechaNac()."'></input></td></tr>";
                    echo "<tr><td><label>Correo</label></td><td><input name ='correo' value='".$obj2->getCorreo()."'></input></td></tr>";
                    echo "<tr><td><label>Contraseña</label></td><td><input name ='contra' value='".$obj2->getContra()."'></input></td></tr>";
                    echo "<tr><td><label>Sueldo</label></td><td><input name ='sueldo' value='".$obj2->getSueldo()."'></input></td></tr>";
                    echo "<tr><td><label>Tipo</label></td><td><input name ='tipo' value='".$obj2->getTipo()."'></input></td></tr>";
                    echo "<tr><td><label>Estatus</label></td><td><input name ='estatus' value='".$obj2->getEstatus()."'></input></td></tr>";
                }
                echo "<tr><td><a href='perfil.php' class='btn btn-danger btn-sm'>CANCELAR</a></td>
                <td><button name='btn' value='guardar' type='submit' class='btn btn-info btn-sm' >GUARDAR</button></td></tr>";
                echo '</div>';
}else{
   echo "<script>window.location.replace('../index.php')</script>";
}?>
