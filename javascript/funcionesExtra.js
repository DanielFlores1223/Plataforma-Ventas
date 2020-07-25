function mostrarSpinner(nombreDiv) {
    document.getElementById(nombreDiv).innerHTML = "<div class='spinner-border text-warning' role='status'><span class='sr-only'>Loading...</span></div>";
}

function mostrarFormPass(nombreDiv) {
    document.getElementById(nombreDiv).innerHTML = "<input type='password' name='pass1' class='form-control' placeholder='Ingrese la nueva contraseña' required minlength='6' title='minimo 6 caracteres'> " +
        " <input type='password' name='pass2' class='form-control mt-2' placeholder='Ingrese de nuevo la nueva contraseña' required minlength='6' title='minimo 6 caracteres'>" +
        "<input type='button' name='btnCancel' onclick=cancelarCambioPass(" + "'formPass'" + ") value='Cancelar modificación' class='form-control mt-2 btn btn-secondary'>";
}

function cancelarCambioPass(nombreDiv) {
    document.getElementById(nombreDiv).innerHTML = "<button type='button'  name='btnActContra' class='btn btn-secondary form-control' onclick=mostrarFormPass('formPass')> Cambiar contraseña </button>";
}

function mostrarFormFoto(nombreDiv) {
    document.getElementById(nombreDiv).innerHTML = '<input type="file" name="foto" class="form-control-file" accept="image/*" required> ' +
        "<input type='button' name='btnCancelFoto' onclick=cancelarCambioFoto(" + "'formFoto'" + ") value='Cancelar modificación' class='form-control mt-2 btn btn-secondary'>";;
}

function cancelarCambioFoto(nombreDiv) {
    document.getElementById(nombreDiv).innerHTML = "<button type='button' name='btnActFoto' class='btn btn-secondary form-control' onclick=mostrarFormFoto('formFoto')> Cambiar Foto </button>";
}