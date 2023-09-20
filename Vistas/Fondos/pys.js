$(document).ready(function() {
    ListarTipoFondo("cmbTipoFondo");
    listarcomboFondo("cmbFondo");
    listarComboTipoDocumento("cmbTipoDocumento");
    listarComboTipoDocumentoEps("cmbTipoDocumentoEps");
    listarcomboFondoEps("cmbFondoEstado");

    //visualizarFondosEps();
    //cuentacontable("AuxContable");
    // cuentacontable("AuxFiscal");
    // cuentacontable("AuxNormas");
    // cuentacontable("FspAuxContable");
    //  cuentacontable("FspAuxFiscal");
    // cuentacontable("FspAuxNormas");
    //  cuentacontable("EduAuxContable");
    // cuentacontable("EduAuxFiscal");
    // cuentacontable("EduAuxNormas");
    // cuentacontable("AuxContableEps");
    // cuentacontable("AuxFiscalEps");
    // cuentacontable("AuxNormasEps");



    $("#btnGuardar").click(function() {
        validarCampos();
    });

    $("#btnGuardarEps").click(function() {
        validarCamposEps();
    });

    $("#btnCancelar").click(function() {
        limpiarCampos();
    });

    $("#btnCancelarEps").click(function() {
        limpiarCamposDos();
    });


    visualizarFondosPension();
    var table = $('#tbl_visualizar_pension').DataTable();
    $('#tbl_visualizar_pension tbody').on('click', 'tr', function() {
        if ($(this).parents().hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    visualizarFondosEps();
    var table = $('#tbl_visualizar_eps').DataTable();
    $('#tbl_visualizar_eps tbody').on('click', 'tr', function() {
        if ($(this).parents().hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

});

function ListarTipoFondo() {
    var ur = CONTROLLERFONDOS;
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
                $listarCombo = $("#cmbTipoFondoDe");
                $listarCombo.html('');
                //  var option = $("<option value=''>Seleccione</option>");
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

function listarcomboFondo() {
    var ur = CONTROLLERFONDOS;
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
                $listarCombo = $("#cmbFondo");
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

function listarcomboFondoEps() {
    var ur = CONTROLLERFONDOS;
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
                $listarCombo = $("#cmbFondoEstado");
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
    var ur = CONTROLLERFONDOS;
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
                $listarCombo = $("#cmbTipoDocumento");
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

function listarComboTipoDocumentoEps() {
    var ur = CONTROLLERFONDOS;
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
                $listarCombo = $("#cmbTipoDocumentoEps");
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

function limpiarCampos() {
    $("#cmbTipoFondo").val('');
    $("#txtCodigo").val('');
    $("#txtNombre").val('');
    $("#cmbTipoDocumento").val('').change();
    $("#txtNumDocumento").val('');
    $("#txtCodAdmin").val('');
    $("#txtPorcePension").val('');
    $("#txtAuxContable").val('');
    $("#txtAuxFiscal").val('');
    $("#txtAuxNormas").val('');
    $("#txtPorceFsp").val('');
    $("#txtFspAuxContable").val('');
    $("#txtFspAuxFiscal").val('');
    $("#txtFspAuxNormas").val('');
    $("#txtPorceEduAhorro").val('');
    $("#txtEduAuxContable").val('');
    $("#txtEduAuxFiscal").val('');
    $("#txtEduAuxNormas").val('');
    $("#cmbEstadoFondo").val('');
    $("#cmbFondo").val('');
    $("#cmbTipoFondo").val('');
    $("#txtEditar").val('');
    $("#txtIdAuxContable").val('');
    $("#txtIdAuxFiscal").val('');
    $("#txtIdAuxNormas").val('');
    $("#txtIdFspAuxContable").val('');
    $("#txtIdFspAuxFiscal").val('');
    $("#txtIdFspAuxNormas").val('');
    $("#txtIdEduAuxContable").val('');
    $("#txtIdEduAuxFiscal").val('');
    $("#txtIdEduAuxNormas").val('');
    $("#btnGuardar").text("Guardar")

}

function limpiarCamposDos() {
    $("#txtCodigoEps").val('');
    $("#txtNombreEps").val('');
    $("#cmbTipoDocumentoEps").val('').change();
    $("#txtNumDocumentoEps").val('');
    $("#txtCodAdminEps").val('');
    $("#txtPorcePensionEps").val('');
    $("#txtAuxContableEps").val('');
    $("#txtAuxFiscalEps").val('');
    $("#txtAuxNormasEps").val('')
    $("#cmbFondoEstado").val('');
    $("#cmbEstadoFondoEps").val('');
    $("#txtIdAuxContableEps").val('');
    $("#txtIdAuxFiscalEps").val('');
    $("#txtIdAuxNormasEps").val('');
}

function validarCampos() {
    var fondoPension = $("#txtFondoPension").val();
    var codigo = $("#txtCodigo").val();
    var nombre = $("#txtNombre").val();
    var tipoDocumento = $("#cmbTipoDocumento").val();
    var numDocumento = $("#txtNumDocumento").val();
    var codAdmin = $("#txtCodAdmin").val();
    var porcPension = $("#txtPorcePension").val();
    /*var auxContablePension = $("#txtIdAuxContable").val();
     var auxFiscalPension = $("#txtIdAuxFiscal").val();
     var auxNormasPension = $("#txtIdAuxNormas").val();*/
    var porcFsp = $("#txtPorceFsp").val();
    /*var auxContableFsp = $("#txtIdFspAuxContable").val();
    var auxFiscalFsp = $("#txtIdFspAuxFiscal").val();
    var auxNormasFsp = $("#txtIdFspAuxNormas").val();*/
    var porcEdu = $("#txtPorceEduAhorro").val();
    /* var auxContableEdu = $("#txtIdEduAuxContable").val();
     var auxFiscalEdu = $("#txtIdEduAuxFiscal").val();
     var auxNormasEdu = $("#txtIdEduAuxNormas").val();*/
    var tipoDeFondo = $("#cmbFondo").val();
    var estadoFondo = $("#cmbEstadoFondo").val();
    var idFondoPension = $("#txtIdFondoPension").val();
    var editar = $("#txtEditar").val();

    //////////////////////////////////////////////////
    if (codigo.length === 0) {
        alertify.alert('Mensaje', 'El Codigo no puede quedar vacio');
    } else if (nombre.length === 0) {
        alertify.alert('Mensaje', 'El Nombre no puede quedar vacio');
    } else if (tipoDocumento.length === 0) {
        alertify.alert('Mensaje', 'Seleccione un tipo de documento');
    } else if (numDocumento.length === 0) {
        alertify.alert('Mensaje', 'Por favor digite el numero de Nit');
    } else if (codAdmin.length === 0) {
        alertify.alert('Mensaje', 'Por favor digite codigo de Administracion');
    } else if (porcPension.length === 0) {
        alertify.alert('Mensaje', 'El valor del porcentaje pension no puede quedar vacio');
    } else if (tipoDeFondo.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione un tipo de fondo');
    } else if (estadoFondo.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione el estado del fondo');
    } else {
        registrarfondo(fondoPension, codigo, nombre, tipoDocumento, numDocumento, codAdmin, porcPension, porcFsp, porcEdu, tipoDeFondo, estadoFondo, idFondoPension, editar);
    }

}

function registrarfondo(fondoDe, codigo, nombre, tipoDocumento, numDocumento, codAdmin, porcPension, porcFsp, porcEdu, tipoDeFondo, estadoFondo, idFondo, editar) {
    var ur = CONTROLLERFONDOS;
    var op = 4;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op,
            fondoDe: fondoDe,
            codigo: codigo,
            nombre: nombre,
            tipoDocumento: tipoDocumento,
            numDocumento: numDocumento,
            codAdmin: codAdmin,
            porcPension: porcPension,
            /*auxContablePension: auxContablePension,
            auxFiscalPension: auxFiscalPension,
            auxNormasPension: auxNormasPension,*/
            porcFsp: porcFsp,
            /*auxContableFsp: auxContableFsp,
            auxFiscalFsp: auxFiscalFsp,
            auxNormasFsp: auxNormasFsp,*/
            porcEdu: porcEdu,
            /*auxContableEdu: auxContableEdu,
            auxFiscalEdu: auxFiscalEdu,
            auxNormasEdu: auxNormasEdu,*/
            tipoDeFondo: tipoDeFondo,
            estadoFondo: estadoFondo,
            editar: editar,
            idFondo: idFondo
        }),
        success: function(data) {
            try {
                var ret = eval('(' + data + ')');
                if (ret.hasOwnProperty("success")) {
                    $('#tbl_visualizar_pension').DataTable().ajax.reload();
                    //visualizarFondosPension();
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

function validarCamposEps() {
    var codigoEps = $("#txtCodigoEps").val();
    var nombreEps = $("#txtNombreEps").val();
    var tipoDocumentoEps = $("#cmbTipoDocumentoEps").val();
    var numeroDocumentoEps = $("#txtNumDocumentoEps").val();
    var codAdminEps = $("#txtCodAdminEps").val();
    var porcSalud = $("#txtPorcePensionEps").val();
    /*var auxContableEps = $("#txtIdAuxContableEps").val();
    var auxFiscalEps = $("#txtIdAuxFiscalEps").val();
    var auxNormasEps = $("#txtIdAuxNormasEps").val();*/
    var tipoDeFondoEps = $("#cmbFondoEstado").val();
    var estadoFondoEps = $("#cmbEstadoFondoEps").val();
    var fondoDe = $("#txtFondoPensionEps").val();
    var editarEps = $("#txtEditarEps").val();
    var idFondoEps = $("#txtIdFondoEps").val();

    if (codigoEps.length === 0) {
        alertify.alert('Mensaje', 'El Codigo no puede quedar vacio');
    } else if (nombreEps.length === 0) {
        alertify.alert('Mensaje', 'El nombre no puede quedar vacio');
    } else if (tipoDocumentoEps.length === 0) {
        alertify.alert('Mensaje', 'Seleccione un tipo de documento');
    } else if (numeroDocumentoEps.length === 0) {
        alertify.alert('Mensaje', 'Por favor digite el numero de Nit');
    } else if (codAdminEps.length === 0) {
        alertify.alert('Mensaje', 'Por favor digite codigo de Administracion');
    } else if (porcSalud.length === 0) {
        alertify.alert('Mensaje', 'El valor del porcentaje no puede quedar vacio');
    } else {
        registrarfondoEps(fondoDe, codigoEps, nombreEps, tipoDocumentoEps, numeroDocumentoEps, codAdminEps, porcSalud, tipoDeFondoEps, estadoFondoEps, editarEps, idFondoEps);
    }
}

function registrarfondoEps(fondoDe, codigoEps, nombreEps, tipoDocumentoEps, numeroDocumentoEps, codAdminEps, porcSalud, tipoDeFondoEps, estadoFondoEps, editarEps, idFondoEps) {
    var ur = CONTROLLERFONDOS;
    var op = 7;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op,
            fondoDe: fondoDe,
            codigoEps: codigoEps,
            nombreEps: nombreEps,
            tipoDocumentoEps: tipoDocumentoEps,
            numeroDocumentoEps: numeroDocumentoEps,
            codAdminEps: codAdminEps,
            porcSalud: porcSalud,
            /*auxContableEps: auxContableEps,*/
            tipoDeFondoEps: tipoDeFondoEps,
            estadoFondoEps: estadoFondoEps,
            /*auxFiscalEps: auxFiscalEps,
            auxNormasEps: auxNormasEps,*/
            editarEps: editarEps,
            idFondoEps: idFondoEps
        }),
        success: function(data) {
            try {
                var ret = eval('(' + data + ')');
                if (ret.hasOwnProperty("success")) {
                    $('#tbl_visualizar_eps').DataTable().ajax.reload();
                    limpiarCamposDos();
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

var listadoFondoPensiones = 0;

function visualizarFondosPension() {
    var ur = CONTROLLERFONDOS;
    var table = $("#tbl_visualizar_pension").DataTable({
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
                d.op = 8;
            },
            error: function() {
                $('#tbl_visualizar_pension').css("display", "none");
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
        data: listadoFondoPensiones,
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
            { name: "RAZON SOCIAL", data: "RAZON_SOCIAL", width: "45%" },
            { name: "TIPO DE DOCUMENTO", data: "TIPO_DOCUMENTO", width: "15%" },
            { name: "NUMERO DE DOCUMENTO", data: "NUMERO_DOCUMENTO", width: "15%" },
            { name: "TIPO DE FONDO", data: "TIPO_DE_FONDO", width: "15%" },
            { name: "ESTADO", data: "ESTADO_FONDO", width: "15%" },
            {
                name: "ORDEN",
                data: null,
                className: "text-center",
                render: function(data) {
                    return '<a onclick =\"obtenerDatosFondoPension(' + data.FONDO_ID + ');\"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                },
                width: "7%"
            },
            {
                name: "ELIMI",
                data: null,
                className: "text-center",
                render: function(data) {
                    return '<a onclick =\"eliminarDatosFondoPension(' + data.FONDO_ID + ');\"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                },
                width: "7%"
            }

        ],
        order: [1, 'asc']
    });
    $('div.dataTables_filter input').addClass('form-control input-sm');
}

var listadoFondoEps = "";

function visualizarFondosEps() {
    var ur = CONTROLLERFONDOS;
    var table = $("#tbl_visualizar_eps").DataTable({
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
                d.op = 9;
            },
            error: function() {
                $('#tbl_visualizar_eps').css("display", "none");
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
        data: listadoFondoEps,
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
            { name: "RAZON SOCIAL", data: "RAZON_SOCIAL", width: "30%" },
            { name: "TIPO DE DOCUMENTO", data: "TIPO_DOCUMENTO", width: "15%" },
            { name: "NUMERO DE DOCUMENTO", data: "NUMERO_DOCUMENTO", width: "15%" },
            { name: "TIPO DE FONDO", data: "TIPO_DE_FONDO", width: "15%" },
            { name: "ESTADO", data: "ESTADO_FONDO", width: "20%" },
            {
                name: "ORDEN",
                data: null,
                className: "text-center",
                render: function(data) {
                    return '<a onclick =\"obtenerDatosFondoEps(' + data.FONDO_ID + ');\"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                },
                width: "7%"
            },
            {
                name: "ELIMI",
                data: null,
                className: "text-center",
                render: function(data) {
                    return '<a onclick =\"eliminarDatosFondoEps(' + data.FONDO_ID + ');\"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                },
                width: "7%"
            }

        ],
        order: [1, 'asc']
    });
    $('div.dataTables_filter input').addClass('form-control input-sm');
}

var idFondo = "";

function obtenerDatosFondoPension(index) {
    let dt = $('#tbl_visualizar_pension').DataTable();
    setTimeout(function() {
        let data = dt.rows('.selected').data()
        idFondo = data[0].FONDO_ID;
        var codigo = data[0].CODIGO;
        var nombre = data[0].RAZON_SOCIAL;
        var tipoDocumento = data[0].TIPO_DOCUMENTO_ID;
        var numDocumento = data[0].NUMERO_DOCUMENTO;
        var codAdmin = data[0].COD_ADMISINISTRADORA;
        var porPension = data[0].PORC_PENSION;
        /*var auxContableP = data[0].AUX_CONT_PENSION;
        var auxFiscalP = data[0].AUX_FISCAL_PENSION;
        var auxNormasP = data[0].AUX_NORMAS_PENSION;*/
        var porFsp = data[0].PORC_FSP;
        /*var auxContableF = data[0].AUX_CONT_FSP;
        var auxFiscalF = data[0].AUX_FISCAL_FSP;
        var auxNormasF = data[0].AUX_NORMAS_FSP;*/
        var porEdu = data[0].PORC_EDU;
        /*var auxContableE = data[0].AUX_CONT_EDU;
        var auxFiscalE = data[0].AUX_FISCAL_EDU;
        var auxNormasE = data[0].AUX_NORMAS_EDU;*/
        var tipoDeFondo = data[0].TIPO_DE_DONDO_ID;
        var estado = data[0].ESTADO;
        /*var auxContablePid = data[0].AUX_CONT_PENSION_ID;
        var auxFiscalPid = data[0].AUX_FISCAL_PENSION_ID;
        var auxNormasPid = data[0].AUX_NORMAS_PENSION_ID;
        var auxContableFid = data[0].AUX_CONT_FSP_ID;
        var auxFiscalFid = data[0].AUX_FISCAL_FSP_ID;
        var auxNormasFid = data[0].AUX_NORMAS_FSP_ID;
        var auxContableEid = data[0].AUX_CONT_EDU_ID;
        var auxFiscalEid = data[0].AUX_FISCAL_EDU_ID;
        var auxNormasEid = data[0].AUX_NORMAS_EDU_ID;*/

        $("#txtCodigo").val(codigo);
        $("#txtNombre").val(nombre);
        $("#cmbTipoDocumento").val(tipoDocumento);
        $("#txtNumDocumento").val(numDocumento);
        $("#txtCodAdmin").val(codAdmin);
        $("#txtPorcePension").val(porPension);
        /*$("#txtAuxContable").val(auxContableP);
        $("#txtAuxFiscal").val(auxFiscalP);
        $("#txtAuxNormas").val(auxNormasP);*/
        $("#txtPorceFsp").val(porFsp);
        /*$("#txtFspAuxContable").val(auxContableF);
        $("#txtFspAuxFiscal").val(auxFiscalF);
        $("#txtFspAuxNormas").val(auxNormasF);*/
        $("#txtPorceEduAhorro").val(porEdu);
        /* $("#txtEduAuxContable").val(auxContableE);
         $("#txtEduAuxFiscal").val(auxFiscalE);
         $("#txtEduAuxNormas").val(auxNormasE);*/
        $("#cmbFondo").val(tipoDeFondo);
        $("#cmbEstadoFondo").val(estado);
        $("#txtIdFondoPension").val(idFondo);
        /*$("#txtIdAuxContable").val(auxContablePid);
        $("#txtIdAuxFiscal").val(auxFiscalPid);
        $("#txtIdAuxNormas").val(auxNormasPid);
        $("#txtIdFspAuxContable").val(auxContableFid);
        $("#txtIdFspAuxFiscal").val(auxFiscalFid);
        $("#txtIdFspAuxNormas").val(auxNormasFid);
        $("#txtIdEduAuxContable").val(auxContableEid);
        $("#txtIdEduAuxFiscal").val(auxFiscalEid);
        $("#txtIdEduAuxNormas").val(auxNormasEid);*/
        $("#txtEditar").val(1);
        $("#btnGuardar").text("Actualizar");
    }, 1);

}
var elimPension = "";

function eliminarDatosFondoPension() {
    let dte = $('#tbl_visualizar_pension').DataTable();
    setTimeout(function() {
        let datae = dte.rows('.selected').data()
        elimPension = datae[0].FONDO_ID;
    }, 100);
    setTimeout(function() {
        if (elimPension === "") {
            alertify.alert("Mensaje", 'Por favor vuelva a seleccionar un fondo de pension.');
        } else {
            alertify.confirm('Mensaje', '¿Esta seguro que desea eliminar el fondo de pension.?', function() {
                var ur = CONTROLLERFONDOS;
                var op = 11;
                $.ajax({
                    type: "POST",
                    url: ur,
                    data: ({
                        op: op,
                        elimPension: elimPension
                    }),
                    success: function(data) {
                        try {
                            var ret = eval('(' + data + ')');
                            if (ret.hasOwnProperty("success")) {
                                alertify.success(ret.success);
                                $('#tbl_visualizar_pension').DataTable().ajax.reload();
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

function obtenerDatosFondoEps(index) {
    let dt = $('#tbl_visualizar_eps').DataTable();
    setTimeout(function() {
        let data = dt.rows('.selected').data()
        idFondoEps = data[0].FONDO_ID;
        var codigoEps = data[0].CODIGO;
        var nombreEps = data[0].RAZON_SOCIAL;
        var tipoDocumento = data[0].TIPO_DOCUMENTO_ID;
        var numDocumento = data[0].NUMERO_DOCUMENTO;
        var codAdmin = data[0].COD_ADMISINISTRADORA;
        var porcSalud = data[0].PORC_SALUD;
        /* var auxContableE = data[0].AUX_CONT_SALUD;
         var auxFiscalE = data[0].AUX_FISCAL_SALUD;
         var auxNormasE = data[0].AUX_NORMAS_SALUD;*/
        var tipoDeFondoEps = data[0].TIPO_DE_DONDO_ID;
        var estadoEps = data[0].ESTADO;
        /*var auxContableEpsId = data[0].AUX_CONT_SALUD_ID;
        var auxFiscalEpsId = data[0].AUX_FISCAL_SALUD_ID;
        var auxNormasEpsId = data[0].AUX_NORMAS_SALUD_ID;*/

        $("#txtCodigoEps").val(codigoEps);
        $("#txtNombreEps").val(nombreEps);
        $("#cmbTipoDocumentoEps").val(tipoDocumento);
        $("#txtNumDocumentoEps").val(numDocumento);
        $("#txtCodAdminEps").val(codAdmin);
        $("#txtPorcePensionEps").val(porcSalud);
        /* $("#txtAuxContableEps").val(auxContableE);
         $("#txtAuxFiscalEps").val(auxFiscalE);
         $("#txtAuxNormasEps").val(auxNormasE);*/
        $("#cmbFondoEstado").val(tipoDeFondoEps);
        $("#cmbEstadoFondoEps").val(estadoEps);
        $("#txtIdFondoEps").val(idFondoEps);
        /* $("#txtIdAuxContableEps").val(auxContableEpsId);
         $("#txtIdAuxFiscalEps").val(auxFiscalEpsId);
         $("#txtIdAuxNormasEps").val(auxNormasEpsId);*/
        $("#txtEditarEps").val(1);
        $("#txtCodigoEps").attr('disabled', true);
        $("#btnGuardarEps").text("Actualizar");
    }, 1);
}

var elimeps = "";

function eliminarDatosFondoEps() {
    let dte = $('#tbl_visualizar_eps').DataTable();
    setTimeout(function() {
        let datae = dte.rows('.selected').data()
        elimeps = datae[0].FONDO_ID;
    }, 100);
    setTimeout(function() {
        if (elimeps === "") {
            alertify.alert("Mensaje", 'Por favor vuelva a seleccionar un fondo de salud.');
        } else {
            alertify.confirm('Mensaje', '¿Esta seguro que desea eliminar el fondo de salud.?', function() {
                var ur = CONTROLLERFONDOS;
                var op = 12;
                $.ajax({
                    type: "POST",
                    url: ur,
                    data: ({
                        op: op,
                        elimeps: elimeps
                    }),
                    success: function(data) {
                        try {
                            var ret = eval('(' + data + ')');
                            if (ret.hasOwnProperty("success")) {
                                alertify.success(ret.success);
                                $('#tbl_visualizar_eps').DataTable().ajax.reload();
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

function cuentacontable(pref) {
    $("#txt" + pref).autoComplete({
        minLength: 0,
        minChars: 1,
        delay: 300,
        source: function(request, response) {
            var dat = $("#txt" + pref).val();
            $.ajax({
                type: "POST",
                url: CONTROLLERFONDOS,
                dataType: "json",
                data: {
                    q: request.term,
                    op: 10,
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