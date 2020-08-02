<?php

//include "clases.php";

class ConexionMySQL{

    private $dbServerName;
	private $dbUsername;
    private $dbPassword;
    private $dbName;
    private $conn;

    public function __construct($dbUser,$dbPass){
		$this->dbServerName ="localhost";
		$this->dbUsername = $dbUser;
		$this->dbPassword = $dbPass;
		$this->dbName = "plataforma_ventas";
		$this->conn = mysqli_connect($this->dbServerName, $this->dbUsername, $this->dbPassword, $this->dbName,"3306");
		//$this->conn = mysqli_connect($this->dbServerName, $this->dbUsername, $this->dbPassword, $this->dbName,"3308");
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			exit();
		}
	}

	public function getConexion(){
		return $this->conn;
    }
    
    public function validaLoginOld($user,$pass){
		$resp=0;
		$sql = "SELECT user,password FROM usuarios WHERE user='$user' AND password= '$pass';";
		$result = mysqli_query($this->conn,$sql);
		while ($reg=mysqli_fetch_array($result)){
			if($user==$reg[0] && $pass==$reg[1]){
				$resp=1;
			}
		}
		return $resp;
	}

	public function validaLoginNuevo($user,$pass){
		$resp=false;
		if($this->validaEmpleado($user,$pass)==true||$this->validaCliente($user,$pass)==true){
			$resp=true;
		}
		return $resp;
	}

	public function validaCliente($user,$pass){
		$resp=false;
		$sql = "SELECT Correo ,Constrasenia  FROM Cliente WHERE Correo='$user' AND Constrasenia= '$pass';";
		$result = mysqli_query($this->conn,$sql);
		while ($reg=mysqli_fetch_array($result)){
			if($user==$reg[0] && $pass==$reg[1]){
				$resp=true;
			}
		}
		return $resp;
	}

	public function validaEmpleado($user,$pass){
		$resp=false;
		$sql = "SELECT Correo ,Constrasenia  FROM Empleado WHERE Correo ='$user' AND Constrasenia = '$pass';";
		$result = mysqli_query($this->conn,$sql);
		while ($reg=mysqli_fetch_array($result)){
			if($user==$reg[0] && $pass==$reg[1]){
				$resp=true;
			}
		}
		return $resp;
	}

	public function getTipoEmpleado($user){
		$tipo="NONE";
		$sql= "SELECT Tipo FROM Empleado WHERE Correo ='$user';";
		$result = mysqli_query($this->conn,$sql);
		while ($reg=mysqli_fetch_array($result)){
			$tipo=$reg[0];
		}
		return $tipo;
	}

	public function esCliente($user){
		$sql="SELECT Id_Cliente FROM Cliente WHERE Correo='$user';";
		if($result=mysqli_query($this->conn,$sql)){
			return $result->num_rows;
		}else
		return 0;
	}

	public function getTipoUsuario($user){
		
		if($resp=$this->esCliente($user)==0){

			$resp=$this->getTipoEmpleado($user);
			return $resp;

		}else{
			return $resp='CLIENTE';
		}
	}

	/**  ACCIONES PARA CRUD  **/

	public function inserta($tabla,$objeto){
		$resp=false;
		switch($tabla){
			case "Cliente":
				$sql="INSERT INTO Cliente(Nombre, ApellidoP, ApellidoM, Telefono, FechaNac, Constrasenia, Correo)VALUES(".
				"'".$objeto->getNombre()."',
				'".$objeto->getApelLidoP()."',
				'".$objeto->getApellidoM()."',
				'".$objeto->getTel()."',
				'".$objeto->getFechaNac()."',
		        '".$objeto->getcontra()."',
				'".$objeto->getCorreo()."');";
			break;

			case "Empleado":
				$sql="INSERT INTO Empleado(Nombre, ApellidoP, ApellidoM, Telefono, FechaNac, Correo, Constrasenia, Sueldo, Tipo, Estatus, Foto)VALUES(".
				"'".$objeto->getNombre()."',
				'".$objeto->getApellidoP()."',
				'".$objeto->getApellidoM()."',
				'".$objeto->getTel()."',
				'".$objeto->getFechaNac()."',
				'".$objeto->getCorreo()."',
				'".$objeto->getContra()."',
				'".$objeto->getSueldo()."',
				'".$objeto->getTipo()."',
				'".$objeto->getEstatus()."',
				'".$objeto->getFoto()."');";
			break;

			case "Venta":
				$sql="INSERT INTO Venta(MetodoPAgo, Tipo, Total, FechaVenta, Id_Cliente)VALUES(".
				"'".$objeto->getMetodoPago()."',
				'".$objeto->getTipo()."',
				'".$objeto->getTotal()."',
				'".$objeto->getFechaVenta()."',
				".$objeto->getId_Cliente().");";
			break;

			case "VentaOnline":
				$sql="INSERT INTO VentaOnline(Id_Venta, DirreccionEnvio, FechaEntrega, Estatus)VALUES(".
				$objeto->geId_VentaOnline().",
				'".$objeto->getDirreccionEnvio()."',
				'".$objeto->getFechaEntrega()."',
				'".$objeto->getEstatus()."');";
			break;

			case "Tiene":
				$sql="INSERT INTO Tiene(Id_Venta ,Id_Producto)VALUES(".
					$objeto->getId_Venta().",
					'".$objeto->getId_Producto()."');";
			break;

			case "Producto":
				$sql="INSERT INTO Producto(Id_Producto, NombreProd, Categoria, SubCategoria, Existencia, Precio, Descripcion, Id_Empleado, Id_Proveedor)VALUES(
					$objeto,
					'$objeto',
					'$objeto',
					'$objeto',
					$objeto,
					$objeto,
					'$objeto',
					$objeto,
					$objeto);";
			break;

			case "Proveedor":
				$sql="INSERT INTO Proveedor(Nombre_Proveedor, Nombre_Agente, Telefono, Horario, Categoria, Direccion, Estatus)VALUES(".
					"'".$objeto->getNombreProv()."',
					'".$objeto->getNombreAgen()."',
					'".$objeto->getTel()."',
					'".$objeto->getHorario()."',
					'".$objeto->getCategoria()."',
					'".$objeto->getDireccion()."',
					'".$objeto->getEstatus()."');";
			break;
		}
		if(mysqli_query($this->conn,$sql))
		    $resp=true;	
		return $resp;
	}
	
	public function modifica($tabla, $objeto){
		$resp=false;
		switch ($tabla) {
			case "Cliente":
				$sql = "UPDATE Cliente SET 
				Nombre ="."'".$objeto->getNombre()."',
				ApellidoP = "."'".$objeto->getApellidoP()."', 
				ApellidoM = "."'".$objeto->getApellidoM()."', 
				Telefono = "."'".$objeto->getTel()."', 
				FechaNac = "."'".$objeto->getFechaNac()."',
				Correo = "."'".$objeto->getCorreo()."'
				WHERE Id_Cliente =".$objeto->getIdCli()."";
				break;
			case "Empleado":
				$sql = "UPDATE Empleado SET 
				Nombre ="."'".$objeto->getNombre()."',
				ApellidoP = "."'".$objeto->getApellidoP()."', 
				ApellidoM = "."'".$objeto->getApellidoM()."', 
				Telefono = "."'".$objeto->getTel()."', 
				FechaNac = "."'".$objeto->getFechaNac()."',
				Correo = "."'".$objeto->getCorreo()."',
				Sueldo = "."'".$objeto->getSueldo()."',
				Tipo = "."'".$objeto->getTipo()."'
				WHERE Id_Empleado =".$objeto->getIdEmpl()."";
				break;
			case "Venta":
					# code...
				break;
			case "Tiene":
				# code...
				break;
			case "Producto":
				$sql = "UPDATE producto SET 
				NombreProd = "."'".$objeto->getNombreProd()."', 
				Categoria = "."'".$objeto->getCategoria()."', 
				SubCategoria = "."'".$objeto->getSubCat()."', 
				Existencia = "."'".$objeto->getExistencia()."',
				Precio = "."'".$objeto->getPrecio()."',
				Descripcion = "."'".$objeto->getDescripcion()."'
				WHERE Id_Producto ='".$objeto->getIdProduc()."'";
				break;
			case "Proveedor":
				$sql = "UPDATE proveedor SET 
				Nombre_Proveedor ="."'".$objeto->getNombreProv()."',
				Nombre_Agente = "."'".$objeto->getNombreAgen()."', 
				Telefono = "."'".$objeto->getTel()."', 
				Horario = "."'".$objeto->getHorario()."', 
				Categoria = "."'".$objeto->getCategoria()."',
				Direccion = "."'".$objeto->getDireccion()."'
				WHERE proveedor.Id_Proveedor =".$objeto->getIdProv()."";
				break;
		}

		if(mysqli_query($this->conn,$sql))
		$resp=true;	
	return $resp;
	}//cierra metodo modifica

	public function modificaPass($tabla,$objeto){
		$resp=false;
		switch ($tabla) {
			case "Cliente":
			 #code	
				break;
			
			case "Empleado":
				$sql = "UPDATE empleado SET Constrasenia ="."'".$objeto->getContra()."'
				WHERE Id_Empleado =".$objeto->getIdEmpl()."";
				break;
		}

		if(mysqli_query($this->conn,$sql))
			$resp=true;	
	
		return $resp;
	}

	public function modificaFoto($tabla, $objeto){
		$resp=false;
		switch ($tabla) {
			case "Producto":
				$sql = "UPDATE producto SET Foto ="."'".$objeto->getFoto()."'
				WHERE Id_Producto =".$objeto->getIdProduc()."";
				break;
			
			case "Empleado":
				$sql = "UPDATE empleado SET Foto ="."'".$objeto->getFoto()."'
				WHERE Id_Empleado =".$objeto->getIdEmpl()."";
				break;

			case "Cliente":
				$sql = "UPDATE cliente SET Foto ="."'".$objeto->getFoto()."'
				WHERE Id_Cliente =".$objeto->getIdCli()."";
				break;
		}

		if(mysqli_query($this->conn,$sql))
			$resp=true;	
	
		return $resp;
	}

	public function modificaPerfil($tabla, $objeto){
		$resp=false;
		switch ($tabla) {
			case "Cliente":
				$sql = "UPDATE Cliente SET 
				Nombre ="."'".$objeto->getNombre()."',
				ApellidoP = "."'".$objeto->getApellidoP()."', 
				ApellidoM = "."'".$objeto->getApellidoM()."', 
				Telefono = "."'".$objeto->getTel()."', 
				FechaNac = "."'".$objeto->getFechaNac()."',
				Correo = "."'".$objeto->getCorreo()."'
				WHERE Id_Cliente =".$objeto->getIdCli()."";
				break;
			case "Empleado":
				$sql = "UPDATE Empleado SET 
				Nombre ="."'".$objeto->getNombre()."',
				ApellidoP = "."'".$objeto->getApellidoP()."', 
				ApellidoM = "."'".$objeto->getApellidoM()."', 
				Telefono = "."'".$objeto->getTel()."', 
				FechaNac = "."'".$objeto->getFechaNac()."',
				Correo = "."'".$objeto->getCorreo()."'
				WHERE Id_Empleado =".$objeto->getIdEmpl()."";
				break;
			case "Venta":
					# code...
				break;
			case "Tiene":
				# code...
				break;
			case "Producto":
				# code...
				break;
			case "Proveedor":
				$sql = "UPDATE proveedor SET 
				Nombre_Proveedor ="."'".$objeto->getNombreProv()."',
				Nombre_Agente = "."'".$objeto->getNombreAgen()."', 
				Telefono = "."'".$objeto->getTel()."', 
				Horario = "."'".$objeto->getHorario()."', 
				Categoria = "."'".$objeto->getCategoria()."',
				Direccion = "."'".$objeto->getDireccion()."'
				WHERE proveedor.Id_Proveedor =".$objeto->getIdProv()."";
				break;
		}

		if(mysqli_query($this->conn,$sql))
		$resp=true;	
	return $resp;

	}//cierra metodo modifica

	public function eliminar($tabla, $id){
		$resp=false;
		switch ($tabla) {
			case "Cliente":
				$sql = "DELETE FROM cliente WHERE Id_Cliente =".$id;
				break;
			case "Empleado":
				$sql = "DELETE FROM empleado WHERE Id_Empleado =".$id;
				break;
			case "Venta":
					# code...
				break;
			case "Tiene":
				# code...
				break;
			case "Producto":
				$sql = "DELETE FROM producto WHERE Id_Producto=".$id;
				break;
			case "Proveedor":
				$sql = "DELETE FROM proveedor WHERE Id_Proveedor=".$id;
				break;
		}

		if(mysqli_query($this->conn,$sql))
		$resp=true;	
	return $resp;
	}

	public function sustituirEliminar($tabla, $id){
		$resp=false;
		switch ($tabla) {
			case "Cliente":
				$sql = "UPDATE cliente SET 
				Estatus = 'Inactivo'
				WHERE Id_Cliente =".$id;
				break;
			case "Empleado":
				$sql = "UPDATE empleado SET 
				Estatus = 'Inactivo'
				WHERE empleado.Id_Empleado =".$id;
				break;
			case "Venta":
					# code...
				break;
			case "Tiene":
				# code...
				break;
			case "Producto":
				# code...
				break;
			case "Proveedor":
				$sql = "UPDATE proveedor SET 
				Estatus = 'Inactivo'
				WHERE proveedor.Id_Proveedor =".$id;
				break;
		}

		if(mysqli_query($this->conn,$sql))
		$resp=true;	
	return $resp;
	}//cierra metodo sustituirEliminar

	public function reactivaEstatus($tabla, $id){
		$resp=false;
		switch ($tabla) {
			case "Cliente":
				$sql = "UPDATE cliente SET 
				Estatus = 'Activo'
				WHERE Id_Cliente =".$id;
				break;
			case "Empleado":
				$sql = "UPDATE empleado SET 
				Estatus = 'Activo'
				WHERE empleado.Id_Empleado =".$id;
				break;
			case "Venta":
					# code...
				break;
			case "Tiene":
				# code...
				break;
			case "Producto":
				# code...
				break;
			case "Proveedor":
				$sql = "UPDATE proveedor SET 
				Estatus = 'Activo'
				WHERE proveedor.Id_Proveedor =".$id;
				break;
		}

		if(mysqli_query($this->conn,$sql))
		$resp=true;	
	return $resp;
	}

	/**  TERMINA ACCIONES PARA CRUD  **/

	/** CONSULTAS **/
	public function consultaGeneral($tabla){
		$sql = "SELECT * FROM $tabla";
		$result = mysqli_query($this->conn,$sql);

		if(mysqli_num_rows($result) > 0)
			return $result;
		else
			return false;
	}

	public function consultaWhereId($tabla,$campoId,$id){
		$sql = "SELECT * FROM $tabla WHERE $campoId = '$id'" ;
		$result = mysqli_query($this->conn,$sql);

		if(mysqli_num_rows($result) > 0)
			return $result;
		else
			return false;
	}


	public function consultaBarraBusqueda($tabla, $campoId, $id){
		$sql = "SELECT * FROM $tabla WHERE $campoId LIKE '%$id%'" ;
		$result = mysqli_query($this->conn,$sql);

		if(mysqli_num_rows($result) > 0)
			return $result;
		else
			return false;
	}

	public function consultaBarraBusquedaPag($tabla, $campo, $valor, $inicio, $npag){
		$sql = "SELECT * FROM $tabla WHERE $campo LIKE '%$valor%' LIMIT $inicio,$npag" ;
		$result = mysqli_query($this->conn,$sql);

		if(mysqli_num_rows($result) > 0)
			return $result;
		else
			return false;
	}

	public function consultaGeneralEstatus($tabla, $estatus){
		$sql = "SELECT * FROM $tabla WHERE Estatus = '$estatus'";
		$result = mysqli_query($this->conn,$sql);

		if(mysqli_num_rows($result) > 0)
			return $result;
		else
			return false;
	}

	public function consultaGeneralPaginacion($tabla, $inicio, $npag){
		$sql = "SELECT * FROM $tabla LIMIT $inicio,$npag";
		$result = mysqli_query($this->conn,$sql);

		if(mysqli_num_rows($result) > 0)
			return $result;
		else
			return false;
	}

	public function consultaWhereAND($tabla,$campoId,$id, $campo2, $valor2){
		$sql = "SELECT * FROM $tabla WHERE $campoId = '$id' AND $campo2 = '$valor2'" ;
		$result = mysqli_query($this->conn,$sql);

		if(mysqli_num_rows($result) > 0)
			return $result;
		else
			return false;
	}

	public function consultaJoinProd($id, $obj){
		$sql = "SELECT prov.* FROM producto AS pr JOIN proveedor AS prov WHERE pr.Id_Producto = '$id' AND pr.Id_Proveedor = prov.Id_Proveedor";
	
		if($result = mysqli_query($this->conn,$sql)){
			while($row = mysqli_fetch_assoc($result)){
				$obj->setIdProv($row['Id_Proveedor']);
				$obj->setNombreProv($row['Nombre_Proveedor']);
				$obj->setNombreAgen($row['Nombre_Agente']);
				$obj->setTel($row['Telefono']);
				$obj->setHorario($row['Horario']);
				$obj->setCategoria($row['Categoria']);
				$obj->setDireccion($row['Direccion']);

			}
		}
		return $obj;

	}
	/** TERMINA CONSULTAS **/

	/** REPORTES **/
	public function reporteSueldoEmp(){
		$sql = "SELECT e.Nombre, e.ApellidoP, e.ApellidoM, e.Sueldo FROM empleado AS e WHERE e.Estatus='Activo'";
		$result = mysqli_query($this->conn,$sql);

		if(mysqli_num_rows($result) > 0)
			return $result;
		else
			return false;
	}

	public function reporteProdSurt(){
		$sql = "SELECT p.Id_Producto, p.NombreProd, p.Existencia, p.Precio, prov.Nombre_Proveedor, prov.Nombre_Agente, prov.Telefono, prov.Horario FROM producto AS p JOIN proveedor as prov WHERE p.Id_Proveedor = prov.Id_Proveedor AND p.Existencia <= 10";
		$result = mysqli_query($this->conn,$sql);

		if(mysqli_num_rows($result) > 0)
			return $result;
		else
			return false;
	}

	public function reporteVentaDia($fecha){
		$sql = "SELECT v.Id_Venta, v.MetodoPAgo, v.Tipo, v.Total, v.FechaVenta, cl.Nombre, cl.Telefono FROM venta AS v JOIN cliente AS cl WHERE v.Id_Cliente = cl.Id_Cliente AND v.FechaVenta = '$fecha'";
		$result = mysqli_query($this->conn,$sql);

		if(mysqli_num_rows($result) > 0)
			return $result;
		else
			return false;
	}

	public function reporteVentaMes($mes, $year){
		$sql = "SELECT v.Id_Venta, v.MetodoPAgo, v.Tipo, v.Total, v.FechaVenta, cl.Nombre, cl.Telefono FROM venta AS v JOIN cliente AS cl WHERE v.Id_Cliente = cl.Id_Cliente AND MONTH(v.FechaVenta) = '$mes' AND YEAR(v.FechaVenta) = '$year'";
		$result = mysqli_query($this->conn,$sql);

		if(mysqli_num_rows($result) > 0)
			return $result;
		else
			return false;
	}

	public function reporteVentaYear($year){
		$sql = "SELECT v.Id_Venta, v.MetodoPAgo, v.Tipo, v.Total, v.FechaVenta, cl.Nombre, cl.Telefono FROM venta AS v JOIN cliente AS cl WHERE v.Id_Cliente = cl.Id_Cliente AND YEAR(v.FechaVenta) = '$year'";
		$result = mysqli_query($this->conn,$sql);

		if(mysqli_num_rows($result) > 0)
			return $result;
		else
			return false;
	}
	

	public function usuarioExistente($user){
		$resp=false;
		$sql="SELECT Correo FROM Cliente WHERE Correo='$user';";
		$result =mysqli_query($this->conn,$sql);

		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				if($row['Correo']==$user){
					$resp=true;
				}
			}
		}
		return $resp;
	}
	
	public function getEmpleadoInfo($user,$obj){
		//$obj = new Empleado();
		$sql="SELECT *FROM Empleado WHERE Correo ='$user';";
		if($result=mysqli_query($this->conn,$sql)){
			while($row = mysqli_fetch_assoc($result)){
				
				$obj->setIdEmpl($row['Id_Empleado']);
				$obj->setNombre($row['Nombre']);
				$obj->setApellidoP($row['ApellidoP']);
				$obj->setApellidoM($row['ApellidoM']);
				$obj->setTel($row['Telefono']);
				$obj->setFechaNac($row['FechaNac']);
				$obj->setCorreo($row['Correo']);
				$obj->setContra($row['Constrasenia']);
				$obj->setSueldo($row['Sueldo']);
				$obj->setTipo($row['Tipo']);
				$obj->setEstatus($row['Estatus']);
				$obj->setFoto($row['Foto']);

			}
		}
		return $obj;
	}

	public function getClienteInfo($user,$obj){
		$sql="SELECT *FROM Cliente WHERE Correo ='$user';";
		if($result=mysqli_query($this->conn,$sql)){
			while($row = mysqli_fetch_assoc($result)){
				$obj->setIdCli($row['Id_Cliente']);
				$obj->setNombre($row['Nombre']);
				$obj->setApellidoP($row['ApellidoP']);
				$obj->setApellidoM($row['ApellidoM']);
				$obj->setTel($row['Telefono']);
				$obj->setFechaNac($row['FechaNac']);
				$obj->setCorreo($row['Correo']);
				$obj->setContra($row['Constrasenia']);
				$obj->setFoto($row['Foto']);
			}
		}
		return $obj;
	}

	public function getProduct($obj,$id_product){
		$sql="SELECT *FROM Producto WHERE Id_Producto = $id_product;";
		if($result=mysqli_query($this->conn,$sql)){
			while ($row=mysqli_fetch_assoc($result)) {
				$obj->setIdProduc($row['Id_Producto']);
				$obj->setNombreProd($row['NombreProd']);
				$obj->setCategoria($row['Categoria']);
				$obj->setSubCat($row['SubCategoria']);
				$obj->setPrecio($row['Precio']);
				$obj->setFoto($row['Foto']);
				$obj->setExistencia($row['Existencia']);
			}
		}
		return $obj;
	}

	public function getProductInfo($obj,$pos,$categoria){
		if($categoria!='Todos'){
			$i=0;
			$sql="SELECT * FROM productos_alfa WHERE Categoria ='$categoria';";
			if($result=mysqli_query($this->conn,$sql)){
				while ($row=mysqli_fetch_assoc($result)) {
					if($i==$pos){
						$obj->setIdProduc($row['Id_Producto']);
						$obj->setNombreProd($row['NombreProd']);
						$obj->setCategoria($row['Categoria']);
						$obj->setSubCat($row['SubCategoria']);
						$obj->setPrecio($row['Precio']);
						$obj->setFoto($row['Foto']);
						return $obj;
					}
					$i++;
				}
			}

		}else{
			$i=0;
			$sql="SELECT * FROM productos_alfa;";
			if($result=mysqli_query($this->conn,$sql)){
				while ($row=mysqli_fetch_assoc($result)) {
					if($i==$pos){
						$obj->setIdProduc($row['Id_Producto']);
						$obj->setNombreProd($row['NombreProd']);
						$obj->setCategoria($row['Categoria']);
						$obj->setSubCat($row['SubCategoria']);
						$obj->setPrecio($row['Precio']);
						$obj->setFoto($row['Foto']);
						return $obj;
					}
					$i++;
				}
			}
		}
	}

	public function totalProductos($categoria){
		if($categoria!='Todos'){
			$sql="SELECT NombreProd FROM Producto WHERE Categoria ='$categoria';";
			if($result=mysqli_query($this->conn,$sql)){
				return $result->num_rows;
			}else
			return 0;
		}else{
			$sql="SELECT NombreProd FROM Producto;";
			if($result=mysqli_query($this->conn,$sql)){
				return $result->num_rows;
			}else
			return 0;
		}
	}

	public function cantidadProducto($id_product){
		$cant=0;
		$sql="SELECT Existencia FROM Producto WHERE Id_Producto = $id_product;";
		if($result=mysqli_query($this->conn,$sql)){
			while ($row=mysqli_fetch_assoc($result)) {
				$cant=$row['Existencia'];
				return $cant;
			}
		}else{
			return $cant;
		}
	}

	public function updateCantidadProducto($newCant,$idPro){
		$sql="UPDATE Producto SET Existencia = $newCant WHERE Id_Producto = $idPro;";
		if(mysqli_query($this->conn,$sql)){
			return true;
		}else{
			return false;
		}
	}

	public function getLastIdVent(){
		$id=0;
		$sql="SELECT Id_Venta FROM Venta;";
		if($result=mysqli_query($this->conn,$sql)){
			while ($row=mysqli_fetch_assoc($result)) {
				$id=$row['Id_Venta'];
			}
		}
		return $id;
	}

	public function getNumPedidos($id){
		$sql="SELECT * FROM Venta WHERE Id_Cliente= $id;";
		if($result=mysqli_query($this->conn,$sql)){
			return $result->num_rows;
		}
	}

	public function getPedidoInfoOld($obj,$pos,$id){
		$i=0;
		$sql="SELECT * FROM Venta v JOIN VentaOnline vo ON v.Id_Venta=vo.Id_Venta JOIN Tiene t ON v.Id_Venta=t.Id_Venta JOIN productos_alfa p ON t.Id_Producto= p.Id_Producto WHERE Id_Cliente= $id;";
		if($result=mysqli_query($this->conn,$sql)){
			while ($row=mysqli_fetch_assoc($result)) {
				if($i==$pos){
					$obj->setId_Venta($row['Id_Venta']);
					$obj->setMetodoPago($row['MetodoPAgo']);
					$obj->setTipo($row['Tipo']);
					$obj->setTotal($row['Total']);
					$obj->setFechaVenta($row['FechaVenta']);
					$obj->setId_VentaOnline($row['Id_Venta']);
					$obj->setId_Empleado($row['Id_Empleado']);
					$obj->setId_Cliente($row['Id_Cliente']);
					$obj->setDirreccionEnvio($row['DirreccionEnvio']);
					$obj->setFechaEntrega($row['FechaEntrega']);
					$obj->setEstatus($row['Estatus']);
					return $obj;
				}
				$i++;
			}
		}
	}

	public function getPedidoInfo($obj,$id){
		//$i=0;
		$sql="SELECT * FROM Tiene WHERE Id_Venta= $id;";
		if($result=mysqli_query($this->conn,$sql)){
			while ($row=mysqli_fetch_assoc($result)) {
					$obj->setId_Venta($row['Id_Venta']);
					$obj->setId_Producto($row['Id_Producto']);
					return $obj;
			}
		}
	}

	public function cerrarDB(){
		mysqli_close($this->conn);	
	}
}