$(document).ready(function() {

    visualizarConceptosNomina();

    listarTipoConcepto('cmbTipoConcepto');
    listarTipoConcepto('cmbTipoConceptoEdi');

    $("#btnGuardar").click(function() {
        validarcampos();
    });

    $("#btnActualizar").click(function() {
        actualizarConcepto();
    });



    var table = $('#tbl_visualizar_cargos').DataTable();
    $('#tbl_visualizar_cargos tbody').on('click', 'tr', function() {
        if ($(this).parents().hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
})

function listarTipoConcepto(idCombo) {
    var ur = CONTROLLERCONCEPTONOMINA;
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

function validarcampos() {
    var codigo = $("#txtCodigo").val();
    var tipoConceptos = $("#cmbTipoConcepto").val();
    var descripcion = $("#txtNombre").val();
    var estado = $("#cmbTipoEstado").val();
    if (codigo.length === 0) {
        alertify.error('El codigo de concepto no pede quedar vacio');
    } else if (tipoConceptos.length === 0) {
        alertify.error('El tipo de concepto no puede quedar vacio');
    } else if (descripcion.length === 0) {
        alertify.error('El nombre del concepto no puede uqedar vacio');
    } else if (estado.length === 0) {
        alertify.error('El estado del concepto no puede quedar vacio');
    } else {
        registrarConceptoNomina(codigo, tipoConceptos, descripcion, estado);
    }
}

function registrarConceptoNomina(codigo, tipoConceptos, descripcion, estado) {
    var ur = CONTROLLERCONCEPTONOMINA;
    var op = 2;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op,
            codigo: codigo,
            tipoConceptos: tipoConceptos,
            descripcion: descripcion,
            estado: estado

        }),
        success: function(data) {
            try {
                var ret = eval('(' + data + ')');
                if (ret.hasOwnProperty("success")) {
                    alertify.success(ret.success);
                    //visualizarConceptosNomina();
                    limpiarCampos();
                } else if (ret.hasOwnProperty("error")) {
                    alertify.alert('Mensaje', ret.error);
                }
            } catch (error) {

            }
        }
    })
}

function limpiarCampos() {
    $("#txtCodigo").val("");
    $("#cmbTipoConcepto").val("");
    $("#txtPorcentaje").val("");
    $("#txtNombre").val("");
    $("#cmbTipoEstado").val("");
}


var listaConceptos = 0;

function visualizarConceptosNomina() {
    var ur = CONTROLLERCONCEPTONOMINA;
    var table = $("#tbl_visualizar_cargos").DataTable({
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
                d.op = 3;
            },
            error: function() {
                $('#tbl_visualizar_cargos').css("display", "none");
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
            sSearch: "Buscar:",
            sLoadingRecords: "Cargando...",
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ registros",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla =(",
            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros"
        },
        data: listaConceptos,
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
            { name: "DESCRIPCION", data: "DESCRIPCION", width: "45%" },
            { name: "TIPO CONCEPTO", data: "TIPO_CONCEPTO", width: "15%" },
            { name: "ESTADO", data: "ESTADO", width: "15%" },
            {
                name: "ORDEN",
                data: null,
                className: "text-center",
                render: function(data) {
                    return '<a onclick =\"consultarInformacionConcepto(' + data.CONCEPTO_ID + ');\"  data-toggle="modal" data-target="#modalEdiConceptos"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                },
                width: "7%"
            }
        ],
        order: [0, 'desc']
    });
    $('div.dataTables_filter input').addClass('form-control input-sm');
}

var concepId = "";

function consultarInformacionConcepto(index) {
    let dt = $('#tbl_visualizar_cargos').DataTable();
    setTimeout(function() {
        let data = dt.rows('.selected').data()
        console.log(data[0]);

        concepId = data[0].CONCEPTO_ID;
        var codigo = data[0].CODIGO;
        var tipoConceptos = data[0].TIPO_CONCEPTO_ID;
        var nombre = data[0].DESCRIPCION;
        var estado = data[0].ESTADO_ID;

        $("#txtCodigoEdi").val(codigo);
        $("#cmbTipoConceptoEdi").val(tipoConceptos);
        $("#txtNombreEdi").val(nombre);
        $("#cmbTipoEstadoEdi").val(estado);

    }, 1000);
}

function actualizarConcepto() {
    var codigo = $("#txtCodigoEdi").val();
    var tipoConceptos = $("#cmbTipoConceptoEdi").val();
    var nombre = $("#txtNombreEdi").val();
    var estado = $("#cmbTipoEstadoEdi").val();

    if (concepId === "") {
        alertify.alert("Mensaje", 'Por favor seleccione un concepto de nomina.');
    } else if (codigo.length === 0) {
        alertify.alert("Mensaje", 'El codigo no puede quedar vacio.');
    } else if (tipoConceptos.length === 0) {
        alertify.alert("Mensaje", 'El tipo de concepto no puede quedar vacio.');
    } else if (nombre.length === 0) {
        alertify.alert("Mensaje", 'El nombre del concetp no puede quedar vacio.');
    } else if (estado.length === 0) {
        alertify.alert("Mensaje", 'El estado no puede quedar vacio.');
    } else {
        alertify.confirm('Mensaje', 'Esta seguro que desea actualizar la informacion del concepto de nomina.?', function() {
            var ur = CONTROLLERCONCEPTONOMINA;
            var op = 4;
            $.ajax({
                type: "POST",
                url: ur,
                data: ({
                    op: op,
                    concepId: concepId,
                    codigo: codigo,
                    tipoConceptos: tipoConceptos,
                    nombre: nombre,
                    estado: estado
                }),
                success: function(data) {
                    try {
                        var ret = eval('(' + data + ')');
                        if (ret.hasOwnProperty("success")) {
                            $("#modalEdiConceptos").modal("hide");
                            $('#tbl_visualizar_cargos').DataTable().ajax.reload();
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

        }, function() {});
    }

}