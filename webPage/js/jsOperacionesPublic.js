/* global tarifario, CONTROLLERPUBLIC, alertify */

$(document).ready(function() {
    choices = [];
    procedures = [];
    specialization = [];
    servicios = [];
    minorProcedure = [];
    arrayOcupaciones = [];
});

function conxecutivoDocumentos(input, tipoConsecutivo) {
    var ur = CONTROLLERPUBLIC;
    var op = 20;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op,
            tipoConsecutivo: tipoConsecutivo
        }),
        success: function(data) {
            var ret = eval('(' + data + ')');
            try {
                $("#" + input).val(ret[0].consecutivo);
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function desglosarCadenasPublic(cadena) {
    var codigos = new Array();
    var isCodigos = true;
    var armarCadenaCodigo = "";
    var armarCadenaDescripcion = "";
    for (var i = 0; i < cadena.length; i++) {
        var caracter = cadena.charAt(i);
        if (caracter === "|") {
            isCodigos = false;
        }
        if (isCodigos) {
            armarCadenaCodigo += armarCadenaCodigo = caracter;
        } else {
            if (caracter !== "|") {
                armarCadenaDescripcion += armarCadenaDescripcion = caracter;
            }
        }
    }
    codigos.push({ codigo: armarCadenaCodigo, descripcion: armarCadenaDescripcion });
    return codigos;
}

function cambiarContrasena() {
    var contraActual = $("#txtContrasenaAnterior").val();
    var contrasenaNueva = $("#txtContrasenaNueva").val();
    var confirmarContrasena = $("#txtConfirmarContraena").val();
    if (contraActual.length === 0) {
        alertify.error("La contraseña actual no puede quedar vacia.");
    } else if (contrasenaNueva.length === 0) {
        alertify.error("La contraseña nueva no puede quedar vacia.");
    } else if (confirmarContrasena.length === 0) {
        alertify.error("Es necesario confirmar la contraseña.");
    } else {
        if (contraActual !== contrasenaNueva) {
            if (contrasenaNueva === confirmarContrasena) {
                var ur = CONTROLLERPUBLIC;
                var op = 33;
                $.ajax({
                    type: "POST",
                    url: ur,
                    data: ({
                        op: op,
                        contraActual: contraActual,
                        contrasenaNueva: contrasenaNueva,
                        confirmarContrasena: confirmarContrasena

                    }),
                    success: function(data) {
                        try {
                            var ret = eval('(' + data + ')');
                            if (ret.hasOwnProperty("success")) {
                                location.href = "/nomina/php_cerrar";
                            } else if (ret.hasOwnProperty("mensaje")) {
                                alertify.error(ret.mensaje);
                            }
                        } catch (e) {}
                    },
                    error: function(objeto, error, error2) {
                        alertify.alert(error);
                    }
                });
            } else {
                alertify.error("La contraseña nueva no coincide con la confirmacion");
            }
        } else {
            alertify.error("La contraseña nueva no puede ser igual a la anterior.");
        }
    }
}

//===========================FUNCIONES ======================
function filtrarDatos(txtInput, txtTabla) {

    $("#" + txtInput).on('keyup', function() {
        var string = new RegExp(this.value, 'i');
        $('.' + txtTabla).each(function() {
            if (string.test(this.innerHTML))
                $(this).show();
            else
                $(this).hide();
        });
    });
}
var filaSelCel = [undefined];

function colorCeltaTabla(celda, index, fila) {

    try {
        if (filaSelCel[index] !== undefined) {
            filaSelCel[index].style.backgroundColor = "transparent";
        }
    } catch (e) {}
    celda.style.backgroundColor = "rgb(168, 204, 236)";
    filaSelCel[index] = celda;
}

function quitarEspacios(idCampo) {
    $("#" + idCampo).val($("#" + idCampo).val().trim());
}