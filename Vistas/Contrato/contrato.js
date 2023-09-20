$(document).ready(function() {
    visualizarEmpleados();

    listarTipoDocumento('cmbTipoDocumento');
    listarCargos('cmbTipoCargo');
    listarTipoContrato('cmbTipoContrato');
    listarMotivoRetiro('cmbMotivoRetiro');
    listarFormaDePago('cmbFormaDePago');
    listarTipoCotizante('cmbTipoDeCotizante');
    listarArl('cmbArl');
    listarCajaCompensacion('cmbCajaDeCompensacion');
    listarFonCesantia('cmbFondoCesantias');
    ciudadDondeLabora('cmbCiudadDondeLabora');
    listarFondoSalud('cmbFondoDeSalud');
    listarFondoPension('cmbFondoDePension');
    listarBancos('cmbBancos');
    listarTipoDeCuenta('cmbTipoCuentaBancaria');
    listarCentroDeCosto('cmbCentroDeCosto');
    listarTipoAnexo('cmbTipoAnexo');

    $("#cmbArl").change(function(e) {
        var porcArl = $(this).find(":selected").data("item");
        $("#txtPorcentajeArl").val(porcArl);
    });

    $("#cmbFondoDeSalud").change(function(e) {
        var porcSalud = $(this).find(":selected").data("item");
        $("#txtPorcentajeSalud").val(porcSalud);
    });

    $("#cmbFondoDePension").change(function(e) {
        var porcPension = $(this).find(":selected").data("item");
        $("#txtPorcentajePension").val(porcPension);
    });

    $("#btnGuardar").click(function() {
        validarContrato();
    });

    $("#btnCancelar").click(function() {
        limpiarCampos();
    });

    $("#btnActualizar").click(function() {
        actualizarContrato();
    });

});

var listadoEmpleados = "";

function visualizarEmpleados() {
    $("#tboBodyEmpleado").html("<label style='float:left; margin-left:249%; margin-top:15%; font-size:11px;'>Cargando...</label><div class='lds-dual-ring' style='float:left; margin-top:%; margin-left:249%; width:5%;'></div>");
    var ur = CONTROLLERCONTRATO;
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
                    var td = $("<td>" + ret[i].TIPODOCUMENTO + "</td>");
                    tr.append(td);
                    var td = $("<td>" + ret[i].NUMDOCUMENTO + "</td>");
                    tr.append(td);
                    var td = $("<td>" + ret[i].NOMBREYAPELLIDO + "</td>");
                    tr.append(td);
                    var td = $("<td>" + ret[i].ESTADOEMPLEADO + "</td>");
                    tr.append(td);
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    })

}

function listarTipoDocumento(idCombo) {
    var ur = CONTROLLERCONTRATO;
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

function obtenerDatosEmpleados(index) {
    var tipoDocumento = listadoEmpleados[index].TIPODOCUMENTO;
    var numDocumento = listadoEmpleados[index].NUMDOCUMENTO;
    var nombreyapellido = listadoEmpleados[index].NOMBREYAPELLIDO;
    var estado = listadoEmpleados[index].ESTADOEMPLEADO;
    var idTipoDocumento = listadoEmpleados[index].TIPODOCUMENTO_ID;
    var estadoId = listadoEmpleados[index].ESTADO_ID;
    var idEmpleado = listadoEmpleados[index].ID;
    var numcontrato = listadoEmpleados[index].NUM_CONTRATO;
    var tipoContrato = listadoEmpleados[index].TIPO_CONTRATO;
    var cargo = listadoEmpleados[index].CARGO;
    var fechaInicio = listadoEmpleados[index].FECHA_INICIO;
    var fechaCulminacion = listadoEmpleados[index].FECHA_FINAL;
    var motivoRetiro = listadoEmpleados[index].MOTIVO_RETIRO;
    var salarioActual = listadoEmpleados[index].SALARIO_ACTUAL;
    var formaPago = listadoEmpleados[index].FORMA_PAGO;
    var tipoCotizante = listadoEmpleados[index].TIPO_COTIZANTE;
    var arl = listadoEmpleados[index].ARL;
    var cajaCompensacion = listadoEmpleados[index].PARAFISCAL_ID;
    var fondoCesantias = listadoEmpleados[index].CESANTIAS_ID;
    var centroCosto = listadoEmpleados[index].CENTRO_COSTO;
    var fechaInicioVacaciones = listadoEmpleados[index].FECHA_INICIO_VACACIONES;
    var fechaFinVacaciones = listadoEmpleados[index].FECHA_FIN_VACACIONES;
    var ciudadLabora = listadoEmpleados[index].CIUDAD;
    var fondoSalud = listadoEmpleados[index].FONDO_SALUD;
    var porcSalud = listadoEmpleados[index].POCENTAJE_SALUD;
    var fechaInicioSalud = listadoEmpleados[index].FECHA_INICIO_SALUD;
    var fondoPension = listadoEmpleados[index].FONDO_PENSION;
    var porcPension = listadoEmpleados[index].PORCENTAJE_PENSION;
    var fechaInicioPension = listadoEmpleados[index].FECHA_INICIO_PENSION;
    var bancos = listadoEmpleados[index].BANCO_ID;
    var tipoCuenta = listadoEmpleados[index].TIPO_CUENTA_BANCARIA;
    var numCuentaBanco = listadoEmpleados[index].NUM_CUENTA;
    var salarioDia = listadoEmpleados[index].SALARIO_DIA;
    var porcArl = listadoEmpleados[index].POCENTAJE_ARL;
    var contratoId = listadoEmpleados[index].CONTRATO_ID;

    $("#mdlEmpleados").modal("hide");
    $("#txtNombreEmpleado").val(nombreyapellido);
    $("#cmbTipoDocumento").val(idTipoDocumento);
    $("#txtNumDocumento").val(numDocumento);
    $("#cmbEstadoEmpleado").val(estadoId);
    $("#txtIdEmpleado").val(idEmpleado);
    $("#txtNumContrato").val(numcontrato);
    $("#cmbTipoContrato").val(tipoContrato);
    $("#cmbTipoCargo").val(cargo);
    $("#txtFechaDeInicio").val(fechaInicio);
    $("#txtFechaDeTerminacion").val(fechaCulminacion);
    $("#cmbMotivoRetiro").val(motivoRetiro);
    $("#txtSalarioActual").val(salarioActual);
    $("#cmbFormaDePago").val(formaPago);
    $("#cmbTipoDeCotizante").val(tipoCotizante);
    $("#cmbArl").val(arl);
    $("#cmbCajaDeCompensacion").val(cajaCompensacion);
    $("#cmbFondoCesantias").val(fondoCesantias);
    $("#cmbCentroDeCosto").val(centroCosto);
    $("#txtFechaDeInicioVacaciones").val(fechaInicioVacaciones);
    $("#txtFechaFinDeVacaciones").val(fechaFinVacaciones);
    $("#cmbCiudadDondeLabora").val(ciudadLabora);
    $("#cmbFondoDeSalud").val(fondoSalud);
    $("#txtPorcentajeSalud").val(porcSalud);
    $("#txtFechaInicioSalud").val(fechaInicioSalud);
    $("#cmbFondoDePension").val(fondoPension);
    $("#txtPorcentajePension").val(porcPension);
    $("#txtFechaInicioPension").val(fechaInicioPension);
    $("#cmbBancos").val(bancos);
    $("#cmbTipoCuentaBancaria").val(tipoCuenta);
    $("#txtNumCuenta").val(numCuentaBanco)
    $("#txtPorcentajeArl").val(porcArl);
    $("#txtSalarioActualDiario").val(salarioDia);
    $("#txtIdContrato").val(contratoId);
    if (contratoId > 0) {
        $("#txtEditar").val(1);
        $("#btnGuardar").text("Actualizar");
    }
    //   $("#txtEditar").val(1);
    //  $("#btnGuardar").text("Actualizar");
}

function listarCargos(idCombo) {
    var ur = CONTROLLERCONTRATO;
    var op = 3;
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

function listarTipoContrato(idCombo) {
    var ur = CONTROLLERCONTRATO;
    var op = 4;
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

function listarMotivoRetiro(idCombo) {
    var ur = CONTROLLERCONTRATO;
    var op = 5;
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

function listarFormaDePago(idCombo) {
    var ur = CONTROLLERCONTRATO;
    var op = 6;
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

function listarTipoCotizante(idCombo) {
    var ur = CONTROLLERCONTRATO;
    var op = 7;
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

function listarArl(idCombo) {
    var ur = CONTROLLERCONTRATO;
    var op = 9;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op
        }),
        success: function(data) {
            var ret = eval('(' + data + ')');
            porcentaje = ret
            try {
                listarCombo = $("#" + idCombo);
                listarCombo.html('');
                var option = $("<option value=''>Seleccione</option>");
                listarCombo.append(option);
                for (var i = 0; i < ret.length; i++) {
                    var option = $("<option data-item = " + ret[i].RIESGO + " value = " + ret[i].ID + ">" + ret[i].DESCRIPCION + "</option>");
                    listarCombo.append(option);
                }

            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function listarCajaCompensacion(idCombo) {
    var ur = CONTROLLERCONTRATO;
    var op = 10;
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

function listarFonCesantia(idCombo) {
    var ur = CONTROLLERCONTRATO;
    var op = 11;
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

function ciudadDondeLabora(idCombo) {
    var ur = CONTROLLERCONTRATO;
    var op = 12;
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

function listarFondoSalud(idCombo) {
    var ur = CONTROLLERCONTRATO;
    var op = 13;
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
                    var option = $("<option data-item =" + ret[i].PORCENTAJE + " value = " + ret[i].ID + ">" + ret[i].DESCRIPCION + "</option>");
                    listarCombo.append(option);
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function listarFondoPension(idCombo) {
    var ur = CONTROLLERCONTRATO;
    var op = 14;
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
                    var option = $("<option data-item =" + ret[i].PORCENTAJE + " value = " + ret[i].ID + ">" + ret[i].DESCRIPCION + "</option>");
                    listarCombo.append(option);
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function listarBancos(idCombo) {
    var ur = CONTROLLERCONTRATO;
    var op = 15;
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

function listarTipoDeCuenta(idCombo) {
    var ur = CONTROLLERCONTRATO;
    var op = 16;
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

function calcularSueldoDiario() {
    var salario = $("#txtSalarioActual").val();
    var salarioDiario = salario / 30;
    $("#txtSalarioActualDiario").val(salarioDiario.toFixed(2));
}

function listarCentroDeCosto(idCombo) {
    var ur = CONTROLLERCONTRATO;
    var op = 17;
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

function validarContrato() {
    var idEmpleado = $("#txtIdEmpleado").val();
    var numContrato = $("#txtNumContrato").val();
    var tipoContrato = $("#cmbTipoContrato").val();
    var cargos = $("#cmbTipoCargo").val();
    var fechaInicioContrato = $("#txtFechaDeInicio").val();
    var fechaCulminacionContrato = $("#txtFechaDeTerminacion").val();
    var motivoRetiro = $("#cmbMotivoRetiro").val();
    var salarioTotal = $("#txtSalarioActual").val();
    var salarioDia = $("#txtSalarioActualDiario").val();
    var formaPago = $("#cmbFormaDePago").val();
    var tipoCotizante = $("#cmbTipoDeCotizante").val();
    var arl = $("#cmbArl").val();
    var porcentajeArl = $("#txtPorcentajeArl").val();
    var cajaCompensacion = $("#cmbCajaDeCompensacion").val();
    var fondoCesantias = $("#cmbFondoCesantias").val();
    var centroCosto = $("#cmbCentroDeCosto").val();
    var fechaInicioVacaciones = $("#txtFechaDeInicioVacaciones").val();
    var fechaFinVacaciones = $("#txtFechaFinDeVacaciones").val();
    var ciudad = $("#cmbCiudadDondeLabora").val();
    var fondoSalud = $("#cmbFondoDeSalud").val();
    var porcentajeSalud = $("#txtPorcentajeSalud").val();
    var fechaInicioSalud = $("#txtFechaInicioSalud").val();
    var fondoPension = $("#cmbFondoDePension").val();
    var porcentajePension = $("#txtPorcentajePension").val();
    var fechaInicioPension = $("#txtFechaInicioPension").val();
    var bancos = $("#cmbBancos").val();
    var tipoCuetaBanco = $("#cmbTipoCuentaBancaria").val();
    var numeroCuentaBanco = $("#txtNumCuenta").val();
    var tipoAnexo = $("#cmbTipoAnexo").val();
    var anexoDocumento = $("#archivo").val();
    var nombreAnexo = $("#txtNombreAnexo").val();
    var descripcionAnexo = $("#txtDetalle").val();
    var editar = $("#txtEditar").val();
    //console.log(editar);
    if (idEmpleado.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un empleado');
    } else if (numContrato.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un numero de contrato');
    } else if (tipoContrato.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un tipo de contrato');
    } else if (cargos.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un tipo de contrato');
    } else if (fechaInicioContrato.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione la fecha de inicio de contrato');
    } else if (fechaCulminacionContrato.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione la fecha de culminacion de contrato');
    } else if (salarioTotal.length === 0) {
        alertify.alert('Mensaje', 'Por favor digite el salario total');
    } else if (formaPago.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione una forma de pago');
    } else if (tipoCotizante.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un tipo cotizante');
    } else if (arl.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione la Arl');
    } else if (cajaCompensacion.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione la caja de compensacion');
    } else if (fondoCesantias.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione fondo cesantias');
    } else if (centroCosto.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un centro de costo');
    } else if (ciudad.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione la ciudad donde labora');
    } else if (fondoSalud.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un fondo de salud');
    } else if (fechaInicioSalud.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione fecha de inicio salud');
    } else if (fondoPension.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un fondo de pension');
    } else if (fechaInicioPension.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione fecha de inicio de pension');
    } else if (bancos.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un banco');
    } else if (tipoCuetaBanco.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un tipo de cuenta bancaria');
    } else if (numeroCuentaBanco.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un numerode cuenta bancaria');
    } else {
        /*asignarContrato(idEmpleado, numContrato, tipoContrato, cargos, fechaInicioContrato, fechaCulminacionContrato, motivoRetiro, salarioTotal, salarioDia, formaPago, tipoCotizante, arl, porcentajeArl,
            cajaCompensacion, fondoCesantias, centroCosto, fechaInicioVacaciones, fechaFinVacaciones, ciudad, fondoSalud, porcentajeSalud, fechaInicioSalud, fondoPension, porcentajePension, fechaInicioPension,
            bancos, tipoCuetaBanco, numeroCuentaBanco, tipoAnexo, anexoDocumento, nombreAnexo, descripcionAnexo);*/
        $("#frmAnexos").submit();
        limpiarCampos();
    }
}

/*function asignarContrato(idEmpleado, numContrato, tipoContrato, cargos, fechaInicioContrato, fechaCulminacionContrato, motivoRetiro, salarioTotal, salarioDia, formaPago, tipoCotizante, arl, porcentajeArl,
    cajaCompensacion, fondoCesantias, centroCosto, fechaInicioVacaciones, fechaFinVacaciones, ciudad, fondoSalud, porcentajeSalud, fechaInicioSalud, fondoPension, porcentajePension, fechaInicioPension, bancos,
    tipoCuetaBanco, numeroCuentaBanco, tipoAnexo, anexoDocumento, nombreAnexo, descripcionAnexo) {

    var ur = CONTROLLERCONTRATO;
    var op = 18;

    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op,
            idEmpleado: idEmpleado,
            numContrato: numContrato,
            tipoContrato: tipoContrato,
            cargos: cargos,
            fechaInicioContrato: fechaInicioContrato,
            fechaCulminacionContrato: fechaCulminacionContrato,
            motivoRetiro: motivoRetiro,
            salarioTotal: salarioTotal,
            salarioDia: salarioDia,
            formaPago: formaPago,
            tipoCotizante: tipoCotizante,
            arl: arl,
            porcentajeArl: porcentajeArl,
            cajaCompensacion: cajaCompensacion,
            fondoCesantias: fondoCesantias,
            centroCosto: centroCosto,
            fechaInicioVacaciones: fechaInicioVacaciones,
            fechaFinVacaciones: fechaFinVacaciones,
            ciudad: ciudad,
            fondoSalud: fondoSalud,
            porcentajeSalud: porcentajeSalud,
            fechaInicioSalud: fechaInicioSalud,
            fondoPension: fondoPension,
            porcentajePension: porcentajePension,
            fechaInicioPension: fechaInicioPension,
            bancos: bancos,
            tipoCuetaBanco: tipoCuetaBanco,
            numeroCuentaBanco: numeroCuentaBanco,
            tipoAnexo: tipoAnexo,
            anexoDocumento: anexoDocumento,
            nombreAnexo: nombreAnexo,
            descripcionAnexo: descripcionAnexo
        }),
        success: function(data) {
            var ret = eval('(' + data + ')');
            if (ret.hasOwnProperty("success")) {
                limpiarCampos();
                alertify.success(ret.success);
            } else if (ret.hasOwnProperty("error")) {
                alertify.alert('Mensaje', ret.error);
            }
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}*/

function limpiarCampos() {
    $("#frmAnexos")[0].reset()
        /*$("#txtNombreEmpleado").val('');
        $("#txtIdEmpleado").val('');
        $("#cmbTipoDocumento").val('');
        $("#txtNumDocumento").val('');
        $("#cmbEstadoEmpleado").val('');
        $("#txtNumContrato").val('');
        $("#cmbTipoContrato").val('');
        $("#cmbTipoCargo").val('');
        $("#txtFechaDeInicio").val('');
        $("#txtFechaDeTerminacion").val('');
        $("#cmbMotivoRetiro").val('');
        $("#txtSalarioActual").val('');
        $("#txtSalarioActualDiario").val('');
        $("#cmbFormaDePago").val('');
        $("#cmbTipoDeCotizante").val('');
        $("#cmbArl").val('');
        $("#txtPorcentajeArl").val('');
        $("#cmbCajaDeCompensacion").val('');
        $("#cmbFondoCesantias").val('');
        $("#cmbCentroDeCosto").val('');
        $("#txtFechaDeInicioVacaciones").val('');
        $("#txtFechaFinDeVacaciones").val('');
        $("#cmbCiudadDondeLabora").val('');
        $("#cmbFondoDeSalud").val('');
        $("#txtPorcentajeSalud").val('');
        $("#txtFechaInicioSalud").val('');
        $("#cmbFondoDePension").val('');
        $("#txtPorcentajePension").val('');
        $("#txtFechaInicioPension").val('');
        $("#cmbBancos").val('');
        $("#cmbTipoCuentaBancaria").val('');
        $("#txtNumCuenta").val('');
        $("#cmbTipoAnexo").val('');
        $("#archivo").val('');
        $("#txtNombreAnexo").val('');
        $("#txtDetalle").val('');
        $("#btnGuardar").text("Guardar");*/
}

/*function actualizarContrato() {
    var idEmpleado = $("#txtIdEmpleado").val();
    var numContrato = $("#txtNumContrato").val();
    var tipoContrato = $("#cmbTipoContrato").val();
    var cargos = $("#cmbTipoCargo").val();
    var fechaInicioContrato = $("#txtFechaDeInicio").val();
    var fechaCulminacionContrato = $("#txtFechaDeTerminacion").val();
    var motivoRetiro = $("#cmbMotivoRetiro").val();
    var salarioTotal = $("#txtSalarioActual").val();
    var salarioDia = $("#txtSalarioActualDiario").val();
    var formaPago = $("#cmbFormaDePago").val();
    var tipoCotizante = $("#cmbTipoDeCotizante").val();
    var arl = $("#cmbArl").val();
    var porcentajeArl = $("#txtPorcentajeArl").val();
    var cajaCompensacion = $("#cmbCajaDeCompensacion").val();
    var fondoCesantias = $("#cmbFondoCesantias").val();
    var centroCosto = $("#cmbCentroDeCosto").val();
    var fechaInicioVacaciones = $("#txtFechaDeInicioVacaciones").val();
    var fechaFinVacaciones = $("#txtFechaFinDeVacaciones").val();
    var ciudad = $("#cmbCiudadDondeLabora").val();
    var fondoSalud = $("#cmbFondoDeSalud").val();
    var porcentajeSalud = $("#txtPorcentajeSalud").val();
    var fechaInicioSalud = $("#txtFechaInicioSalud").val();
    var fondoPension = $("#cmbFondoDePension").val();
    var porcentajePension = $("#txtPorcentajePension").val();
    var fechaInicioPension = $("#txtFechaInicioPension").val();
    var bancos = $("#cmbBancos").val();
    var tipoCuetaBanco = $("#cmbTipoCuentaBancaria").val();
    var numeroCuentaBanco = $("#txtNumCuenta").val();

    if (idEmpleado.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un empleado');
    } else if (numContrato.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un numero de contrato');
    } else if (tipoContrato.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un tipo de contrato');
    } else if (cargos.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un tipo de contrato');
    } else if (fechaInicioContrato.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione la fecha de inicio de contrato');
    } else if (salarioTotal.length === 0) {
        alertify.alert('Mensaje', 'Por favor digite el salario total');
    } else if (formaPago.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione una forma de pago');
    } else if (tipoCotizante.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un tipo cotizante');
    } else if (arl.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione la Arl');
    } else if (cajaCompensacion.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione la caja de compensacion');
    } else if (fondoCesantias.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione fondo cesantias');
    } else if (centroCosto.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un centro de costo');
    } else if (ciudad.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione la ciudad donde labora');
    } else if (fondoSalud.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un fondo de salud');
    } else if (fechaInicioSalud.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione fecha de inicio salud');
    } else if (fondoPension.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un fondo de pension');
    } else if (fechaInicioPension.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione fecha de inicio de pension');
    } else if (bancos.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un banco');
    } else if (tipoCuetaBanco.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un tipo de cuenta bancaria');
    } else if (numeroCuentaBanco.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un numerode cuenta bancaria');
    } else {
        alertify.confirm('Mensaje', '¿Esta seguro que desea actualizar datos del contrato. ?', function() {
                $("#frmAnexos").submit();
            }
            
                           var ur = CONTROLLERCONTRATO;
                            var op = 19;
                            $.ajax({
                                type: "POST",
                                url: ur,
                                data: ({
                                    op: op,
                                    idEmpleado: idEmpleado,
                                    numContrato: numContrato,
                                    tipoContrato: tipoContrato,
                                    cargos: cargos,
                                    fechaInicioContrato: fechaInicioContrato,
                                    fechaCulminacionContrato: fechaCulminacionContrato,
                                    motivoRetiro: motivoRetiro,
                                    salarioTotal: salarioTotal,
                                    salarioDia: salarioDia,
                                    formaPago: formaPago,
                                    tipoCotizante: tipoCotizante,
                                    arl: arl,
                                    porcentajeArl: porcentajeArl,
                                    cajaCompensacion: cajaCompensacion,
                                    fondoCesantias: fondoCesantias,
                                    centroCosto: centroCosto,
                                    fechaInicioVacaciones: fechaInicioVacaciones,
                                    fechaFinVacaciones: fechaFinVacaciones,
                                    ciudad: ciudad,
                                    fondoSalud: fondoSalud,
                                    porcentajeSalud: porcentajeSalud,
                                    fechaInicioSalud: fechaInicioSalud,
                                    fondoPension: fondoPension,
                                    porcentajePension: porcentajePension,
                                    fechaInicioPension: fechaInicioPension,
                                    bancos: bancos,
                                    tipoCuetaBanco: tipoCuetaBanco,
                                    numeroCuentaBanco: numeroCuentaBanco
                                }),
                                success: function(data) {
                                    try {
                                        var ret = eval('(' + data + ')');
                                        if (ret.hasOwnProperty("success")) {
                                            limpiarCampos();
                                            alertify.success(ret.success);
                                            visualizarEmpleados();
                                        } else if (ret.hasOwnProperty("error")) {
                                            alertify.alert('Mensaje', ret.error);
                                        }
                                    } catch (e) {}
                                },
                                error: function(objeto, error, error2) {
                                    alertify.alert(error);
                                }
                            });
                        },
                    function() {}
        );
    }
}*/

function listarTipoAnexo(idCombo) {
    var ur = CONTROLLERCONTRATO;
    var op = 20;
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