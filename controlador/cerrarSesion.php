<?php 
    session_start();
    session_destroy();
    if (isset($_GET['cam'])) {
        echo "<script>alert('Cambio de contraseña o correo correcto, vuelve a iniciar sesión')</script>"; 
        echo "<script>window.location.replace('../index.php')</script>";    
    }else{
      header("Location:../index.php");     
    }
    
?>