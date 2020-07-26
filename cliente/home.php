<?php session_start();
include('barraCliente.php');
include('../modelo/conexion.php');
include('../modelo/clases.php');
//if(isset($_SESSION['usuario']) && isset($_SESSION['contra'])){ 
  $obj= new ConexionMySQL("root",""); 
  $obj2 = new Producto();
  //$info=$obj->getProductInfo($obj2);
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
                        <option value="">---Todos---</option>
                        <option value="Alimentos">Alimentos</option>
                        <option value="Abarrotes">Abarrotes</option>
                        <option value="Servicios">Servicios</option>
                    </select>                 
                </div> 

        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
            <button type="button" class="btn btn-success mt-2">Buscar Producto</button>
        </div>
    </div>
    <div class="container">

    </div>
</form>
</div>

<div class="container-fluid">
    <?php

    /*echo $info[0]->getNombreProd()."<br>";
    echo $info[0]->getCategoria()."<br>";
    echo $info[0]->getSubCat()."<br>";
    echo $info[0]->getPrecio()."<br>";*/


    for($i=0;$i<$obj->totalProductos();$i++){
        $info=$obj->getProductInfo($obj2,$i);

        echo "<form action='carrito.php' method='POST'>";
			echo "<div class='container'>
			<div class='row'>
			<div class='col-xs-12 col-sm-12 col-lg-12 col-xl-12'>
			<div class='card'>
			<div class='card-body text-center'>";
			echo "<table>
     		<tr>
        	 <td rowspan='8'><img src='../img/fondo.png' width='100px' height='90px'></td>
     			</tr>
     			 <tr>
         		 <td rowspan='5'><img src='../img/default_img.png' width='190px' height='200px'></td>
          		<td rowspan='5'><img src='../img/fondo.png' width='100px' height='90px'></td>
      			</tr>
     			 <tr>
         		 <td>".$info->getNombreProd()."</td>
      			</tr>
      			<tr>
      			 <td>".$info->getCategoria()."</td>
      			 </tr>
     			 <tr>
         		 <td>".$info->getSubCat()."</td>
      			</tr>
      			<tr>
         		 <td>".$info->getPrecio()."</td>
      			</tr>
                  <tr><td><button type='submit' class='btn btn-warning' name ='id'>Comprar</button></td>
                  <td><button type='submit' class='btn btn-primary' name ='id'>Agregar al carrito</button></td></tr>
  				</table>";
			echo "</div></div></div></div></div><br>";
			echo "</form>";
    }
    ?>
</div>