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
                            <button type="submit" class="btn btn-success">Buscar Peidos</button>
                        </div> 
            </div>
        </div>
    </div>
</form>
</div><hr>

<div class="container">
    <div class="col-sm-12 col-md-12 col-lg-12" id="tabla">
        <table class="mt-1 table table-striped">
            <tr>
                <td class="text-center"><b>Pedidos</b></td>
                <td class="text-center"><b>Pedidos en Curso</b></td>
                <td class="text-center"><b>Pedidos Cancelados</b></td>
            </tr>
        </table>
    </div>
    <?php 
    $obj= new ConexionMySQL("root",""); 
    $obj2= new VentaOnline();
    $totalP=$obj->getNumPedidos($_SESSION['id']);
    if($totalP!=0){
        for($i=0;$i<$totalP;$i++){
            $info=$obj->getPedidoInfo($obj2,$i,$_SESSION['id']); ?>
            <form action='pedidoCliente.php' method='POST'>
                <div class='container'>
                    <div class='row'>
                        <div class='col-xs-12 col-sm-12 col-lg-12 col-xl-12'>
                            <div class='card'>
                                <div class='card-body text-center'>
                                    <table id="ProductTable">
                                        <tr><td>ID Pedido</td><td><?php echo $info->getId_Venta(); ?></td></tr>
                                        <tr><td>Metodo de Pago</td><td><?php echo $info->getMetodoPago(); ?></td></tr>
                                        <tr><td>Total Venta</td><td><?php echo $info->getTotal(); ?></td></tr>
                                        <tr><td>Fecha Registro</td><td><?php echo $info->getFechaVenta(); ?></td></tr>
                                    </table>
                                    <div><hr>
                                    <button type='submit' class='btn btn-warning' name ='idAgregar' value='back'>imprimir</button>
                                    <button type='submit' class='btn btn-primary' name ='masDetallesP' value='<?php echo $info->getId_Venta(); ?>'>Mas detalles</button>
                                    <button type='submit' class='btn btn-danger' name ='cancelarP' value='<?php echo $info->getId_Venta(); ?>'>Cancelar</button>
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