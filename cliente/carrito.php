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
                <label>Carrito</label>
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
        for($i=0;$i<$totalP;$i++){
            //$info=$obj->getPedidosUser($obj2,$i,$_SESSION['id'],"Carrito");
            $info=true;
            if($info==null){
                //quite codigo aqui
                 }else{
                $objTiene=$obj->getCarritoTiene($objTiene,$i,$obj->getCarritoId($_SESSION['id']));
                $infoP=$obj->getProduct($objp,$objTiene->getId_Producto());//$idp=$objTiene->getId_Producto();?>
                <form action='pedidoMasInfo.php' method='POST'>
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
                                            <div class="col">
                                                <table id="ProductTable" class="table-responsive">
                                                    <tr><td>Producto</td><td><?php echo $infoP->getNombreProd(); ?></td></tr>
                                                    <tr><td>Categoria</td><td><?php echo $infoP->getCategoria(); ?></td></tr>
                                                    <tr><td>Subcategoria</td><td><?php echo $infoP->getSubCat(); ?></td></tr>
                                                    <tr><td>Precio</td><td><?php echo $infoP->getPrecio(); ?></td></tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='text-center'><hr>
                                    <button type='submit' class='btn btn-warning' name ='back' value='back'>imprimir</button>
                                    <button type='submit' class='btn btn-primary' name ='masDetallesP' value='<?php $obj->getCarritoId($_SESSION['id']); ?>'>Mas detalles</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>                
            </form>
                
                <?php }}
       }
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}