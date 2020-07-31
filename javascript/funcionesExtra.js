function mostrarSpinner(nombreDiv) {
    document.getElementById(nombreDiv).innerHTML = "<div class='spinner-border text-warning' role='status'><span class='sr-only'>Loading...</span></div>";
}

function mostrarFormPass(nombreDiv) {
    document.getElementById(nombreDiv).innerHTML = "<input type='password' name='pass1' class='form-control' placeholder='Ingrese la nueva contraseña' required minlength='6' title='minimo 6 caracteres'> " +
        " <input type='password' name='pass2' class='form-control mt-2' placeholder='Ingrese de nuevo la nueva contraseña' required minlength='6' title='minimo 6 caracteres'>" +
        "<input type='button' name='btnCancel' onclick=cancelarCambioPass(" + "'formPass'" + ") value='Cancelar' class='form-control mt-2 btn  btn-warning'>";
}

function cancelarCambioPass(nombreDiv) {
    document.getElementById(nombreDiv).innerHTML = "<button type='button'  name='btnActContra' class='btn btn-primary form-control' onclick=mostrarFormPass('formPass')> Cambiar contraseña </button>";
}

function mostrarFormFoto(nombreDiv) {
    document.getElementById(nombreDiv).innerHTML = '<input type="file" name="foto" class="form-control-file mt-1" accept="image/*" required> ' +
        "<input type='button' name='btnCancelFoto' onclick=cancelarCambioFoto(" + "'formFoto'" + ") value='Cancelar' class='form-control mt-2 btn btn-warning'>";;
}

function cancelarCambioFoto(nombreDiv) {
    document.getElementById(nombreDiv).innerHTML = "<button type='button' name='btnActFoto' class='btn btn-primary form-control' onclick=mostrarFormFoto('formFoto')> Cambiar Foto </button>";
}

function mostrarSubcat(valor, nombreDiv) {
    switch (valor) {
        case 'Alimentos':
            document.getElementById(nombreDiv).innerHTML = '<select name="subCategoria" id="" class="form-control">' +
                '<option value="Quesos y Lacteos">Quesos y Lacteos</option>' +
                '<option value="Carnes frias y Embutidos">Carnes frias y Embutidos</option>' +
                '<option value="Bebidas y Frituras">Bebidas y Frituras</option>' +
                '<option value="Reposteria">Reposteria</option>' +
                '</select>';
            break;

        case 'Abarrotes':
            document.getElementById(nombreDiv).innerHTML = '<select name="subCategoria" id="" class="form-control">' +
                '<option value="Hogar y Limpieza">Hogar y Limpieza</option>' +
                '<option value="Salud y Cuidado Personal">Salud y Cuidado Personal</option>' +
                '<option value="Semillas y Cereales">Semillas y Cereales</option>' +
                '<option value="Productos diversos">Productos diversos</option>' +
                '</select>';
            break;

        case 'Servicios':

            break;

        default:
            break;
    }
}