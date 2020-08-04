<?php session_start();
include('barraCliente.php');
include('../modelo/conexion.php');
include('../modelo/clases.php');
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
  $obj= new ConexionMySQL("root",""); 
  $obj2 = new Producto();
  $cli= new Cliente();
  $cli=$obj->getClienteInfo($_SESSION['usuario'],$cli);
  $_SESSION['id']=$cli->getIdCli();
?>
<div class="container-fluid">
    <form action="../controlador/productos.php" method="POST">
        <div class="row bg-light text-dark p-2">
            <div class="col-sm-12 col-md-2 col-lg-3 mt-3 text-center">
                <a href="../cliente/home.php"><img src="../img/title.png" class="img-fluid" style="max-width:100%; height: 2.5rem" alt="Responsive image"></a>             
            </div>         
            <div class="col-sm-12 col-md-9 col-lg-9" >
                <div class="form-inline">
                    <?php 
                    if(isset($_POST['barraBusquedaProducto'])){
                        ?>
                        <input type="search" 
                        name="barraBusquedaProducto" 
                        class="form-control mt-2 ml-2 w-75" 
                        placeholder="Buscar Producto..."
                        value="<?php echo $_POST['barraBusquedaProducto'];?>"
                        aria-label="Search"
                        autofocus>                    
                        <?php 
                    }else{ ?> 
                        <input type="search" 
                        name="barraBusquedaProducto" 
                        class="form-control mt-2 ml-2 w-75" 
                        placeholder="Buscar Producto..."
                        value=""
                        aria-label="Search"
                        autofocus
                            >

                          <?php  
                          }
                          ?> 
                    <button type="submit" class="btn mt-2"><img src="../img/lupaNormal.png" alt="imagen lupa"></button>
                    <select class="form-control mt-2" name="filtro" id="idFilt">
                          <option value="Todos">---Todos---</option>
                          <option value="Alimentos">Alimentos</option>
                          <option value="Abarrotes">Abarrotes</option>
                          <option value="Servicios">Servicios</option>
                    </select>                  
                     
                                    
                    </div>
        </div>           
    </form>
</div>
</div>

<!--mensajes -->
<?php if(isset($_GET['action'])){
    if($_GET['action']=='pedido'){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">Pedido agregado <strong>Correctamente!</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../cliente/home.php?pagina=1');">
    <span aria-hidden="true">&times;</span></button></div>
    <?php }
    else if($_GET['action']=='agregado'){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">Agregado al <strong>Carrito Correctamente!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../cliente/home.php?pagina=1');">
        <span aria-hidden="true">&times;</span></button></div>
        <?php } 
        else if($_GET['action']=='fail'){ ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">No se pudo <strong>Registrar Pedido!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../cliente/home.php?pagina=1');">
            <span aria-hidden="true">&times;</span></button></div>
       <?php }
       }?>

<!--Barra de filtros -->
       <div class="row mx-1">
            <div class="col-sm-2 col-md-2 col-lg-2 mt-2">
                <form action="../controlador/productos.php" method="POST">
                <div class="card">
                    <div class='card-body text-center'>
                        <h4>Filtrar</h4>
                        <button class="btn btn-warning">Aplicar</button>
                    </div>
                </div>
                </form>
            </div>
       
            <?php
            if(isset($_GET['filtro'])){
                switch($_GET['filtro']){

                    case 'Todos':
                        $categoria='Todos';
                    break;
                    
                    case 'Alimentos':
                        $categoria='Alimentos';
                    break;

                    case 'Abarrotes':
                        $categoria='Abarrotes';
                    break;

                    case 'Servicios':
                        $categoria='Servicios';
                    break;
                }
            }else{
                $categoria='Todos'; 
            }
           ?>
        
           <?php 
           if(!isset($_GET['filtro'])){
                //paginacion
                $articulos_x_pag = 6;
                $paginas = 0;
                //Paginacion
                $total_rows = $obj->totalProductos($categoria);
                $paginas = $total_rows / $articulos_x_pag;
                $paginas = ceil($paginas); //redondea hacia arriba 1.2 -> 2             
                $iniciar = ($_GET['pagina'] - 1) * $articulos_x_pag;        
           ?>
                <div class="col-sm-10 col-md-10 col-lg-10">
                 <div class="row">
                <?php for($i=0;$i < $articulos_x_pag;$i++){
                         $info=$obj->getProductInfoPaginacion($obj2,$i,$categoria,$iniciar,$articulos_x_pag); ?>
                         <div class="col-sm-12 col-md-4 col-lg-4" align="center">
                         <form action='formConfirmProducto.php' method='POST'>               
                             <div class="card my-2" style="width: 20rem; max-width:100%;">
                                 <button type='submit' class="btn" name ='idInfo' value='<?php echo $info->getIdProduc(); ?>'>
                                  <img src="<?php echo  $info->getFoto() != "" ? '../'.$info->getFoto() : 'img/default_img.png' ; ?>" class="card-img-top" style='height: 18rem; '>
                                  </button>
                                <div class="card-body">
                                  <h5 class="card-title"><?php echo $info->getNombreProd(); ?></h5>
                                  <p class="card-text"><b>Precio:</b> <b class="text-success"><?=$info->getPrecio()?></b> pesos.</p>
                                  <div class=" text-center">
                                     <button type='submit' class='btn btn-info mb-2 form-control' name ='idInfo' value='<?php echo $info->getIdProduc(); ?>'>Más Información</button> 
                                     <button type='submit' class='btn btn-warning mb-2 form-control' name ='idComprar' value='<?php echo $info->getIdProduc(); ?>'>Comprar</button>
                                     <button type='submit' class='btn btn-warning mb-2 form-control' name ='idAgregar' value='<?php echo $info->getIdProduc(); ?>'>Agregar al carrito</button>
                                  </div>
                                </div>
                              </div>
                         </form>
                         </div>
                <?php } ?>  
                </div>
            </div>      
        </div>
                 <!-- Paginacion -->    
                <nav aria-label="Page navigation example">
                       <ul class="pagination justify-content-end mr-3" >
                       <?php if(isset($_GET['pagina'])){?>

                       <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled':''; ?>">
                           <a class="page-link" href="home.php?pagina=<?php echo $_GET['pagina'] - 1; ?>">Anterior</a>
                         </li>
                         <?php 
                             for ($i=0; $i < $paginas; $i++) {                      
                         ?>
                             <li class="page-item <?php echo $_GET['pagina'] == ($i+1) ? ' active' : '' ?>">
                               <a class="page-link" href="home.php?pagina=<?php echo ($i+1); ?>"><?php echo ($i+1); ?></a>
                               </li>
                         <?php 
                             }//cierra for de la paginacion 
                         ?>
                         <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled':''; ?>">
                           <a class="page-link" href="home.php?pagina=<?php echo $_GET['pagina'] + 1; ?>">Siguiente</a>
                         </li>
                           <?php } ?>
                       </ul>
                 </nav>
            <!-- Termina Paginacion -->
            <?php 
                }else{
            ?>
            <div class="col-sm-10 col-md-10 col-lg-10">
            <div class="row">
                    <?php for($i=0;$i<$obj->totalProductos($categoria);$i++){
                            $info=$obj->getProductInfo($obj2,$i,$categoria); ?>
                            <div class="col-sm-12 col-md-4 col-lg-4" align="center">
                    <form action='formConfirmProducto.php' method='POST'>               
                        <div class="card my-2" style="width: 20rem; max-width:100%;">
                            <button type='submit' class="btn" name ='idInfo' value='<?php echo $info->getIdProduc(); ?>'>
                             <img src="<?php echo  $info->getFoto() != "" ? '../'.$info->getFoto() : 'img/default_img.png' ; ?>" class="card-img-top" style='height: 18rem; '>
                             </button>
                           <div class="card-body">
                             <h5 class="card-title"><?php echo $info->getNombreProd(); ?></h5>
                             <p class="card-text"><b>Precio:</b> <b class="text-success"><?=$info->getPrecio()?></b> pesos.</p>
                             <div class=" text-center">
                                <button type='submit' class='btn btn-info mb-2 form-control' name ='idInfo' value='<?php echo $info->getIdProduc(); ?>'>Más Información</button> 
                                <button type='submit' class='btn btn-warning mb-2 form-control' name ='idComprar' value='<?php echo $info->getIdProduc(); ?>'>Comprar</button>
                                <button type='submit' class='btn btn-warning mb-2 form-control' name ='idAgregar' value='<?php echo $info->getIdProduc(); ?>'>Agregar al carrito</button>
                             </div>
                           </div>
                         </div>

                    </form>
                </div>
                <?php 
                    }
                ?>  
                </div>
                </div>      
            </div> 
            ?>
            <?php
            }             
            ?>
         
 <!-- Cierra el contenido de la pagina con la barra de navegacion-->    
 </div>
</div>
<?php 
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}//cierra validacion de un inicio de sesion previo
?>


