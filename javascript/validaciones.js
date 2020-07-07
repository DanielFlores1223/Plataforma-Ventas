function validarVacioLogin(comp1, comp2, nombreDiv) {
    if (comp1.value != "" && comp2.value != "") {
        return true;
    } else {
        document.getElementById(nombreDiv).innerHTML = "<div class='alert alert-danger text-center' role='alert'>No se debe dejar ningun campo vacio!</div>";
        desactivarSpinner('spinnerLogin');
        return false;
    }

}

function desactivarSpinner(nombreDivSpinner) {
    document.getElementById(nombreDivSpinner).innerHTML = "";
}

function soloLetras(evento) {
    key = evento.KeyCode || evento.which;
    tecla = String.fromCharCode(key).toLocaleLowerCase();
    letras = "abcdefghijklmnñopqrstuvwxyzáéíóú";
    especiales = [32, 8, 239];

    tecla_especial = false;
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;

    } else {
        return true;
    }
}


function soloNumeros(evento) {
    key = evento.KeyCode || evento.which;
    tecla = String.fromCharCode(key).toLocaleLowerCase();
    numeros = "1234567890";
    especiales = [8];

    tecla_especial = false;
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (numeros.indexOf(tecla) == -1) {
        return false;

    } else {
        return true;
    }

}

function validarTelefono(evento) {
    key = evento.KeyCode || evento.which;
    tecla = String.fromCharCode(key).toLocaleLowerCase();
    letras = "1234567890";
    especiales = [8, 45];

    tecla_especial = false;
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {

        return false;

    } else {
        return true;
    }
}

function validarEdad() {
    edad1 = document.form1.edad.value;
    if (edad1.length <= 3) {

    } else {
        alert("La edad es invalida.");
        document.form1.edad.focus();

    }
}