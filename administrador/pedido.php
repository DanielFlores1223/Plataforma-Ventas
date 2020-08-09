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
             if(isset($_POST['estatus'])||isset($_GET['estatus'])){

                if(isset($_POST['estatus']))
                    $est=$_POST['estatus'];

                if(isset($_GET['estatus']))
                    $est=$_GET['estatus'];

               switch ($est) {
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
        $_SESSION['estatus']=$estatus;
    }else{
        
        if(isset($_GET['estatus'])){
            $estatus=$_GET['estatus'];
            $_SESSION['estatus']=$estatus;
        }else{
            $estatus="Pendiente";
            $_SESSION['estatus']=$estatus;
        }
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
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/pedido.php?estatus=<?php echo $_SESSION['estatus'];?>&pagina=1');">
                            <span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php }else if($_GET['action'] == 'Cancelado'){
                        ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            Se ha <strong>Cancelado!</strong> el Pedido
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/pedido.php?estatus=<?php echo $_SESSION['estatus'];?>&pagina=1');">
                            <span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
    }
    if($totalP!=0){
        $infoVenta= new VentaOnline();
        for($i=0;$i<$totalP;$i++){
            $info=$obj->getTodosPedidos($obj2,$i,$estatus);
            
            $infoVenta->setId_Venta($info->getId_Venta());
            $infoVenta=$obj->getPedidosALL($infoVenta,$i,$info->getEstatus());

            $articulos=$obj->getNumArticulos($info->getId_Venta());


            if($articulos==1){
                $objTiene=$obj->getPedidoTiene($objTiene,$info->getId_Venta());
                $infoP=$obj->getProduct($objp,$objTiene->getId_Producto());
                
                ?>
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
                                            <div class="col-sm-12 col-md-3 col-lg-5">
                                                    <p class="font-weight-light text-info h5">Información del producto</p> 
                                                    <hr>                                        
                                                    <p><b class="text-info">Producto: </b> <?php echo $infoP->getNombreProd(); ?></p> 
                                                    <p><b class="text-info">Categoria: </b> <?php echo $infoP->getCategoria(); ?></p>
                                                    <p><b class="text-info">Subcategoria: </b><?php echo $infoP->getSubCat(); ?></p>
                                                    <p><b class="text-info">Precio: </b><b class="text-success"><?php echo $infoP->getPrecio(); ?></b> pesos.</p>
                                                    <p><b class="text-info">Cantidad: </b><?php echo $infoVenta->getTotal()/$infoP->getPrecio(); ?></p>
                                                </div>
                                                <div class="col-sm-12 col-md-4 col-lg-4">
                                                    <p class="font-weight-light text-info h5">Información del pedido</p> 
                                                    <hr>
                                                    <p><b class="text-info">Fecha Pedido: </b><?php echo $infoVenta->getFechaVenta(); ?></p>
                                                    <p><b class="text-info">No° de Pedido: </b> <?php echo $info->getId_Venta(); ?></p>
                                                    <p><b class="text-info">Metodo de Pago: </b> <?php echo $infoVenta->getMetodoPago(); ?></p>
                                                    <p><b class="text-info">Total Venta: </b> <b class="text-success"><?php echo $infoVenta->getTotal(); ?></b>  pesos.</p>
                                                    <p><b class="text-info">Total Articulos:</b><b class="text-success"><?php echo $articulos; ?></b></p>
                                                    <?php
                                                    if($info->getEstatus()=='Completo'){
                                                        ?>
                                                        <label class="bg-success p-2">Estatus: <?php echo $info->getEstatus();?></label> 
                                                        <?php }else if($info->getEstatus()=='Cancelado') { ?>
                                                            <label class="bg-warning p-2">Estatus: <?php echo $info->getEstatus();?></label>
                                                            <?php } else{
                                                                ?>
                                                                <label class="bg-warning p-2">Estatus</label>
                                                                <select name="estatusP" class="cantidad">
                                                                <option value="Completo">Pendiente</option>
                                                                <option value="Completo">Completo</option>
                                                                <option value="Cancelado">Cancelado</option>
                                                                    </select>
                                                                    <?php 
                                                                } ?>
                                                </div>
                                        </div>
                                    </div>
                                    <div class='text-center'><hr>
                                    <!--poner icono para imprimir -->
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
            <?php
            }else{
                ?>
                <form action='../controlador/pedidoControlador.php' method='POST'>
                    <div class='container'>
                        <div class='row'>
                            <div class='col-sm-12 col-md-12 col-lg-12'>
                                <div class='card'>
                                    <div class='card-body'>
                                        <div class="container">
                                            <div class="row">
                                                <?php
                                                for($j=0;$j<$articulos;$j++){
                                                    $objTiene=$obj->getCarritoTiene($objTiene,$j,$info->getId_Venta());
                                                    $infoP=$obj->getProduct($objp,$objTiene->getId_Producto());
                                                    ?>
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
                                                 <p><b class="text-info">Cantidad: </b><?php echo $infoVenta->getTotal()/$infoP->getPrecio(); ?></p>
                                            </div>

                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                            <?php if($j==0){ ?>
                                                <p class="font-weight-light text-info h5">Información del pedido</p> 
                                                <hr>
                                                <p><b class="text-info">Fecha Pedido: </b><?php echo $infoVenta->getFechaVenta(); ?></p>
                                                <p><b class="text-info">No° de Pedido: </b> <?php echo $info->getId_Venta(); ?></p>
                                                <p><b class="text-info">Metodo de Pago: </b> <?php echo $infoVenta->getMetodoPago(); ?></p>
                                                <p><b class="text-info">Total Venta: </b> <b class="text-success"><?php echo $infoVenta->getTotal(); ?></b>  pesos.</p>
                                                <p><b class="text-info">Total Articulos:</b><b class="text-success"><?php echo $articulos; ?></b></p>
                                                <?php
                                                if($info->getEstatus()=='Completo'){
                                                    ?>
                                                    <label class="bg-success p-2">Estatus: <?php echo $info->getEstatus();?></label> 
                                                    <?php }else if($info->getEstatus()=='Cancelado') { ?>
                                                        <label class="bg-warning p-2">Estatus: <?php echo $info->getEstatus();?></label>
                                                        <?php } else{?>
                                                            <label class="bg-warning p-2">Estatus</label>
                                                                <select name="estatusP" class="cantidad">
                                                                <option value="Completo">Pendiente</option>
                                                                <option value="Completo">Completo</option>
                                                                <option value="Cancelado">Cancelado</option>
                                                            </select>
                                                            <?php }
                                                        }?>
                                            </div>
                                                 <?php } ?>
                                            </div>
                                        </div>
                                        <div class='text-center'><hr>
                                        <!--poner icono para imprimir -->
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
                <?php
                }
                echo "<br>";
        }//for
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