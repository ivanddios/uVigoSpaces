//COMPROBACIONES JS EN CASTELLANO
function nif(dni) {
    var numero
    var letr
    var letra
    var expresion_regular_dni

    expresion_regular_dni = /^\d{8}[a-zA-Z]$/;

    if (expresion_regular_dni.test(dni) == true) {
        numero = dni.substr(0, dni.length - 1);
        letr = dni.substr(dni.length - 1, 1);
        numero = numero % 23;
        letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
        letra = letra.substring(numero, numero + 1);
        if (letra != letr.toUpperCase()) {
            alert('Dni erróneo, la letra del NIF no se corresponde');
            return false;
        } else {

            return true;
        }
    } else {
        alert('Dni erroneo, formato no válido');
        return false;
    }
}
function validaCCC(val) {
    var banco = val.substring(0, 4);
    var sucursal = val.substring(4, 8);
    var dc = val.substring(8, 10);
    var cuenta = val.substring(10, 20);
    var CCC = banco + sucursal + dc + cuenta;
    if (!/^[0-9]{20}$/.test(banco + sucursal + dc + cuenta)) {
        return false;
    } else
    {
        valores = new Array(1, 2, 4, 8, 5, 10, 9, 7, 3, 6);
        control = 0;
        for (i = 0; i <= 9; i++)
            control += parseInt(cuenta.charAt(i)) * valores[i];
        control = 11 - (control % 11);
        if (control == 11)
            control = 0;
        else if (control == 10)
            control = 1;
        if (control != parseInt(dc.charAt(1))) {
            return false;
        }
        control = 0;
        var zbs = "00" + banco + sucursal;
        for (i = 0; i <= 9; i++)
            control += parseInt(zbs.charAt(i)) * valores[i];
        control = 11 - (control % 11);
        if (control == 11)
            control = 0;
        else if (control == 10)
            control = 1;
        if (control != parseInt(dc.charAt(0))) {
            return false;
        }
        return true;
    }
}
function validarEmail(email) {
    expr = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if (!expr.test(email)) {
        return false;
    } else {
        return true;
    }
}

function validarFechaMenorActual(date) {
    var x = new Date();
    var fecha = date.split("-");

    x.setFullYear(fecha[0], fecha[1] - 1, fecha[2]);

    var today = new Date();

    if (x >= today)
        return false;
    else
        return true;
}
function valida_envia_ROL() {

    if (document.form.ROL_NOM.value.length == 0) {
        alert("Introduzca un valor para el nombre");
        document.form.ROL_NOM.focus();
        return false;
    }
    if (document.form.ROL_NOM.value.length < 2) {
        alert("Nombre del rol demasiado corto (min 2 caracteres)");
        document.form.ROL_NOM.focus();
        return false;
    }
    if (document.form.ROL_NOM.value.length > 25) {
        alert("Nombre del rol demasiado largo (max 25 caracteres)");
        document.form.ROL_NOM.focus();
        return false;
    }
    return true;

}
function valida_envia_FUNCIONALIDAD() {

    if (document.form.FUNCIONALIDAD_NOM.value.length == 0) {
        alert("Introduzca un valor para el nombre");
        document.form.FUNCIONALIDAD_NOM.focus();
        return false;
    }
    if (document.form.FUNCIONALIDAD_NOM.value.length < 2) {
        alert("Nombre de la funcionalidad demasiado corto (min 2 caracteres)");
        document.form.FUNCIONALIDAD_NOM.focus();
        return false;
    }
    if (document.form.FUNCIONALIDAD_NOM.value.length > 50) {
        alert("Nombre de la funcionalidad demasiado largo (max 50 caracteres)");
        document.form.FUNCIONALIDAD_NOM.focus();
        return false;
    }
    return true;

}
function valida_envia_PAGINA() {

    if (document.form.PAGINA_NOM.value.length == 0) {
        alert("Introduzca un valor para el nombre");
        document.form.PAGINA_NOM.focus();
        return false;
    }
    if (document.form.PAGINA_NOM.value.length < 2) {
        alert("Nombre de la página  demasiado corto (min 2 caracteres)");
        document.form.PAGINA_NOM.focus();
        return false;
    }
    if (document.form.PAGINA_NOM.value.length > 25) {
        alert("Nombre de la página demasiado largo (max 25 caracteres)");
        document.form.PAGINA_NOM.focus();
        return false;
    }
    return true;

}

//Nombramos la función
function valida_envia_USUARIO() {
    if (document.form.USUARIO_USER.value.length == 0) {
        alert("Introduzca un valor para el usuario");
        document.form.USUARIO_USER.focus();
        return false;
    }
    if (document.form.USUARIO_USER.value.length < 2) {
        alert("Nombre de usuario demasiado corto (mínimo 2 caracteres)");
        document.form.USUARIO_USER.focus();
        return false;
    }
    if (document.form.USUARIO_USER.value.length > 25) {
        alert("Nombre de usuario demasiado largo (máximo 25 caracteres)");
        document.form.USUARIO_USER.focus();
        return false;
    }

    if (document.form.USUARIO_PASSWORD.value.length == 0) {
        alert("Introduzca un valor para la contraseña");
        document.form.USUARIO_PASSWORD.focus();
        return false;
    }

    if (document.form.USUARIO_PASSWORD.value.length < 2) {
        alert("Contraseña demasiado corta (mínimo 2 caracteres)");
        document.form.USUARIO_PASSWORD.focus();
        return false;
    }

    if (document.form.USUARIO_PASSWORD.value.length > 32) {
        alert("Contraseña demasiado larga (máximo 32 caracteres)");
        document.form.USUARIO_PASSWORD.focus();
        return false;
    }

//Validamos un campo o área de texto, por ejemplo el campo nombre
    if (document.form.USUARIO_NOMBRE.value.length == 0) {
        alert("Introduzca un valor para el nombre");
        document.form.USUARIO_NOMBRE.focus();
        return false;
    }
    if (document.form.USUARIO_NOMBRE.value.length < 2) {
        alert("Nombre demasiado corto (mínimo 2 caracteres)");
        document.form.USUARIO_NOMBRE.focus();
        return false;
    }
    if (document.form.USUARIO_NOMBRE.value.length > 25) {
        alert("Nombre demasiado largo (máximo 25 caracteres)");
        document.form.USUARIO_NOMBRE.focus();
        return false;
    }


    if (document.form.USUARIO_APELLIDO.value.length == 0) {
        alert("Introduzca un valor para el apellido");
        document.form.USUARIO_APELLIDO.focus();
        return false;
    }
    if (document.form.USUARIO_APELLIDO.value.length < 2) {
        alert("Apellido demasiado corto (mínimo 2 caracteres)");
        document.form.USUARIO_APELLIDO.focus();
        return false;
    }
    if (document.form.USUARIO_APELLIDO.value.length > 50) {
        alert("Apellido demasiado largo (máximo 50 caracteres)");
        document.form.USUARIO_APELLIDO.focus();
        return false;
    }



    if (!nif(document.form.USUARIO_DNI.value)) {
        document.form.USUARIO_DNI.focus();
        return false;
    }

    if (document.form.USUARIO_FECH_NAC.value == false) {
        alert("Introduzca un valor  para la fecha de nacimiento");
        document.form.USUARIO_FECH_NAC.focus();
        return false;
    }
    if (!validarFechaMenorActual(document.form.USUARIO_FECH_NAC.value)) {
        alert("¿Viene del futuro?");
        document.form.USUARIO_FECH_NAC.focus();
        return false;
    }
    if (((document.form.USUARIO_EMAIL.value.length == 0) || !validarEmail(document.form.USUARIO_EMAIL.value))) {
        alert("Introduzca una dirección de email válida");
        document.form.USUARIO_EMAIL.focus();
        return false;
    }
    valor = document.form.USUARIO_TELEFONO.value;
    if (!(/^\d{9}$/.test(valor))) {
        alert("Tiene que escribir un teléfono de 9 dígitos");
        document.form.USUARIO_TELEFONO.focus();
        return false;
    }

    if (document.form.USUARIO_CUENTA.value.length == 0 || !validaCCC(document.form.USUARIO_CUENTA.value)) {
        alert("Introduzca un valor correcto para el numero de CCC(sin espacios)");
        document.form.USUARIO_CUENTA.focus();
        return false;
    }




    if (document.form.USUARIO_DIRECCION.value.length == 0) {
        alert("Introduzca dirección");
        document.form.USUARIO_DIRECCION.focus();
        return false;
    }




    return true;

}

function valida_envia_RUBRICA() {
    if (document.form.RUBRICA_NOMBRE.value.length > 25) {
        alert("El tamaño máximo para el nombre de una rúbrica es 25 caracteres");
        document.form.RUBRICA_NOMBRE.focus();
        return false;
    }
      if (document.form.RUBRICA_NOMBRE.value.length == 0) {
        alert("Es necesario darle un nombre a la rúbrica");
        document.form.RUBRICA_NOMBRE.focus();
        return false;
    }
    if (document.form.RUBRICA_DESCRIPCION.value.length > 50) {
        alert("El tamaño máximo para la descripción de una rúbrica es 25 caracteres");
        document.form.RUBRICA_DESCRIPCION.focus();
        return false;
    }
     if (document.form.RUBRICA_NIVELES.value > 10) {
        alert("El tamaño máximo de niveles de una rúbrica es 10");
        document.form.RUBRICA_DESCRIPCION.focus();
        return false;
    }
    if (document.form.RUBRICA_NIVELES.value < 2) {
        alert("El tamaño minimo de niveles de una rúbrica es 2");
        document.form.RUBRICA_DESCRIPCION.focus();
        return false;
    }
    return true;
}

function valida_envia_DOCUMENTACION() {
    if (document.form.DOCUMENTACION_NOM.value.length==0){
        alert("Introduzca un valor para el nombre del documento");
        document.form.DOCUMENTACION_NOM.focus();
        return false;
    }
    if (document.form.DOCUMENTACION_NOM.value.length<2){
        alert("Nombre del documento demasiado corto (mínimo 2 caracteres)");
        document.form.DOCUMENTACION_NOM.focus();
        return false;
    }
    if (document.form.DOCUMENTACION_NOM.value.length > 25) {
        alert("El tamaño máximo para el nombre de un documento es de 25 caracteres");
        document.form.DOCUMENTACION_NOM.focus();
        return false;
    }
   
   
    if (document.form.DOCUMENTACION_CATEGORIA.value.length > 25) {
        alert("El tamaño máximo para el nombre de una categoría es de 25 caracteres");
        document.form.DOCUMENTACION_CATEGORIA.focus();
        return false;
    }
    
    return true;
}


function valida_envia_ENTREGA(){
    if (document.form.ENTREGA_NOMBRE.value.length==0){
        alert("Introduzca un valor para el nombre de la entrega");
        document.form.ENTREGA_NOMBRE.focus();
        return false;
    }
    if (document.form.ENTREGA_NOMBRE.value.length<2){
        alert("Nombre de la entrega demasiado corto (mínimo 2 caracteres)");
        document.form.ENTREGA_NOMBRE.focus();
        return false;
    }
    if (document.form.ENTREGA_NOMBRE.value.length>25){
        alert("Nombre de la entrega demasiado largo (máximo 25 caracteres)");
        document.form.ENTREGA_NOMBRE.focus();
        return false;
    }

    if (document.form.ENTREGA_ID.value==false){
        alert("Introduzca un valor para el id de la entrega");
        document.form.ENTREGA_ID.focus();
        return false;
    }



    if (document.form.ENTREGA_TRABAJO.value==false){
        alert("Introduzca un valor para el id del trabajo");
        document.form.ENTREGA_TRABAJO.focus();
        return false;
    }


    if (document.form.ENTREGA_ALUMNO.value==false){
        alert("Introduzca un valor para el id del alumno");
        document.form.ENTREGA_ALUMNO.focus();
        return false;
    }


    if(document.form.ENTREGA_FECHA.value==false){
        alert("Introduzca un valor  para la fecha de entrega");
        document.form.ENTREGA_FECHA.focus();
        return false;
    }

    if(document.form.ENTREGA_HORA.value==false){
        alert("Introduzca un valor  para la hora de entrega");
        document.form.ENTREGA_HORA.focus();
        return false;
    }

    if(document.form.ENTREGA_HORAS_DEDIC.value==false){
        alert("Introduzca un valor  para las horas dedicadas a la realización de la entrega");
        document.form.ENTREGA_HORAS_DEDIC.focus();
        return false;
    }




    return true;
}

function valida_envia_ITEM() {
    if (document.form.ITEM_NOMBRE.value.length > 30) {
        alert("El tamaño máximo para el nombre de un item es 30 caracteres");
        document.form.ITEM_NOMBRE.focus();
        return false;
    }
      if (document.form.ITEM_NOMBRE.value.length == 0) {
        alert("Es necesario darle un nombre a al titulo del item");
        document.form.ITEM_NOMBRE.focus();
        return false;
    }
    if (document.form.ITEM_PORCENTAJE.value.length > 100) {
        alert("El valor maximo del item es 100");
        document.form.ITEM_PORCENTAJE.focus();
        return false;
    }
     if (document.form.ITEM_PORCENTAJE.value == 0) {
        alert("El item debe poseer algun valor");
        document.form.ITEM_PORCENTAJE.focus();
        return false;
    }
    
        valor = document.form.ITEM_PORCENTAJE.value;
    if (!/^([0-9])*$/.test(valor)) {
        alert("Tiene que escribir un valor entre 0-100");
        document.form.ITEM_PORCENTAJE.focus();
        return false;
    }
    
    if (parseInt(document.form.ITEM_PORCENTAJE.value) + parseInt(document.form.ITEM_SUM.value) > 100) {
        alert("La suma de los items de la rubrica debe de ser 100 como máximo. ");
        document.form.ITEM_PORCENTAJE.focus();
        return false;
    }
    
    return true;
}


function valida_envia_NIVEL() {
    if (document.form.NIVEL_DESCRIPCION.value.length > 1000) {
        alert("El tamaño máximo para la descripcion de un nivel es 1000 caracteres");
        document.form.NIVEL_DESCRIPCION.focus();
        return false;
    }
      if (document.form.NIVEL_DESCRIPCION.value.length == 0) {
        alert("Es necesario darle una descripcion al item");
        document.form.NIVEL_DESCRIPCION.focus();
        return false;
    }
    if (document.form.NIVEL_PORCENTAJE.value.length > 100) {
        alert("El valor maximo del item es 100");
        document.form.NIVEL_PORCENTAJE.focus();
        return false;
    }
     if (document.form.NIVEL_PORCENTAJE.value == 0) {
        alert("El item debe poseer algun valor");
        document.form.NIVEL_PORCENTAJE.focus();
        return false;
    }
    
    valor = document.form.NIVEL_PORCENTAJE.value;
    if (!/^([0-3])*$/.test(valor)) {
        alert("Tiene que escribir un valor entre 0-100");
        document.form.NIVEL_PORCENTAJE.focus();
        return false;
    }
    
    if (parseInt(document.form.NIVEL_PORCENTAJE.value) > 100) {
        alert("El maximo valor del nivel es 100");
        document.form.NIVEL_PORCENTAJE.focus();
        return false;
    }
    
    return true;
}

/*function valida_envia_TRABAJO() {
    if (document.form.TRABAJO_NOMBRE.value.length > 25) {
        alert("El tamaño máximo para el nombre de un trabajo es 25 caracteres");
        document.form.TRABAJO_NOMBRE.focus();
        return false;
    }
    if (document.form.TRABAJO_NOMBRE.value.length == 0) {
        alert("Es necesario darle un nombre al trabajo");
        document.form.TRABAJO_NOMBRE.focus();
        return false;
    }
    if (document.form.TRABAJO_DESCRIPCION.value.length > 50) {
        alert("El tamaño máximo para la descripción de un trabajo es 25 caracteres");
        document.form.TRABAJO_DESCRIPCION.focus();
        return false;
    }
    return true;
}*/

