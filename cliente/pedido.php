<?php session_start();
include('barraCliente.php');
include('../modelo/conexion.php');
include('../modelo/clases.php');
if(isset($_SESSION['usuario']) && isset($_SESSION['contra'])){
    ?>
<div class="container">
<form action="" method="post">
    <div class="row bg-light py-3">
        <div class="col-3">
            <p class="text-center">Mis Pedidos</p>
        </div>
        <div class="col-9">
            <div class="form-inline">
                <?php if(isset($_POST['barraBusquedaPedido'])){
                    ?>
                    <input type="search" 
                    name="barraBusquedaPedido" 
                    class="form-control mt-2  w-75" 
                    placeholder="Buscar Pedido..."
                    value="<?php echo $_POST['barraBusquedaPedido'];?>"
                    aria-label="Search"
                    autofocus>
                    <?php }else{ ?>
                        <input type="search" 
                        name="barraBusquedaPedido" 
                        class="form-control mt-2 w-75" 
                        placeholder="Buscar Pedido..."
                        value=""
                        aria-label="Search"
                        autofocus>
                        <?php  }?>
                        <div class="mt-1 ml-3">
                            <button type="submit" class="btn btn-success">Buscar Pedidos</button>
                        </div> 
            </div>
        </div>
    </div>
</form>
</div><hr>

<div class="container">
    <div class="col-sm-12 col-md-12 col-lg-12" id="tabla">
        <form action="pedido.php" method="POST">
            <table class="mt-1 table table-striped">
                <tr>
                    <td class="text-center"><button class='btn btn-primary btn-sm' name='btnFiltro' value='TODOS'>Pedidos</button></td>
                    <td class="text-center"><button class='btn btn-primary btn-sm' name='btnFiltro' value='PROCESO'>Pedidos en Proceso</button><td>
                    <td class="text-center"><button class='btn btn-primary btn-sm' name="btnFiltro" value='CANCELADO'>Pedidos Cancelados</button></td>
                </tr>
            </table>
        </form>
    </div>
    <?php 
    if(isset($_POST['btnFiltro'])){
        $estatus=$_POST['btnFiltro'];
    }else{
        $estatus="TODOS";
    }
    $obj= new ConexionMySQL("root",""); 
    $obj2= new VentaOnline();
    $objTiene= new Tiene();
    $objp= new Producto();
    $totalP=$obj->getNumPedidos($_SESSION['id']);
    if($totalP!=0){
        for($i=0;$i<$totalP;$i++){
            $info=$obj->getPedidosUser($obj2,$i,$_SESSION['id'],$estatus);
            $objTiene=$obj->getPedidoTiene($objTiene,$info->getId_Venta());
            $infoP=$obj->getProduct($objp,$objTiene->getId_Producto());
            //$idp=$objTiene->getId_Producto();
            ?>
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
                                                    <img src='<?php echo '../'.$infoP->getFoto(); ?>'  width='190px' height='200px'>
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
                                                    <tr><td>Total Venta</td><td><?php echo $info->getTotal(); ?></td></tr>
                                                    <tr class="table-warning" ><td>Estatus</td><td><?php echo $info->getEstatus(); ?></td></tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='text-center'><hr>
                                    <button type='submit' class='btn btn-warning' name ='back' value='back'>imprimir</button>
                                    <button type='submit' class='btn btn-primary' name ='masDetallesP' value='<?php echo $info->getId_Venta(); ?>'>Mas detalles</button>
                                    <button type='button' class='btn btn-danger' name ='cancelarP' value='<?php echo $info->getId_Venta(); ?>'>Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>                
            </form>
        <?php }
       }else{?>
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
    ?>
</div>
    <?php
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}