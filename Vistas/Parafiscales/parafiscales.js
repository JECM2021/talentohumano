$(document).ready(function() {


    $("#btnGuardar").click(function() {
        validarCampos();
    });

    $("#btnCancelar").click(function() {
        limpiarCampos();
    });
    cuentacontable("AuxContableSubfam");
    cuentacontable("AuxFiscalSubfam");
    cuentacontable("AuxNormasSubfam");
    cuentacontable("AuxContableIcbf");
    cuentacontable("AuxFiscalIcbf");
    cuentacontable("AuxNormasIcbf");
    cuentacontable("AuxContableSena");
    cuentacontable("AuxFiscalSena");
    cuentacontable("AuxNormasSena");
    ListarTipoFondo("cmbTipoFondo");
    visualizarParaf();

    var table = $('#tbl_visualizar_parafiscales').DataTable();
    $('#tbl_visualizar_parafiscales tbody').on('click', 'tr', function() {
        if ($(this).parents().hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
});

function cuentacontable(pref) {
    $("#txt" + pref).autoComplete({
        minLength: 0,
        minChars: 1,
        delay: 300,
        source: function(request, response) {
            var dat = $("#txt" + pref).val();
            $.ajax({
                type: "POST",
                url: CONTROLLERPARAFISCALES,
                dataType: "json",
                data: {
                    q: request.term,
                    op: 1,
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

function ListarTipoFondo() {
    var ur = CONTROLLERPARAFISCALES;
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

function validarCampos() {
    var codigo = $("#txtCodigo").val();
    var idParafiscal = $("#txtIdParafiscal").val();
    var editar = $("#txtEditarParafiscal").val();
    var nombreParafiscal = $("#txtNombre").val();
    var porcSubfam = $("#txtPorceSubfam").val();
    /*var auxContableSubfam = $("#txtIdAuxContableSubfam").val();
    var auxFicalSubfam = $("#txtIdAuxFiscalSubfam").val();
    var auxNormasSubfam = $("#txtIdAuxNormasSubfam").val();*/
    var nitSubfam = $("#txtNumDocumentoSubfam").val();
    var codAdminSubfam = $("#txtCodAdminSubfam").val();

    var porcIcbf = $("#txtPorceIcbf").val();
    /* var auxContableIcbf = $("#txtIdAuxContableIcbf").val();
     var auxFiscalIcbf = $("#txtIdAuxFiscalIcbf").val();
     var auxNormasIcbf = $("#txtIdAuxNormasIcbf").val();*/
    var nitIcbf = $("#txtNumDocumentoIcbf").val();
    var codAdminIcbf = $("#txtCodAdminIcbf").val();

    var porcSena = $("#txtPorceSena").val();
    /*var auxcontableSena = $("#txtIdAuxContableSena").val();
    var auxFiscalSena = $("#txtIdAuxFiscalSena").val();
    var auxNormasSena = $("#txtIdAuxNormasSena").val();*/
    var nitSena = $("#txtNumDocumentoSena").val();
    var codAdminSena = $("#txtCodAdminSena").val();

    var tipoFondo = $("#cmbTipoFondo").val();
    var estadoFondo = $("#cmbEstadoFondo").val();

    if (codigo.length === 0) {
        alertify.alert('Mensaje', 'El Codigo no puede quedar vacio');
    } else if (nombreParafiscal.length === 0) {
        alertify.alert('Mensaje', 'El Nombre no puede quedar vacio');
    } else if (estadoFondo.length === 0) {
        alertify.alert('Mensaje', 'Seleccione estado del fondo');
    } else if (tipoFondo.length === 0) {
        alertify.alert('Mensaje', 'Seleccione un tipo de fondo');
    } else {
        registrarParafiscal(codigo, idParafiscal, editar, nombreParafiscal, porcSubfam, nitSubfam, codAdminSubfam, porcIcbf, nitIcbf, codAdminIcbf, porcSena, nitSena, codAdminSena,
            tipoFondo, estadoFondo);


    }
}

function registrarParafiscal(codigo, idParafiscal, editar, nombreParafiscal, porcSubfam, nitSubfam, codAdminSubfam, porcIcbf, nitIcbf, codAdminIcbf, porcSena, nitSena, codAdminSena,
    tipoFondo, estadoFondo) {

    var ur = CONTROLLERPARAFISCALES;
    var op = 3;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op,
            codigo: codigo,
            idParafiscal: idParafiscal,
            editar: editar,
            nombreParafiscal: nombreParafiscal,
            porcSubfam: porcSubfam,
            /*auxContableSubfam: auxContableSubfam,
            auxFicalSubfam: auxFicalSubfam,
            auxNormasSubfam: auxNormasSubfam,*/
            nitSubfam: nitSubfam,
            codAdminSubfam: codAdminSubfam,
            porcIcbf: porcIcbf,
            /*auxContableIcbf: auxContableIcbf,
            auxFiscalIcbf: auxFiscalIcbf,
            auxNormasIcbf: auxNormasIcbf,*/
            nitIcbf: nitIcbf,
            codAdminIcbf: codAdminIcbf,
            porcSena: porcSena,
            /*auxcontableSena: auxcontableSena,
             auxFiscalSena: auxFiscalSena,
             auxNormasSena: auxNormasSena,*/
            nitSena: nitSena,
            codAdminSena: codAdminSena,
            tipoFondo: tipoFondo,
            estadoFondo: estadoFondo
        }),
        success: function(data) {
            try {
                var ret = eval('(' + data + ')');
                if (ret.hasOwnProperty("success")) {
                    $('#tbl_visualizar_parafiscales').DataTable().ajax.reload();
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
    $("#txtCodigo").val('');
    $("#txtEditarParafiscal").val('');
    $("#txtIdParafiscal").val('');
    $("#txtNombre").val('');
    $("#txtPorceSubfam").val('');
    $("#txtAuxContableSubfam").val('');
    $("#txtIdAuxContableSubfam").val('');
    $("#txtAuxFiscalSubfam").val('');
    $("#txtIdAuxFiscalSubfam").val('');
    $("#txtAuxNormasSubfam").val('');
    $("#txtIdAuxNormasSubfam").val('');
    $("#txtNumDocumentoSubfam").val('');
    $("#txtCodAdminSubfam").val('');
    $("#txtPorceIcbf").val('');
    $("#txtAuxContableIcbf").val('');
    $("#txtIdAuxContableIcbf").val('');
    $("#txtAuxFiscalIcbf").val('');
    $("#txtIdAuxFiscalIcbf").val('');
    $("#txtAuxNormasIcbf").val('');
    $("#txtIdAuxNormasIcbf").val('');
    $("#txtNumDocumentoIcbf").val('');
    $("#txtCodAdminIcbf").val('');
    $("#txtPorceSena").val('');
    $("#txtAuxContableSena").val('');
    $("#txtIdAuxContableSena").val('');
    $("#txtAuxFiscalSena").val('');
    $("#txtIdAuxFiscalSena").val('');
    $("#txtAuxNormasSena").val('');
    $("#txtIdAuxNormasSena").val('');
    $("#txtNumDocumentoSena").val('');
    $("#txtCodAdminSena").val('');
    $("#cmbTipoFondo").val('');
    $("#cmbEstadoFondo").val('');
    $("#txtCodigo").attr('disabled', false);
    $("#btnGuardar").text("Guardar");
}

var listadoParafiscal = 0;

function visualizarParaf() {
    var ur = CONTROLLERPARAFISCALES;
    var table = $("#tbl_visualizar_parafiscales").DataTable({
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
                d.op = 4;
            },
            error: function() {
                $('#tbl_visualizar_parafiscales').css("display", "none");
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
        data: listadoParafiscal,
        columns: [

            {
                name: "CONSECUTIVO",
                data: null,
                width: "3%",
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { name: "CODIGO", data: "PARAF_CODIGO", width: "10%" },
            { name: "RAZON SOCIAL", data: "PARAF_NOMBRE", width: "45%" },
            { name: "TIPO DE FONDO", data: "FONDO_NAME", width: "15%" },
            { name: "ESTADO", data: "ESTADO", width: "15%" },
            {
                name: "ORDEN",
                data: null,
                className: "text-center",
                render: function(data) {
                    return '<a onclick =\"obtenerDatosParaf(' + data.PARAF_ID + ');\"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                },
                width: "7%"
            },
            {
                name: "ELIMI",
                data: null,
                className: "text-center",
                render: function(data) {
                    return '<a onclick =\"eliminarInformacionParaf(' + data.PARAF_ID + ');\"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                },
                width: "7%"
            }

        ],
        order: [1, 'asc']
    });
    $('div.dataTables_filter input').addClass('form-control input-sm');
}

var parafId = "";

function obtenerDatosParaf() {
    let dt = $('#tbl_visualizar_parafiscales').DataTable();
    setTimeout(function() {
        let data = dt.rows('.selected').data()
        parafId = data[0].PARAF_ID;
        var codigoParaf = data[0].PARAF_CODIGO;
        var nombreParaf = data[0].PARAF_NOMBRE;
        var porcSubman = data[0].PORC_SUBMAN;
        var porcIcbf = data[0].PORC_ICBF;
        var porcSena = data[0].PORC_SENA;
        var auxContSubfamId = data[0].CONT_SUBFAM_ID;
        var auxContSubfam = data[0].CONT_SUBFAM;
        var auxFiscSubfamId = data[0].FISC_SUBFAM_ID;
        var auxFiscSubfam = data[0].FISC_SUBFAM;
        var auxNormSubfamId = data[0].NORMAS_SUBFAM_ID;
        var auxNormSubfam = data[0].NORMAS_SUBFAM;
        var auxContIcbfId = data[0].CONT_ICBF_ID;
        var auxContIcbf = data[0].CONT_ICBF;
        var auxFiscIcbfId = data[0].FISC_ICBF_ID;
        var auxFiscIcbf = data[0].FISC_ICBF;
        var auxNormIcbfId = data[0].NORMAS_ICBF_ID;
        var auxNormIcbf = data[0].NORMAS_ICBF;
        var auxContSenaId = data[0].CONT_SENA_ID;
        var auxContSena = data[0].CONT_SENA;
        var auxFiscSenaId = data[0].FISC_SENA_ID;
        var auxFiscSena = data[0].FISC_SENA;
        var auxNormSenaId = data[0].NORMAS_SENA_ID;
        var auxNormSena = data[0].NORMAS_SENA;
        var tipoDeFondo = data[0].TIPO_FONDO;
        var estadoParaf = data[0].ESTADO_ID;
        var nitSubfam = data[0].NITSUBFAM;
        var nitIcbf = data[0].NITICBF;
        var nitSena = data[0].NITSENA;
        var AdminSubfam = data[0].CODADMIN_SUBFAM;
        var AdminIcbf = data[0].CODADMIN_ICBF;
        var AdminSena = data[0].CODADMIN_SENA;

        $("#txtCodigo").val(codigoParaf);
        $("#txtIdParafiscal").val(parafId);
        $("#txtEditarParafiscal").val(1);
        $("#txtNombre").val(nombreParaf);
        $("#txtPorceSubfam").val(porcSubman);
        $("#txtPorceIcbf").val(porcIcbf);
        $("#txtPorceSena").val(porcSena);
        $("#txtAuxContableSubfam").val(auxContSubfam);
        $("#txtIdAuxContableSubfam").val(auxContSubfamId);
        $("#txtAuxFiscalSubfam").val(auxFiscSubfam);
        $("#txtIdAuxFiscalSubfam").val(auxFiscSubfamId);
        $("#txtAuxNormasSubfam").val(auxNormSubfam);
        $("#txtIdAuxNormasSubfam").val(auxNormSubfamId);
        $("#txtNumDocumentoSubfam").val(nitSubfam);
        $("#txtAuxContableIcbf").val(auxContIcbf);
        $("#txtIdAuxContableIcbf").val(auxContIcbfId);
        $("#txtAuxFiscalIcbf").val(auxFiscIcbf);
        $("#txtIdAuxFiscalIcbf").val(auxFiscIcbfId);
        $("#txtAuxNormasIcbf").val(auxNormIcbf);
        $("#txtIdAuxNormasIcbf").val(auxNormIcbfId);
        $("#txtNumDocumentoIcbf").val(nitIcbf);
        $("#txtAuxContableSena").val(auxContSena);
        $("#txtIdAuxContableSena").val(auxContSenaId);
        $("#txtAuxFiscalSena").val(auxFiscSena);
        $("#txtIdAuxFiscalSena").val(auxFiscSenaId);
        $("#txtAuxNormasIcbf").val(auxNormSena);
        $("#txtIdAuxNormasIcbf").val(auxNormSenaId);
        $("#txtNumDocumentoSena").val(nitSena);
        $("#cmbTipoFondo").val(tipoDeFondo);
        $("#cmbEstadoFondo").val(estadoParaf);
        $("#txtCodAdminSubfam").val(AdminSubfam);
        $("#txtCodAdminIcbf").val(AdminIcbf);
        $("#txtCodAdminSena").val(AdminSena);
        $("#txtCodigo").attr('disabled', true);
        $("#btnGuardar").text("Actualizar");
    }, 1);
}

var parfe = "";

function eliminarInformacionParaf(index) {
    let dte = $('#tbl_visualizar_parafiscales').DataTable();
    setTimeout(function() {
        let datae = dte.rows('.selected').data()
        parfe = datae[0].PARAF_ID;
    }, 100);
    setTimeout(function() {
        if (parfe === "") {
            alertify.alert("Mensaje", 'Por favor vuelva a seleccionar el fondo parafiscal.');
        } else {
            alertify.confirm('Mensaje', '¿Esta seguro que desea eliminar el fondo parafiscal.?', function() {
                var ur = CONTROLLERPARAFISCALES;
                var op = 5;
                $.ajax({
                    type: "POST",
                    url: ur,
                    data: ({
                        op: op,
                        parfe: parfe
                    }),
                    success: function(data) {
                        try {
                            var ret = eval('(' + data + ')');
                            if (ret.hasOwnProperty("success")) {
                                alertify.success(ret.success);
                                $('#tbl_visualizar_parafiscales').DataTable().ajax.reload();
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