<?php 
session_start();
include('barraCliente.php');

if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    include ('../modelo/conexion.php');
    include ('../modelo/clases.php');
    $obj = new ConexionMySQL("root","");
    $obj2 = new Producto();

    if(isset($_POST['idComprar'])){
        $id=$_POST['idComprar'];
        $obj2=$obj->getProduct($obj2,$id);
        if($obj2!=null){ ?>
    <link rel="stylesheet" href="../estilos/general.css">
            <form action="../controlador/pedidoCliente.php" method="POST"><hr>    
            <div class="container">
                <div class="card bg-light">
                    <div class="container">
                        <h3 class="my-3 font-weight-light">Confirmar Pedido</h3>
                    </div><hr>
                    <div class="row mt-4">
                        <div class="col-sm-12 col-md-3 col-lg-3 text-center mb-3">
                            <div class="ml-4">
                            <img src='<?php echo '../'.$obj2->getFoto() ?>' width='190px' height='200px'>
                            </div>
                        </div>   
                        <div class='col-sm-12 col-md-2 col-lg-5 mb-2 ml-2'>          
                            <p class="h5"><?php echo $obj2->getNombreProd(); ?></p> 
                            <p><b class="text-info">Categoria: </b><?php echo $obj2->getCategoria(); ?></p>
                            <p><b class="text-info">Subcategoria</b><?php echo $obj2->getSubCat(); ?></p>
                            <p><b class="text-info">Precio: </b><b class="text-success"><?php echo $obj2->getPrecio();?></b> pesos.</p> 
                            <p><b class="text-info">Descripción: </b><?php echo $obj2->getDescripcion();?></p>   
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3 text-center">
                            <label class="font-weight-bold text-info">Cantidad </label>  
                            <select class="form-control cantidad"  name="cantidad" id="cant">
                                <option value=1>1</option>
                                <option value=2>2</option>
                                <option value=3>3</option>
                                <option value=4>4</option>
                                <option value=5>5</option>
                                <option value=6>6</option>
                                <option value=7>7</option>
                                <option value=8>8</option>
                                <option value=9>9</option>
                            </select>      
                            <label class="mt-2 font-weight-bold text-info">Total</label>
                            <input type="text" class="form-control cantidad" value="<?php echo $obj2->getPrecio(); ?>">
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class='col-12'>
                            <div class="text-right mr-4">            
                                <a href='home.php?pagina=1' class='btn btn-secondary '>Cancelar</a>
                                <button name='btnConfirm' type='submit' class='btn btn-success' value='<?php echo $obj2->getIdProduc() ?>'>Confirmar</button>
                            </div>
                        </div>
                    </div>
                </div >
            </div>
           </form>
        <?php }else{
            echo "<script>window.location.replace('../cliente/home.php?action=fail&pagina=1')</script>";
        }
    }else{
        if(isset($_POST['idInfo'])){
            $idPedido = $_POST['idInfo'];
            $obj2=$obj->getProduct($obj2,$idPedido); ?>
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a href="../cliente/home.php?pagina=1" class="btn btn-light">Regresar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Más detalles</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body" >
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <img src="<?php echo  $obj2->getFoto() != "" ? '../'.$obj2->getFoto() : '../img/default_img.png' ; ?>" style="max-width:100%;" alt="">
                            </div>
                            <div class="col-sm-12 col-md-9 col-lg-9">
                                <p class="h3 font-weight-light"><?php echo $obj2->getNombreProd(); ?> </p>
                                <p><b class="text-info">Categoria: </b> <?php echo $obj2->getCategoria(); ?> </p>
                                <p><b class="text-info">Sub Categoria: </b> <?php echo $obj2->getSubCat();?> </p>
                                <p><b class="text-info">Precio: </b> <b class="text-success"><?php echo $obj2->getPrecio(); ?></b> pesos.</p>
                                <p><b class="text-info">Descripcion: </b> <?php echo $obj2->getDescripcion(); ?> </p>
                            </div>
                        </div>
                        <hr  style="border-top: .3rem solid rgb(224, 191, 3);">
                    </div>
                </div>
                </div> <?php
    
            //echo "<script>window.location.replace('../cliente/home.php?action=mostrar')</script>";
        }else{
            if(isset($_POST['idAgregar'])){
                //if(!isset($_SESSION['idCarrito'])){
                if($obj->getCarritoId($_SESSION['id'])==0){

                    $id=$_POST['idAgregar'];
                    $obj3 = new VentaOnline();
                    $obj2=$obj->getProduct($obj2,$id);
                    $obj3->setMetodoPago("Caja");
                    $obj3->setTipo("Online");
                    //$obj3->setTotal($obj2->getPrecio()*$_POST['cantidad']);
                    $obj3->setTotal($obj2->getPrecio());
                    $obj3->setFechaVenta(date("Y-m-d"));
                    $obj3->setId_Cliente($_SESSION['id']);
                    $existencia=$obj2->getExistencia();
        
                    if($obj->inserta("Venta",$obj3)==true){
                        //$existencia=$existencia-$_POST['cantidad'];
                        $existencia=$existencia-1;
                        if($obj->updateCantidadProducto($existencia,$id)==true){
                            $objTiene=new Tiene();
                            $idV=$obj->getLastIdVent();
                            $_SESSION['idCarrito']=$idV;
                            $objTiene->setId_Venta($idV);
                            $objTiene->setId_Producto($id);
                            $obj->inserta("Tiene",$objTiene);
                            $obj3->setId_VentaOnline($idV);
                            $obj3->setDirreccionEnvio("NULA");
                            $obj3->setFechaEntrega("2020-07-29");
                            $obj3->setEstatus("Carrito");
                            $obj->inserta("VentaOnline",$obj3);
                            echo "<script>window.location.replace('../cliente/home.php?action=agregado&pagina=1')</script>";
                            
                        }else{
                            echo "NO SE ACTUALIZO";
                        }
                    }
                }else{
                    $_SESSION['idCarrito']=$obj->getCarritoId($_SESSION['id']);
                    //echo "Saludos". $_SESSION['idCarrito'];
                    $idP=$_POST['idAgregar'];
                    $obj2=$obj->getProduct($obj2,$idP);
                    $existencia=$obj2->getExistencia();
                    if($obj->updateCantidadProducto($existencia,$idP)==true){
                        $objTiene=new Tiene();
                        $objTiene->setId_Venta($_SESSION['idCarrito']);
                        $objTiene->setId_Producto($idP);
                        $obj->inserta("Tiene",$objTiene);
                        echo "<script>window.location.replace('../cliente/home.php?action=agregado&pagina=1')</script>";
                    }
                    
                }
                //echo "<script>window.location.replace('../cliente/home.php?action=agregado')</script>";  
            }else{
                echo "<script>window.location.replace('../cliente/home.php?pagina=1')</script>";
            }
            
        }
    }
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}
?>