$(document).ready(function() {
    visualizarEmpleados();
    listarTipoAnexo('cmbTipoAnexo');

    $("#btnGuardar").click(function() {
        validarCampos();
    });
});

var listadoEmpleados = "";

function visualizarEmpleados() {
    $("#tboBodyEmpleado").html("<label style='float:left; margin-left:249%; margin-top:15%; font-size:11px;'>Cargando...</label><div class='lds-dual-ring' style='float:left; margin-top:%; margin-left:249%; width:5%;'></div>");
    var ur = CONTROLER_INSANEXOS;
    var op = 1;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op
        }),
        success: function(data) {
            var ret = eval('(' + data + ')');
            listadoEmpleados = ret;
            try {
                $("#tboBodyEmpleado").html('');
                var listarEmpleado = $("#tboBodyEmpleado");
                $("#tboBodyEmpleado").append(listarEmpleado);
                for (var i = 0; i < ret.length; i++) {
                    var tr = $("<tr class='tblFiltradoFondo' style='cursor:pointer' onclick =\"obtenerDatosEmpleados('" + i + "')\"></tr>");
                    listarEmpleado.append(tr);
                    var td = $("<td>" + ret[i].NUMDOCUMENTO + "</td>");
                    tr.append(td);
                    var td = $("<td>" + ret[i].NOMBREYAPELLIDO + "</td>");
                    tr.append(td);
                    var td = $("<td>" + ret[i].NUM_CONTRATO + "</td>");
                    tr.append(td);
                    var td = $("<td>" + ret[i].CENTRO_COSTO + "</td>");
                    tr.append(td);
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    })
}

function obtenerDatosEmpleados(index) {
    var idEmpleado = listadoEmpleados[index].ID;
    var contratoId = listadoEmpleados[index].CONTRATO_ID;
    var nombreyapellido = listadoEmpleados[index].NOMBREYAPELLIDO;
    $("#txtIdContrato").val(contratoId);
    $("#txtIdEmpleado").val(idEmpleado);
    $("#txtNombreEmpleado").val(nombreyapellido);
    $("#mdlEmpleados").modal("hide");
}

function listarTipoAnexo(idCombo) {
    var ur = CONTROLER_INSANEXOS;
    var op = 2;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op
        }),
        success: function(data) {
            var ret = eval('(' + data + ')');
            try {
                listarCombo = $("#" + idCombo);
                listarCombo.html('');
                var option = $("<option value=''>Seleccione</option>");
                listarCombo.append(option);
                for (var i = 0; i < ret.length; i++) {
                    var option = $("<option value = " + ret[i].ID + ">" + ret[i].DESCRIPCION + "</option>");
                    listarCombo.append(option);
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function validarCampos() {
    var idEmpleado = $("#txtIdEmpleado").val();
    var idContrato = $("#txtIdContrato").val();
    var tipoAnexo = $("#cmbTipoAnexo").val();
    var nombreAnexo = $("#txtNombreAnexo").val();
    var fechaCaducidad = $("#txtFechaDeCaducidad").val();
    var anexoDocumento = $("#archivo").val();
    var descripcionAnexo = $("#txtDetalle").val();

    if (idEmpleado.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un empleado');
    } else if (tipoAnexo.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione el tipo de anexo');
    } else if (nombreAnexo.length === 0) {
        alertify.alert('Mensaje', 'El nombre de anexo no puede quedar vacio');
    } else if (anexoDocumento.length === 0) {
        alertify.alert('Mensaje', 'Por favor cargar un documento');
    } else {
        $("#frmAnexosIns").submit();
        limpiarCampos();
    }

}

function limpiarCampos() {
    $("#frmAnexosIns")[0].reset();
}