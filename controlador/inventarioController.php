<?php 
session_start();  
include("../modelo/conexion.php");
include("../modelo/clases.php");

//Conexion a la base de datos
$dbUser="root";
$dbPass="";
$con = new ConexionMySQL($dbUser,$dbPass);

$tablaBD = 'Producto';
$tabla = 'Producto';
$articulos_x_pag = 3;
$paginas = 0;

//funciones
function desencriptar(){
    foreach ($_GET as $key => $data) {
        $data2 = $_GET[$key] = base64_decode(urldecode($data));
    }

    $desencrypt = (($data2 * 956783) /5678)/123456789;
    $id = round($desencrypt);

    return $id;
}

//consultas
$proveedores = $con->consultaGeneral("Proveedor");

if(isset($_POST['btnBuscarProd']) && $_POST['categoria'] == "Todos" && $_POST['barraBusquedaProd'] != ''){
    $bus = $_POST['barraBusquedaProd'];
    $filtro = $_POST['filtro'];
    $res = $con->consultaBarraBusqueda($tablaBD, $filtro, $bus);
    
}elseif (isset($_POST['categoria']) && $_POST['categoria'] != "Todos" && !isset($_POST['btnBuscarProd'])) {
     $res = $con->consultaBarraBusqueda($tablaBD, 'Categoria', $_POST['categoria']);
    
}elseif(isset($_POST['btnBuscarProd']) && $_POST['categoria'] != "Todos" && $_POST['barraBusquedaProd'] != ''){
    $bus = $_POST['barraBusquedaProd'];
    $filtro = $_POST['filtro'];
    $res = $con->consultaWhereAND($tablaBD,$filtro,$bus, 'Categoria', $_POST['categoria']);

}elseif(isset($_GET['pagina'])){
     //Consulta general para imprimir todos los registros
     $res = $con->consultaGeneral($tablaBD);
     //Paginacion
     $total_rows = mysqli_num_rows($res);
     $paginas = $total_rows / $articulos_x_pag;
     $paginas = ceil($paginas); //redondea hacia arriba 1.2 -> 2
     
     
     $iniciar = ($_GET['pagina'] - 1) * $articulos_x_pag;
     $res = $con->consultaGeneralPaginacion($tablaBD, $iniciar, $articulos_x_pag);
}

//insertar producto
if(isset($_POST['btnRegistrarProd'])){
    $validarExistencia = $con->consultaWhereId($tablaBD,"Id_Producto",$_POST['codigo']);
    $myReg = $con->consultaWhereAND('Empleado','Correo',$_SESSION['usuario'], 'Constrasenia', $_SESSION['contra']);
    $myReg = mysqli_fetch_array($myReg);
    $myId = $myReg['Id_Empleado'];

    if ($validarExistencia == false) {
        $productoI = new Producto();
        $productoI->setIdProduc($_POST['codigo']);
        $productoI->setNombreProd($_POST['nombre']);
        $productoI->setCategoria($_POST['categoria']);
        $productoI->setSubCat($_POST['subCategoria']);
        $productoI->setExistencia($_POST['existencia']);
        $productoI->setPrecio($_POST['precio']);
        $productoI->setDescripcion($_POST['descripcion']);
        $productoI->setIdEmple($myId);
        $productoI->setIdPro($_POST['idProv']);
        //insertamos foto del empleado
        $foto = $_FILES['foto']['name'];
        $ruta = $_FILES["foto"]["tmp_name"];
        $destino = "../img/fotoProducto/".$foto;
        copy($ruta,$destino);
        $destino = "img/fotoProducto/".$foto;
        $productoI->setFoto($destino);

        $insercion = $con->inserta($tabla,$productoI);
        if($insercion != false)
            echo "<script>window.location.replace('../administrador/inventario.php?action=Icorrect&pagina=1')</script>";
        else
            echo "<script>window.location.replace('../administrador/inventario.php?action=Ix&pagina=1')</script>";

    }else{
        echo "<script>window.location.replace('../administrador/inventario.php?action=Ixx&pagina=1')</script>";
    }


}

//Action CRUD
if(isset($_GET['actionCRUD'])){

    if($_GET['actionCRUD'] == 'modificar' || $_GET['actionCRUD'] == 'masDetalles'){        
        $action = $_GET['actionCRUD'];
        if(isset($_GET['p']))
            $p = $_GET['p'];

        $idM = desencriptar();
        
        $regProd = $con->consultaWhereId($tablaBD,"Id_Producto",$idM);
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

            $arregloProd = array( $producto->getIdProduc(),
                                  $producto->getNombreProd(),
                                  $producto->getCategoria(),
                                  $producto->getSubCat(),
                                  $producto->getExistencia(),
                                  $producto->getPrecio(),
                                  $producto->getDescripcion(),
                                  $producto->getIdPro(),
                                  $producto->getFoto());
            
            $_SESSION['producto'] = $arregloProd;

            if($action == 'modificar'){
                echo "<script>window.location.replace('../administrador/formModificarProd.php')</script>";
            
            }elseif ($action == 'masDetalles'){
                $prov = new Proveedor();
                $prov = $con->consultaJoinProd($idM, $prov);
                $arregloProv = array($prov->getIdProv(), 
                                $prov->getNombreProv(), 
                                $prov->getNombreAgen(), 
                                $prov->getTel(), 
                                $prov->getHorario(),
                                $prov->getCategoria(),
                                $prov->getDireccion(),
                                $prov->getEstatus());
                                
                
                $_SESSION['prove'] = $arregloProv;
                echo "<script>window.location.replace('../$p/masInfoProd.php')</script>"; 
            
            }   
        }

    }elseif($_GET['actionCRUD'] == "mComplete"){
        
        $idM = desencriptar();

        $productoMC = new Producto();
        $productoMC->setIdProduc($idM);
        $productoMC->setNombreProd($_POST['nombre']);
        $productoMC->setCategoria($_POST['categoria']);
        $productoMC->setSubCat($_POST['subCategoria']);
        $productoMC->setExistencia($_POST['existencia']);
        $productoMC->setPrecio($_POST['precio']);
        $productoMC->setDescripcion($_POST['descripcion']);
        $productoMC->setIdPro($_POST['idProv']);

        $id = $productoMC->getIdProduc();
        
        //validacion del cambio de foto
        if(isset($_FILES['foto'])){
            //insertamos foto del producto
            $foto = $_FILES['foto']['name'];
            $ruta = $_FILES["foto"]["tmp_name"];
            $destino = "../img/fotoProducto/".$foto;
            copy($ruta,$destino);
            $destino = "img/fotoProducto/".$foto;
            $productoMC->setFoto($destino);
            
            $modificacionFoto = $con->modificaFoto($tabla, $productoMC);

            if($modificacionFoto == false)
                echo "<script>window.location.replace('../administrador/formModificarEmp.php?action=Ixfoto&pagina=1')</script>";
        }

        $modificacionProduc = $con->modifica($tabla, $productoMC);

        if($modificacionProduc != false){
            echo "<script>window.location.replace('../administrador/inventario.php?action=Mcorrect&pagina=1')</script>";
        }else{
            echo "<script>window.location.replace('../administrador/inventario.php?action=Mx&pagina=1')</script>";
        } 
    }elseif ($_GET['actionCRUD'] == "eliminar") {

        if(isset($_GET['eliComplete'])){      
            $id = desencriptar();
            $productoVenta = $con->consultaWhereId('Tiene','Id_Producto', $id);

            if($productoVenta == false){
                $eliminacionCorrecta = $con->eliminar($tabla, $id);
                
                if($eliminacionCorrecta != false){
                    header('location:../administrador/inventario.php?action=Ecorrect&pagina=1 ');    
                }else{
                    echo "<script>window.location.replace('../administrador/inventario.php?action=Ex&pagina=1')</script>";
                }
            }else{
                echo "<script>window.location.replace('../administrador/inventario.php?action=Ex&pagina=1')</script>";
            }

        }else{
            $idE = $_GET['idE'];
            echo "<script>window.location.replace('../administrador/confirmarELiminacion.php?pagina=1&tabla=producto&id=$idE')</script>";
        }
}
}
//cierra Action CRUD
?>