<?php session_start();
include('barraCliente.php');
include('../modelo/conexion.php');
include('../modelo/clases.php');

if(isset($_SESSION['usuario']) && isset($_SESSION['contra'])){
    $obj = new ConexionMySQL("root","");
    $obj2 = new Producto();
    $objTiene = new Tiene();

    if(isset($_POST['btnPagar'])){
        $id=$_POST['btnPagar'];
        $totalNCarito=$obj->getNumCarrito($_SESSION['idCarrito']);
        //$precioarray[$totalNCarito];

        if($obj2!=null){ ?>
    <link rel="stylesheet" href="../estilos/general.css">
    <script>
        function sumaTotal(){
            var precio=document.getElementById('price').innerHTML;
            var cantidad=document.getElementById('cant').value;
            var total=(precio*cantidad);
            //document.getElementById('totalP').value =total;
            document.getElementById('totalP').innerHTML =total;
        }
    </script>
            <form action="../controlador/carrito.php" method="POST"><hr>    
            <div class="container">
            <div class="card bg-light">
                    <div class="container">
                        <h3 class="my-3 font-weight-light">Confirmar Pedido</h3>
                    </div><hr>
                    <?php
                    
                     for($i=0;$i<$totalNCarito;$i++){
                        $objTiene=$obj->getCarritoTiene($objTiene,$i,$obj->getCarritoId($_SESSION['id']));
                        $infoP=$obj->getProduct($obj2,$objTiene->getId_Producto());
                        $_SESSION['precios'][$i]=$infoP->getPrecio(); ?>
                    <div class="row mt-4">
                        <div class="col-sm-12 col-md-3 col-lg-3 text-center mb-3">
                            <div class="ml-4">
                            <img src='<?php echo '../'.$infoP->getFoto() ?>' width='190px' height='200px'>
                            </div>
                        </div>   
                        <div class='col-sm-12 col-md-2 col-lg-5 mb-2 ml-2'>          
                            <p class="h5"><?php echo $obj2->getNombreProd(); ?></p> 
                            <p><b class="text-info">Categoria: </b><?php echo $infoP->getCategoria(); ?></p>
                            <p><b class="text-info">Subcategoria</b><?php echo $infoP->getSubCat(); ?></p>
                            <p><b class="text-info">Precio: </b><b id="price" class="text-success"><?php echo $infoP->getPrecio();?></b> pesos.</p> 
                            <p><b class="text-info">Descripción: </b><?php echo $infoP->getDescripcion();?></p>   
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3 text-center">
                            <!--<label class="mt-2 font-weight-bold text-info">Total</label>-->
                            <p><b class="text-info">Total: </b><h3><b id="totalP"><?php echo $obj2->getPrecio(); ?></b></h3>pesos.</p>  
                            <!--<input type="text" id="totalP" class="form-control cantidad" value="<?php //echo $obj2->getPrecio(); ?>">-->
                            <label class="font-weight-bold text-info">Cantidad </label>  
                            <select class="form-control cantidad"  name="cantidad" id="cant" onchange="sumaTotal()">
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
                        </div>
                    </div><hr>
                    <?php } ?>
                    <!--Mostrando el total de los productos -->
                    <div class="container">
                        <div class="row" >
                            <div class="col-md-12">
                                <div class='container'>
                                <div class='d-flex justify-content-end' >
                                    <h3><label class="card-text">Total a Pagar:</label>
                                    <b class="text-success"><?php echo $obj->carritoTotal($obj->getCarritoId($_SESSION['id'])); ?></b></h3>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- mostrando los metods de pago -->
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="online-tab" data-toggle="tab" href="#online" role="tab" aria-controls="online" aria-selected="true"> Pagar en Linea</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="sucursal-tab" data-toggle="tab" href="#sucursal" role="tab" aria-controls="sucursal" aria-selected="false"> Pagar en Sucursal</a>
                                        </li>
                                    </ul>
                                    
                                    <div class="tab-content" id="contenido">
                                        <div class="tab-pane fade show active" id="online" role="tabpanel" aria-labelledby="online-tab">
                                            <div class="row mt-5">
                                                <div class='col-sm-12 col-md-2 col-lg-5 mb-2 ml-2'>
                                                    <div id="paypal-button-container">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-12'>
                                                <div class="text-right mr-11 my-4">            
                                                    <a href='carrito.php' class='btn btn-secondary '>Cancelar</a>
                                                    <button name='btnConfirm' type='submit' class='btn btn-success' value='<?php echo $obj2->getIdProduc() ?>'>Confirmar</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="sucursal" role="tabpanel" aria-labelledby="sucursal-tab">
                                            <div class="row mt-5">
                                                
                                                <div class='container'>
                                                    <div class="row">
                                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                                        <img src="../img/clerk.png" style='height: 15rem; max-width: 100%'>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                                        <iframe style='height: 15rem; max-width: 100%' src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3734.0977620534063!2d-103.36407218559918!3d20.624871606820356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428ad86dec01a3b%3A0x36f000abe4e24dc2!2sCremeria%20y%20Abarrotes%20%22Liz%22!5e0!3m2!1ses!2smx!4v1596668749918!5m2!1ses!2smx"  height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                                    </div>
                                                    </div>
                                                </div>
                                            
                                            <div class='col-12'>
                                                <div class="text-right mr-11 my-4">            
                                                    <a href='carrito.php' class='btn btn-secondary '>Cancelar</a>
                                                    <button name='btnConfirm' type='submit' class='btn btn-success' value='<?php echo $obj2->getIdProduc() ?>'>Confirmar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
<script>
      paypal.Buttons({
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '0.01'
              }
            }]
          });
        },
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
            alert('Transaction completed by ' + details.payer.name.given_name);
          });
        }
      }).render('#paypal-button-container'); // Display payment options on your web page
    </script>