<?php
session_start();
include('../modelo/conexion.php');
include('../modelo/clases.php');

if(isset($_POST['btn']) || isset($_GET['cam'])){
    $obj = new ConexionMySQL("root","");
    $tipo=$_SESSION['tipo'];
    $resp2=false;

    if($_POST['btn']=="guardar"){
        if($_SESSION['tipo']=="CLIENTE"){
            $obj2=new Cliente();
            $obj2->setIdCli($_SESSION['id']);
            $id = $obj2->getIdCli();
            //cambio de contraseña
            if (isset($_GET['cam'])) {
                $obj2->setContra($_POST['pass1']);
                $resp2 = $obj->modificaPass('Cliente',$obj2);
        
            }else{  
                $obj2->setNombre($_POST['nombre']);
                $obj2->setApellidoM($_POST['apellidom']);
                $obj2->setApellidoP($_POST['apellidop']);
                $obj2->setTel($_POST['telefono']);
                $obj2->setFechaNac($_POST['fechnac']);
                $obj2->setCorreo($_POST['correo']);

                $correoSinCambios = $obj->consultaWhereAND('cliente','Id_Cliente',$id, 'Correo', $_POST['correo']);
                 //validacion del cambio de foto
                if(isset($_FILES['foto'])){
                    //insertamos foto del empleado
                    $foto = $_FILES['foto']['name'];
                    $ruta = $_FILES["foto"]["tmp_name"];
                    $destino = "../img/fotoCliente/".$foto;
                    copy($ruta,$destino);
                    $obj2->setFoto($destino);
                
                    $modificacionFoto = $obj->modificaFoto('Cliente', $obj2);
                }
                if($correoSinCambios != false){
                    $resp=$obj->modificaPerfil("Cliente",$obj2);
                }else{
                    //si hay cambios
                    $existeCorreo = $obj->consultaWhereId('empleado','correo', $_POST['correo']);
                    $correoInexistenteC = $obj->consultaWhereId('cliente','correo', $_POST['correo']);
                
                    if($existeCorreo != false || $correoInexistenteC != false){
                        echo "<script>window.location.replace('../cliente/perfilModifica.php?action=Ixcorreo')</script>";
                    }else{
                        //si el nuevo correo no existe en la tabla empleado entonces modifica el correo
                        $resp = $obj->modificaPerfil("Cliente",$obj2);
                        $resp2 = true;
                        }
                }
            
                
            }
        
        }else if($_SESSION['tipo']=="ADMIN"){
            $obj2= new Empleado();
            $obj2->setIdEmpl($_SESSION['idAdmin']);
            $id = $obj2->getIdEmpl();
            //cambio de contraseña
            if (isset($_GET['cam'])) {
                $obj2->setContra($_POST['pass1']);
                $resp2 = $obj->modificaPass('Empleado',$obj2);
        
            }else{  
                //Validar que el correo no se haya modificado para modificar los otros campos.
                $obj2->setNombre($_POST['nombre']);
                $obj2->setApellidoM($_POST['apellidom']);
                $obj2->setApellidoP($_POST['apellidop']);
                $obj2->setTel($_POST['telefono']);
                $obj2->setFechaNac($_POST['fechnac']);
                $obj2->setCorreo($_POST['correo']);

                $correoSinCambios = $obj->consultaWhereAND('empleado','Id_Empleado',$id, 'Correo', $_POST['correo']);

                    if($correoSinCambios != false){
                        $resp=$obj->modificaPerfil("Empleado",$obj2);
                    }else{
                        //si hay cambios
                        $existeCorreo = $obj->consultaWhereId('empleado','correo', $_POST['correo']);
                        $correoInexistenteC = $obj->consultaWhereId('cliente','correo', $_POST['correo']);
                    
                        if($existeCorreo != false || $correoInexistenteC != false){
                            echo "<script>window.location.replace('../administrador/perfilModifica.php?action=Ixcorreo')</script>";
                        }else{
                            //si el nuevo correo no existe en la tabla empleado entonces modifica el correo
                            $resp = $obj->modificaPerfil("Empleado",$obj2);
                            $resp2 = true;
                            }
                    }
                
                }
            
        }else{
            $obj2= new Empleado();   
            $obj2->setIdEmpl($_SESSION['id']);
            $id = $obj2->getIdEmpl();
            if (isset($_GET['cam'])) {
                $obj2->setContra($_POST['pass1']);
                $resp2 = $obj->modificaPass('Empleado',$obj2);
        
            }else{ 
                $obj2->setNombre($_POST['nombre']);
                $obj2->setApellidoM($_POST['apellidom']);
                $obj2->setApellidoP($_POST['apellidop']);
                $obj2->setTel($_POST['telefono']);
                $obj2->setFechaNac($_POST['fechnac']);
                $obj2->setCorreo($_POST['correo']);

                $correoSinCambios = $obj->consultaWhereAND('empleado','Id_Empleado',$id, 'Correo', $_POST['correo']);

                    if($correoSinCambios != false){
                        $resp=$obj->modificaPerfil("Empleado",$obj2);
                    }else{
                        //si hay cambios
                        $existeCorreo = $obj->consultaWhereId('empleado','correo', $_POST['correo']);
                        $correoInexistenteC = $obj->consultaWhereId('cliente','correo', $_POST['correo']);
                    
                        if($existeCorreo != false || $correoInexistenteC != false){
                            echo "<script>window.location.replace('../empleado/perfilModifica.php?action=Ixcorreo')</script>";
                        }else{
                            //si el nuevo correo no existe en la tabla empleado entonces modifica el correo
                            $resp = $obj->modificaPerfil("Empleado",$obj2);
                            $resp2 = true;
                            }
                    }
            }
        }
        
        if($resp==true || $resp2==true){
            if($resp2==true){
                echo "<script>window.location.replace('../controlador/cerrarSesion.php?cam=exito')</script>";
                echo "<script>alert('Cambio de contraseña correcto, vuelve a iniciar sesion')</script>";         
            }

            if($tipo=="CLIENTE"){
                echo "<script>window.location.replace('../cliente/perfil.php?action=Actualizado')</script>";
            }else if($tipo=="ADMIN"){
                echo "<script>window.location.replace('../administrador/perfil.php?action=Actualizado')</script>";
            }else{
                echo "<script>window.location.replace('../empleado/perfil.php?action=Actualizado')</script>";
            }

        }
        else{
            if($tipo=="CLIENTE"){
                echo "<script>window.location.replace('../cliente/perfil.php?action=fail')</script>";
            }else if($tipo=="ADMIN"){
                echo "<script>window.location.replace('../administrador/perfil.php?action=fail')</script>";
            }else{
                echo "<script>window.location.replace('../empleado/perfil.php?action=fail')</script>";
            }
        }
    }
}else{
    echo "No ingreso";
}
 