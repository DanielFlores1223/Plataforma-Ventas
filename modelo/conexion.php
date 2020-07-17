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
		$tipo="none";
		$sql= "SELECT Tipo FROM Empleado WHERE Correo ='$user';";
		$result = mysqli_query($this->conn,$sql);
		while ($reg=mysqli_fetch_array($result)){
			$tipo=$reg[0];
		}
		return $tipo;
	}

	public function inserta($tabla,$objeto){
		$resp=false;
		switch($tabla){
			case "Cliente":
				$sql="INSERT INTO Cliente(Nombre, ApellidoP, ApellidoM, Telefono, FechaNac, Constrasenia, Correo)VALUES(
					'$objeto-',
					'$objeto',
					'$objeto',
					'$objeto',
					$objeto,
					'$objeto',
					'$objeto');";
			break;

			case "Empleado":
				$sql="INSERT INTO Empleado(Nombre, ApellidoP, ApellidoM, Telefono, FechaNac, Correo, Constrasenia, Sueldo, Tipo)VALUES(
					'$objeto',
					'$objeto',
					'$objeto',
					'$objeto',
					$objeto,
					'$objeto',
					'$objeto',
					$objeto,
					'$objeto');";
			break;

			case "Venta":
				$sql="INSERT INTO Venta(MetodoPAgo, Tipo, Total, FechaVenta, Id_Empleado, Id_Cliente)VALUES(
					'$objeto',
					'$objeto',
					$objeto,
					'$objeto',
					'$objeto',
					'$objeto');";
			break;

			case "Tiene":
				$sql="INSERT INTO Tiene(Id_Venta ,Id_Producto)VALUES(
					$objeto,
					$objeto);";
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
				$sql="INSERT INTO Proveedor(Nombre_Proveedor, Nombre_Agente, Telefono, Horario, Categoria, Direccion)VALUES(".
					"'".$objeto->getNombreProv()."',
					'".$objeto->getNombreAgen()."',
					'".$objeto->getTel()."',
					'".$objeto->getHorario()."',
					'".$objeto->getCategoria()."',
					'".$objeto->getDireccion()."');";
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
				# code...
				break;
			case "Empleado":
				# code...
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

	public function consultaGeneral($tabla){
		$sql = "SELECT * FROM $tabla";
		$result = mysqli_query($this->conn,$sql);

		if(mysqli_num_rows($result) > 0)
			return $result;
		else
			return false;
	}

	public function consultaWhereId($tabla,$campoId,$id){
		$sql = "SELECT * FROM $tabla WHERE $campoId = $id" ;
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

	public function creaUsuario($name,$flastname,$mlastname,$birthd,$phone,$user,$password){
		$resp=false;
		$sql="INSERT INTO Cliente(Nombre,ApellidoP,ApellidoM,Telefono, FechaNac,Constrasenia,Correo)VALUES(
			'$name',
			'$flastname',
			'$mlastname',
			'$phone',
			$birthd,
			'$password',
			'$user');";
			
			if(mysqli_query($this->conn,$sql)){
				$resp=true;
				//echo "Cuenta Creada con EXITO";
			}
		return $resp;
	}

	public function getEmpleadoInfo($user){
		$obj = new Empleado();
		$sql="SELECT *FROM Empleado WHERE Correo ='$user';";
		if($result=mysqli_query($this->conn,$sql)){
			while($row = mysqli_fetch_assoc($result)){
				
				$obj->setIdEmpl($row['Id_Empleado']);
				$obj->setNombre($row['Nombre']);
				$obj->setApellidoP($row['ApellidoP']);
				$obj->setApellidoM($row['ApellidoM']);
				$obj->setTel($row['Telefono']);
				$obj->setFechaNac($row['FechaNac']);
				$obj->setContra($row['Correo']);
				$obj->setContra($row['Constrasenia']);
				$obj->setSueldo($row['Sueldo']);
				$obj->setTipo($row['Tipo']);
			}
		}
		return $obj;
	}

	public function getClienteInfo($user){
		$obj = new Cliente();
		$sql="SELECT *FROM Cliente WHERE Correo ='$user';";
		if($result=mysqli_query($this->conn,$sql)){
			while($row = mysqli_fetch_assoc($result)){
				$obj->setIdEmpl($row['Id_Empleado']);
				$obj->setNombre($row['Nombre']);
				$obj->setApellidoP($row['ApellidoP']);
				$obj->setApellidoM($row['ApellidoM']);
				$obj->setTel($row['Telefono']);
				$obj->setFechaNac($row['FechaNac']);
				$obj->setContra($row['Correo']);
				$obj->setContra($row['Constrasenia']);
			}
		}
		return $obj;
	}

	public function printUsersInfo($info){

	}

	public function cerrarDB(){
		mysqli_close($this->conn);	
	}
}