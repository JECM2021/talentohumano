$(document).ready(function() {
    $("#btnGuardar").click(function() {
        validarCargos();
    });

    $("#btnCancelar").click(function() {
        limpiarCampos();
    });

    $("#btnActualizar").click(function() {
        actualizarCargos();
    });

    visualizarCargos();

    var table = $('#tbl_visualizar_cargos').DataTable();
    $('#tbl_visualizar_cargos tbody').on('click', 'tr', function() {
        if ($(this).parents().hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

});

function validarCargos() {
    var codigo = $("#txtCodigo").val();
    var descripcion = $("#txtNombre").val();
    var fechaCreacion = $("#fechaCreacion").val();
    var estado = $("#cmbTipoEstado").val();
    if (codigo.length === 0) {
        alertify.alert('Mensaje', 'El Codigo del cargo no puede quedar vacio');
    } else if (descripcion.length === 0) {
        alertify.alert('Mensaje', 'El Codigo del Cargo no puede quedar vacio');
    } else if (fechaCreacion.length === 0) {
        alertify.alert('Mensaje', 'La fecha de creacion no puede quedar vacia');
    } else if (estado === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione el estado del cargo');
    } else {
        registrarcargo(codigo, descripcion, fechaCreacion, estado);
    }
}

function registrarcargo(codigo, descripcion, fechaCreacion, estado) {
    var ur = CONTROLLERCARGOS;
    var op = 1;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op,
            codigo: codigo,
            descripcion: descripcion,
            fechaCreacion: fechaCreacion,
            estado: estado
        }),
        success: function(data) {
            try {
                var ret = eval('(' + data + ')');
                if (ret.hasOwnProperty("success")) {
                    alertify.success(ret.success);
                    limpiarCampos();
                    //$('#tbl_visualizar_pacientes').DataTable().ajax.reload();
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
    $("#txtCodigo").val("");
    $("#txtNombre").val("");
    $("#fechaCreacion").val("");
    $("#cmbTipoEstado").val("")
}

var listaCargos = 0;

function visualizarCargos() {
    var ur = CONTROLLERCARGOS;
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
                d.op = 2;
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
        data: listaCargos,
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
            { name: "FECHA", data: "FECHA_CREACION", width: "15%" },
            { name: "ESTADOS", data: "ESTADOS", width: "15%" },
            {
                name: "ORDEN",
                data: null,
                className: "text-center",
                render: function(data) {
                    return '<a onclick =\"consultarInformacionCargo(' + data.CARGO_ID + ');\"  data-toggle="modal" data-target="#modalEdiCargos"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                },
                width: "7%"
            }
        ],
        order: [1, 'asc']
    });
    $('div.dataTables_filter input').addClass('form-control input-sm');
}

var cargo = "";

function consultarInformacionCargo(index) {
    let dt = $('#tbl_visualizar_cargos').DataTable();
    setTimeout(function() {
        let data = dt.rows('.selected').data()
        console.log(data[0]);

        cargo = data[0].CARGO_ID;
        var codigoEdi = data[0].CODIGO;
        var descripcionEdi = data[0].DESCRIPCION;
        var fechaEdi = data[0].FECHA_CREACION;
        var estadoEdi = data[0].ESTADO;

        $("#txtCodigoEdi").val(codigoEdi);
        $("#txtNombreEdi").val(descripcionEdi);
        $("#fechaCreacionEdi").val(fechaEdi);
        $("#cmbTipoEstadoEdi").val(estadoEdi);
    }, 1000);
}

function actualizarCargos() {
    var codigo = $("#txtCodigoEdi").val();
    var descripcion = $("#txtNombreEdi").val();
    var fecha = $("#fechaCreacionEdi").val();
    var estado = $("#cmbTipoEstadoEdi").val();

    if (cargo === "") {
        alertify.alert("Mensaje", 'Por favor vuelva a seleccionar el cargo.');
    } else if (codigo.length === 0) {
        alertify.alert('Mensaje', 'El Codigo del cargo no puede quedar vacio');
    } else if (descripcion.length === 0) {
        alertify.alert('Mensaje', 'El Codigo del Cargo no puede quedar vacio');
    } else if (fecha.length === 0) {
        alertify.alert('Mensaje', 'La fecha de creacion no puede quedar vacia');
    } else if (estado.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione el estado del cargo');
    } else {
        alertify.confirm('Mensaje', '¿Esta seguro que desea actualizar la informacion de este paciente. ?', function() {
            var ur = CONTROLLERCARGOS;
            var op = 3;
            $.ajax({
                type: "POST",
                url: ur,
                data: ({
                    op: op,
                    cargo: cargo,
                    codigo: codigo,
                    descripcion: descripcion,
                    fecha: fecha,
                    estado: estado
                }),
                success: function(data) {
                    try {
                        var ret = eval('(' + data + ')');
                        if (ret.hasOwnProperty("success")) {
                            $("#modalEdiCargos").modal("hide");
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