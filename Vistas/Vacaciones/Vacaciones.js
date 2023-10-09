$(document).ready(function() {
    visualizarEmpleados();

    $("#btnGuardar").click(function() {
        validarCampos();
    });

    $("#btnCancelar").click(function() {
        limpiarCampos();
    });

    $("#btnActualizar").click(function() {
        actualizarDatos();
    });
});

var listadoEmpleados = "";

function visualizarEmpleados() {
    $("#tboBodyEmpleado").html("<label style='float:left; margin-left:249%; margin-top:15%; font-size:11px;'>Cargando...</label><div class='lds-dual-ring' style='float:left; margin-top:%; margin-left:249%; width:5%;'></div>");
    var ur = CONTROLLERVACACIONES;
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
                    var td = $("<td>" + ret[i].TIPO_DOCUMENTO + "</td>");
                    tr.append(td);
                    var td = $("<td>" + ret[i].NUMDOCUMENTO + "</td>");
                    tr.append(td);
                    var td = $("<td>" + ret[i].NOMBRE_COMPLETO + "</td>");
                    tr.append(td);
                    var td = $("<td>" + ret[i].TIPO_CONTRATACION + "</td>");
                    tr.append(td);
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    })
}

var idEmpleado = "";
var idVac = "";

function obtenerDatosEmpleados(index) {
    idEmpleado = listadoEmpleados[index].EMPLEADO_ID;
    var nombreCompleto = listadoEmpleados[index].NOMBRE_COMPLETO;
    var numDocumento = listadoEmpleados[index].NUMDOCUMENTO;
    var tipoContratacion = listadoEmpleados[index].TIPO_CONTRATACION;
    var area = listadoEmpleados[index].AREA;
    var cargo = listadoEmpleados[index].CARGO;
    var estado = listadoEmpleados[index].ID_EMPL_ESTADO;
    idVac = listadoEmpleados[index].VAC_ID;

    $("#mdlEmpleados").modal("hide");
    $("#txtNombreEmpleadoVac").val(nombreCompleto);
    $("#txtIdEmpleadoVac").val(idEmpleado);
    $("#txtNumDocumentoVac").val(numDocumento);
    $("#txtTipoContratacion").val(tipoContratacion);
    $("#txtArea").val(area);
    $("#txtCargo").val(cargo);
    $("#cmbEstadoEmpleadoVac").val(estado);
    $("#txtEditarVac").val(idVac);
    if (idVac > 0) {
        obtenerHistorial();
    } else {
        $("#tbl_visualizar_Vacaciones tbody").html('');
    }
}

function validarCampos() {
    var idEmpleado = $("#txtIdEmpleadoVac").val();
    var perven_inicio = $("#txtFechaInicioPv").val();
    var perven_fin = $("#txtFechaFinPv").val();
    var vac_inicio = $("#txtFechaInicioVac").val();
    var vac_fin = $("#txtFechaFinVac").val();
    var observaciones = $("#txtObservaciones").val();
    var idNovVac = $("#txtEditarVac").val();

    if (idEmpleado.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un empleado');
    } else if (perven_inicio.length === 0) {
        alertify.alert('Mensaje', 'selecione la fecha de inicio del periodo vencido');
    } else if (perven_fin.length === 0) {
        alertify.alert('Mensaje', 'selecione la fecha de fin del periodo vencido');
    } else if (vac_inicio.length === 0) {
        alertify.alert('Mensaje', 'selecione la fecha inicio de vacaciones');
    } else if (vac_fin.length === 0) {
        alertify.alert('Mensaje', 'selecione la fecha fin de vacaciones');
    } else {
        registrarNovedadVacaciones(idEmpleado, perven_inicio, perven_fin, vac_inicio, vac_fin, observaciones, idNovVac);
    }
}

function registrarNovedadVacaciones(idEmpleado, perven_inicio, perven_fin, vac_inicio, vac_fin, observaciones, idNovVac) {
    var ur = CONTROLLERVACACIONES;
    var op = 2;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op,
            idEmpleado: idEmpleado,
            perven_inicio: perven_inicio,
            perven_fin: perven_fin,
            vac_inicio: vac_inicio,
            vac_fin: vac_fin,
            observaciones: observaciones,
            idNovVac: idNovVac
        }),
        success: function(data) {
            try {
                var ret = eval('(' + data + ')');
                if (ret.hasOwnProperty("success")) {
                    $('#tbl_visualizar_Vacaciones').DataTable().ajax.reload();
                    limpiarCampos();
                    alertify.success(ret.success);
                } else if (ret.hasOwnProperty("error")) {
                    alertify.alert('Mensaje', ret.error);
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

var filaSel = [undefined];

function colorCeldas(celda, index) {
    try {
        if (filaSel[index] !== undefined) {
            filaSel[index].style.backgroundColor = "transparent";
        }
    } catch (e) {}
    celda.style.backgroundColor = "rgb(168, 204, 236)";
    filaSel[index] = celda;
}

var listarHistorial = "";

function obtenerHistorial() {
    var ur = CONTROLLERVACACIONES;
    var op = 3;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op,
            idVac: idVac
        }),
        beforeSend: function() {
            $("#modalLoandig").modal('show');
        },
        success: function(data) {
            var ret = eval('(' + data + ')');
            listarHistorial = ret;
            try {
                $("#divVisualizarVacacones").html('');
                var detalleHistorial = $("<table  id='tbl_visualizar_Vacaciones'  style ='font-size: 11px; cursor:pointer;width: 100%;' class='table-condensed table-bordered  table table-bordered'> </table> ");
                //detalleHistorial.html('');
                $("#divVisualizarVacacones").append(detalleHistorial);
                var thead = $("<thead></thead>");
                detalleHistorial.append(thead);
                var tr = $("<tr class='info'></tr>");
                thead.append(tr);
                var th = $("<th  style='width: 20%;'>PERIODO VENCIDO DESDE</th>");
                tr.append(th);
                var th = $("<th  style='width: 20%;'>PERIODO VENCIDO HASTA</th>");
                tr.append(th);
                var th = $("<th  style='width: 20%;'>FECHA INICIO VACACIONES</th>");
                tr.append(th);
                var th = $("<th  style='width: 20%;'>FECHA FIN VACACIONES</th>");
                tr.append(th);
                var th = $("<th  style='width: 18%;'>OBSERVACIONES</th>");
                tr.append(th);
                var th = $("<th style='' ><i class='fa fa-pencil-square-o'  aria-hidden='true'></i></th>");
                tr.append(th);
                var tbody = $("<tbody></tbody>");
                detalleHistorial.append(tbody);
                for (var i = 0; i < ret.length; i++) {
                    var style = "";
                    if (ret[i].VACD_ESTADO == "C") {
                        style = "danger";
                    }
                    var tr = $("<tr class='tblfiltro " + style + "' id='fila" + i + "' onclick =\"colorCeltaTabla(this,1);\"></tr>");
                    tbody.append(tr);
                    var td = $("<td>" + ret[i].PERIODO_VENCIDO_DESDE + "</td>");
                    tr.append(td);
                    var td = $("<td>" + ret[i].PERIODO_VENCIDO_HASTA + "</td>");
                    tr.append(td);
                    var td = $("<td>" + ret[i].FECHA_INICIO_VACACIONES + "</td>");
                    tr.append(td);
                    var td = $("<td>" + ret[i].FECHA_FIN_VACACIONES + "</td>");
                    tr.append(td);
                    var td = $("<td>" + ret[i].OBSERVACIONES + "</td>");
                    tr.append(td);
                    var td = $("<td onclick =\"consultarDatosHistorial('" + i + "');\"  data-toggle='modal' data-target='#modalActulizarHistorial'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></td>");
                    tr.append(td);
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        },
        complete: function() {
            $("#modalLoandig").modal("hide");
        },
    }, function() {});
}



function consultarDatosHistorial(index) {
    var fechaPerVenDesde = listarHistorial[index].PERIODO_VENCIDO_DESDE;
    var fechaPerVenHasta = listarHistorial[index].PERIODO_VENCIDO_HASTA;
    var fechaIncVacaciones = listarHistorial[index].FECHA_INICIO_VACACIONES;
    var fechaFinVacaciones = listarHistorial[index].FECHA_FIN_VACACIONES;
    var observaciones = listarHistorial[index].OBSERVACIONES;
    var idVacDet = listarHistorial[index].ID_VACD;
    var idEstado = listarHistorial[index].VACD_ESTADO;

    $("#txtFechaInicioPvAct").val(fechaPerVenDesde);
    $("#txtFechaFinPvAct").val(fechaPerVenHasta);
    $("#txtFechaInicioVacAct").val(fechaIncVacaciones);
    $("#txtFechaFinVacAct").val(fechaFinVacaciones);
    $("#txtObservacionesAct").val(observaciones);
    $("#txtIdVacDet").val(idVacDet);
    $("#cmbEstadoVacaciones").val(idEstado);
}

function actualizarDatos() {
    var idVacacionesDetAct = $("#txtIdVacDet").val();
    var fechaPerVenDesdeAct = $("#txtFechaInicioPvAct").val();
    var fechaPerVenHastaAct = $("#txtFechaFinPvAct").val();
    var fechaIncVacacionesAct = $("#txtFechaInicioVacAct").val();
    var fechaFinVacacionesAct = $("#txtFechaFinVacAct").val();
    var observacionesAct = $("#txtObservacionesAct").val();
    var estadoAct = $("#cmbEstadoVacaciones").val();

    if (fechaPerVenDesdeAct.length === 0) {
        alertify.alert('Mensaje', 'selecione la fecha de inicio del periodo vencido');
    } else if (fechaPerVenHastaAct.length === 0) {
        alertify.alert('Mensaje', 'selecione la fecha de fin del periodo vencido');
    } else if (fechaIncVacacionesAct.length === 0) {
        alertify.alert('Mensaje', 'selecione la fecha inicio de vacaciones');
    } else if (fechaFinVacacionesAct.length === 0) {
        alertify.alert('Mensaje', 'selecione la fecha fin de vacaciones');
    } else {
        alertify.confirm('Mensaje', '¿Esta seguro que desea actualizar los Datos. ?', function() {
                var ur = CONTROLLERVACACIONES;
                var op = 4;
                $.ajax({
                    type: "POST",
                    url: ur,
                    data: ({
                        op: op,
                        idVacacionesDetAct: idVacacionesDetAct,
                        fechaPerVenDesdeAct: fechaPerVenDesdeAct,
                        fechaPerVenHastaAct: fechaPerVenHastaAct,
                        fechaIncVacacionesAct: fechaIncVacacionesAct,
                        fechaFinVacacionesAct: fechaFinVacacionesAct,
                        observacionesAct: observacionesAct,
                        estadoAct: estadoAct
                    }),
                    success: function(data) {
                        try {
                            var ret = eval('(' + data + ')');
                            if (ret.hasOwnProperty("success")) {
                                alertify.success(ret.success);
                                limpiarCamposDos();
                                $("#modalActulizarHistorial").modal("hide");
                                $('#tbl_visualizar_Vacaciones').DataTable().ajax.reload();
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
            function() {});
    }
}

function limpiarCampos() {
    $("#txtNombreEmpleadoVac").val('');
    $("#txtIdEmpleadoVac").val('');
    $("#txtEditarVac").val('');
    $("#txtNumDocumentoVac").val('');
    $("#txtTipoContratacion").val('');
    $("#txtArea").val('');
    $("#txtCargo").val('');
    $("#cmbEstadoEmpleadoVac").val('');
    $("#txtFechaInicioPv").val('');
    $("#txtFechaFinPv").val('');
    $("#txtFechaInicioVac").val('');
    $("#txtFechaFinVac").val('');
    $("#tbl_visualizar_Vacaciones tbody").html('');
}

function limpiarCamposDos() {
    $("#txtIdVacDet").val('');
    $("#txtFechaInicioPvAct").val('');
    $("#txtFechaFinPvAct").val('');
    $("#txtFechaInicioVacAct").val('');
    $("#txtFechaFinVacAct").val('');
    $("#txtObservacionesAct").val('');
}