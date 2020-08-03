<?php 
session_start();
include('plantillas/bootstrap.php'); 
include('plantillas/header.php'); 
include("modelo/conexion.php");
include("modelo/clases.php");
$dbUser="root";
$dbPass="";
$con = new ConexionMySQL($dbUser,$dbPass);
//funciones
function desencriptar(){
    foreach ($_GET as $key => $data) {
        $data2 = $_GET[$key] = base64_decode(urldecode($data));
    }

    $desencrypt = (($data2 * 956783) /5678)/123456789;
    $id = round($desencrypt);

    return $id;
}

if(isset($_GET['ir'])){
    
    if($_GET['ir'] == 'masDetalles'){
        $idM = desencriptar();
        
        $regProd = $con->consultaWhereId('producto',"Id_Producto",$idM);
        $regProd = mysqli_fetch_array($regProd);

        if($regProd != false){
            $producto = new Producto();
            $producto->setIdProduc($regProd[0]);
            $producto->setNombreProd($regProd[1]);
            $producto->setCategoria($regProd[2]);
            $producto->setSubCat($regProd[3]);
            $producto->setExistencia($regProd[4]);
            $producto->setPrecio($regProd[5]);
            $producto->setDescripcion($regProd[6]);
            $producto->setIdPro($regProd[8]);
            $producto->setFoto($regProd[9]); 
        }
    }
}

?>
<link rel="stylesheet" href="estilos/general.css">

<div class="container">
    <div class="row mt-5">
        <div class="col-sm-12 col-md-1 col-lg-1">
            
            <a href="<?php echo $_GET['c'] == 'j' ? 'alimentos.php?pagina=1&c=Al':'abarrotes.php?pagina=1&c=Ab'?>" class="btn btn-light btn-sm"><img src="img/back.png" alt=""></a>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 text-center">
        
            <img src="<?php echo  $producto->getFoto() != "" ? $producto->getFoto() : 'img/default_img.png' ; ?>"  style='height: 18rem;  max-width:100%;'>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8">
            <h4 class="font-weight-light h3"><?=$producto->getNombreProd()?></h4>
            <p><b class="text-info">Categoria: </b><?=$producto->getCategoria()?></p>
            <p><b class="text-info">Subcategoria: </b> <?=$producto->getSubCat()?></p>
            <p><b class="text-info">Precio: </b><b class="text-success font-weight-normal"><?=$producto->getPrecio()?></b> pesos.</p>
            <p><b class="text-info">Descripcion: </b><?=$producto->getDescripcion()?></p>
            <form action="">
                <label for="cant"> <b class="text-info">Cantidad</b> </label>
                <select name="" id="cant" class="cantidad">
                    <?php 
                        for ($i=0; $i < 5; $i++) { 
                    ?>
                        <option value="<?=$i+1?>"><?=$i+1?></option>
                    <?php
                        }
                    ?>
                </select>
            </form>
            <div class="text-center">
                <a href="" class="btn btn-warning mb-3">Agregar al carrito</a>
                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalInicioSesion">Comprar ahora</a>
            </div>           
        </div>
    
    </div>


</div>


<?php include('plantillas/footerAdaptado.php'); 

?> 
