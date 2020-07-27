<?php session_start();
include('barraCliente.php');
include('../modelo/conexion.php');
include('../modelo/clases.php');
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
  $obj= new ConexionMySQL("root",""); 
  $obj2 = new Producto();
?>
<div class="container-fluid">
<form action="../controlador/productos.php" method="POST">
    <div class="row bg-light text-dark p-2">
        <div class="col-sm-2 col-md-2 col-lg-2 ">
            <label><a href="../cliente/home.php"><img src="../img/title.png" class="img-fluid" alt="Responsive image"></a></label>             
        </div>
        <div class="col-sm-8 col-md-8 col-lg-8">
        <div class="form-inline">
            <?php 
            if(isset($_POST['barraBusquedaProducto'])){
                ?>
                <input type="search" 
                name="barraBusquedaProducto" 
                class="form-control mt-2  w-75" 
                placeholder="Buscar Producto..."
                value="<?php echo $_POST['barraBusquedaProducto'];?>"
                aria-label="Search"
                autofocus>                    
                <?php 
            }else{ ?> 
                <input type="search" 
                name="barraBusquedaProducto" 
                class="form-control mt-2 w-75" 
                placeholder="Buscar Producto..."
                value=""
                aria-label="Search"
                autofocus
                    >

                  <?php  
                  }
                  ?>
                  <select class="form-control mt-2" name="filtro" id="">
                        <option value="">---Todos---</option>
                        <option value="Alimentos">Alimentos</option>
                        <option value="Abarrotes">Abarrotes</option>
                        <option value="Servicios">Servicios</option>
                    </select>                 
                </div> 

        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
            <button type="submit" class="btn btn-success mt-2">Buscar Producto</button>
        </div>
    </div>
    <div class="container">

    </div>
</form>
</div>
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
            <?php for($i=0;$i<$obj->totalProductos();$i++){
                $info=$obj->getProductInfo($obj2,$i); ?>
                <form action='../controlador/carrito.php' method='POST'>
                    <div class='container'>
                        <div class='row'>
                            <div class='col-xs-12 col-sm-12 col-lg-12 col-xl-12'>
                                <div class='card'>
                                    <div class='card-body text-center'>
                                        <table>
                                            <tr><td rowspan='8'><img src='../img/fondo.png' width='100px' height='90px'></td></tr>
                                            <tr><td rowspan='5'><img src='../img/default_img.png' width='190px' height='200px'></td>
                                            <td rowspan='5'><img src='../img/fondo.png' width='100px' height='90px'></td></tr>
                                            <tr><td><?php echo $info->getNombreProd(); ?></td></tr>
                                            <tr><td><?php echo $info->getCategoria(); ?></td></tr>
                                            <tr><td><?php echo $info->getSubCat(); ?></td></tr>
                                            <tr><td><?php echo $info->getPrecio(); ?></td></tr>
                                            <tr><td><button type='submit' class='btn btn-warning' name ='idComprar'>Comprar</button></td>
                                            <td><button type='submit' class='btn btn-primary' name ='idAgregar'>Agregar al carrito</button></td>
                                            <td><button type='submit' class='btn btn-success' name ='idInfo'>Mas Informacion</button></td></tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>                
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


