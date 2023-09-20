$(document).ready(function() {
    listarComboTipoDocumento('cmbTipoDocumento');
    listarComboEstadoCivil('cmbEstadoCivil');
    listarComboSexo('cmbSexo');
    listarComboGrupoSanguineo('cmbGrupoSanguineo');
    listarComboEscolaridad('cmbNivelEscolaridad');
    listarComboNivelSocioEconomico('cmbEstratoSocial');
    listarComboDepartamento('cmbDepartamento');

    $("#btnGuardar").click(function() {
        validarCampos();
    });

    $("#btnCancelar").click(function() {
        limpiarCampos();
    });

    $("#btnActualizar").click(function() {
        actulizarDatosEmpleado();
    });

    $("#txtNumDocumento").keypress(function(event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode === 13) {
            buscarEmpleados();
        }
    });

    visualizarEmpleados();
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

function listarComboTipoDocumento(idCombo) {
    var ur = CONTROLLEREMPLEADO;
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
                $listarCombo = $("#" + idCombo);
                $listarCombo.html('');
                var option = $("<option value=''>Seleccione</option>");
                $listarCombo.append(option);
                for (var i = 0; i < ret.length; i++) {
                    var option = $("<option value = " + ret[i].ID + ">" + ret[i].DESCRIPCION + "</option>");
                    $listarCombo.append(option);
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function listarComboEstadoCivil(idCombo) {
    var ur = CONTROLLEREMPLEADO;
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
                $listarCombo = $("#" + idCombo);
                $listarCombo.html('');
                var option = $("<option value=''>Seleccione</option>");
                $listarCombo.append(option);
                for (var i = 0; i < ret.length; i++) {
                    var option = $("<option value = " + ret[i].ID + ">" + ret[i].DESCRIPCION + "</option>");
                    $listarCombo.append(option);
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function listarComboSexo(idCombo) {
    var ur = CONTROLLEREMPLEADO;
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
                $listarCombo = $("#" + idCombo);
                $listarCombo.html('');
                var option = $("<option value=''>Seleccione</option>");
                $listarCombo.append(option);
                for (var i = 0; i < ret.length; i++) {
                    var option = $("<option value = " + ret[i].ID + ">" + ret[i].DESCRIPCION + "</option>");
                    $listarCombo.append(option);
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function listarComboGrupoSanguineo(idCombo) {
    var ur = CONTROLLEREMPLEADO;
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
                $listarCombo = $("#" + idCombo);
                $listarCombo.html('');
                var option = $("<option value=''>Seleccione</option>");
                $listarCombo.append(option);
                for (var i = 0; i < ret.length; i++) {
                    var option = $("<option value = " + ret[i].ID + ">" + ret[i].DESCRIPCION + "</option>");
                    $listarCombo.append(option);
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function listarComboEscolaridad(idCombo) {
    var ur = CONTROLLEREMPLEADO;
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
                $listarCombo = $("#" + idCombo);
                $listarCombo.html('');
                var option = $("<option value=''>Seleccione</option>");
                $listarCombo.append(option);
                for (var i = 0; i < ret.length; i++) {
                    var option = $("<option value = " + ret[i].ID + ">" + ret[i].DESCRIPCION + "</option>");
                    $listarCombo.append(option);
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function listarComboNivelSocioEconomico(idCombo) {
    var ur = CONTROLLEREMPLEADO;
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
                $listarCombo = $("#" + idCombo);
                $listarCombo.html('');
                var option = $("<option value=''>Seleccione</option>");
                $listarCombo.append(option);
                for (var i = 0; i < ret.length; i++) {
                    var option = $("<option value = " + ret[i].ID + ">" + ret[i].DESCRIPCION + "</option>");
                    $listarCombo.append(option);
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function listarComboDepartamento(idCombo) {
    var ur = CONTROLLEREMPLEADO;
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
                $listarCombo = $("#" + idCombo);
                $listarCombo.html('');
                var option = $("<option value=''>Seleccione</option>");
                $listarCombo.append(option);
                for (var i = 0; i < ret.length; i++) {
                    var option = $("<option value = " + ret[i].ID + ">" + ret[i].DESCRIPCION + "</option>");
                    $listarCombo.append(option);
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function listarComboCiudad(valor, idDepartamento) {
    var idCiudad = valor.value;
    var ur = CONTROLLEREMPLEADO;
    var op = 8;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op,
            idDepartamento: idCiudad
        }),
        success: function(data) {
            var ret = eval('(' + data + ')');
            try {
                $listarCombo = $("#" + idDepartamento);
                $listarCombo.html('');
                var option = $("<option value=''>Seleccione</option>");
                $listarCombo.append(option);
                for (var i = 0; i < ret.length; i++) {
                    var option = $("<option value = " + ret[i].ID + ">" + ret[i].DESCRIPCION + "</option>");
                    $listarCombo.append(option);
                }
                setTimeout(function() { $("#" + idDepartamento).trigger('change'); }, 1000);
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function validarCampos() {
    var tipoDocumento = $("#cmbTipoDocumento").val();
    var numDocumento = $("#txtNumDocumento").val();
    var primerNombre = $("#txtPrimerNombre").val();
    var segundoNombre = $("#txtSegundoNombre").val();
    var primerApellido = $("#txtPrimerApellido").val();
    var segundoApellido = $("#txtSegundoApellido").val();
    var fechaNacimiento = $("#txtfechaDeNacimiento").val();
    var departamento = $("#cmbDepartamento").val();
    var ciudad = $("#cmbCiudad").val();
    var estadoCivil = $("#cmbEstadoCivil").val();
    var sexo = $("#cmbSexo").val();
    var grupoSanguineo = $("#cmbGrupoSanguineo").val();
    var estratoSocial = $("#cmbEstratoSocial").val();
    var correo = $("#txtEmail").val();
    var nivelEscolaridad = $("#cmbNivelEscolaridad").val();
    var estado = $("#cmbEstadoEmpleado").val();
    var editar = $("#txtEditar").val();
    var idEmpleado = $("#txtIdEmpleado").val();

    if (tipoDocumento.length === 0) {
        alertify.alert('Mensaje', 'Seleccione un tipo de documento');
    } else if (numDocumento.length === 0) {
        alertify.alert('Mensaje', 'Por favor digite el numero de documento');
    } else if (primerNombre.length === 0) {
        alertify.alert('Mensaje', 'Por favor digite el primer nombre');
    } else if (primerApellido.length === 0) {
        alertify.alert('Mensaje', 'Por favor digite el primer apellido');
    } else if (segundoApellido.length === 0) {
        alertify.alert('Mensaje', 'Por favor digite el segundo apellido');
    } else if (fechaNacimiento.length === 0) {
        alertify.alert('Mensaje', 'Por favor digite la fecha de nacimiento');
    } else if (departamento.length === 0) {
        alertify.alert('Mensaje', 'Por favor Seleccione un departamento');
    } else if (ciudad.length === 0) {
        alertify.alert('Mensaje', 'Por favor Seleccione una ciudad');
    } else if (estadoCivil.length === 0) {
        alertify.alert('Mensaje', 'Por favor Seleccione el estado civil');
    } else if (sexo.length === 0) {
        alertify.alert('Mensaje', 'Por favor Seleccione el sexo');
    } else if (grupoSanguineo.length === 0) {
        alertify.alert('Mensaje', 'Por favor Seleccione el grupo sanguineo');
    } else if (estratoSocial.length === 0) {
        alertify.alert('Mensaje', 'Por favor Seleccione el estrato social');
    } else if (correo.length === 0) {
        alertify.alert('Mensaje', 'Por favor digite el correo electronico');
    } else if (nivelEscolaridad.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione el nivel de escolaridad');
    } else if (estado.length === 0) {
        alertify.alert('Mensaje', 'Por favor seleccione el estado del empleado');
    } else {
        registrarEmpleado(tipoDocumento, numDocumento, primerNombre, segundoNombre, primerApellido, segundoApellido, fechaNacimiento, departamento, ciudad, estadoCivil, sexo,
            grupoSanguineo, estratoSocial, correo, nivelEscolaridad, estado, editar, idEmpleado)
    }

}

function registrarEmpleado(tipoDocumento, numDocumento, primerNombre, segundoNombre, primerApellido, segundoApellido, fechaNacimiento, departamento, ciudad, estadoCivil, sexo,
    grupoSanguineo, estratoSocial, correo, nivelEscolaridad, estado, editar, idEmpleado) {

    var ur = CONTROLLEREMPLEADO;
    var op = 9;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op,
            tipoDocumento: tipoDocumento,
            numDocumento: numDocumento,
            primerNombre: primerNombre,
            segundoNombre: segundoNombre,
            primerApellido: primerApellido,
            segundoApellido: segundoApellido,
            fechaNacimiento: fechaNacimiento,
            departamento: departamento,
            ciudad: ciudad,
            estadoCivil: estadoCivil,
            sexo: sexo,
            grupoSanguineo: grupoSanguineo,
            estratoSocial: estratoSocial,
            correo: correo,
            nivelEscolaridad: nivelEscolaridad,
            estado: estado,
            editar: editar,
            idEmpleado: idEmpleado
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
}

function limpiarCampos() {
    $("#cmbTipoDocumento").val('');
    $("#txtNumDocumento").val('');
    $("#txtPrimerNombre").val('');
    $("#txtSegundoNombre").val('');
    $("#txtPrimerApellido").val('');
    $("#txtSegundoApellido").val('');
    $("#txtfechaDeNacimiento").val('');
    $("#cmbDepartamento").val('').change();
    $("#cmbCiudad").val('');
    $("#cmbEstadoCivil").val('').change();
    $("#cmbSexo").val('').change();
    $("#cmbGrupoSanguineo").val('').change();
    $("#cmbEstratoSocial").val('').change();
    $("#txtEmail").val('');
    $("#cmbNivelEscolaridad").val('').change();
    $("#cmbEstadoEmpleado").val('').change();
}

function buscarEmpleados() {
    var ur = CONTROLLEREMPLEADO;
    var op = 10;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op,
            documento: $("#txtNumDocumento").val()
        }),
        success: function(data) {
            try {
                if (data != "") {
                    var ret = eval('(' + data + ')');
                    $("#txtIdEmpleado").val(ret[0].IDEMPLEADO);
                    $("#cmbTipoDocumento").val(ret[0].TIPODOCUMENTO).change();
                    $("#txtNumDocumento").val(ret[0].NUMDOCUMENTO);
                    $("#txtPrimerNombre").val(ret[0].PRIMERNOMBRE);
                    $("#txtSegundoNombre").val(ret[0].SEGUNDONOMBRE);
                    $("#txtPrimerApellido").val(ret[0].PRIMERAPELLIDO);
                    $("#txtSegundoApellido").val(ret[0].SEGUNDOAPELLIDO);
                    $("#txtfechaDeNacimiento").val(ret[0].FECHANACIMIENTO);
                    $("#cmbDepartamento").val(ret[0].DEPARTAMENTO).change();
                    $("#cmbCiudad").val(ret[0].CIUDAD).change();
                    $("#cmbEstadoCivil").val(ret[0].ESTADOCIVIL).change();
                    $("#cmbSexo").val(ret[0].SEXO).change();
                    $("#cmbGrupoSanguineo").val(ret[0].GRUPOSANGUINEO).change();
                    $("#cmbEstratoSocial").val(ret[0].ESTRATOSOCIAL).change();
                    $("#txtEmail").val(ret[0].EMAIL);
                    $("#cmbNivelEscolaridad").val(ret[0].NIVELESCOLAR).change();
                    $("#cmbEstadoEmpleado").val(ret[0].ESTADO).change();
                } else {
                    alertify.error("No se encontro registro en la base de datos");
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function actulizarDatosEmpleado() {
    var idEmpleado = $("#txtIdEmpleado").val();
    var tipoDocumento = $("#cmbTipoDocumento").val();
    var documento = $("#txtNumDocumento").val();
    var primerNombre = $("#txtPrimerNombre").val();
    var segundoNombre = $("#txtSegundoNombre").val();
    var primerApellido = $("#txtPrimerApellido").val();
    var segundoApellido = $("#txtSegundoApellido").val();
    var fechaNacimiento = $("#txtfechaDeNacimiento").val();
    var departamento = $("#cmbDepartamento").val();
    var ciudad = $("#cmbCiudad").val();
    var estadoCivil = $("#cmbEstadoCivil").val();
    var sexo = $("#cmbSexo").val();
    var grupoSanguineo = $("#cmbGrupoSanguineo").val();
    var estratoSocial = $("#cmbEstratoSocial").val();
    var email = $("#txtEmail").val();
    var nivelEscolar = $("#cmbNivelEscolaridad").val();
    var estado = $("#cmbEstadoEmpleado").val();

    if (idEmpleado === "") {
        alertify.alert("Mensaje", 'Por favor vuelva a seleccionar el empleado.');
    } else if (tipoDocumento.length === 0) {
        alertify.alert("Mensaje", 'El tipo de documento no puede quedar vacio.');
    } else if (documento.length === 0) {
        alertify.alert("Mensaje", 'El documento no puede quedar vacio.');
    } else if (primerNombre.length === 0) {
        alertify.alert("Mensaje", 'El primer nombre no puede quedar vacio.');
    } else if (primerApellido.length === 0) {
        alertify.alert("Mensaje", 'El primer apellido no puede quedar vacio.');
    } else if (segundoApellido.length === 0) {
        alertify.alert("Mensaje", 'El segundo apellido nopuede quedar vacio.');
    } else if (fechaNacimiento.length === 0) {
        alertify.alert("Mensaje", 'La fecha de nacimiento no puede quedar vacio.');
    } else if (departamento.length === 0) {
        alertify.alert("Mensaje", 'Por favor elija un departamento.');
    } else if (ciudad.length === 0) {
        alertify.alert("Mensaje", 'Por favor elija una ciudad.');
    } else if (estadoCivil.length === 0) {
        alertify.alert("Mensaje", 'Por favor elija un estado civil.');
    } else if (sexo.length === 0) {
        alertify.alert("Mensaje", 'Por favor elija un sexo.');
    } else if (grupoSanguineo.length === 0) {
        alertify.alert("Mensaje", 'Por favor elija un grupo sanguineo.');
    } else if (estratoSocial.length === 0) {
        alertify.alert("Mensaje", 'Por favor elija un estro social.');
    } else if (email.length === 0) {
        alertify.alert("Mensaje", 'Por favor dijite el correo electronico.');
    } else if (nivelEscolar.length === 0) {
        alertify.alert("Mensaje", 'Por favor elija un nivel escolar.');
    } else if (estado.length === 0) {
        alertify.alert("Mensaje", 'Por favor elija un estado');
    } else {
        alertify.confirm('Mensaje', '¿Esta seguro que desea actualizar la informacion de este paciente. ?', function() {
                var ur = CONTROLLEREMPLEADO;
                var op = 11;
                $.ajax({
                    type: "POST",
                    url: ur,
                    data: ({
                        op: op,
                        idEmpleado: idEmpleado,
                        tipoDocumento: tipoDocumento,
                        documento: documento,
                        primerNombre: primerNombre,
                        segundoNombre: segundoNombre,
                        primerApellido: primerApellido,
                        segundoApellido: segundoApellido,
                        fechaNacimiento: fechaNacimiento,
                        departamento: departamento,
                        ciudad: ciudad,
                        estadoCivil: estadoCivil,
                        sexo: sexo,
                        grupoSanguineo: grupoSanguineo,
                        estratoSocial: estratoSocial,
                        email: email,
                        nivelEscolar: nivelEscolar,
                        estado: estado
                    }),
                    success: function(data) {
                        try {
                            var ret = eval('(' + data + ')');
                            if (ret.hasOwnProperty("success")) {
                                alertify.success(ret.success);
                                limpiarCampos();
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

var listarEmpleados = 0;

function visualizarEmpleados() {
    var ur = CONTROLLEREMPLEADO;
    var table = $("#tbl_visualizar_Empleados").DataTable({
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
                d.op = 12;
            },
            error: function() {
                $('#tbl_visualizar_Empleados').css("display", "none");
            }
        },
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copy', attr: { id: 'allan' } }, 'csv', 'excel', 'pdf'
        ],
        paging: true,
        lengthChange: false,
        lengthMenu: [10],
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
        //data: listarEmpleados,
        columns: [

            {
                name: "CONSECUTIVO",
                //data: null,
                width: "3%",
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { name: "TIPO DOCUMENTO", data: "TIPO_DOCUMENTO", width: "15%" },
            { name: "NUMERO DOCUMENTO", data: "NUMERO_DOCUMENTO", width: "15%" },
            { name: "NOMBRES Y APELLIDOS", data: "NOMBRES_APELLIDOS", width: "25%" },
            { name: "NIVEL ESCOLARIDAD", data: "NIVEL_ESCOLARIDAD", width: "15%" },
            { name: "EMAIL", data: 'EMAIL', width: "7%" },
            { name: "ESTADO", data: 'ESTADO', width: "7%" }

        ],
        order: [0, 'desc']
    });
    $('div.dataTables_filter input').addClass('form-control input-sm');
}