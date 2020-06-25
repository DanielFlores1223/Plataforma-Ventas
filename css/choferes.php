<?php 
include "../PHP/consulta.php";
session_start();
$usuario = $_SESSION['usu']; 
$contraseña = $_SESSION['contraseña'];
$bd = new consulta();
$con=$bd->conectar($usuario, $contraseña);
$c = new consulta();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../estilos/estiloAdmin.css">
    <link rel="stylesheet" href="../estilos/estiloInterfazAdmin.css">
    <title>Administrador-chofer</title>
</head>

<header>
    <!--Comienza la barra lateral-->   
    <div id="slidebar" class="active">
        <div class="toggle-btn">
            
            <span><img src="../img/menu.png" alt="" class="pt-4"></span>

        </div>

        <ul>
            <li class="pb-5 pt-4"><img src="../img/logo_recortado.png" alt=""></li>
            <a href="inicio.php"><li class="estiloNav"  onmouseover="cambiarColor(this, 'rgb(230, 21, 21)')" onmouseout="cambiarColor(this, '#151719')"><label for="" class="letra">Inicio</label></li></a>
            <a href="clientes.php"><li class="estiloNav" onmouseover="cambiarColor(this, 'rgb(230, 21, 21)')" onmouseout="cambiarColor(this, '#151719')"><label for="" class="letra">Clientes</label></li></a>
            <a href="#"><li class="estiloNav" onmouseover="cambiarColor(this, 'rgb(230, 21, 21)')" onmouseout="cambiarColor(this, '#151719')"><label for="" class="letra">Choferes</label></li></a>
            <a href="servicios.php"><li class="estiloNav" onmouseover="cambiarColor(this, 'rgb(230, 21, 21)')" onmouseout="cambiarColor(this, '#151719')"><label for="" class="letra">Servicios</label></li>
            <a href="unidades.php"><li class="estiloNav" onmouseover="cambiarColor(this, 'rgb(230, 21, 21)')" onmouseout="cambiarColor(this, '#151719')"><label for="" class="letra">Unidades</label></li></a>
           <a href="../PHP/cerrarSesion.php"><li class="estiloNav" onmouseover="cambiarColor(this, 'rgb(230, 21, 21)')" onmouseout="cambiarColor(this, '#151719')"><label for="" class="letra">Cerrar Sesión</label></li></a> 


        </ul>

    </div>
 <!--Termina la barra lateral-->  
</header>

<body>
    <!--Comienza la parte de la barra de busqueda-->
<form action="" method=POST>
 
 <div class="barra-busqueda">
     <select name="tipoBusqueda" class="barra-busqueda-select" required>
         <option value="Nombre">filtro de búsqueda</option>
         <option value="Nombre">Nombre</option>
         <option value="Id">ID</option>
         <option value="Correo">Correo</option>
         <option value="Sexo">Sexo</option>
         <option value="Ninguno">Mostrar todos</option>
 
     </select>
     <input class="barra-busqueda-txt" name="barraBusqueda" placeholder="buscar chofer..." type="text">
     <input type="submit" name="botonBuscar"class="barra-busqueda-btn btn btn-dark" value="Buscar">
     
 </form>

<form action="formularioRegistroChofer.php">
     <input type="submit" style="margin-top:11px" class="btn btn-success ml-2" value="Registrar chofer">
</form>
 </div>
<!--Termina la parte de la barra de busqueda-->

 <!--Comienza la tabla donde se consultan registros-->
 <div class="container">   
    <table border=1 class="formularioCliente mt-5 mb-3 table">
        <tr>
            <td class="text-center"><b>Id</b></td>
            <td class="text-center"><b>Nombre</b></td>
            <td class="text-center"><b>Apellidos</b></td>
            <td class="text-center"><b>Sexo</b></td>
            <td class="text-center"><b>Fecha de Nacimiento</b></td>
            <td class="text-center"><b>Dirección</b></td>
            <td class="text-center"><b>Teléfono</b></td>
            <td class="text-center"><b>Correo electrónico<b></td>
            <td class="text-center"><b>Sueldo<b></td>
            <td class="text-center"><b>Acción<b></td>
            <td class="text-center"><b>Acción<b></td>
        </tr> 
        <?php

         if (isset($_POST['botonBuscar']) && $_POST['tipoBusqueda'] != "Ninguno") {
            $filtroB = $_POST['tipoBusqueda'];
            $valorB = $_POST['barraBusqueda'];   
            $ejecutar = $c->consultaAprox("chofer", $filtroB,$_POST['barraBusqueda'],$con);
        
            while ($fila = sqlsrv_fetch_array($ejecutar)){
                $Id = $fila["Id"];
                $Nombre = $fila["Nombre"];
                $Apellidos = $fila["Apellidos"];
                $Sexo = $fila["Sexo"];
                $fecha_Nac = $fila["Fecha_Nacimiento"];
                $Direccion = $fila["Direccion"];
                $Telefono = $fila["Telefono"];
                $Correo = $fila["Correo"];
                $Sueldo = $fila["Sueldo"];
          ?> 
        <tr>
            <td><?php echo $Id; ?></td>
            <td><?php echo $Nombre; ?></td>
            <td><?php echo $Apellidos; ?></td>
            <td><?php echo $Sexo; ?></td>
            <?php echo"<td>".$fecha_Nac->format('Y-m-d')."</td>"; ?>
            <td><?php echo $Direccion;?></td>
            <td style="font-size:16 px"><?php echo $Telefono;?></td>
            <td><?php echo $Correo;?></td>
            <td><?php echo $Sueldo;?></td>
            <form action="formularioModificarChofer.php" method="POST">
                <td><button type="submit" name="btnModificar" value=<?php echo "$Id";?> class="btn btn-secondary">Modificar</button></td>
            </form>

            <form action="../PHP/eliminarChofer.php" method="POST">
                <td><button type="submit" name="btnEliminar" value=<?php echo "$Id";?> class="btn btn-secondary">Eliminar</button></td>
            </form>
        </tr>

        <?php
            }//cierra el while de la busqueda aprox 
        }else{
        
            $ejecutar = $c->consultaGeneral("chofer", $con);
        
            while ($fila = sqlsrv_fetch_array($ejecutar)) {
                $Id = $fila["Id"];
                $Nombre = $fila["Nombre"];
                $Apellidos = $fila["Apellidos"];
                $Sexo = $fila["Sexo"];
                $fecha_Nac =  $fila["Fecha_Nacimiento"];
                $Direccion = $fila["Direccion"];
                $Telefono = $fila["Telefono"];
                $Correo = $fila["Correo"];
                $Sueldo = $fila["Sueldo"];
                
            ?>

        <tr>
            <td><?php echo $Id; ?></td>
            <td><?php echo $Nombre; ?></td>
            <td><?php echo $Apellidos; ?></td>
            <td><?php echo $Sexo; ?></td>
            <?php echo"<td>".$fecha_Nac->format('Y-m-d')."</td>"; ?>
            <td><?php echo $Direccion;?></td>
            <td style="font-size:16 px"><?php echo $Telefono;?></td>
            <td><?php echo $Correo;?></td>
            <td><?php echo $Sueldo;?></td>
            
            <form action="formularioModificarChofer.php" method="POST">
                <td><button type="submit" name="btnModificar" value=<?php echo "$Id";?> class="btn btn-secondary">Modificar</button></td>
            </form>
           
            <form action="../PHP/eliminarChofer.php" method="POST">
            <td><button type="submit" name="btnEliminar" value=<?php echo "$Id"; ?> class="btn btn-secondary">Eliminar</button></td>
            </form>
          


        </tr>
        <?php }//cierra el ciclo while 
                }//cierra el else ?>    
    </table>
        </div>

    <br>
  <!--Termina la tabla donde se consultan registros-->
    <!--Script-->
    <script src="../javascript/funciones.js"></script>
    <script src="../javascript/barra.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> 
</body>
</html>