<?php
session_start();
include('barraCliente.php');
include('../modelo/conexion.php');
include('../modelo/clases.php');

if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    ?>
    <div class='container'>
        <div class="row bg-light text-dark p-2"> 
            <div class="col-sm-9 col-md-9 col-lg-9 ">
                <h4>Carrito</h4>
            </div>
        </div><hr>
    </div>
    <?php
    $obj= new ConexionMySQL("root",""); 
    $obj2= new VentaOnline();
    $objTiene= new Tiene();
    $objp= new Producto();
    $totalP=$obj->getNumCarrito($obj->getCarritoId($_SESSION['id']));
    if($totalP!=0){

        //mensajes 
        if(isset($_GET['action'])){
            if($_GET['action']=='removido'){ ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">Producto removido <strong>Correctamente!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../cliente/carrito.php');">
            <span aria-hidden="true">&times;</span></button></div>
            <?php }
            else if($_GET['action']=='agregado'){ ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">Agregado al <strong>Carrito Correctamente!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../cliente/carrito.php');">
                <span aria-hidden="true">&times;</span></button></div>
                <?php } 
                else if($_GET['action']=='fail'){ ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">No se pudo <strong>Registrar Pedido!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../cliente/carrito.php');">
                    <span aria-hidden="true">&times;</span></button></div>
               <?php }
        }      
        //tweminan los mensajes
        for($i=0;$i<$totalP;$i++){

            $info=true;
            if($info==null){
                //quite codigo aqui
                 }else{
                $objTiene=$obj->getCarritoTiene($objTiene,$i,$obj->getCarritoId($_SESSION['id']));
                $infoP=$obj->getProduct($objp,$objTiene->getId_Producto());//$idp=$objTiene->getId_Producto();?>
                <script>
                    function suma(cant){
                        var precio=document.getElementById('price').innerHTML;
                        var cantidad=document.getElementById('cant').value;
                        var total=(precio*cantidad);
                        document.getElementById('totalP').innerHTML =total;
                    }
                </script>
                <form action='../controlador/carrito.php' method='POST'>
                <div class='container'>
                    <div class='row'>
                        <div class='col-xs-12 col-sm-12 col-lg-12 col-xl-12'>
                            <div class='card'>
                                <div class='card-body'>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col">
                                                <div>
                                                    <img src='<?php echo "../".$infoP->getFoto(); ?>'  width='190px' height='200px'>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <table id="ProductTable" class="table-responsive">       
                                                    <p class="h5"><?php echo $infoP->getNombreProd(); ?></p> 
                                                    <!--<tr><td>Id Producto</td><td><?php //echo $infoP->getIdProduc(); ?></td></tr>
                                                    <tr><td>Producto</td><td><?php //echo $infoP->getNombreProd(); ?></td></tr> -->
                                                    <tr><td><label class='font-weight-bold text-info'>Categoria</label></td><td><label><?php echo $infoP->getCategoria(); ?></label></td></tr>
                                                    <tr><td><label class='font-weight-bold text-info' >Subcategoria</label></td><td><label><?php echo $infoP->getSubCat(); ?></label></td></tr>
                                                    <tr><td><label class='font-weight-bold text-info' >Precio</label></td><td><label id="price"><?php echo $infoP->getPrecio(); ?></label></td></tr>
                                                    <tr><td><label class="font-weight-bold text-info">Cantidad </label></td><td><div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                                        <select class="form-control cantidad"  name="cantidad" id="cant" onchange="suma()">
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
                                                    </div></td></tr>
                                                </table>
                                                
                                            </div>
                                            <div class="col" >
                                                <h4><p class="card-text"><b>Total:</b> <b class="text-success" id="totalP"><?=$infoP->getPrecio()?></b></p></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='text-center'><hr>
                                    <button type='submit' class='btn btn-warning' name ='removerP' value='<?php echo $infoP->getIdProduc(); ?>'>Remover</button>
                                    <button type='submit' class='btn btn-primary' name ='masDetallesP' value='<?php echo $infoP->getIdProduc(); ?>'>Mas detalles</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>                
            </form>
                
                <?php }}
       }
    else{
        ?>
            <div class="container" ></div>
            <div class="row">
                <div class='col-xs-12 col-sm-12 col-lg-12 col-xl-12'>
                    <div class='card'>
                        <div class='card-body text-center'>
                            <p>No hay Registros para Mostrar</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}