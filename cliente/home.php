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
<!--mensajes -->
<?php if(isset($_GET['action'])){
    if($_GET['action']=='pedido'){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">Pedido agregado <strong>Correctamente!</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../cliente/home.php');">
    <span aria-hidden="true">&times;</span></button></div>
    <?php }
    else if($_GET['action']=='agregado'){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">Agregado al <strong>Carrito Correctamente!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../cliente/home.php');">
        <span aria-hidden="true">&times;</span></button></div>
        <?php } 
        else if($_GET['action']=='fail'){ ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">No se pudo <strong>Registrar Pedido!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../cliente/home.php');">
            <span aria-hidden="true">&times;</span></button></div>
       <?php }
       }?>
<!--Barra de filtros -->
<div class="container-fluid">
    <div class="row bg-light text-dark p-2">
        <div class="col-sm-2 col-md-2 col-lg-2">
            <form action="../controlador/productos.php" method="POST">
            <div class="card">
                <div class='card-body text-center'>
                    <h4>Filtrar</h4>
                    <button class="btn btn-warning">Aplicar</button>
                </div>
            </div>
            </form>
        </div>
        <div class="col-sm-10 col-md-10 col-lg-10">
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
            for($i=0;$i<$obj->totalProductos($categoria);$i++){
                    $info=$obj->getProductInfo($obj2,$i,$categoria); ?>
                    <form action='formConfirmProducto.php' method='POST'>
                        <div class='container'>
                            <div class='row my-2'>
                                <div class='col-sm-12 col-md-12 col-lg-12'>
                                    <div class='card'>
                                        <div class='card-body text-center'>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-3">                                                
                                                    <img src='<?php echo '../'.$info->getFoto(); ?>' width='190px' height='200px'></td>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-9">
                                                    <p class="h5"><?php echo $info->getNombreProd(); ?></p> 
                                                    <p><b class="text-info">Categoria: </b><?php echo $info->getCategoria(); ?></p>
                                                    <p><b class="text-info">Subcategoria: </b><?php echo $info->getSubCat(); ?></p>
                                                    <p><b class="text-info">Precio: </b><?php echo $info->getPrecio(); ?></p>
                                                </div>
                                            
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-sm-12 col-md-12 col-lg-4">
                                                <button type='submit' class='btn btn-info mb-2 form-control' name ='idInfo' value='<?php echo $info->getIdProduc(); ?>'>Mas Informacion</button>                                                   
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-4">
                                                <button type='submit' class='btn btn-warning mb-2 form-control' name ='idComprar' value='<?php echo $info->getIdProduc(); ?>'>Comprar</button>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-4">
                                                <button type='submit' class='btn btn-warning mb-2 form-control' name ='idAgregar' value='<?php echo $info->getIdProduc(); ?>'>Agregar al carrito</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>              
                    </form>
                <?php } ?>
        </div>
    </div>
</div>

<?php 
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}//cierra validacion de un inicio de sesion previo
?>


