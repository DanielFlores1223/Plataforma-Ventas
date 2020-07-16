<?php 

class Empleado{
    private $id_Empleado;
    private $nombre;
    private $apellidoM;
    private $apellidoP;
    private $telefono;
    private $fechaNac;
    private $correo;
    private $contrasenia;
    private $sueldo;
    private $tipo;
  
    public function __construct(){
        $this->id_Empleado = null;
        $this->nombre = "";
        $this->apellidoM = "";
        $this->apellidoP = "";
        $this->telefono = "";
        $this->fechaNac = "";
        $this->correo = "";
        $this->contrasenia = "";
        $this->sueldo = "";
        $this->tipo = "";
    }

    //Setters and Getters
    public function getIdEmpl(){
        return $this->id_Empleado;
    }

    public function setIdEmpl($id_Empleado){
        $this->id_Empleado = $id_Empleado;
    }

    public function getNombre(){
        return $this->nombre; 
    }

    public function setNombre($nombre){
        $this->nombre = $nombre; 
    }

    public function getApellidoM(){
        return $this->apellidoM;
    }

    public function setApellidoM($apellidoM){
        $this->apellidoM = $apellidoM;
    }

    public function getApellidoP(){
        return $this->apellidoP;
    }

    public function setApellidoP($apellidoP){
        $this->apellidoP = $apellidoP;
    }

    public function getTel(){
        return $this->telefono;
    }

    
    public function setTel($telefono){
        $this->telefono = $telefono;
    }

    public function getFechaNac(){
        return $this->fechaNac;
    }

    public function setFechaNac($fechaNac){
        $this->fechaNac = $fechaNac;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function setCorreo($correo){
        $this->correo = $correo;
    }

    public function getContra(){
        return $this->contrasenia;
    }

    public function setContra($contrasenia){
        $this->contrasenia = $contrasenia;
    }

    public function getSueldo(){
        return $this->sueldo;
    }

    public function setSueldo($sueldo){
        $this->sueldo = $sueldo;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

}//cierra clase Empleado

class Proveedor{

    private $id_proveedor;
    private $nombre_Proveedor;
    private $nombre_Agente;
    private $telefono;
    private $horario;
    private $categoria;
    private $direccion;

    public function __construct(){
        $this->id_proveedor = null;
        $this->nombre_Proveedor = "";
        $this->nombre_Agente = "";
        $this->telefono = "";
        $this->horario = "";
        $this->categoria = "";
        $this->direccion = "";
    }

    //Setters y Getters
    public function getIdProv(){
        return $this->id_proveedor;
    }

    public function setIdProv($id){
        $this->id_proveedor = $id;
    }

    public function getNombreProv(){
        return $this->nombre_Proveedor;
    }

    public function setNombreProv($nombre_Proveedor){
        $this->nombre_Proveedor = $nombre_Proveedor;
    }

    public function getNombreAgen(){
        return $this->nombre_Agente;
    }

    public function setNombreAgen($nombre_Agente){
        $this->nombre_Agente = $nombre_Agente;
    }

    public function getTel(){
        return $this->telefono;
    }

    public function setTel($telefono){
        $this->telefono = $telefono;
    }

    public function getHorario(){
        return $this->horario;
    }

    public function setHorario($horario){
        $this->horario = $horario;
    }

    public function getCategoria(){
        return $this->categoria;
    }

    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

}//cierrra la clase Proveedor






?>