$(document).ready(function() {
    visualizarDetalleEmpleado();
    listarTipoLiquidacionNomina('cmbTipoLiquidacion');
    listarMesesdelano('cmbMes');
    anos('cmbAno');
    novedadesNomina();

    $("#btnLiquidar").click(function() {
        //console.log(liquidarNomina());.
        registrarNomina();
    });
    $("#btnImprimir").click(function() {
        generPdfNomina();
    });

})

var listarDetalleEmpleado = "";


function visualizarDetalleEmpleado() {
    var ur = CONTROLLERCREARNOMINA;
    var op = 1;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op
        }),
        success: function(data) {
            try {
                var ret = eval('(' + data + ')');
                listarDetalleEmpleado = ret;
                var detalleEmpleado = $("#tbl_visualizar_detalle_empleados");
                detalleEmpleado.html('');
                var thead = $("<thead></thead>");
                detalleEmpleado.append(thead);
                var tr = $("<tr class='info'></tr>");
                thead.append(tr);

                th = $("<th style='' ><input type='checkbox'  onclick= 'seleccionAll' value='' style='cursor:pointer'></th>");
                tr.append(th);
                th = $("<th style='width: 15% ;'>Identificacion</th>");
                tr.append(th);
                th = $("<th style='width: 24% ;'>Nombre y Apellido</th>");
                tr.append(th);
                th = $("<th style='width: 19% ;'>Cargo</th>");
                tr.append(th);
                th = $("<th style='width: 19% ;'>Salario</th>");
                tr.append(th);
                th = $("<th style='width: 19% ;'>Fecha Inicio Contrato</th>");
                tr.append(th);
                var tbody = $("<tbody></tbody>");
                detalleEmpleado.append(tbody);
                for (var i = 0; i < ret.length; i++) {
                    var tr = $("<tr  style  = 'cursor:pointer; ' id='fila" + i + "'></tr>");
                    tbody.append(tr);
                    td = $("<td><input type='checkbox' id='checkbox" + i + "' style='cursor:pointer'></td>");
                    tr.append(td);
                    var td = $("<td >" + (ret[i].hasOwnProperty("NUMERO_DOCUMENTO") ? ret[i].NUMERO_DOCUMENTO : "") + "</td>");
                    tr.append(td);
                    var td = $("<td>" + (ret[i].hasOwnProperty("NOMBRE_COMPLETO") ? ret[i].NOMBRE_COMPLETO : "") + "</td>");
                    tr.append(td);
                    var td = $("<td>" + (ret[i].hasOwnProperty("CARGOS") ? ret[i].CARGOS : "") + "</td>");
                    tr.append(td);
                    var td = $("<td>" + (ret[i].hasOwnProperty("SALARIO_TOTAL") ? ret[i].SALARIO_TOTAL : "") + "</td>");
                    tr.append(td);
                    var td = $("<td>" + (ret[i].hasOwnProperty("FECHA_CONTRATO") ? ret[i].FECHA_CONTRATO : "") + "</td>");
                    tr.append(td);
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}
var valorDias = "";

function listarTipoLiquidacionNomina(idCombo) {
    var ur = CONTROLLERCREARNOMINA;
    var op = 2;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op
        }),
        success: function(data) {
            var ret = eval('(' + data + ')');
            valorDias = ret;
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

function listarMesesdelano(idCombo) {
    var ur = CONTROLLERCREARNOMINA;
    var op = 3;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op
        }),
        success: function(data) {
            var ret = eval('(' + data + ')');
            valorDias = ret;
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

var listadoNovedades = "";
//var idEmpleadoNov = "";

function novedadesNomina() {
    var ur = CONTROLLERCREARNOMINA;
    var op = 6;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op
        }),
        success: function(data) {
            //debugger;
            var ret = eval('(' + data + ')');
            listadoNovedades = ret;
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function anos(idCombo) {
    listarCombo = $("#" + idCombo);
    listarCombo.html('');
    var option = $("<option value=''>Seleccione</option>");
    listarCombo.append(option);
    var myDate = new Date();
    var year = myDate.getFullYear();
    for (var i = 1900; i < year + 1; i++) {
        var option = $('<option value="' + i + '">' + i + '</option>')
        listarCombo.append(option);
    }
}



var auxTransporte = 117172;
var salMinimo = 1000000;
var totalDevengado = 0;
var totalNovedad = 0;

/*function liquidarNomina_old() {
    contadorControles = 0;
    var id = false;
    var listadoSD = new Array();
    var novedades = listadoNovedades.data;
    for (index = 0; index < listarDetalleEmpleado.length; index++) {
        $.each(novedades, function(key) {
            if (novedades[key].EMPLEADONOV_ID === listarDetalleEmpleado[index].ID_EMPLEADO) {
                id = true;
            }
        });
        if (id) {
            contadorControles++;
            listadoSD.push({
                totalDevengado: totalDevengado,
                salud: salud,
                pension: pension,
                netoPagar: netoPagar,
                fsp: fsp,
                salario: salario,
                auxTransporte: auxTransporte,
                idEmpleado: idEmpleado,
                totalneto: totalneto
            });
        }
    }
    console.log(listadoSD);
    return listadoSD;
}*/

function liquidarNomina() {
    // debugger;
    var listadoSD = new Array()
    var MesS = $("#cmbMes").val();
    for (index = 0; index < listarDetalleEmpleado.length; index++) {
        var idEmpleado = listarDetalleEmpleado[index].ID_EMPLEADO;
        var salario = listarDetalleEmpleado[index].SALARIO_TOTAL;
        var salarioDia = listarDetalleEmpleado[index].SALARIO_DIA;
        var pension = listarDetalleEmpleado[index].TOTAL_PENSION;
        pension = pension.replace(/,/g, "");
        pension = pension.split(".", 1);
        var salud = listarDetalleEmpleado[index].TOTAL_SALUD;
        salud = salud.replace(/,/g, "");
        salud = salud.split(".", 1);
        var totalDeduciones = listarDetalleEmpleado[index].TOTAL_DEDUCIONES;
        totalDeduciones = totalDeduciones.replace(/,/g, "");
        totalDeduciones = totalDeduciones.split(".", 1);
        var devengado = listarDetalleEmpleado[index].DEVENGADO;
        var netopagar = listarDetalleEmpleado[index].NETOPAGAR;
        netopagar = netopagar.replace(/,/g, "");
        netopagar = netopagar.split(".", 1);
        var fsp = listarDetalleEmpleado[index].FSP;
        fsp = fsp.replace(/,/g, "");
        fsp = fsp.split(".", 1);
        for (j = 0; j < listadoNovedades.data.length; j++) {
            var idNovedad = listadoNovedades.data[j].NOVEDAD_ID;
            var idNovedadEmp = listadoNovedades.data[j].EMPLEADONOV_ID;
            var idTipoConcepto = listadoNovedades.data[j].TIPO_CONCEPTO_ID;
            var valorNovedad = listadoNovedades.data[j].VALOR;
            var idMesNovedad = listadoNovedades.data[j].MES;
            var netoPagar = 0;
            /*if (MesS == idMesNovedad || MesS == MesS) {
                if (idEmpleado === idNovedadEmp) {
                    if ($('#checkbox' + index).prop('checked')) {
                        if (idTipoConcepto == 1) {
                            totalNovedad = totalNovedad + valorNovedad;
                        } else if (idTipoConcepto == 2) {
                            totalNovedad = totalNovedad - valorNovedad;
                        } else {
                            totalNovedad = 0;
                        }

                        listadoSD.push({
                            idEmpleado: idEmpleado,
                            idNovedad: idNovedad,
                            totalNovedad: totalNovedad,
                            salario: salario,
                            salarioDia: salarioDia,
                            pension: pension[0],
                            salud: salud[0],
                            totalDeduciones: totalDeduciones[0],
                            devengado: devengado,
                            netopagar: netopagar[0],
                            fsp: fsp[0],
                            auxTransporte: auxTransporte
                        });
                        totalNovedad = 0;
                    }

                } else {
                    totalNovedad = 0;
                }
            }*/
            if (MesS == idMesNovedad || MesS == MesS) {
                if ($('#checkbox' + index).prop('checked')) {
                    if (idEmpleado === idNovedadEmp) {
                        if (idTipoConcepto == 1) {
                            totalNovedad = totalNovedad + valorNovedad;
                        } else if (idTipoConcepto == 2) {
                            totalNovedad = totalNovedad - valorNovedad;
                        } else {
                            totalNovedad = 0;
                        }

                        listadoSD.push({
                            idEmpleado: idEmpleado,
                            idNovedad: idNovedad,
                            totalNovedad: totalNovedad,
                            salario: salario,
                            salarioDia: salarioDia,
                            pension: pension[0],
                            salud: salud[0],
                            totalDeduciones: totalDeduciones[0],
                            devengado: devengado,
                            netopagar: netopagar[0],
                            fsp: fsp[0],
                            auxTransporte: auxTransporte
                        });
                        totalNovedad = 0;
                    } else if (idEmpleado != idNovedadEmp) {
                        totalNovedad = 0;
                        listadoSD.push({
                            idEmpleado: idEmpleado,
                            idNovedad: idNovedad,
                            totalNovedad: totalNovedad,
                            salario: salario,
                            salarioDia: salarioDia,
                            pension: pension[0],
                            salud: salud[0],
                            totalDeduciones: totalDeduciones[0],
                            devengado: devengado,
                            netopagar: netopagar[0],
                            fsp: fsp[0],
                            auxTransporte: auxTransporte
                        });
                    }
                }
            }
        } ////fin  foreach J

    } ///fin  foreach Index/
    console.log(listadoSD);
    return listadoSD;
}

function registrarNomina() {
    var tipoLiquidacion = $("#cmbTipoLiquidacion").val();
    var descripcion = $("#txtDescripcion").val();
    var mes = $("#cmbMes").val();
    var year = $("#cmbAno").val();

    if (tipoLiquidacion.length === 0) {
        alertify.error('Por favor seleccione un tipo de liquidacion');
    } else if (descripcion.length === 0) {
        alertify.error('La descripcion no puede quedar vacia');
    } else if (mes.length === 0) {
        alertify.error('Por favor seleccione el mes al que pertenece la liquidacion');
    } else if (year.length === 0) {
        alertify.error('Por favor seleccione el año al que pertenece la liquidacion');
    } else {
        alertify.confirm('Mensaje', 'Esta seguro de realizar la liquidacion de nomina', function() {
            var ur = CONTROLLERCREARNOMINA;
            var op = 4;
            $.ajax({
                type: "POST",
                url: ur,
                data: ({
                    op: op,
                    tipoLiquidacion: tipoLiquidacion,
                    descripcion: descripcion,
                    mes: mes,
                    year: year,
                    listado: JSON.stringify(liquidarNomina())
                }),
                beforeSend: function() {
                    $("#modalLoandig").modal('show');
                },
                success: function(data) {
                    var ret = eval('(' + data + ')');
                    if (ret.hasOwnProperty("success")) {
                        alertify.success(ret.success);
                        $("#txtIdNomina").val(ret.data);
                    } else if (ret.hasOwnProperty("error")) {
                        alertify.alert('Mensaje', ret.error);
                    }
                },
                error: function(objeto, error, error2) {
                    alertify.alert(error);

                },
                complete: function() {
                    $("#modalLoandig").modal("hide");
                },
            });
        }, function() {})
    }
}

function generPdfNomina() {
    var obj = {
        idNomina: $("#txtIdNomina").val()
    };
    abrirVentana("../reporte" + "?action=" + CONTROLLERCREARNOMINA + "&op=5" +
        "&parametros=" + JSON.stringify(obj));
}

function abrirVentana(pagina) {
    var alto = parseInt((screen.height));
    var ancho = parseInt((screen.width));
    var posicionX = (screen.width / 2) - (ancho / 2);
    var posicionY = (screen.height / 2) - (alto / 2);
    window.open(pagina, "Visor", "width=" + ancho + ",height=" + alto + ",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left=" + posicionX + ",top=" + posicionY + "");
}