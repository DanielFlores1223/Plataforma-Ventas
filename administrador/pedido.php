<?php 
include("../controlador/empleadoController.php");
include("barraAdmin.php");

if(isset($_SESSION['usuario']) && isset($_SESSION['contra'])){
    ?>
<div class="container">
<form action="pedido.php?pagina=1" method="post">
    <div class="row bg-light text-dark p-2">
        <div class="col-sm-4 col-md-4 col-lg-4 ">
            <label>Pedidos</label>             
        </div>
        <div class="col-sm-8 col-md-8 col-lg-8 text-center">
          <?php 
             if(isset($_POST['estatus'])){
               switch ($_POST['estatus']) {
                 case 'Pendiente':
          ?>
                  <input type="radio" 
          name="estatus" 
          value="Pendiente"
          checked
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label >Pendiente</label>

          <input type="radio" 
          name="estatus" 
          value="Completo" 
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label>Completo</label>
          
          <input type="radio" 
          name="estatus" 
          value="Cancelado"
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label>Cancelado</label>

          <input type="radio" 
          name="estatus" 
          value="Todos"
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label>Todos</label>
          </div>
          <?php         
                   break;
                 case 'Completo':
          ?>
                  <input type="radio" 
          name="estatus" 
          value="Pendiente"
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label >Pendiente</label>

          <input type="radio" 
          name="estatus" 
          value="Completo" 
          checked
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label>Completo</label>
          
          <input type="radio" 
          name="estatus" 
          value="Cancelado"
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label>Cancelado</label>

          <input type="radio" 
          name="estatus" 
          value="Todos"
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label>Todos</label>
          </div>
          <?php         
                   break;
                 case 'Cancelado':
          ?>
                  <input type="radio" 
          name="estatus" 
          value="Pendiente"
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label >Pendiente</label>

          <input type="radio" 
          name="estatus" 
          value="Completo" 
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label>Completo</label>
          
          <input type="radio" 
          name="estatus" 
          value="Cancelado"
          checked
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label>Cancelado</label>

          <input type="radio" 
          name="estatus" 
          value="Todos"
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label>Todos</label>
          </div>
          <?php
                    break;
                  case 'Todos':                   
          ?>    
                       <input type="radio" 
          name="estatus" 
          value="Pendiente"
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label >Pendiente</label>

          <input type="radio" 
          name="estatus" 
          value="Completo" 
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label>Completo</label>
          
          <input type="radio" 
          name="estatus" 
          value="Cancelado"
          
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label>Cancelado</label>

          <input type="radio" 
          name="estatus" 
          value="Todos"
          checked
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label>Todos</label>
          </div>
          <?php
                 break;
                }//cierra switch
             }else{
          ?>
          <input type="radio" 
          name="estatus" 
          value="Pendiente"
          checked
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label >Pendiente</label>

          <input type="radio" 
          name="estatus" 
          value="Completo" 
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label>Completo</label>
          
          <input type="radio" 
          name="estatus" 
          value="Cancelado"
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label>Cancelado</label>

          <input type="radio" 
          name="estatus" 
          value="Todos"
          class="mr-0 ml-2"
          onclick="submit()"
          >
          <label>Todos</label>
          </div>
          <?php 
             }//cierra else
          ?>
        
    </div>  
</form>
</div><hr>
    <?php 
    if(isset($_POST['estatus'])){
        $estatus=$_POST['estatus'];
    }else{
        $estatus="Pendiente";
    }
    $obj= new ConexionMySQL("root",""); 
    $obj2= new VentaOnline();
    $objTiene= new Tiene();
    $objp= new Producto();
    $totalP=$obj->getNumPedidos($estatus);
    //comienzan alertas correctas
    if(isset($_GET['action'])){ 
        ?>
        <div class='container'>
            <div class='row'>
                <div class='col-xs-12 col-sm-12 col-lg-12 col-xl-12'>
                    <?php
                    if($_GET['action'] == 'Completo'){ 
                        ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Se Completo el pedido con<strong>Exito!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/pedido.php?pagina=1');">
                            <span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php }else if($_GET['action'] == 'Cancelado'){
                        ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            Se ha <strong>Cancelado!</strong> el Pedido
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/pedido.php?pagina=1');">
                            <span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
    }
    if($totalP!=0){
        for($i=0;$i<$totalP;$i++){
            $info=$obj->getTodosPedidos($obj2,$i,$estatus);
            if($info==null){
                //quite codigo aqui
                 }else{
                $objTiene=$obj->getPedidoTiene($objTiene,$info->getId_Venta());
                $infoP=$obj->getProduct($objp,$objTiene->getId_Producto());//$idp=$objTiene->getId_Producto();?>

                <form action='../controlador/pedidoControlador.php' method='POST'>
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
                                                    <tr><td>Total Venta</td><td><?php echo $info->getTotal(); ?></td></tr><?php
                                                    if($info->getEstatus()=='Completo'){?>
                                                    <tr class="table-success" ><td>Estatus</td><td><?php echo $info->getEstatus();?></td></tr>
                                                    <?php }else if($info->getEstatus()=='Cancelado') { ?>
                                                      <tr class="table-warning" ><td>Estatus</td><td><?php echo $info->getEstatus();?></td></tr>
                                                      </select></td></tr>

                                                    <?php } else{?>
                                                      <tr class="table-warning" ><td>Estatus</td><td><select name="estatusP" class="form-control">
                                                      <option value="Completo">Pendiente</option>
                                                      <option value="Completo">Completo</option>
                                                      <option value="Cancelado">Cancelado</option>
                                                    <?php }
                                                ?></table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='text-center'><hr>
                                    <button type='submit' class="btn btn-warning btn-sm " name ='actualizar' value='<?php echo $info->getId_Venta(); ?>'>Actualizar</button>
                                    <button type='submit' class="btn btn-info btn-sm" name ='masDetallesP' value='<?php echo $info->getId_Venta(); ?>'>Más detalles</button>
                                    <button type='button' class="btn btn-danger btn-sm" name ='cancelarP' value='<?php echo $info->getId_Venta(); ?>'>Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>                
            </form>
                
                <?php }}
       }else{?>
           <div class="container" ></div>
           <div class="row">
               <div class='col-xs-12 col-sm-12 col-lg-12 col-xl-12'>
                   <div class='card'>
                       <div class='card-body text-center'>
                           <p>No hay Registros para Mostrar</p>
       <?php }
    ?>
</div>
    <?php
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}