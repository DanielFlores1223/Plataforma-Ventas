<?php session_start();?>

<?php include('plantillas/bootstrap.php'); ?> 

<?php include('plantillas/header.php'); ?> 

<?php

if(isset($_POST['loginB'])){
    echo "No has iniciado sesion<br>";
    echo "No se pueden mostrar datos";
}
else{ 
    echo "<div class='container'>";
    echo "<h3>". $_SESSION['usuario'] ." </h3><br></div>";
}
?>
