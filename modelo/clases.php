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
    private $estatus;
    private $foto;
  
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
        $this->estatus = "";
        $this->foto = "";
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

    
    public function getEstatus(){
        return $this->estatus;
    }

    public function setEstatus($estatus){
        $this->estatus = $estatus;
    }

    public function getFoto(){
        return $this->foto;
    }

    public function setFoto($foto){
        $this->foto = $foto;
    }
}//cierra clase Empleado

class Cliente{
    private $id_Cliente;
    private $nombre;
    private $apellidoM;
    private $apellidoP;
    private $telefono;
    private $fechaNac;
    private $correo;
    private $contrasenia;
    private $foto;
    
  
    public function __construct(){
        $this->id_Cliente = null;
        $this->nombre = "";
        $this->apellidoM = "";
        $this->apellidoP = "";
        $this->telefono = "";
        $this->fechaNac = "";
        $this->correo = "";
        $this->contrasenia = "";
        $this->foto = "";
    }

    //Setters and Getters
    public function getIdCli(){
        return $this->id_Cliente;
    }

    public function setIdCli($id_Cliente){
        $this->id_Cliente = $id_Cliente;
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

    public function getFoto(){
        return $this->foto;
    }

    public function setFoto($foto){
        $this->foto = $foto;
    }
}//cierre clase Cliente

class Proveedor{

    private $id_proveedor;
    private $nombre_Proveedor;
    private $nombre_Agente;
    private $telefono;
    private $horario;
    private $categoria;
    private $direccion;
    private $estatus;

    public function __construct(){
        $this->id_proveedor = null;
        $this->nombre_Proveedor = "";
        $this->nombre_Agente = "";
        $this->telefono = "";
        $this->horario = "";
        $this->categoria = "";
        $this->direccion = "";
        $this->estatus = "";
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

    public function getEstatus(){
        return $this->estatus;
    }

    public function setEstatus($estatus){
        $this->estatus = $estatus;    
    }
}//cierrra la clase Proveedor


class Producto{
    private $idProduc;
    private $nombreProd;
    private $categoria;
    private $subCat;
    private $existencia;
    private $precio;
    private $descripcion;
    private $idEmple;
    private $idPro;
    private $foto;

    public function __construct(){
        $this->idProduc = "";
        $this->nombreProd = "";
        $this->categoria = "";
        $this->subCat = "";
        $this->existencia = "";
        $this->precio = null;
        $this->descripcion = "";
        $this->idEmple = "";
        $this->idPro = "";
        $this->foto = "";
    }

    public function setIdProduc($idProduc){
        $this->idProduc=$idProduc;

    }

    public function getIdProduc(){
        return $this->idProduc;

    }

    public function setNombreProd($nombreProd){
        $this->nombreProd=$nombreProd;

    }

    public function getNombreProd(){
        return $this->nombreProd;

    }

    public function setCategoria($categoria){
        $this->categoria=$categoria;

    }

    public function getCategoria(){
        return $this->categoria;

    }

    public function setSubCat($subCat){
        $this->subCat=$subCat;

    }

    public function getSubCat(){
        return $this->subCat;

    }

    public function setExistencia($existencia){
        $this->existencia=$existencia;

    }

    public function getExistencia(){
        return $this->existencia;

    }

    public function setPrecio($precio){
        $this->precio=$precio;

    }

    public function getPrecio(){
        return $this->precio;

    }

    public function setDescripcion($descripcion){
        $this->descripcion=$descripcion;

    }

    public function getDescripcion(){
        return $this->descripcion;

    }

    public function setIdEmple($idEmple){
        $this->idEmple=$idEmple;

    }

    public function getIdEmple(){
        return $this->idEmple;

    }

    public function setIdPro($idPro){
        $this->idPro=$idPro;
    }

    public function getIdPro(){
        return $this->idPro;
    }
 
    public function getFoto(){
        return $this->foto;
    }

    public function setFoto($foto){
        $this->foto = $foto;
    }
}

class Venta{
    private $id_Venta;
    private $metodoPago;
    private $tipo;
    private $total;
    private $fechaVenta;
    private $id_Empleado;
    private $id_Cliente;

    public function __construct(){
        $this->id_Venta = null;
        $this->metodoPago = "";
        $this->tipo = "";
        $this->total = null;
        $this->fechaVenta = "";
        $this->id_Empleado = null;
        $this->id_Cliente = null;
    }

    public function setId_Venta($id_Venta){
        $this->id_Venta=$id_Venta;

    }

    public function getId_Venta(){
        return $this->id_Venta;
    }

    public function setMetodoPago($metodoPago){
        $this->metodoPago=$metodoPago;

    }
    
    public function getMetodoPago(){
        return $this->metodoPago;
    }

    public function setTipo($tipo){
        $this->tipo=$tipo;

    }
    
    public function getTipo (){
        return $this->tipo;

    }

    public function setTotal($total){
        $this->total=$total;

    }
    
    public function getTotal(){
        return $this->total;

    }

    public function setFechaVenta($fechaVenta){
        $this->fechaVenta=$fechaVenta;

    }
    
    public function getFechaVenta(){
        return $this->fechaVenta;

    }

    public function setId_Empleado($id_Empleado){
        $this->id_Empleado=$id_Empleado;

    }
    
    public function getId_Empleado(){
        return $this->id_Empleado;

    }

    public function setId_Cliente($id_Cliente){
        $this->id_Cliente=$id_Cliente;

    }
    
    public function getId_Cliente(){
        return $this->id_Cliente;

    }

}

class VentaPresencial extends Venta{
    private $id_Venta;
    //aqui tiene que ir el codigo presencial

    public function __construct(){
        parent::__construct();
        $this->id_Venta=null;
    }

    public function setId_VentaP($id_Venta){
        $this->id_Venta=$id_Venta;
    }

    public function geId_VentaP(){
        return $this->id_Venta;
    }


}

class VentaOnline extends Venta{
    private $id_VentaO;
    private $dirreccionEnvio;
    private $fechaEntrega;
    private $estatus;
    
    public function __construct(){
        parent::__construct();
        $this->id_Venta=null;
        $this->dirreccionEnvio="";
        $this->fechaEntrega="";
        $this->estatus="";
    }

    public function setId_VentaOnline($id_VentaO){
        $this->id_VentaO=$id_VentaO;
    }

    public function getId_VentaOnline(){
        return $this->id_VentaO;
    }

    public function setDirreccionEnvio ($dirreccionEnvio){
        $this->dirreccionEnvio=$dirreccionEnvio;
    }

    public function getDirreccionEnvio (){
        return $this->dirreccionEnvio;
    }

    public function setFechaEntrega ($fechaEntrega){
        $this->fechaEntrega=$fechaEntrega;
    }

    public function getFechaEntrega (){
        return $this->fechaEntrega;
    }

    public function setEstatus ($estatus){
        $this->estatus=$estatus;
    }

    public function getEstatus (){
        return $this->estatus;
    }
}

class Tiene{
    private $id_Venta;
    private $id_Producto;
    
    public function __construct(){
        $this->id_Venta=null;
        $this->id_Producto=""; 
    }

    public function setId_Venta($id_Venta){
        $this->id_Venta=$id_Venta;
    }

    public function getId_Venta(){
        return $this->id_Venta;
    }

    public function setId_Producto($id_Producto){
        $this->id_Producto=$id_Producto;
    }

    public function getId_Producto(){
        return $this->id_Producto;
    }
}

?>