<?php 
session_start();
//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    include ('../modelo/conexion.php');
    include ('../modelo/clases.php');
    $obj = new ConexionMySQL("root","");
    $obj2 = new Producto();


    if(isset($_POST['idComprar'])){
        $id=$_POST['idComprar'];
        if($obj2=$obj->getProduct($obj2,$id)!=null){ ?>
        <div class="container">
            
            <h3>Saludos</h3>

        </div>

        <?php }else{
            echo "<script>window.location.replace('../cliente/home.php?action=fail')</script>";
        }
    }

    if(isset($_POST['idAgregar'])){
        echo "<script>window.location.replace('../cliente/home.php?action=agregado')</script>";  
    }

    if(isset($_POST['idInfo'])){

        echo "<script>window.location.replace('../cliente/home.php?action=mostrar')</script>";
    }
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}
?>