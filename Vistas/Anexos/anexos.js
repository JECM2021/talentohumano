$(document).ready(function() {
    listarTipoAnexo('cmbTipoAnexoEditar');
    $("#btnActualizarA").click(function() {
        actualizarAnexo();
    });
    visualizarPacienteAnexo();
    var table = $('#tbl_visualizar_Pacientes').DataTable();
    $('#tbl_visualizar_Pacientes tbody').on('click', 'tr', function() {
        console.log($(this).find("td").eq(3).html());
        var contrato = $(this).find("td").eq(3).html();
        var documento = $(this).find("td").eq(1).html();
        var nombre = $(this).find("td").eq(2).html();
        $("#txtDocumentoAnexo").val(documento);
        $("#txtNombrePacienteAnexo").val(nombre);
        $("#txtNumEvento").val(contrato);
        $("#mdlBuscarEmpleados").modal('hide');
        detalleAnexos(contrato);
    });

});

var listarPacienteAnexo = 0;

function visualizarPacienteAnexo() {
    // $("#tbodyPacientes").html("<label style='float:left; margin-left:249%; margin-top:15%; font-size:11px;'>Cargando...</label><div class='lds-dual-ring' style='float:left; margin-top:%; margin-left:249%; width:5%;'></div>")
    var ur = CONTROLER_ANEXOS;
    var table = $('#tbl_visualizar_Pacientes').DataTable({
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
                $('#tbl_visualizar_Pacientes').css("display", "none");
            }
        },
        dom: 'Bfrtip',
        paging: true,
        lengthChange: false,
        lengthMenu: [8],
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
        data: listarPacienteAnexo,
        columns: [

            {
                name: "CODIGO",
                data: null,
                width: "3%",
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { name: "NUMERO_DOCUMENTO", data: "NUMERO_DOCUMENTO", width: "5%" },
            { name: "NOMBRE_COMPLETO", data: "NOMBRE_COMPLETO", width: "35%" },
            { name: "NUMERO_CONTRATO", data: "NUMERO_CONTRATO", width: "10%" },
            { name: "CENTRO_COSTO", data: "CENTRO_COSTO", width: "8%" },

        ],
        order: [0, 'desc']

    });
    $('div.dataTables_filter input').addClass('form-control input-sm');
}
var listarDetalleAnexo = 0;

function detalleAnexos(contrato) {

    $("#tbodyPacientesAnexo").html("<label style='float:left; margin-left:249%; margin-top:15%; font-size:11px;'>Cargando...</label><div class='lds-dual-ring' style='float:left; margin-top:%; margin-left:249%; width:5%;'></div>");

    //$("#txtNumId").val(idevento);
    var ur = CONTROLER_ANEXOS;
    var up = 3;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: up,
            contrato: contrato
        }),
        success: function(data) {
            var ret = eval('(' + data + ')');
            var contador = 1;
            listarDetalleAnexo = ret;
            try {
                $("#tbodyPacientesAnexo").html('');
                var listadoDetalleAnexo = $("#tbodyPacientesAnexo");
                $("#tbodyPacientesAnexo").append(listadoDetalleAnexo);
                for (var i = 0; i < ret.length; i++) {
                    var tr = $("<tr class='tblFiltradoPaciente' id='detAnexo" + ret[i].ID + "' style='cursor:pointer' onclick =\"colorCeltaTabla(this,1,'" + i + "');\" ></tr>")
                    listadoDetalleAnexo.append(tr);

                    var td = $("<td>" + contador + "</td>");
                    tr.append(td);
                    var td = $("<td>" + ret[i].FECHA_REGISTRO + "</td>");
                    tr.append(td);
                    var td = $("<td>" + ret[i].DESCRIPCION + "</td>");
                    tr.append(td);
                    var td = $("<td>" + ret[i].TIPO_ANEXO + "</td>");
                    tr.append(td);
                    var td = $("<td onclick =\"visualizarpdf('" + i + "');\"  ><i class='fa fa-file-pdf-o' aria-hidden='true'></i></td>")
                    tr.append(td);
                    var td = $("<td onclick =\"editarAnexo('" + i + "');\" ><i class='fa fa-pencil-square' aria-hidden='true'></i></td>")
                    tr.append(td);
                    var td = $("<td onclick =\"eliminarAnexo('" + ret[i].ID + "');\"  ><i class='fa fa-trash' aria-hidden='true'></i></td>")
                    tr.append(td);
                    contador++;
                }
                contador = 1;
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alert(error);
        }
    });
}

function visualizarpdf(index) {
    $("#ModalPdf").modal('show');
    var archivo = listarDetalleAnexo[index].NOMBRE;
    //console.log(archivo);
    var loc = window.location.host;
    $("#iframePDF").attr('src', 'http://' + loc + '/nomina/webPage/anexos/' + archivo);

}

function editarAnexo(index) {
    $("#modalEditarAnexo").modal('show');
    if (listarDetalleAnexo.length > 0) {
        var idAnexo = listarDetalleAnexo[index].ID;
        var documentoE = listarDetalleAnexo[index].DOCUMENTO
        var nombreE = listarDetalleAnexo[index].EMPLEADO;
        var tipoAnexoE = listarDetalleAnexo[index].ID_TIPO;
        var nombreAnexoE = listarDetalleAnexo[index].NOMBRE;
        var urlE = listarDetalleAnexo[index].RUTA;
        var detallleE = listarDetalleAnexo[index].DESCRIPCION;
        var fechaE = listarDetalleAnexo[index].FECHA_REGISTRO;
        $("#txtDocumentoEditar").val(documentoE);
        $("#txtNombrePacienteEditar").val(nombreE);
        $("#cmbTipoAnexoEditar").val(tipoAnexoE);
        $("#txtNombreEditarAnexo").val(nombreAnexoE);
        $("#txturl").val(urlE);
        $("#txtIdAnexo").val(idAnexo);
        $("#txtDetalleEditarDocumento").val(detallleE);
        $("#txtFechaDocumentoEditar").val(fechaE);
    }
}


function actualizarAnexo() {
    var fechaEditada = $("#txtFechaDocumentoEditar").val();
    var tipoAnexoEditado = $("#cmbTipoAnexoEditar").val();
    var DetalleEditado = $("#txtDetalleEditarDocumento").val();
    var idAnexo = $("#txtIdAnexo").val();
    if (idAnexo === "") {
        toastr.options = { "positionClass": "toast-bottom-right", };
        toastr.warning('Seleccione un Anexo.');
    } else if (fechaEditada.length === 0) {
        toastr.options = { "positionClass": "toast-bottom-right", };
        toastr.warning('La fecha no puede quedar vacia.');
    } else if (tipoAnexoEditado.length === 0) {
        toastr.options = { "positionClass": "toast-bottom-right", };
        toastr.warning('Seleccion un tipo de Anexo.');
    } else if (DetalleEditado.length === 0) {
        toastr.options = { "positionClass": "toast-bottom-right", };
        toastr.warning('El detalle del Anexo no puede quedar vacio.');
    } else {
        alertify.confirm('¿esta seguro que desea actualizar los Datos del Anexo.?', function() {
            var ur = CONTROLER_ANEXOS;
            var up = 4;
            $.ajax({
                type: "POST",
                url: ur,
                data: ({
                    op: up,
                    idAnexo: idAnexo,
                    fechaEditada: fechaEditada,
                    tipoAnexoEditado: tipoAnexoEditado,
                    DetalleEditado: DetalleEditado
                }),
                success: function(data) {
                    try {
                        var ret = eval('(' + data + ')');
                        if (ret.hasOwnProperty("success")) {
                            $("#modalEditarAnexo").modal("hide");
                            //detalleDocumentacion();
                            toastr.success(ret.success);
                        } else if (ret.hasOwnProperty("error")) {
                            toastr.error(ret.error);
                        }
                    } catch (e) {}
                },
                error: function(objeto, error, error2) {
                    alert(error);
                }
            })
        }, function() {});
    }
}

function eliminarAnexo(id) {
    alertify.confirm('Mensaje', 'Esta seguro que desea eliminar el Anexo?', function() {
        var ur = CONTROLER_ANEXOS;
        var up = 5;
        $.ajax({
            type: "POST",
            url: ur,
            data: ({
                op: up,
                idAnexo: id
            }),
            success: function(data) {
                try {
                    var ret = eval('(' + data + ')');
                    if (ret.hasOwnProperty("success")) {
                        $('#detAnexo' + id + '').remove();
                        toastr.success(ret.success);
                    } else {
                        toastr.error(ret.error);
                    }
                } catch (e) {}
            },
            error: function(objeto, error, error2) {
                alert(error);
            }
        });

    }, function() {});
}

function listarTipoAnexo(idCombo) {
    var ur = CONTROLER_ANEXOS;
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