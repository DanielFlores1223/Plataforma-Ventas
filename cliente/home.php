<?php session_start();
include('barraCliente.php');
include('../modelo/conexion.php');
include('../modelo/clases.php');
//if(isset($_SESSION['usuario']) && isset($_SESSION['contra'])){ 
  $obj= new ConexionMySQL("root",""); 
  $obj2 = new Cliente();
?>
<div class="container-fluid">
<form action="clientes.php?pagina=1" method="POST">
    <div class="row bg-light text-dark p-2">
        <div class="col-sm-2 col-md-2 col-lg-2 ">
            <label><img src="../img/title.png" class="img-fluid" alt="Responsive image"></label>             
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
                        <option value="">---Filtar---</option>
                        <option value="Id_Cliente">Categoria</option>
                        <option value="Nombre">Marca</option>
                        <option value="ApellidoP">Sub Categoria</option>
                    </select>                 
                </div> 

        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
            <button type="button" class="btn btn-success mt-2">Buscar</button>
        </div>
    </div>
    <div class="container">

    </div>
</form>
</div>
