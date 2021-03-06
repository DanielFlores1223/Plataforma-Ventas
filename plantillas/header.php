<script src="javascript/validaciones.js"></script>
<script src="javascript/funcionesExtra.js"></script>

<div class="estilo-header">
<nav class="navbar navbar-expand-lg navbar-light" style="background:rgb(238, 238, 238);">
  <a class="navbar-brand pb-1 pt-1" href="index.php"> <img src="img/logo_crem_adap.png" alt="logo cremeria liz"> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="nosotros.php">Nosotros</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Productos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          
          <a class="dropdown-item" href="alimentos.php?c=Al&pagina=1">Alimentos</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="abarrotes.php?c=Ab&pagina=1">Abarrotes</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item " href="servicios.php">Servicios</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="contacto.php">Contacto</a>
      </li>
    </ul>
 
    <ul class="navbar-nav ">
    <div class="row align-items-center mr-3">
        <li class="nav-item">
            <img src="img/usario_header.png" alt="">
        </li>
    
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#modalRegistro">Registrarse</a>
        </li>
    </div>
    <div class="row align-items-center">
        <li class="nav-item">
            <img src="img/ingreso.png" alt="">
        </li>
    
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#modalInicioSesion">Iniciar Sesión</a>
        </li>
    </div>
    </ul>
  </div>
</nav>
</div>

<!-- Modal registro -->

<div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div style="background:rgb(238, 238, 238);">
      <div class="modal-header"  style="background:rgb(238, 238, 238);">
        <div class="mr-3">
          <img src="img/usario_header.png" alt="">
        </div>
          <h5 class="modal-title" id="modalRegistro">  Registro cliente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        </div>
        <div class="modal-body">
        <div class="row">
          <div class="col-4">
            <img src="img/logo_crem_adap.png" alt="logo cremeria liz">
          </div>
          <div class="col-8">
            <p class="text-center alert alert-warning">Ingresa la información que se solicita.<p>
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-patch-exclamation-fll" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.553.553 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
            </svg> 
            <b>Campos obligatorios</b>
          </div>
       </div>
      <hr>
        <!-- Formulario de registro  -->
        <?php if(isset($_GET['action'])){
          if($_GET['action']=='Registrado'){ ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            Se Registro al cliente <strong>Correctamente!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('index.php');">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <?php }else if($_GET['action']=='fail'){ ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Inicie Sesion!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('index.php');">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>

          <?php }elseif ($_GET['action']=='failcorreo') {
          ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Correo sospechoso</strong> Ingrese un correo valido.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('index.php');">
                <span aria-hidden="true">&times;</span>
              </button>
           </div>
         <?php
          }
        }?>
        <form action='controlador/signup.php' method="POST" onsubmit="mostrarSpinner('spinnerReg')">
          <p >
            Nombre completo
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-patch-exclamation-fll" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.553.553 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
            </svg>   
          </p>
          <div class="form-row">
              <div class="col">
                <input type="text" 
                       name="nombre" 
                       class="form-control" 
                       placeholder="Nombre(s)" 
                       onkeypress="return soloLetras(event)"
                       required
                       maxlength='50' 
                       title='minimo 50 caracteres'
                >
                
              </div>
              <div class="col">
                <input type="text" 
                       name="a_pat" 
                       class="form-control" 
                       placeholder="Apellido Paterno" 
                       onkeypress="return soloLetras(event)"
                       required
                       maxlength='50' 
                       title='minimo 50 caracteres'
              >
              </div>
              <div class="col">
                <input type="text" 
                       name="a_mat" 
                       class="form-control" 
                       placeholder="Apellido Materno" 
                       onkeypress="return soloLetras(event)"
                       required
                       maxlength='50' 
                       title='minimo 50 caracteres'
                >
              </div>
          </div>
          <br>
          <div class="form-row">
              <div class="col-4">
                 <p>
                    Fecha de nacimiento 
                 </p>
              </div>
              <div class="col-7">
                <input type="date" 
                       name="fechaNac" 
                       class="form-control" 
                       placeholder="fecha de nacimiento"
                       required
                >
              </div>
              <div class="col-1">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-patch-exclamation-fll" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.553.553 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
            </svg> 
              </div>
          </div>
          <div class="form-row mt-2">
              <div class="col-4">
                 <p >
                    Teléfono ó movil                
                 </p>
              </div>
              <div class="col-7">
                <input type="text" 
                       name="telefono" 
                       class="form-control" 
                       placeholder="Ejem. 33-33-33-33-33" 
                       onkeypress="return validarTelefono(event)"
                       maxlength = "14"
                       minlength = "14"
                       required 
                       title="maximo 14 caracteres"
                > 
              </div>
              <div class="col-1">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-patch-exclamation-fll" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.553.553 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                </svg> 
              </div>
          </div>
          <hr>
          <p >
            Registro de cuenta
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-patch-exclamation-fll" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.553.553 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
            </svg> 
          </p>
          <div class="form-row">
              <div class="col">
                <input type="email" 
                       name="correo" 
                       class="form-control" 
                       placeholder="Correo"
                       required
                       maxlength='50' 
                       title='minimo 50 caracteres'
              >
              </div>
              <div class="col">
                <input type="password" 
                       name="contra" 
                       class="form-control" 
                       placeholder="Contraseña"
                       required
                       minlength='6' 
                       title='minimo 6 caracteres'
                >
              </div>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" name="signup-button">Registrarse</button>
            <div id="spinnerReg"></div>
          </div>
        </form>
        <!-- termina Formulario de registro  -->
      </div>
    </div>
  </div>
</div>

<!-- Modal Inicio de sesion -->
<div class="modal fade" id="modalInicioSesion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"  style="background:rgb(238, 238, 238);">
      <div class="mr-3">
      <img src="img/ingreso.png" alt="">
      </div>
        <h5 class="modal-title" id="modalInicioSesion">Inicio de sesión</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
            <img src="img/logo_crem_adap.png" alt="logo cremeria liz">
        </div>
       <!-- Formulario de login  -->
       <!--<form id="formLogin" name="formLogin" action="controlador/login.php" method="POST" onsubmit="return validarVacioLogin(pass,correo,'validacionLogin')">-->
       <form id="formLogin" onsubmit="return validaLogin('validacionLogin')">
          <div id="validacionLogin" class="mt-2"></div>

         <div class="form-row mt-3 mr-2">
        
              <div class="col-2 text-center">
                <label for="correo"> <img src="img/correo_icono.png" alt=""> </label>
              </div>
              <div class="col-10">
                <input type="email" 
                       name="correo" 
                       class="form-control" 
                       aria-describedby="emailHelp" 
                       placeholder="Ingrese su correo eléctronico"
                >
              </div>
         </div>   
         <div class="form-row mt-3 mr-2">
              <div class="col-2 text-center">
                <label for="pass"> <img src="img/pass_icono.png" alt="icono contraseña"> </label>
              </div>
              <div class="col-10 mb-3">
                <input type="password" 
                       name="pass" 
                       class="form-control"  
                       placeholder="Ingrese su contraseña"
                >
                <div id="alertaPass"></div>
              </div>
          </div>
          <div class="modal-footer">
          <div class="m-auto">
             <div id="spinnerLogin" class="text-center"></div>
             <br>
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
             <button type="submit" class="btn btn-primary" name="loginB" onclick="mostrarSpinner('spinnerLogin')">Iniciar Sesión</button></div>
             
           </div>
        </form>
        <small class="form-text text-muted text-center">¿No tienes cuenta? <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#modalRegistro"><span aria-hidden="true">Registrarse</span></a> </small>     
       
        

       <!-- termina Formulario de login  -->
      </div>
      <!--de aqui quite los botones-->
    </div>
  </div>
</div>