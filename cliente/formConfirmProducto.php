<?php 
session_start();
include('barraCliente.php');
//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    include ('../modelo/conexion.php');
    include ('../modelo/clases.php');
    $obj = new ConexionMySQL("root","");
    $obj2 = new Producto();


    if(isset($_POST['idComprar'])){
        $id=$_POST['idComprar'];
        $obj2=$obj->getProduct($obj2,$id);
        if($obj2!=null){ ?>
            <div class="container">
                <form action="../controlador/pedido.php" method="POST">
                <div class="form-row">
                    <div class="col-4">
                         <p class="text-center">Nombre del Proveedor</p>
                     </div>
                    <div class="col-7">
                        <p class="text-center"><?php echo $obj2->getNombreProd(); ?></p>
                    </div>
                </div>
            </form>
    
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