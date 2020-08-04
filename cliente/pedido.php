<?php session_start();
include('barraCliente.php');
include('../modelo/conexion.php');
include('../modelo/clases.php');
if(isset($_SESSION['usuario']) && isset($_SESSION['contra'])){
    ?>
<link rel="stylesheet" href="../estilos/general.css">
<div class="container">
<form action="pedido.php" method="post">
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
    $totalP=$obj->getNumPedidosCliente($_SESSION['id'],$estatus);
    if($totalP!=0){
        for($i=0;$i<$totalP;$i++){
            $info=$obj->getPedidosUser($obj2,$i,$_SESSION['id'],$estatus);
            if($info==null){
                //quite codigo aqui
                 }else{
                $objTiene=$obj->getPedidoTiene($objTiene,$info->getId_Venta());
                $infoP=$obj->getProduct($objp,$objTiene->getId_Producto());//$idp=$objTiene->getId_Producto();?>
                <form action='pedidoMasInfo.php' method='POST'>
                <div class='container'>
                    <div class='row'>
                        <div class='col-sm-12 col-md-12 col-lg-12'>
                            <div class='card'>
                                <div class='card-body'>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-3 col-lg-3">
                                                <div>
                                                    <img src='<?php echo "../".$infoP->getFoto(); ?>'  width='190px' height='200px'>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3 col-lg-5">
                                                 <p class="font-weight-light text-info h5">Información del producto</p> 
                                                 <hr>                                        
                                                 <p><b class="text-info">Producto: </b> <?php echo $infoP->getNombreProd(); ?></p> 
                                                 <p><b class="text-info">Categoria: </b> <?php echo $infoP->getCategoria(); ?></p>
                                                 <p><b class="text-info">Subcategoria: </b><?php echo $infoP->getSubCat(); ?></p>
                                                 <p><b class="text-info">Precio: </b><b class="text-success"><?php echo $infoP->getPrecio(); ?></b> pesos.</p>
                                                 <p><b class="text-info">Cantidad: </b><?php echo $info->getTotal()/$infoP->getPrecio(); ?></p>
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                            <p class="font-weight-light text-info h5">Información del pedido</p> 
                                            <hr>
                                                <p><b class="text-info">Fecha Pedido: </b><?php echo $info->getFechaVenta(); ?></p>
                                                <p><b class="text-info">No° de Pedido: </b> <?php echo $info->getId_Venta(); ?></p>
                                                <p><b class="text-info">Metodo de Pago: </b> <?php echo $info->getMetodoPago(); ?></p>
                                                <p><b class="text-info">Total Venta: </b> <b class="text-success"><?php echo $info->getTotal(); ?></b>  pesos.</p>
                                                <?php
                                                     if($info->getEstatus()=='Completo'){
                                                 ?>
                                                        <label class="bg-success p-2">Estatus<?php echo $info->getEstatus();?></label> 
                                                 
                                                 <?php }else if($info->getEstatus()=='Cancelado') { ?>
                                                           <label class="bg-warning p-2">Estatus<?php echo $info->getEstatus();?></label>
                                    
                                                 <?php } else{?>
                                                            <label class="bg-warning p-2">Estatus</label>
                                                            <select name="estatusP" class="cantidad">
                                                                <option value="Completo">Pendiente</option>
                                                                <option value="Cancelado">Cancelar</option>
                                                            </select>
                                                 <?php }
                                                ?>
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