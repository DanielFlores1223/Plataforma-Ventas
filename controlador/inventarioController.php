<?php 
session_start();  
include("../modelo/conexion.php");
include("../modelo/clases.php");

//Conexion a la base de datos
$dbUser="root";
$dbPass="";
$con = new ConexionMySQL($dbUser,$dbPass);

$tablaBD = 'producto';
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
$proveedores = $con->consultaGeneral("proveedor");

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

}else{
     //Consulta general para imprimir todos los registros
     $res = $con->consultaGeneral($tablaBD);
     //Paginacion
     $total_rows = mysqli_num_rows($res);
     $paginas = $total_rows / $articulos_x_pag;
     $paginas = ceil($paginas); //redondea hacia arriba 1.2 -> 2
     
     
     $iniciar = ($_GET['pagina'] - 1) * $articulos_x_pag;
     $res = $con->consultaGeneralPaginacion($tablaBD, $iniciar, $articulos_x_pag);
}


?>