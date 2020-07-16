<?php  include("barraAdmin.php") ?>
    
      <div class="container">
        <!-- Barra de busqueda -->
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <form action="">
                    <select class="form-control mt-2" name="" id="">
                        <option value="">Filtrar por...</option>
                        <option value="">Nombre del Proveedor</option>
                        <option value="">Categoria</option>
                        <option value="">Subcategoria</option>
                    </select>
                
                </form>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
            
                <form class="form-inline">

                  <input class="form-control mt-2 ml-3 w-75" type="text" placeholder="Buscar Proveedor..."
                    aria-label="Search">
                 <button type="submit" class="btn mt-2"><img src="../img/lupaUser32.png" alt="imagen lupa"></button>
                </form>       
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3">
                <button class="btn btn-success mt-2">Registrar un Nuevo Proveedor</button>
            </div>
        </div>
         <!-- termina Barra de busqueda -->
         <div class="col-sm-12 col-md-12 col-lg-12">
            <table border=1 class="mt-5 table">
                <tr>
                    <td class="text-center"><b>Id</b></td>
                    <td class="text-center"><b>Nombre Proveedor</b></td>
                    <td class="text-center"><b>Nombre Agente</b></td>
                    <td class="text-center"><b>Teléfono</b></td>
                    <td class="text-center"><b>Acción<b></td>
                    
                </tr> 
        </div>
            </table>
      </div>


    
<!-- Cierra el contenido de la pagina con la barra de navegacion-->    
    </div>
</div> 
    