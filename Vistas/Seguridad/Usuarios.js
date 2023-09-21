/* global alertify, CONTROLLER_USER */

$(document).ready(function () {
    tipoCrud = 1;
    listarComboPerfiles();
    listarMenu();
    visualizarUsuarios();
    $("#btnGuardar").click(function () {
        switch (tipoCrud) {
            case 1:
                registrarUsuarios();
                break;
            case 2:
                actualizarUsuario();
                break;
            default:
                break;
        }
    });
    visualizarPerfiles();
    $("#btnAgregarPaginas").click(function () {
        addPaginasPerfiles();
    });

    $("#cmbPerfil").change(function () {
        var idPerfil = this.value;
        $('#cmbPaginas').attr('disabled', true);
        if (idPerfil.length !== '0') {
            listarcomboSubmenu();
            $('#cmdSubmenu').attr('disabled', false);
        } else {
            $('#cmdSubmenu').attr('disabled', true);
        }
    });
    $("#cmdSubmenu").change(function () {
        var id = this.value;
        if (id.length !== '0') {
            ListarComboPaginas();
            $('#cmbPaginas').attr('disabled', false);
        } else {
            $('#cmbPaginas').attr('disabled', true);
        }
    });
    $('#cmbPaginas').attr('disabled', true);
    $("#cmdSubmenu").attr('disabled', true);
    $("#agregarPaginas").click(function () {
        guardarPaginasPerfiles();
    });
    $("#btnAddPerfil").click(function () {
        guardarPerfiles();
    });
    $("#btnCancelar").click(function () {
        limpiarPerfiles();
    });
    $("#btnCancelUser").click(function () {
        tipoCrud = 1;
        $("#btnGuardar").html('<i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar');
        $("#cmbPerfiles").val("").select2('destroy').val("").select2();

    });

    $(".callback1").ClassyContextMenu({
        menu: 'callbackmenu1',
        onSelect: function (e) {
            if (e.action !== "") {
                switch (e.action) {
                    case '2':
                        alertify.confirm('Mensaje', 'Esta seguro que desea restablecer la contraseña del usuario seleccionado?', function () {
                            restablecerContrasena();
                        }
                        , function () {
                        });
                        break;
                    case '3':
                        $("#txtDocumento").val(documento);
                        $("#txtPrimerNombre").val(primer);
                        $("#txtSegundoNombre").val(segundo);
                        $("#txtPrimerApellido").val(primer_api);
                        $("#txtSegundoApellido").val(segundo_api);
                        $("#txtUsuario").val(usuario);
                        $('#cmbPerfiles').val(perfil).trigger('change.select2');
                        $('#cmbEstado').val(usuEstado === "ACTIVO" ? "A" : "I");
                        tipoCrud = 2;
                        $("#btnGuardar").html('<i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar');
                        break;
                    case '4':
                        visualizarOperaciones();
                        var nombre = primer + " " + segundo + " " + primer_api + " " + segundo_api;
                        $("#lblTitutlo").html('<strong><lable>PERMISOS: ' + nombre + "</label></strong>");
                        $('#modalOperaciones').modal('show');
                        break;

                }
            }
        }
    });
    listarComboTipoDocumento('cmbTipoDocumento');
});

function listarComboPerfiles() {
    var ur = CONTROLLER_USER;
    var op = 1;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op
        }),
        success:
                function (data) {
                    var ret = eval('(' + data + ')');
                    try {
                        $listarCombo = $("#cmbPerfiles");
                        $listarCombo.html('');
                        var option = $("<option value=''>Seleccione</option>");
                        $listarCombo.append(option);
                        for (var i = 0; i < ret.length; i++) {
                            var option = $("<option value = " + ret[i].ID + ">" + ret[i].NOMBRE + "</option>");
                            $listarCombo.append(option);
                        }
                    } catch (e) {
                    }
                },
        error: function (objeto, error, error2) {
            alertify.alert(error);
        }
    });
}
function registrarUsuarios() {
    var documento = $("#txtDocumento").val();
    var primerNombre = $("#txtPrimerNombre").val();
    var segundoNombre = $("#txtSegundoNombre").val();
    var primerApellido = $("#txtPrimerApellido").val();
    var segundoApellido = $("#txtSegundoApellido").val();
    var usuario = $("#txtUsuario").val();
    var perfil = $("#cmbPerfiles").val();
    if (documento.length === 0) {
        alertify.error("El documento no puede quedar vacio");
    } else if (documento.length === 0) {
        alertify.error("Por favor digite los nombres");
    } else if (primerNombre.length === 0) {
        alertify.error("El primer nombre  no puede quedar vacio");
    } else if (primerApellido.length === 0) {
        alertify.error("El primer apellido no puede quedar vacio");
    } else if (segundoApellido.length === 0) {
        alertify.error("El segundo apellido no puede quedar vacio");
    } else if (usuario.length === 0) {
        alertify.error("El usuario no puede quedar vacio");
    } else if (perfil.length === 0) {
        alertify.error("Elija un perfil");
    } else {
        var ur = CONTROLLER_USER;
        var op = 2;
        $.ajax({
            type: "POST",
            url: ur,
            data: ({
                op: op,
                documento: documento,
                primerNombre: primerNombre,
                segundoNombre: segundoNombre,
                primerApellido: primerApellido,
                segundoApellido: segundoApellido,
                usuario: usuario,
                perfil: perfil
            }),
            success:
                    function (data) {
                        try {
                            var ret = eval('(' + data + ')');
                            if (ret.hasOwnProperty("success")) {
                                alertify.success(ret.success);
                                visualizarUsuarios();
                            } else if (ret.hasOwnProperty("error")) {
                                alertify.alert('Mensaje', ret.error);
                            }
                        } catch (e) {
                        }
                    },
            error: function (objeto, error, error2) {
                alertify.alert(error);
            }
        });
    }
}
function actualizarUsuario() {
    var documento = $("#txtDocumento").val();
    var primerNombre = $("#txtPrimerNombre").val();
    var segundoNombre = $("#txtSegundoNombre").val();
    var primerApellido = $("#txtPrimerApellido").val();
    var segundoApellido = $("#txtSegundoApellido").val();
    var usuario = $("#txtUsuario").val();
    var perfil = $("#cmbPerfiles").val();
    if (documento.length === 0) {
        alertify.error("El documento no puede quedar vacio");
    } else if (documento.length === 0) {
        alertify.error("Por favor digite los nombres");
    } else if (primerNombre.length === 0) {
        alertify.error("El primer nombre  no puede quedar vacio");
    } else if (primerApellido.length === 0) {
        alertify.error("El primer apellido no puede quedar vacio");
    } else if (segundoApellido.length === 0) {
        alertify.error("El segundo apellido no puede quedar vacio");
    } else if (usuario.length === 0) {
        alertify.error("El usuario no puede quedar vacio");
    } else if (perfil.length === 0) {
        alertify.error("Elija un perfil");
    } else {
        var ur = CONTROLLER_USER;
        var op = 14;
        $.ajax({
            type: "POST",
            url: ur,
            data: ({
                op: op,
                documento: documento,
                primerNombre: primerNombre,
                segundoNombre: segundoNombre,
                primerApellido: primerApellido,
                segundoApellido: segundoApellido,
                usuario: usuario,
                perfil: perfil,
                estado: $("#cmbEstado").val(),
                idUsuario: usuId
            }),
            success:
                    function (data) {
                        try {
                            var ret = eval('(' + data + ')');
                            if (ret.hasOwnProperty("success")) {
                                alertify.success(ret.success);
                                visualizarUsuarios();
                            } else if (ret.hasOwnProperty("error")) {
                                alertify.alert('Mensaje', ret.error);
                            }
                        } catch (e) {
                        }
                    },
            error: function (objeto, error, error2) {
                alertify.alert(error);
            }
        });
    }
}
function restablecerContrasena() {

    var ur = CONTROLLER_USER;
    var op = 15;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op,
            documento: documento,
            idUsuario: usuId
        }),
        success:
                function (data) {
                    try {
                        var ret = eval('(' + data + ')');
                        if (ret.hasOwnProperty("success")) {
                            alertify.success(ret.success);
                            visualizarUsuarios();
                        } else if (ret.hasOwnProperty("error")) {
                            alertify.alert('Mensaje', ret.error);
                        }
                    } catch (e) {
                    }
                },
        error: function (objeto, error, error2) {
            alertify.alert(error);
        }
    });

}

var listarUsuarios = "";
function visualizarUsuarios() {
    $("#tbl_visualizaer_usuarios").html("<label style='float:left; margin-left:48%; margin-top:15%; font-size:15px;'>Cargando...</label><img src=''  style='float:left; margin-top:%; margin-left:49%; width:5%;'>");
    var ur = CONTROLLER_USER;
    var op = 3;
    $.ajax({
        type: "POST",
        url: ur,
        data: (
                {op: op
                }),
        cache: false,
        dataType: "html",
        success:
                function (data) {
                    var ret = "";
                    try {
                        ret = eval('(' + data + ')');
                        listarUsuarios = ret;
                        if (ret.hasOwnProperty("error")) {
                            alertify.error(ret.error);
                        } else {
                            $listaUsuario = $("#tbl_visualizaer_usuarios");
                            $listaUsuario.html('');
                            var thead = $("<thead></thead>");
                            $listaUsuario.append(thead);
                            var tr = $("<tr class='info'></tr>");
                            thead.append(tr);
                            var th = $("<th style='' >DOCUMENTO</th>");
                            tr.append(th);
                            var th = $("<th style='' >NOMBRE</th>");
                            tr.append(th);
                            th = $("<th style='' >USUARIO</th>");
                            tr.append(th);
                            var th = $("<th style='' >PERFIL</th>");
                            tr.append(th);
                            th = $("<th style='' >ESTADO</th>");
                            tr.append(th);
                            th = $("<th style='' >CREADO POR  </th>");
                            tr.append(th);
                            var tbody = $("<tbody></tbody>");
                            $listaUsuario.append(tbody);
                            for (var i = 0; i < ret.length; i++) {
                                var tr = $("<tr class='tblFiltrarUsuario' oncontextmenu=\"colorCeldas(this,4,'" + i + "');optenerInformacionUsuario('" + i + "');\"  style  = 'cursor:pointer;'></tr>");
                                tbody.append(tr);
                                var td = $("<td>" + (ret[i].hasOwnProperty("documento") ? ret[i].documento : "") + "</td>");
                                tr.append(td);
                                var td = $("<td>" + (ret[i].hasOwnProperty("nombres") ? ret[i].nombres : "") + ' ' + (ret[i].hasOwnProperty("apellidos") ? ret[i].apellidos : "") + "</td>");
                                tr.append(td);
                                var td = $("<td>" + (ret[i].hasOwnProperty("usuario") ? ret[i].usuario : "") + "</td>");
                                tr.append(td);
                                var td = $("<td>" + (ret[i].hasOwnProperty("perfil") ? ret[i].perfil : "") + "</td>");
                                tr.append(td);
                                var td = $("<td>" + (ret[i].hasOwnProperty("estado") ? ret[i].estado : "") + "</td>");
                                tr.append(td);
                                var td = $("<td>" + (ret[i].hasOwnProperty("creacion") ? ret[i].creacion : "") + "</td>");
                                tr.append(td);
                            }
                        }
                    } catch (e) {
                    }
                },
        error: function (objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

var usuId = "",
        documento = "",
        primer = "",
        primer = "",
        segundo = "",
        primer_api = "",
        segundo_api = "",
        usuario = "", perfil = "",
        usuEstado = "";
function optenerInformacionUsuario(row) {
    ter = listarUsuarios[row].NIT;
    documento = listarUsuarios[row].documento;
    primer = listarUsuarios[row].primer;
    segundo = listarUsuarios[row].segundo;
    primer_api = listarUsuarios[row].primer_api;
    segundo_api = listarUsuarios[row].segundo_api;
    usuario = listarUsuarios[row].usuario;
    perfil = listarUsuarios[row].per_id;
    usuId = listarUsuarios[row].usu_id;
    usuEstado = listarUsuarios[row].estado;
}


function visualizarPerfiles() {
    var ur = CONTROLLER_USER;
    var op = 4;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op
        }),
        success:
                function (data) {
                    try {
                        var ret = eval('(' + data + ')');
                        listaRoles = ret;
                        $("#datatable_roles").html('');
                        $tablaFilto = $("<table id='tbl_visualizar_paginas'  style =' font-size: 11px;' class='table-condensed table-bordered  table table-bordered fijoTable'> </table> ");
                        $("#datatable_roles").append($tablaFilto);
                        var thead = $("<thead></thead>");
                        $tablaFilto.append(thead);
                        var tr = $("<tr class='Info'></tr>");
                        thead.append(tr);
                        var th = $("<th  style='width: 2%;' ><i style=' margin-left: 3px' class='fa fa-info' aria-hidden='true'></i></th>");
                        tr.append(th);
                        var th = $("<th style=' text-align: center;' >#</th>");
                        tr.append(th);
                        var th = $("<th style='    width: 120%;     text-align: center;' >NOMBRE PERFIL</th>");
                        tr.append(th);
                        th = $("<th style='width: 2%;text-align: center' ><i class='fa fa-trash-o' aria-hidden='true'></i></th>");
                        tr.append(th);
                        th = $("<th style='width: 2%;text-align: center' ><i class='fa fa-pencil-square'  aria-hidden='true'></i></th>");
                        tr.append(th);
                        var th = $("<th  style='width: 2%;text-align: center ' ><i class='fa fa-folder-open'  aria-hidden='true'></i></th>");
                        tr.append(th);
                        var tbody = $("<tbody></tbody>");
                        $tablaFilto.append(tbody);
                        for (var i = 0; i < ret.length; i++) {
                            var tr = $("<tr class ='tblFiltroPrincipal' id='trPrincipal" + ret[i].ID + "'  style  = 'cursor:pointer;'  onclick =\"colorCeldas(this,1,'" + i + "');\"  ></tr>");
                            tbody.append(tr);
                            var td = $("<td onclick =\"visualizarPaginas('" + i + "');\" class='accordion-toggle' data-toggle='collapse' href='#paginas" + i + "'><i class='fa fa-plus' id='icono" + i + "' aria-hidden='true'></i></td> ");
                            tr.append(td);
                            var td = $("<td style='text-align: center;'>" + (ret[i].hasOwnProperty("ID") ? ret[i].ID : "") + "</td>");
                            tr.append(td);
                            var td = $("<td style='width: 15%;text-align: center;text-transform: capitalize;'> " + (ret[i].hasOwnProperty("NOMBRE") ? ret[i].NOMBRE : "") + "</td>");
                            tr.append(td);
                            var td = $("<td  onclick =\"eliminarPerfil('" + ret[i].ID + "');\" style='text-align: center'><i class='fa fa-trash-o' aria-hidden='true'></i></td>");
                            tr.append(td);
                            var td = $("<td  onclick =\"editarPerfil('" + ret[i].ID + "','" + ret[i].NOMBRE + "');\" style='text-align: center'><i class='fa fa-pencil-square' aria-hidden='true'></i></td>");
                            tr.append(td);
                            var td = $("<td class='accordion-toggle' style='text-align: center'   onclick =\"addpages('" + ret[i].ID + "','" + ret[i].NOMBRE + "');\"  ><i class='fa fa-folder-open'  aria-hidden='true'></i></td> ");
                            tr.append(td);
                            var tr = $("<tr><td  colspan ='7' style ='padding: 0px'><div style ='padding: 10px' id='paginas" + i + "' class='accordion-body collapse'><table  style =' font-size: 11px;'  id='tbl_ordens_paginas" + i + "' class='table-striped  table '></table></div></td></tr>");
                            tbody.append(tr);

                        }
                        $(".fijoTable").tableHeadFixer();
                    } catch (e) {
                    }
                },
        error: function (objeto, error, error2) {
            alertify.alert(error);
        }
    });
}
var filaSel = [undefined];
function colorCeldas(celda, index, fila) {

    try {
        if (filaSel[index] !== undefined) {
            filaSel[index].style.backgroundColor = "transparent";
        }
    } catch (e) {
    }
    celda.style.backgroundColor = "rgb(168, 204, 236)";
    filaSel[index] = celda;
}
var codigoPagina = "";
function visualizarPaginas(index) {
    var codigo = listaRoles[index].ID;
    codigoPagina = listaRoles[index].ID;
    var clase = $("#icono" + index).attr('class');
    switch (clase) {
        case 'fa fa-plus':
            $("#icono" + index).removeClass("fa fa-plus");
            verPaginas(codigo, index);
            $("#icono" + index).addClass("fa fa-minus");
            break;
        case 'fa fa-minus':
            $("#icono" + index).removeClass("fa fa-minus");
            $("#icono" + index).addClass("fa fa-plus");
            break;
    }
}
function verPaginas(codigo, indice) {
    $("#paginas" + indice).html("<label style='float:left; margin-left:48%; margin-top:15%; font-size:15px;'>Cargando...</label><img src=''  style='float:left; margin-top:%; margin-left:49%; width:5%;'>");
    var ur = CONTROLLER_USER;
    var op = 5;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op,
            id: codigo
        }),
        success:
                function (data) {
                    var ret = "";
                    try {
                        ret = eval('(' + data + ')');
                        $("#paginas" + indice).html('');
                        $tblpaginas = $("<div class='row'> <div class='col-md-12'><input type='text' name='txtFiltroSegundario" + indice + "' id='txtFiltroSegundario" + indice + "' class='form-control input-sm' onclick=\"filtrarDatos('txtFiltroSegundario" + indice + "', 'tblFiltroSegundario');\" placeholder='Buscar Paginas...'><br></div></div><table id='tbl_ordens_paginas" + indice + "'   style ='font-size: 11px;' class='table-condensed table-bordered  table table-bordered'> </table> ");
                        $("#paginas" + indice).append($tblpaginas);
                        var thead = $("<thead class=' '></thead>");
                        $tblpaginas.append(thead);
                        var tr = $("<tr class='secondary'></tr>");
                        thead.append(tr);
                        var th = $("<th style='text-align: center; ' >#</th>");
                        tr.append(th);
                        var th = $("<th style='text-align: center;' >TIPO</th>");
                        tr.append(th);
                        var th = $("<th style='text-align: center;' >MENU</th>");
                        tr.append(th);
                        var th = $("<th style='text-align: center;' >SUB MENU</th>");
                        tr.append(th);
                        var th = $("<th style='text-align: center;' >PAGINAS</th>");
                        tr.append(th);
                        th = $("<th style='text-align: center' ><i class='fa fa-trash' aria-hidden='true' title='Eliminar Pagina'></i></th>");
                        tr.append(th);
                        th = $("<th style='text-align: center' ><i class='fa fa-info-circle text-danger' aria-hidden='true' style='cursor: pointer' title='Pase el indicador del mouse para mas informacion'></i> </th>");
                        tr.append(th);
                        var tbody = $("<tbody></tbody>");
                        $tblpaginas.append(tbody);
                        j = 1;
                        for (var i = 0; i < ret.length; i++) {
                            if (ret[i].ESTADO === "A") {
                                estado = 'fa-toggle-on';
                                title = 'Activada';
                            } else {
                                estado = 'fa-toggle-off';
                                title = 'Desactivada';
                            }
                            var PAGINA = "";
                            PAGINA = ret[i].PAGINA.replace(/[1-9][-]/, ' ');
                            var tr = $("<tr class ='tblFiltroSegundario' trfiltro' id='row" + ret[i].PAG_ID + "' style  = 'cursor:pointer;' id='fila" + i + "' onclick =\"colorCeldas(this,2,'" + i + "');\" oncontextmenu=\"colorCeldas(this,2,'" + i + "');\" ></tr>");
                            tbody.append(tr);
                            var td = $("<td style='width: 1%;text-align: center;'>" + j + "</td>");
                            tr.append(td);
                            var td = $("<td style=' width: 15%; text-align: center;'>" + ret[i].TIPO + "</td>");
                            tr.append(td);
                            var td = $("<td style=' width: 15%; text-align: center;'>" + ret[i].MENU + "</td>");
                            tr.append(td);
                            var td = $("<td style='width: 10%;text-align: center;'>" + ret[i].SUB_MENU + "</td>");
                            tr.append(td);
                            var td = $("<td style='text-align: center;'>" + PAGINA + "</td>");
                            tr.append(td);
                            var td = $("<td  onclick =\"eliminarPagina('" + ret[i].PAG_ID + "','" + codigo + "','" + ret[i].ID_MENU + "');\" style='text-align: center'><i class='fa fa-trash-o' aria-hidden='true' title=''></i></td>");
                            tr.append(td);
                            var td = $("<td  onclick =\"activarPagina('" + ret[i].PAG_ID + "','" + codigo + "','" + i + "','" + ret[i].ID_MENU + "','" + ret[i].SUB_MENUHIJO + "','" + ret[i].ESTADO + "');\" style='text-align: center'><i id='icon" + i + "' class='fa " + estado + "' title='Estado Pagina " + title + "' aria-hidden='true'></i></td>");
                            tr.append(td);
                            j++;
                        }
                    } catch (e) {
                    }
                },
        error: function (objeto, error, error2) {
            alertify.alert(error);
        }
    });
}
function eliminarPagina(pagina, perfil, menu) {
    alertify.confirm('Mensaje', 'Esta seguro que desea eliminar la orden seleccionada ?', function () {
        var ur = CONTROLLER_USER;
        var dat = pagina;
        var op = 10;
        $.ajax({
            type: "POST",
            url: ur,
            data: ({
                op: op,
                pagina: pagina,
                perfil: perfil,
                menu: menu
            }),
            success:
                    function (data) {
                        try {
                            var ret = eval('(' + data + ')');
                            if (ret.hasOwnProperty("success")) {
                                $('#row' + pagina + '').remove();
                                alertify.success(ret.success);
                            } else {
                                alertify.error(ret.error);
                            }
                        } catch (e) {
                        }
                    },
            error: function (objeto, error, error2) {
                alertify.alert(error);
            }
        });
    }
    , function () {
    });
}
function addpages(index, nombre) {
    $("#txtNomPerfil").val(nombre);
    $("#idPrincipal").val(index);
    $("#mdlpaginas").modal("show");
}
var listaCodigoPaginas = new Array();
var conse = 1;
function addPaginasPerfiles() {
    var pagina = $("#cmbPaginas").val();
    var menu = $("#cmbPerfil").val();
    var submenu = $("#cmdSubmenu").val();
    var idPerfil = $("#idPrincipal").val();
    var nombrePagina = $("#cmbPaginas option:selected").text();
    var nombreMenu = $("#cmbPerfil option:selected").text();
    var nombreSubMenu = $("#cmdSubmenu option:selected").text();
    if (submenu === "") {
        nombreSubMenu = "No tiene";
    }
    if (pagina === "") {
        alertify.alert("Mensaje", "<strong><label>Por favor indique una Pagina .</strong></label>");
    } else if (menu === "") {
        alertify.alert("Mensaje", "<strong><label>Por favor indique un Perfil.</strong></label>");
    } else {
        var id = false;
        $.each(listaCodigoPaginas, function (key) {
            if (listaCodigoPaginas[key].idpagina === pagina && listaCodigoPaginas[key].idmenu === menu) {
                id = true;
            }
        });
        if (!id) {
            var $lista = $("#tbodyPaginas");
            var tr = $("<tr style='cursor:pointer;' id='filaEliminar" + pagina + "'></tr>");
            $lista.append(tr);
            tr.append(tr);
            var td = $("<td>" + conse + "</td> ");
            tr.append(td);
            td = $("<td>" + nombreMenu + "</td> ");
            tr.append(td);
            td = $("<td>" + nombreSubMenu + "</td> ");
            tr.append(td);
            var td = $("<td>" + nombrePagina + "</td> ");
            tr.append(td);

            td = $("<td onclick=\"filaEliminar('" + pagina + "');\"><i class='fa fa-trash' aria-hidden='true'></i></td> ");
            tr.append(td);
            listaCodigoPaginas.push({idpagina: parseInt(pagina), idmenu: menu, idPerfil: idPerfil, idSubmenu: submenu});
            $("#cmbPaginas").val("").change();
            $("#cmbPerfil").val("").change();
            $("#cmdSubmenu").val("").change();
            conse = conse + 1;
        } else {
            alertify.error("La Pagina seleccionada ya se encuentra en la tabla.");
        }
    }
}
function filaEliminar(codigoPagina) {
    alertify.confirm('Mensaje', '¿Esta seguro  que desea eliminar la pagina seleccionada ?', function () {
        listaCodigoPaginas = $.grep(listaCodigoPaginas,
                function (o, i) {
                    return o.idpagina === parseInt(codigoPagina);
                },
                true);
        $("#filaEliminar" + codigoPagina).remove('');
    }
    , function () {
    });

}
function listarcomboSubmenu() {
    var codigo = $("#cmbPerfil").val();
    var ur = CONTROLLER_USER;
    var op = 11;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op,
            id: codigo
        }),
        success:
                function (data) {
                    var ret = eval('(' + data + ')');
                    try {
                        $listarCombo = $("#cmdSubmenu");
                        $listarCombo.html('');
                        var option = $("<option value=''>Seleccione</option>");
                        $listarCombo.append(option);
                        for (var i = 0; i < ret.length; i++) {
                            var option = $("<option value = " + ret[i].ID + ">" + ret[i].NOMBRE + "</option>");
                            $listarCombo.append(option);
                        }
                        if (ret.length === 0) {
                            ListarComboPaginas();
                            $('#cmbPaginas').attr('disabled', false);
                            $("#cmdSubmenu").attr('disabled', true);
                        } else if (ret.length === 1) {
                            ListarComboPaginas();
                            $('#cmbPaginas').attr('disabled', false);
                        } else {
                            $('#cmbPaginas').attr('disabled', true);
                            $("#cmdSubmenu").attr('disabled', false);
                        }
                        //
                    } catch (e) {
                    }
                },
        error: function (objeto, error, error2) {
            alertify.alert(error);
        }
    });
}
function ListarComboPaginas() {
    var menu = $("#cmbPerfil").val();
    var submenu = $("#cmdSubmenu").val();
    var ur = CONTROLLER_USER;
    var op = 8;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op,
            menu: menu,
            submenu: submenu
        }),
        success:
                function (data) {
                    var ret = eval('(' + data + ')');
                    try {
                        $listarCombo = $("#cmbPaginas");
                        $listarCombo.html('');
                        var option = $("<option value=''>Seleccione</option>");
                        $listarCombo.append(option);
                        for (var i = 0; i < ret.length; i++) {
                            var option = $("<option  value = " + ret[i].PAG_ID + ">" + ret[i].NOMBRE.substr(2) + "</option>");
                            $listarCombo.append(option);
                        }
                    } catch (e) {
                    }
                },
        error: function (objeto, error, error2) {
            alertify.alert(error);
        }
    });
}
function guardarPaginasPerfiles() {
    if (listaCodigoPaginas.length === '0') {
        alertify.alert("Mensaje", "<strong><label>Debe Agregar Campos a Lista .</strong></label>");
    } else {
        var ur = CONTROLLER_USER;
        var op = 6;
        $.ajax({
            type: "POST",
            url: ur,
            data: ({
                op: op,
                tablePaginas: JSON.stringify(listaCodigoPaginas)

            }),
            success:
                    function (data) {
                        try {
                            var ret = eval('(' + data + ')');
                            if (ret.hasOwnProperty("success")) {
                                limpiaCampos();
                                alertify.success(ret.success);
                            } else {
                                alertify.error(ret.error);
                            }
                        } catch (e) {
                        }
                    },
            error: function (objeto, error, error2) {
                alertify.alert(error);
            }
        });
    }

}
function limpiaCampos() {
    listaCodigoPaginas = [];
    $("#tbodyPaginas").html('');
    $("#mdlpaginas").modal("hide");
    conse = 1;
}
function listarMenu() {
    var ur = CONTROLLER_USER;
    var op = 7;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op
        }),
        success:
                function (data) {
                    var ret = eval('(' + data + ')');
                    try {
                        $listarCombo = $("#cmbPerfil");
                        $listarCombo.html('');
                        var option = $("<option value=''>Seleccione</option>");
                        $listarCombo.append(option);
                        for (var i = 0; i < ret.length; i++) {
                            var option = $("<option value = " + ret[i].ID + ">" + ret[i].NOMBRE + "</option>");
                            $listarCombo.append(option);
                        }
                    } catch (e) {
                    }
                },
        error: function (objeto, error, error2) {
            alertify.alert(error);
        }
    });
}


function activarPagina(pagina, perfil, index, menu, submenu, estado) {
    var ur = CONTROLLER_USER;
    var op = 9;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op,
            pagina: pagina,
            perfil: perfil,
            menu: menu,
            submenu: submenu,
            estado: estado

        }),
        success:
                function (data) {
                    try {
                        var ret = eval('(' + data + ')');
                        if (ret.hasOwnProperty("success")) {
                            cambiarEstado(index);

                            alertify.success(ret.success);
                        } else {
                            alertify.error(ret.error);
                        }
                    } catch (e) {
                    }
                },
        error: function (objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function cambiarEstado(index) {
    var clase = $("#icon" + index).attr('class');
    switch (clase) {
        case 'fa fa-toggle-on':
            $("#icon" + index).removeClass("fa fa-toggle-on");
            $("#icon" + index).addClass("fa fa-toggle-off");
            $("#icon" + index)[0].title = "Estado Pagina Desactivada";
            break;
        case 'fa fa-toggle-off':
            $("#icon" + index).removeClass("fa fa-toggle-off");
            $("#icon" + index).addClass("fa fa-toggle-on");
            $("#icon" + index)[0].title = "Estado Pagina Activada";
            break;
    }
}
function guardarPerfiles() {
    var perfil = $("#txtPerfil").val().toLowerCase();
    var status = $("#cmbEstado").val();
    var idPerfil = $("#txtidPerfil").val();
    if (perfil.length == 0) {
        alertify.error("<strong><label>Debe digitar un Nombre de Perfil .</strong></label>");
    } else if (status.length == 0) {
        alertify.error("<strong><label>Debe selecionar un estado .</strong></label>");
    } else {
        var ur = CONTROLLER_USER;
        var op = 12;
        $.ajax({
            type: "POST",
            url: ur,
            data: ({
                op: op,
                nombrePerfil: perfil,
                estado: status,
                idperfil: idPerfil

            }),
            success:
                    function (data) {
                        try {
                            var ret = eval('(' + data + ')');
                            if (ret.hasOwnProperty("success")) {
                                $("#txtPerfil").val('');
                                $("#cmbEstado").val('').change();
                                $("#txtidPerfil").val('');
                                visualizarPerfiles();
                                alertify.alert('Mensaje', ret.success);
                            } else {
                                alertify.alert('Mensaje', ret.error);
                            }
                        } catch (e) {
                        }
                    },
            error: function (objeto, error, error2) {
                alertify.alert(error);
            }
        });
    }
}
function eliminarPerfil(codigo) {
    alertify.confirm('Mensaje', 'Esta seguro que desea eliminar la Perfil seleccionada ?', function () {
        var ur = CONTROLLER_USER;
        var op = 13;
        $.ajax({
            type: "POST",
            url: ur,
            data: ({
                op: op,
                idperfil: codigo
            }),
            success:
                    function (data) {
                        try {
                            var ret = eval('(' + data + ')');
                            if (ret.hasOwnProperty("success")) {
                                $('#trPrincipal' + codigo + '').remove();
                                alertify.success(ret.success);
                            } else {
                                alertify.error(ret.error);
                            }
                        } catch (e) {
                        }
                    },
            error: function (objeto, error, error2) {
                alertify.alert(error);
            }
        });
    }
    , function () {
    });
}

function visualizarOperaciones() {
    $("#tbl_visualizaer_operaciones").html("<label style='float:left; margin-left:48%; margin-top:15%; font-size:15px;'>Cargando...</label><img src=''  style='float:left; margin-top:%; margin-left:49%; width:5%;'>");
    var ur = CONTROLLER_USER;
    var op = 16;
    $.ajax({
        type: "POST",
        url: ur,
        data: (
                {op: op,
                    usuId: usuId
                }),
        cache: false,
        dataType: "html",
        success:
                function (data) {
                    var ret = "";
                    try {
                        ret = eval('(' + data + ')');
                        if (ret.hasOwnProperty("error")) {
                            alertify.error(ret.error);
                        } else {
                            $listaOperaciones = $("#tbl_visualizaer_operaciones");
                            $listaOperaciones.html('');
                            var thead = $("<thead></thead>");
                            $listaOperaciones.append(thead);
                            var tr = $("<tr class='info'></tr>");
                            thead.append(tr);
                            var th = $("<th style='' >PERMISO</th>");
                            tr.append(th);
                            var th = $("<th style='' >ESTADO</th>");
                            tr.append(th);
                            var th = $("<th style='' ><i   class='fa fa-toggle-off' aria-hidden='true'></i></th>");
                            tr.append(th);
                            var tbody = $("<tbody></tbody>");
                            $listaOperaciones.append(tbody);
                            for (var i = 0; i < ret.length; i++) {
                                var tr = $("<tr class='tblfilOperaciones' onclick =\"colorCeldas(this,5,'" + i + "');\" ></tr>");
                                tbody.append(tr);
                                var td = $("<td style='width: 90%;'>" + (ret[i].hasOwnProperty("permiso") ? ret[i].permiso : "") + "</td>");
                                tr.append(td);
                                var td = $("<td>" + (ret[i].hasOwnProperty("estado") ? ret[i].estado : "") + "</td>");
                                tr.append(td);
                                var td = $("<td><i  style  = 'cursor:pointer;' onclick =\"agregarORQuitarPermisos('" + ret[i].id + "','" + usuId + "','" + ret[i].estado + "');\" class='" + ret[i].icono + "' aria-hidden='true'></i></td>");
                                tr.append(td);
                            }
                        }
                    } catch (e) {
                    }
                },
        error: function (objeto, error, error2) {
            alertify.alert(error);
        }
    });
}


function agregarORQuitarPermisos(idOperacion, idUsuario, estado) {
    var ur = CONTROLLER_USER;
    var op = 17;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op,
            idoperacion: idOperacion,
            idUsuario: idUsuario,
            estado: estado.toLowerCase()
        }),
        success:
                function (data) {
                    try {
                        var ret = eval('(' + data + ')');
                        if (ret.hasOwnProperty("success")) {
                            alertify.success(ret.success);
                            visualizarOperaciones();
                        } else if (ret.hasOwnProperty("error")) {
                            alertify.error(ret.error);
                        }
                    } catch (e) {
                    }
                },
        error: function (objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function editarPerfil(codigo, nombre) {
    $("#txtidPerfil").val(codigo);
    $("#txtPerfil").val(nombre);
    $("#btnAddPerfil").text('Actualizar');
}
function limpiarPerfiles() {
    $("#txtidPerfil").val('');
    $("#txtPerfil").val('');
    $("#cmbEstado").val('').change();
    $("#btnAddPerfil").text('Guardar');
}
