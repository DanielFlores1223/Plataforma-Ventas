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
  $_SESSION['PaginaTurno']=1;
?>
<div class="container-fluid">
    <form action="../controlador/productos.php" method="POST">
        <div class="row bg-light text-dark p-2">
            <div class="col-sm-12 col-md-2 col-lg-2 mt-2 text-center">
            <select class="form-control " name="filtro" id="idFilt">
                          <option value="Todos">---Todos---</option>
                          <option value="Alimentos">Alimentos</option>
                          <option value="Abarrotes">Abarrotes</option>
                          <option value="Servicios">Servicios</option>
                    </select>          
            </div>         
            <div class="col-sm-12 col-md-10 col-lg-10" >
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
                                 
                    </div>
        </div>           
    </form>
</div>
</div>

<!--mensajes -->
<?php if(isset($_GET['action'])){
    $numPagina=$_SESSION['PaginaTurno'];//ajuste not sure 
    if($_GET['action']=='pedido'){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">Pedido agregado <strong>Correctamente!</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../cliente/home.php?pagina=<?php echo $numPagina ?>');">
    <span aria-hidden="true">&times;</span></button></div>
    <?php }
    else if($_GET['action']=='agregado'){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">Agregado al <strong>Carrito Correctamente!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../cliente/home.php?pagina=<?php echo $numPagina ?>');">
        <span aria-hidden="true">&times;</span></button></div>
        <?php } 
        else if($_GET['action']=='fail'){ ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">No se pudo <strong>Registrar Pedido!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../cliente/home.php?pagina=<?php echo $numPagina ?>');">
            <span aria-hidden="true">&times;</span></button></div>
       <?php }
       }?>

<!--Barra de filtros -->
       <div class="row mx-1">
            <div class="col-sm-12 col-md-2 col-lg-12 mt-2">
                <form action="../controlador/productos.php" method="POST">
                <div class="card" style="border-bottom: .3rem solid rgb(224, 191, 3);">
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
                <div class="col-sm-12 col-md-12 col-lg-12">
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
                                     <button type='submit' class='btn btn-warning mb-2 form-control' name ='idAgregar' value='<?php echo $info->getIdProduc(); ?>'>
                                         <svg width="1.5em" height="2em" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
                                          <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0v-2z"/>
                                          <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                        </svg>
                                     </button>
                                     <button type='submit' class='btn btn-warning mb-2 form-control' name ='idComprar' value='<?php echo $info->getIdProduc(); ?>'>Comprar</button>
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
                       <?php if(isset($_GET['pagina'])){
                           ?>

                       <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled':''; ?>">
                           <a class="page-link" href="home.php?pagina=<?php echo $_GET['pagina'] - 1;$_SESSION['PaginaTurno']=$_SESSION['PaginaTurno']-1; ?>">Anterior</a>
                         </li>
                         <?php 
                             for ($i=0; $i < $paginas; $i++) {                      
                         ?>
                             <li class="page-item <?php echo $_GET['pagina'] == ($i+1) ? ' active' : '' ?>">
                               <a class="page-link" href="home.php?pagina=<?php echo ($i+1); ?>"><?php echo ($i+1);$_SESSION['PaginaTurno']=($i); ?></a>
                               </li>
                         <?php 
                             }//cierra for de la paginacion 
                         ?>
                         <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled':''; ?>">
                           <a class="page-link" href="home.php?pagina=<?php echo $_GET['pagina'] + 1;$_SESSION['PaginaTurno']=$_GET['pagina'] + 1; ?>">Siguiente</a>
                         </li>
                           <?php } ?>
                       </ul>
                 </nav>
            <!-- Termina Paginacion -->
            <?php 
                }else{
            ?>
            <div class="col-sm-12 col-md-12 col-lg-12">
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
                                <button type='submit' class='btn btn-warning mb-2 form-control' name ='idAgregar' value='<?php echo $info->getIdProduc(); ?>'>
                                    <svg width="1.5em" height="2em" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
                                        <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0v-2z"/>
                                        <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                    </svg>
                                </button>
                                <button type='submit' class='btn btn-warning mb-2 form-control' name ='idComprar' value='<?php echo $info->getIdProduc(); ?>'>Comprar</button>
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


