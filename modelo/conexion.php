<?php

class ConexionMySQL{

    private $dbServerName;
	private $dbUsername;
    private $dbPassword;
    private $dbName;
    private $conn;

    public function __construct(){
		$this->dbServerName ="localhost";
		$this->dbUsername = "root";
		$this->dbPassword = "";
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
    
    public function validaLogin($user,$pass){
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

	public function usuarioExistente($user){
		$resp=false;
		$sql="SELECT user FROM usuarios WHERE user='$user';";
		$result =mysqli_query($this->conn,$sql);

		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				if($row['user']==$user){
					$resp=true;
				}
			}
		}
		return $resp;
	}

	public function creaUsuario($name,$flastname,$mlastname,$birthd,$phone,$user,$password){
		$resp=0;
		$sql="INSERT INTO usuarios(name,father_lastname,mother_lastname,birth_day,phone_number,user,password,type)VALUES(
			'$name',
			'$flastname',
			'$mlastname',
			$birthd,
			'$phone',
			'$user',
			'$password',
			'CLIENTE');";
			
			if(mysqli_query($this->conn,$sql)){
				echo "Cuenta Creada con EXITO";
			}
			else{
				echo "NO SE PUDO CREAR CUENTA CONTACTE AL ADMINISTRADOR";
			}
	}
}