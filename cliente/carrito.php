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
    $totalP=$obj->getNumPedidosCliente($_SESSION['id'],"Carrito");
    if($totalP!=0){
        for($i=0;$i<$totalP;$i++){
            $info=$obj->getPedidosUser($obj2,$i,$_SESSION['id'],"Carrito");
            if($info==null){
                //quite codigo aqui
                 }else{
                $objTiene=$obj->getPedidoTiene($objTiene,$info->getId_Venta());
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
                                                    <tr><td>Cantidad</td><td><?php echo $info->getTotal()/$infoP->getPrecio(); ?></td></tr>
                                                </table>
                                            </div>
                                            <div class="col">
                                                <table id="ProductTable"class="table-responsive">
                                                    <tr><td>Fecha Peido</td><td><?php echo $info->getFechaVenta(); ?></td></tr>
                                                    <tr><td>No° de Pedido</td><td><?php echo $info->getId_Venta(); ?></td></tr>
                                                    <tr><td>Metodo de Pago</td><td><?php echo $info->getMetodoPago(); ?></td></tr>
                                                    <tr><td>Total Venta</td><td><?php echo $info->getTotal(); ?></td></tr><?php
                                                    if($info->getEstatus()=='Completo'){?>
                                                    <tr class="table-success" ><td>Estatus</td><td><?php echo $info->getEstatus();?></td></tr>
                                                    <?php }else if($info->getEstatus()=='Cancelado') { ?>
                                                      <tr class="table-warning" ><td>Estatus</td><td><?php echo $info->getEstatus();?></td></tr>
                                                      </select></td></tr>

                                                    <?php } else{?>
                                                      <tr class="table-info" ><td>Cantidad</td><td><select name="cantidadP" class="form-control">
                                                      <option value=1>1</option>
                                                      <option value=2>2</option>
                                                      <option value=3>3</option>
                                                      <option value=4>4</option>
                                                      <option value=5>5</option>
                                                      <option value=6>6</option>
                                                      <option value=7>7</option>
                                                      <option value=8>8</option>
                                                      <option value=9>9</option>
                                                    <?php }
                                                ?></table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='text-center'><hr>
                                    <button type='submit' class='btn btn-warning' name ='back' value='back'>imprimir</button>
                                    <button type='submit' class='btn btn-primary' name ='masDetallesP' value='<?php echo $info->getId_Venta(); ?>'>Mas detalles</button>
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