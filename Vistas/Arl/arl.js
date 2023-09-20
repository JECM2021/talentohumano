$(document).ready(function() {
    listarTipoFondo("cmbTipoFondo");
    listarComboTipoDocumento("cmbTipoDocumento");
    cuentacontable("AuxContable");
    cuentacontable("AuxFiscal");
    cuentacontable("AuxNormas");

    $("#btnGuardar").click(function() {
        validarArl();
    });

    $("#btnCancelar").click(function() {
        limpiarCampos();
    });

    visualizarArl();
    var table = $('#tbl_visualizar_Arl').DataTable();
    $('#tbl_visualizar_Arl tbody').on('click', 'tr', function() {
        if ($(this).parents().hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
});

function listarTipoFondo() {
    var ur = CONTROLLERARL;
    var op = 1;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op
        }),
        success: function(data) {
            var ret = eval('(' + data + ')');
            try {
                $listarCombo = $("#cmbTipoFondo");
                $listarCombo.html('');
                var option = $("<option value=''>Seleccione</option>");
                $listarCombo.append(option);
                for (var i = 0; i < ret.length; i++) {
                    var option = $("<option  value = " + ret[i].ID + ">" + ret[i].DESCRIPCION + "</option>");
                    $listarCombo.append(option);
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function listarComboTipoDocumento() {
    var ur = CONTROLLERARL;
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
                $listarCombo = $("#cmbTipoDocumento");
                $listarCombo.html('');
                var option = $("<option value=''>Seleccione</option>")
                $listarCombo.append(option);
                for (var i = 0; i < ret.length; i++) {
                    var option = $("<option  value = " + ret[i].ID + ">" + ret[i].DESCRIPCION + "</option>");
                    $listarCombo.append(option);
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function cuentacontable(pref) {
    $("#txt" + pref).autoComplete({
        minLength: 0,
        minChars: 1,
        delay: 300,
        source: function(request, response) {
            var dat = $("#txt" + pref).val();
            $.ajax({
                type: "POST",
                url: CONTROLLERARL,
                dataType: "json",
                data: {
                    q: request.term,
                    op: 3,
                    pat: dat
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: item.nombre,
                            value: item.cuenta,
                            id: item.idcuenta
                        };
                    }));
                }
            });
        },
        renderItem: function(item, search) {
            var itemlabel = item.label;
            var itemvalue = item.value;
            var itemurl = item.id;
            search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&'); //unused
            var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi"); //unused
            return '<div class="autocomplete-suggestion" data-evento="' + itemurl + ' "data-val="' + itemvalue + '"><span style="color:blue;font-weight:bold">' + itemlabel + '</div>';
        },
        onSelect: function(e, term, item) {
            var idCuenta = $(item[0]).attr("data-evento");
            $("#txtId" + pref).val(idCuenta);
        }
    })
}

function validarArl() {
    var codigo = $("#txtCodigoArl").val();
    var nombreArl = $("#txtNombreArl").val();
    var tipoDocumentoArl = $("#cmbTipoDocumento").val();
    var numDocumentoArl = $("#txtNumDocumento").val();
    var codAdministradora = $("#txtCodAdminArl").val();
    var riesgoCero = $("#txtRiesgoCero").val();
    var riesgoUno = $("#txtRiesgoUno").val();
    var riesgoDos = $("#txtRiesgoDos").val();
    var riesgoTres = $("#txtRiesgoTres").val();
    var riesgoCuatro = $("#txtRiesgoCuatro").val();
    var riesgoCinco = $("#txtRiesgoCinco").val();
    var riesgoSeis = $("#txtRiesgoSeis").val();
    var riesgoSiete = $("#txtRiesgoSiete").val();
    //var auxContableArl = $("#txtIdAuxContable").val();
    //var auxFiscalArl = $("#txtIdAuxFiscal").val();
    //var auxNormasArl = $("#txtIdAuxNormas").val();
    //var fuenteContable = $("#txtFuentesContables").val();
    var tipoFondo = $("#cmbTipoFondo").val();
    var estadoFondo = $("#cmbEstadoFondo").val();
    var editar = $("#txtEditar").val();
    var idArl = $("#txtIdFondoArl").val();
    if (codigo.length === 0) {
        alertify.alert('Mensaje', 'El Codigo no puede quedar vacio');
    } else if (nombreArl.length === 0) {
        alertify.alert('Mensaje', 'El Nombre no puede quedar vacio');
    } else if (tipoDocumentoArl.length === 0) {
        alertify.alert('Mensaje', 'Seleccione un tipo de documento');
    } else if (numDocumentoArl.length === 0) {
        alertify.alert('Mensaje', 'Por favor digite el numero de documento');
    } else if (codAdministradora.length === 0) {
        alertify.alert('Mensaje', 'El codigo de Administradora no puede quedar vacio');
    } else if (riesgoCero.length === 0) {
        alertify.alert('Mensaje', 'Digite el nivel de riesgo');
    } else if (tipoFondo.length === 0) {
        alertify.alert('Mensaje', 'Seleccione un tipo de fondo');
    } else if (estadoFondo.length === 0) {
        alertify.alert('Mensaje', 'Seleccione estado del fondo');
    } else {
        registrarArl(codigo, nombreArl, tipoDocumentoArl, numDocumentoArl, codAdministradora, riesgoCero, riesgoUno, riesgoDos, riesgoTres,
            riesgoCuatro, riesgoCinco, riesgoSeis, riesgoSiete, tipoFondo, estadoFondo,
            editar, idArl);
    }
}

function registrarArl(codigo, nombreArl, tipoDocumentoArl, numDocumentoArl, codAdministradora, riesgoCero, riesgoUno, riesgoDos, riesgoTres,
    riesgoCuatro, riesgoCinco, riesgoSeis, riesgoSiete, tipoFondo, estadoFondo,
    editar, idArl) {

    var ur = CONTROLLERARL;
    var op = 4;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op,
            codigo: codigo,
            nombreArl: nombreArl,
            tipoDocumentoArl: tipoDocumentoArl,
            numDocumentoArl: numDocumentoArl,
            codAdministradora: codAdministradora,
            riesgoCero: riesgoCero,
            riesgoUno: riesgoUno,
            riesgoDos: riesgoDos,
            riesgoTres: riesgoTres,
            riesgoCuatro: riesgoCuatro,
            riesgoCinco: riesgoCinco,
            riesgoSeis: riesgoSeis,
            riesgoSiete: riesgoSiete,
            tipoFondo: tipoFondo,
            estadoFondo: estadoFondo,
            editar: editar,
            idArl: idArl
        }),
        success: function(data) {
            try {
                var ret = eval('(' + data + ')');
                if (ret.hasOwnProperty("success")) {
                    $('#tbl_visualizar_Arl').DataTable().ajax.reload();
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

function limpiarCampos() {
    $("#txtCodigoArl").val('');
    $("#txtEditar").val('');
    $("#txtIdFondoArl").val('');
    $("#txtNombreArl").val('');
    $("#cmbTipoDocumento").val('').change();
    $("#txtNumDocumento").val('');
    $("#txtCodAdminArl").val('');
    $("#txtRiesgoCero").val('');
    $("#txtRiesgoUno").val('');
    $("#txtRiesgoDos").val('');
    $("#txtRiesgoTres").val('');
    $("#txtRiesgoCuatro").val('');
    $("#txtRiesgoCinco").val('');
    $("#txtRiesgoSeis").val('');
    $("#txtRiesgoSiete").val('');
    /*$("#txtAuxContable").val('');
    $("#txtIdAuxContable").val('');
    $("#txtAuxFiscal").val('');
    $("#txtIdAuxFiscal").val('');
    $("#txtAuxNormas").val('');
    $("#txtIdAuxNormas").val('');
    $("#txtFuentesContables").val('');*/
    $("#cmbTipoFondo").val('');
    $("#cmbEstadoFondo").val('');
    $("#btnGuardar").text("Guardar");
}
var listarArl = 0;

function visualizarArl() {
    var ur = CONTROLLERARL;
    var table = $("#tbl_visualizar_Arl").DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: ur,
            type: "POST",
            data: function(d) {
                $.each(d.columns, function(i, col) {
                    d.columns[i].data = undefined
                    d.columns[i].searchable = undefined
                    d.columns[i].orderable = undefined
                    d.columns[i].search = col.search.value
                });
                d.op = 5;
            },
            error: function() {
                $('#tbl_visualizar_Arl').css("display", "none");
            }
        },
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copy', attr: { id: 'allan' } }, 'csv', 'excel', 'pdf'
        ],
        paging: true,
        lengthChange: false,
        lengthMenu: [20],
        ordering: true,
        autoWidth: true,
        searching: true,
        language: {
            paginate: {
                last: "<i class='fa fa-angle-double-right'></i>",
                first: "<i class='fa fa-angle-double-left'></i>",
                next: "<i class='fa fa-angle-right'></i>",
                previous: "<i class='fa fa-angle-left'></i>",
            },
            sSearch: "Buscar",
            sLoadingRecords: "Cargando...",
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ registros",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla =(",
            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros"
        },
        data: listarArl,
        columns: [

            {
                name: "CONSECUTIVO",
                data: null,
                width: "3%",
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { name: "CODIGO", data: "CODIGO", width: "10%" },
            { name: "RAZON SOCIAL", data: "RAZON_SOCIAL", width: "35%" },
            { name: "TIPO DE DOCUMENTO", data: "TIPO_DOCUMENTO", width: "15%" },
            { name: "NUMERO DOCUMENTO", data: "NUMERO_DOCUMENTO", width: "15%" },
            { name: "TIPO DE FONDO", data: "TIPO_DE_FONDO", width: "10%" },
            { name: "ESTADO", data: "ESTADO_ARL", width: "10%" },
            {
                name: "ORDEN",
                data: null,
                className: "text-center",
                render: function(data) {
                    return '<a onclick =\"obtenerDatosFondoArl(' + data.ARL_ID + ');\"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                },
                width: "7%"
            },
            {
                name: "ELIMI",
                data: null,
                className: "text-center",
                render: function(data) {
                    return '<a onclick =\"eliminarInformacionArl(' + data.ARL_ID + ');\"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                },
                width: "7%"
            }

        ],
        order: [1, 'asc']
    });
    $('div.dataTables_filter input').addClass('form-control input-sm');
}

var arlId = "";

function obtenerDatosFondoArl() {
    let dt = $('#tbl_visualizar_Arl').DataTable();
    setTimeout(function() {
        let data = dt.rows('.selected').data()
        arlId = data[0].ARL_ID;
        var codigo = data[0].CODIGO;
        var nombre = data[0].RAZON_SOCIAL;
        var tipoDocumento = data[0].TIPO_DOCUMENTO_ID;
        var numDocumento = data[0].NUMERO_DOCUMENTO;
        var tipoFondo = data[0].TIPO_DE_FONDO_ID;
        var codAdmin = data[0].COD_ADMINISTRADORA;
        var estado = data[0].ESTADO_ARL_ID;
        /*var auxContableAid = data[0].AUX_CONT_ARL_ID;
        var auxFiscalAid = data[0].AUX_FISCAL_ARL_ID;
        var auxNormasAid = data[0].AUX_NORMAS_ARL_ID;
        var auxContableA = data[0].AUX_CONT_ARL;
        var auxFiscalA = data[0].AUX_FISCAL_ARL;
        var auxNormasA = data[0].AUX_NORMAS_ARL;*/
        var riesgoCero = data[0].RIESGO_CERO;
        var riesgoUno = data[0].RIESGO_UNO;
        var riesgoDos = data[0].RIESGO_DOS;
        var riesgoTres = data[0].RIESGO_TRES;
        var riesgoCuatro = data[0].RIESGO_CUATRO;
        var riesgoCinco = data[0].RIESGO_CINCO;
        var riesgoSeis = data[0].RIESGO_SEIS;
        var riesgoSiete = data[0].RIESGO_SIETE;
        //var fuenteContable = data[0].FUENTE_CONTABLE;



        $("#txtCodigoArl").val(codigo);
        $("#txtIdFondoArl").val(arlId);
        $("#txtNombreArl").val(nombre);
        $("#cmbTipoDocumento").val(tipoDocumento);
        $("#txtNumDocumento").val(numDocumento);
        $("#txtCodAdminArl").val(codAdmin);
        $("#txtRiesgoCero").val(riesgoCero);
        $("#txtRiesgoUno").val(riesgoUno);
        $("#txtRiesgoDos").val(riesgoDos);
        $("#txtRiesgoTres").val(riesgoTres);
        $("#txtRiesgoCuatro").val(riesgoCuatro);
        $("#txtRiesgoCinco").val(riesgoCinco);
        $("#txtRiesgoSeis").val(riesgoSeis);
        $("#txtRiesgoSiete").val(riesgoSiete);
        /*$("#txtAuxContable").val(auxContableA);
        $("#txtAuxFiscal").val(auxFiscalA);
        $("#txtAuxNormas").val(auxNormasA);
        $("#txtIdAuxContable").val(auxContableAid);
        $("#txtIdAuxFiscal").val(auxFiscalAid);
        $("#txtIdAuxNormas").val(auxNormasAid);*/
        $("#cmbTipoFondo").val(tipoFondo);
        $("#cmbEstadoFondo").val(estado);
        // $("#txtFuentesContables").val(fuenteContable);

        $("#txtEditar").val(1);
        $("#btnGuardar").text("Actualizar");
    }, 1);

}

var arlEliminar = "";

function eliminarInformacionArl() {
    let dte = $('#tbl_visualizar_Arl').DataTable();
    setTimeout(function() {
        let datae = dte.rows('.selected').data()
        arlEliminar = datae[0].ARL_ID;
    }, 100);
    setTimeout(function() {
        if (arlEliminar === "") {
            alertify.alert("Mensaje", 'Por favor vuelva a seleccionar la arl.');
        } else {
            alertify.confirm('Mensaje', '¿Esta seguro que desea eliminar el arl.?', function() {
                var ur = CONTROLLERARL;
                var op = 6;
                $.ajax({
                    type: "POST",
                    url: ur,
                    data: ({
                        op: op,
                        arlEliminar: arlEliminar
                    }),
                    success: function(data) {
                        try {
                            var ret = eval('(' + data + ')');
                            if (ret.hasOwnProperty("success")) {
                                alertify.success(ret.success);
                                $('#tbl_visualizar_Arl').DataTable().ajax.reload();
                            } else {
                                alertify.error(ret.error);
                            }
                        } catch (e) {}
                    },
                    error: function(objeto, error, error2) {
                        alertify.alert(error);
                    }
                });
            }, function() {});
        }
    }, 400);
}