<?php 
session_start();
//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    if(isset($_POST['filtro'])){
        switch($_POST['filtro']){

            case 'Todos':
                echo "<script>window.location.replace('../cliente/home.php?pagina=1')</script>";
            break;

            case 'Alimentos':
                echo "<script>window.location.replace('../cliente/home.php?filtro=Alimentos')</script>";
            break;

            case 'Abarrotes':
                echo "<script>window.location.replace('../cliente/home.php?filtro=Abarrotes')</script>";
            break;

            case 'Servicios':
                echo "<script>window.location.replace('../cliente/home.php?filtro=Servicios')</script>";
            break;
        }
    }else{

    }
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}
?>