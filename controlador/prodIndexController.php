<?php  
    include("modelo/conexion.php");
    include("modelo/clases.php");

//Conexion a la base de datos

$dbUser="root";
$dbPass="";
$con = new ConexionMySQL($dbUser,$dbPass);

$tablaBD = 'Producto';
$tabla = 'Producto';
$articulos_x_pag = 6;
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

if(isset($_GET['c'])){
    switch ($_GET['c']) {
        case 'Al':
            if (isset($_POST['btnBuscarProd']) && $_POST['barraBusquedaProd'] != "" && $_POST['sub'] == "") {
                $res = $con->consultaWhereAND2($tablaBD,'NombreProd',$_POST['barraBusquedaProd'], 'Categoria', 'Alimentos');
                
            }elseif(isset($_POST['sub']) && $_POST['barraBusquedaProd'] == "" && $_POST['sub'] != ""){
                $res = $con->consultaWhereAND2($tablaBD,'SubCategoria',$_POST['sub'], 'Categoria', 'Alimentos');
            
            }elseif(isset($_POST['btnBuscarProd']) && $_POST['barraBusquedaProd'] != "" && $_POST['sub'] != ""){
                $res = $con->consultaWhereAND2($tablaBD,'NombreProd',$_POST['barraBusquedaProd'], 'SubCategoria', $_POST['sub']);
            
            }elseif (isset($_GET['pagina']) || isset($_POST['btnBuscarProd']) && $_POST['barraBusquedaProd'] == "") {
                $res = $con->consultaWhereId($tablaBD,'Categoria','Alimentos');
                //Paginacion
                $total_rows = mysqli_num_rows($res);
                $paginas = $total_rows / $articulos_x_pag;
                $paginas = ceil($paginas); //redondea hacia arriba 1.2 -> 2


                $iniciar = ($_GET['pagina'] - 1) * $articulos_x_pag;
                $res = $con->consultaWHEREPaginacion($tablaBD, $iniciar, $articulos_x_pag, 'Categoria','Alimentos');           
            }
            
        break;
    
        case 'Ab':
            if (isset($_POST['barraBusquedaProd']) && $_POST['barraBusquedaProd'] != "" && $_POST['sub'] == "") {
                $res = $con->consultaWhereAND2($tablaBD,'NombreProd',$_POST['barraBusquedaProd'], 'Categoria', 'Abarrotes');
            
            }elseif(isset($_POST['sub']) && $_POST['barraBusquedaProd'] == "" && $_POST['sub'] != ""){
                $res = $con->consultaWhereAND2($tablaBD,'SubCategoria',$_POST['sub'], 'Categoria', 'Abarrotes');
            
            }elseif(isset($_POST['btnBuscarProd']) && $_POST['barraBusquedaProd'] != "" && $_POST['sub'] != ""){
                $res = $con->consultaWhereAND2($tablaBD,'NombreProd',$_POST['barraBusquedaProd'], 'SubCategoria', $_POST['sub']);
            
            } elseif (isset($_GET['pagina']) || isset($_POST['barraBusquedaProd']) && $_POST['barraBusquedaProd'] == "") {
                $res = $con->consultaWhereId($tablaBD,'Categoria','Abarrotes');
                //Paginacion
                $total_rows = mysqli_num_rows($res);
                $paginas = $total_rows / $articulos_x_pag;
                $paginas = ceil($paginas); //redondea hacia arriba 1.2 -> 2
            
            
                $iniciar = ($_GET['pagina'] - 1) * $articulos_x_pag;
                $res = $con->consultaWHEREPaginacion($tablaBD, $iniciar, $articulos_x_pag, 'Categoria','Abarrotes');
            }
            break;
    }
}

