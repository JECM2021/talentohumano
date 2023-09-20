$(document).ready(function() {
    listarConceptoNomina('cmbConceptoNomina');
    visualizarDetalleEmpleado();
    listarComboMes('cmbMesConcepto');

    $("#btnLiquidar").click(function() {
        registrarNovedades();
    });


    $("#btnCancelar").click(function() {
        limpiarCampos();
    });

});


var concepto = "";
var tipoconcep = "";

function listarConceptoNomina(idCombo) {
    var ur = CONTROLLERNOVEDADES;
    var op = 1;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op
        }),
        success: function(data) {
            var ret = eval('(' + data + ')');
            concepto = ret;
            try {
                $listarCombo = $("#" + idCombo);
                $listarCombo.html('');
                var option = $("<option value=''>Seleccione</option>");
                $listarCombo.append(option);

                for (var i = 0; i < ret.length; i++) {

                    var option = $("<option value = " + ret[i].ID + " data-value2= " + ret[i].TIPOCONCEPTO_ID + ">" + ret[i].DESCRIPCION + "</option>");
                    $listarCombo.append(option);
                    tipoconcep = ret[i].TIPOCONCEPTO_ID;
                    //tipoconcep = $("#cmbConceptoNomina").find("option:selected").data("value2");
                }

            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });

}


function listarComboMes(idCombo) {
    var ur = CONTROLLERNOVEDADES;
    var op = 4;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op
        }),
        success: function(data) {
            var ret = eval('(' + data + ')');
            concepto = ret;
            try {
                $listarCombo = $("#" + idCombo);
                $listarCombo.html('');
                var option = $("<option value=''>Seleccione</option>");
                $listarCombo.append(option);

                for (var i = 0; i < ret.length; i++) {

                    var option = $("<option value =" + ret[i].ID + ">" + ret[i].DESCRIPCION + "</option>");
                    $listarCombo.append(option);
                }

            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });

}








var listarDetalleEmpleado = "";

function visualizarDetalleEmpleado() {
    var ur = CONTROLLERNOVEDADES;
    var op = 2;
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
                var detalleEmpleado = $("#tbl_visualizar_detalle_novedades");
                detalleEmpleado.html('');
                var thead = $("<thead></thead>");
                detalleEmpleado.append(thead);
                var tr = $("<tr class='info'></tr>");
                thead.append(tr);
                th = $("<th style='width: 2% ;' ><input type='checkbox'  id='seleccionAll' value='' style='cursor:pointer'></th>");
                tr.append(th);
                th = $("<th style='width: 10% ;'>IDENTIFICACION</th>");
                tr.append(th);
                th = $("<th style='width: 28% ;'>NOMBRES Y APELLIDOS</th>");
                tr.append(th);
                th = $("<th style='width: 19% ;'>SALARIO</th>");
                tr.append(th);
                th = $("<th style='width: 19% ;'>VALOR EN HORAS</th>");
                tr.append(th);
                th = $("<th style='width: 19% ;'>VALOR EN PESOS</th>");
                tr.append(th);
                var tbody = $("<tbody></tbody>");
                detalleEmpleado.append(tbody);
                for (var i = 0; i < ret.length; i++) {
                    var tr = $("<tr  style  = 'cursor:pointer; ' id='fila" + i + "' ></tr>");
                    tbody.append(tr);
                    td = $("<td><input type='checkbox' id='checkbox" + i + "' style='cursor:pointer' onclick =\"sumarCheck(this,'" + i + "');\"  class='chkseleccion'></td>");
                    tr.append(td);
                    var td = $("<td >" + (ret[i].hasOwnProperty("DOCUMENTO") ? ret[i].DOCUMENTO : "") + "</td>");
                    tr.append(td);
                    var td = $("<td>" + (ret[i].hasOwnProperty("NOMBRE_COMPLETO") ? ret[i].NOMBRE_COMPLETO : "") + "</td>");
                    tr.append(td);
                    var td = $("<td>" + (ret[i].hasOwnProperty("SALARIO") ? ret[i].SALARIO : "") + "</td>");
                    tr.append(td);
                    var td = $("<td class='horas' style='width: 15%;text-align: center;'> <div id='errorHoras" + i + "' class='error" + i + "'><input type='text' id ='horas" + i + "' min='0' onblur=\"calcular(this,'" + i + "');\"class='aplicada  form-control input-sm " + i + "'></div></td>");
                    tr.append(td);
                    var td = $("<td class='valor' style='width: 15%;text-align: center;'> <div id='errorValor" + i + "' class='error" + i + "'><input type='text' id ='valor" + i + "' class='aplicada  form-control input-sm " + i + "' disabled></div></td>");
                    tr.append(td);
                }

                $('#seleccionAll').click(function() {
                    var checked = this.checked;
                    $('.chkseleccion').each(function(e) {
                        this.checked = checked;
                    });
                });
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function sumarCheck(ths, index) {
    if ($('#checkbox' + index).prop('checked')) {
        $("#horas" + index).prop("disabled", false);
        $("#valor" + index).prop("disabled", true);

    }
    calcular(null, index, null);
}



function calcular(th, index, cant) {
    tipoconcep = $("#cmbConceptoNomina").find("option:selected").data("value2");
    var ConceptoId = $("#cmbConceptoNomina").val();
    if (ConceptoId.length === 0) {
        alertify.alert('Por favor seleccione un tipo de concepto');
    } else {
        if ($("#checkbox" + index).is(':checked')) {
            var salario = listarDetalleEmpleado[index].SALARIO;
            var cantidad = $("#horas" + index).val();
            var result = 0;
            if (ConceptoId == 1) {
                var valorHora = (salario / 240);
                var totalHora = (valorHora * cantidad);
                var porcentaje = totalHora * (25 / 100);
                result = (totalHora + porcentaje);
                $("#valor" + index).val(number_format(parseInt(result)));

            } else if (ConceptoId == 2) {
                var valorHora = (salario / 240);
                var totalHora = (valorHora * cantidad);
                var porcentaje = totalHora * (75 / 100);
                result = (totalHora + porcentaje);
                $("#valor" + index).val(number_format(parseInt(result)));

            } else if (ConceptoId == 3) {
                var valorHora = (salario / 240);
                var totalHora = (valorHora * cantidad);
                var porcentaje = totalHora * (75 / 100);
                result = (totalHora + porcentaje);
                $("#valor" + index).val(number_format(parseInt(result)));

            } else if (ConceptoId == 4) {
                var valorHora = (salario / 240);
                var totalHora = (valorHora * cantidad);
                var porcentaje = totalHora * (100 / 100);
                result = (totalHora + porcentaje);
                $("#valor" + index).val(number_format(parseInt(result)));

            } else if (ConceptoId == 5) {
                var valorHora = (salario / 240);
                var totalHora = (valorHora * cantidad);
                var porcentaje = totalHora * (150 / 100);
                result = (totalHora + porcentaje);
                $("#valor" + index).val(number_format(parseInt(result)));

            } else if (tipoconcep == 2) {
                result = (cantidad);
                $("#valor" + index).val(number_format(parseInt(result)));

            } else if (tipoconcep == 1) {
                result = (cantidad);
                $("#valor" + index).val(number_format(parseInt(result)));
            }

        } else {
            $("#valor" + index).val(0);
        }
    }
}

function listarCantidadValor() {
    var tipo = $("#cmbConceptoNomina").val();
    var listado = new Array();
    if (tipo.length > 0) {
        for (var i = 0; i < listarDetalleEmpleado.length; i++) {
            if ($("#checkbox" + i).is(':checked')) {
                listado.push({ idEmpleado: listarDetalleEmpleado[i].ID_EMPLEADO, cantidad: $("#horas" + i).val(), valor: $("#valor" + i).val() })
            }
        }
        return listado;
    }

}

function registrarNovedades() {
    var ConceptoId = $("#cmbConceptoNomina").val();
    var mesConcepto = $("#cmbMesConcepto").val();
    if (ConceptoId.length === 0) {
        alertify.alert('Por favor seleccione un tipo de concepto');
    } else {
        alertify.confirm('Mensaje', 'Esta segro de registrar las novedades', function() {
            var ur = CONTROLLERNOVEDADES;
            var op = 3;
            $.ajax({
                type: "POST",
                url: ur,
                data: ({
                    op: op,
                    ConceptoId: ConceptoId,
                    tipoconcepId: tipoconcep,
                    mesConcepto: mesConcepto,
                    listado: JSON.stringify(listarCantidadValor())
                }),
                beforeSend: function() {
                    $("#modalLoandig").modal('show');
                },
                success: function(data) {
                    var ret = eval('(' + data + ')');
                    if (ret.hasOwnProperty("success")) {
                        alertify.success(ret.success);
                        limpiarCampos();
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
        }, function() {});
    }
}

function number_format(amount, decimals) {
    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto
    decimals = decimals || 0; // por si la variable no fue fue pasada
    if (isNaN(amount) || amount === 0)
        return parseFloat(0).toFixed(decimals);
    amount = '' + amount.toFixed(decimals);
    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;
    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');
    return amount_parts.join('.');
}

function limpiarCampos() {
    $("#cmbConceptoNomina").val('').change();
    $("#tbl_visualizar_detalle_novedades tbody").html('');
    visualizarDetalleEmpleado();

}













































/*var listarNovedades = "";
var NovedadesD = "";

function listarCabeceraNovedades() {
    var ur = CONTROLLERNOVEDADES;
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
                listarNovedades = ret.data1;
                NovedadesD = ret.data2;
                var novedades = $("#tbl_visualizar_detalle_novedades");
                novedades.html('');
                var thead = $("<thead></thead>");
                novedades.append(thead);
                var tr = $("<tr class='info'></tr>");
                thead.append(tr);

                th = $("<th style='width:1%' ><input type='checkbox'  id='seleccionAll' value='' style='cursor:pointer'></th>");
                tr.append(th);
                th = $("<th style='width: 5% ;'>IDENTIFICACION</th>");
                tr.append(th);
                th = $("<th style='width: 17% ;'>NOMBRES Y APELLIDOS</th>");
                tr.append(th);
                var contador = ret.data1.length;
                var j = 0;
                for (var i = 0; i < ret.data1.length; i++) {
                    var th = $("<th>" + (ret.data1[i].hasOwnProperty("NOVEDADES") ? ret.data1[i].NOVEDADES : "") + "</th>")
                    tr.append(th);
                }
                var tbody = $("<tbody></tbody>");
                novedades.append(tbody);
                for (var i = 0; i < ret.data2.length; i++) {
                    var tr = $("<tr  style  = 'cursor:pointer; ' id='fila" + i + "'></tr>");
                    tbody.append(tr);
                    td = $("<td><input type='checkbox' id='checkbox" + i + "' style='cursor:pointer' class='chkseleccion'></td>");
                    tr.append(td);
                    var td = $("<td>" + (ret.data2[i].hasOwnProperty("NUMERO_DOCUMENTO") ? ret.data2[i].NUMERO_DOCUMENTO : "") + "</td>");
                    tr.append(td);
                    var td = $("<td>" + (ret.data2[i].hasOwnProperty("NOMBRE_COMPLETO") ? ret.data2[i].NOMBRE_COMPLETO : "") + "</td>");
                    tr.append(td);
                    if (j != contador) {
                        for (var n = 0; n < ret.data1.length; n++) {
                            var td = $("<td class='' style='text-align: center;'> <div id='error" + n + "' class='error" + n + "'><input type='number' id ='txt-" + ret.data1[n].ALIAS + "-" + i + "' class='form-control input-sm'  value='0'/></div></td>");
                            tr.append(td);
                        }
                    }
                    j++;
                }

                $('#seleccionAll').click(function() {
                    var checked = this.checked;
                    $('.chkseleccion').each(function(e) {
                        this.checked = checked;
                    });
                });
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

/*function recorrerInput() {
    var listado = new Array();
    listarNovedades;
    var j = 0;
    var contador = NovedadesD.length;
    for (var i = 0; i < NovedadesD.length; i++) {
        if (j != contador) {
            if ($("#checkbox" + i).is(':checked')) {
                for (var n = 0; n < listarNovedades.length; n++) {
                    var valor = $("#txt-" + listarNovedades[n].ALIAS + "-" + i).val();
                    if (valor.length > 0) {
                        // console.log(valor);
                        listado.push({ idEmpleado: NovedadesD[i].ID_EMPLEADO, valor: valor, idConcepto: listarNovedades[n].CON_NOM_ID, idTipoConcepto: listarNovedades[n].TIPO_CONCEPTO_ID })
                    }
                }
            }
        }
        j++;
    }
    return listado;
}*/

/*function recorrerInput() {
    var listado = new Array();
    listarNovedades;
    var j = 0;
    var contador = NovedadesD.length;
    for (var i = 0; i < NovedadesD.length; i++) {
        var salarioE = NovedadesD[i].SALARIO;
        var horaE = salarioE / 240;
        var valor = 0;
        if (j != contador) {
            if ($("#checkbox" + i).is(':checked')) {
                for (var n = 0; n < listarNovedades.length; n++) {
                    var cantidad = $("#txt-" + listarNovedades[n].ALIAS + "-" + i).val();
                    if (listarNovedades[n].ALIAS = "hed") {
                        total = (horaE * cantidad);
                        var sub = (total * (25 / 100));
                        valor = total + sub;
                        console.log(valor);
                    }
                    if (listarNovedades[n].ALIAS = "hen") {
                        total = (horaE * cantidad);
                        var sub = (total * (75 / 100));
                        valor = total + sub;
                        console.log(valor);
                    }
                    if (valor.length > 0) {
                        //console.log(valor);
                        listado.push({ idEmpleado: NovedadesD[i].ID_EMPLEADO, valor: valor, idConcepto: listarNovedades[n].CON_NOM_ID, idTipoConcepto: listarNovedades[n].TIPO_CONCEPTO_ID })
                    }
                }
            }
        }
        j++;
    }
    return listado;
}*/

/*function registrarNovedades() {
    alertify.confirm('Mensaje', 'Esta seguro de Registrar estas Novedades', function() {
        var ur = CONTROLLERNOVEDADES;
        var op = 2;
        $.ajax({
            type: "POST",
            url: ur,
            data: ({
                op: op,
                listado: JSON.stringify(recorrerInput())
            }),
            beforeSend: function() {
                $("#modalLoandig").modal('show');
            },
            success: function(data) {
                var ret = eval('(' + data + ')');
                if (ret.hasOwnProperty("success")) {
                    listarCabeceraNovedades();
                    alertify.success(ret.success);
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
    }, function() {});
}*/