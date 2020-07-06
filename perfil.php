<?php session_start();?>

<?php include('plantillas/bootstrap.php'); ?> 

<?php include('plantillas/header.php'); ?> 

<?php
include ('modelo/conexion.php');
$obj = new ConexionMySQL();
if(isset($_POST['loginB'])){
    echo "No has iniciado sesion<br>";
    echo "No se pueden mostrar datos";
}
else{
    if(isset($_SESSION['usuario'])){
        echo "<div class='container'>";
        echo "<h3>". $_SESSION['usuario'] ." </h3>";
        $info=$obj->getUserInfo($_SESSION['usuario']);
        for($i=0;$i<count($info);$i++){
            echo "<h4>".$info[$i]."</h4><br>";
            //Este arreglo se pasa a javascript
        }
        echo "<br></div>";
    }else{
        echo "No estas logeado";
    }
}
?>
