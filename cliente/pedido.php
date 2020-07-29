<?php session_start();
include('barraCliente.php');
include('../modelo/conexion.php');
include('../modelo/clases.php');
if(isset($_SESSION['usuario']) && isset($_SESSION['contra'])){
    ?>
<div class="container">
<form action="../controlador/pedidos.php" method="POST">
    <div class="row bg-light text-dark p-2">
        
        <div class="col-sm-4 col-md-4 col-lg-4 ">
            <div class="mt-2">
            <label><h4>Mis Pedidos</h4></label>
            </div>             
        </div>
        <div class="col-sm-8 col-md-8 col-lg-8">
        <div class="form-inline">
            <?php 
            if(isset($_POST['barraBusquedaPedido'])){
                ?>
                <input type="search" 
                name="barraBusquedaPedido" 
                class="form-control mt-2  w-75" 
                placeholder="Buscar Pedido..."
                value="<?php echo $_POST['barraBusquedaPedido'];?>"
                aria-label="Search"
                autofocus>                    
                <?php 
            }else{ ?> 
                <input type="search" 
                name="barraBusquedaPedido" 
                class="form-control mt-2 w-75" 
                placeholder="Buscar Pedido..."
                value=""
                aria-label="Search"
                autofocus>
                  <?php  
                  }
                  ?>
                  <div class="ml-2">
                  <button type="submit" class="btn btn-success mt-1 btn-lg">Buscar Pedido</button> 
                  </div>              
                </div> 
        </div>
    </div>
</form><hr>
</div>

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
</div>
    <?php
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}