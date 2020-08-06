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
    <script>
        function sumaTotal(){
            var precio=document.getElementById('price').innerHTML;
            var cantidad=document.getElementById('cant').value;
            var total=(precio*cantidad);
            document.getElementById('totalP').value =total;
            //console.log(precio);
        }
    </script>
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
                            <p><b class="text-info">Precio: </b><b id="price" class="text-success"><?php echo $obj2->getPrecio();?></b> pesos.</p> 
                            <p><b class="text-info">Descripción: </b><?php echo $obj2->getDescripcion();?></p>   
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3 text-center">
                            <label class="font-weight-bold text-info">Cantidad </label>  
                            <select class="form-control cantidad"  name="cantidad" id="cant" onclick="sumaTotal()">
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
                            <input type="text" id="totalP" class="form-control cantidad" value="<?php echo $obj2->getPrecio(); ?>">
                        </div>
                    </div><hr>
                    <div class="container">
                        <div class="card bg-light">
                            <div class="container">
                                <h3 class="my-3 font-weight-light">Metodo de Pago</h3>
                            </div><hr>
                            <div class="row mt-4">
                                <div class='col-sm-12 col-md-2 col-lg-5 mb-2 ml-2'>
                                <form action="/procesar_pago.php" method="post" id="pay" name="pay" > 
                                    <fieldset>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <p>
                                                    <label class="font-weight-bold text-info" for="description">Descripción</label>                        
                                                    <input  class="form-control cantidad" type="text" name="description" id="description" value="Ítem seleccionado"/>
                                                </p>  
                                            </div>
                                            <div class="form-group col-md-6">
                                                <p>
                                                    <label class="font-weight-bold text-info" for="transaction_amount">Monto a pagar</label>                        
                                                    <input class="form-control cantidad" name="transaction_amount" id="transaction_amount" value="100"/>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6" >
                                            <p>
                                                <label class="font-weight-bold text-info" for="cardNumber">Número de la tarjeta</label>
                                                <input class="form-control cantidad" type="text" id="cardNumber" data-checkout="cardNumber" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off />
                                            </p>
                                            </div>
                                            <div class="form-group col-md-6" >
                                            <p>
                                                <label class="font-weight-bold text-info" for="cardholderName">Nombre y apellido</label>
                                                <input class="form-control cantidad" type="text" id="cardholderName" data-checkout="cardholderName" />
                                            </p>       
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <p>
                                                    <label class="font-weight-bold text-info" for="cardExpirationMonth">Mes de vencimiento</label>
                                                    <input class="form-control cantidad"  type="text" id="cardExpirationMonth" data-checkout="cardExpirationMonth" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off />
                                                </p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <p>
                                                    <label class="font-weight-bold text-info" for="cardExpirationYear">Año de vencimiento</label>
                                                    <input class="form-control cantidad" type="text" id="cardExpirationYear" data-checkout="cardExpirationYear" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off />
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <p>
                                                    <label class="font-weight-bold text-info" for="securityCode">Código de seguridad</label>
                                                    <input class="form-control cantidad" type="text" id="securityCode" data-checkout="securityCode" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off />
                                                </p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <p>
                                                    <label class="font-weight-bold text-info" for="installments">Cuotas</label>
                                                    <select class="form-control cantidad" id="installments" class="form-control" name="installments"></select>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <p>
                                                    <label class="font-weight-bold text-info" for="docType">Tipo de documento</label>
                                                    <select class="form-control cantidad" id="docType" data-checkout="docType"></select>
                                                </p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <p>
                                                    <label class="font-weight-bold text-info"  for="docNumber">Número de documento</label>
                                                    <input class="form-control cantidad" type="text" id="docNumber" data-checkout="docNumber"/>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <p>
                                                    <label class="font-weight-bold text-info" for="email">Email</label>
                                                    <input class="form-control cantidad" type="email" id="email" name="email" value="test@test.com"/>
                                                </p>  
                                            </div>
                                        </div>
                                        <input type="hidden" name="payment_method_id" id="payment_method_id"/>
                                        <input class='btn btn-primary' type="submit" value="Pagar"/>
                                    </fieldset>
                                </form>

                                </div>
                            </div>
                        </div>
                    </div><hr>
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