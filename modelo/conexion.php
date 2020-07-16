<?php

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
		$this->conn = mysqli_connect($this->dbServerName, $this->dbUsername, $this->dbPassword, $this->dbName,"3308");
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
					'$objeto',
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

	public function consultaGeneral($tabla){
		$sql = "SELECT * FROM $tabla";
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

	public function getUserInfo($user){
		$pos=0;
		$info=array("","","","","","","","","");
		$sql="SELECT *FROM usuarios WHERE user ='$user';";
		if($result=mysqli_query($this->conn,$sql)){
			while($row = mysqli_fetch_assoc($result)){
				$info[0]=$row['code'];
				$info[1]=$row['name'];
				$info[2]=$row['father_lastname'];
				$info[3]=$row['mother_lastname'];
				$info[4]=$row['birth_day'];
				$info[5]=$row['phone_number'];
				$info[6]=$row['user'];
				$info[7]=$row['password'];
				$info[8]=$row['type'];
			}
		}
		return $info;
		//DBEE REGRESAR UN ARREGLO CON TODA LA INFO DEL USUSARIO
	}

	public function printUsersInfo($info){

	}

	public function cerrarDB(){
		mysqli_close($this->conn);	
	}
}