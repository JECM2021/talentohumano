$(document).ready(function () {
    visualizarPaginas();
    listarMenu();
    var pathname = window.location.pathname;
    $("#cmbPerfil").change(function () {
        var idPerfil = this.value;
        $('#cmbPaginas').attr('disabled', true);
        if (idPerfil.length != 0) {
            listarcomboSubmenu();
            $('#cmdSubmenu').attr('disabled', false);
        } else {
            $('#cmdSubmenu').attr('disabled', true);
        }
    });
    $("#cmdSubmenu").attr('disabled', true);
    $("#txtnombreCarpeta").keyup(function () {
        var value = $(this).val();
        var archivo = $("#txtnombreArchivo").val();
        var urltemp1 = pathname.substr(0,17);
        
        if ($(this).val() === "") {
            $("#txtnombreArchivo").attr('disabled', true);
        }else{
            $("#txtnombreArchivo").attr('disabled', false);
        }
        if (archivo.length == 0){
            $("#txtnombreArchivo").val('');
        }
        
        var result = urltemp1 +"/"+ value +"/"+ archivo;
        $("#txtUrl").val(result);
        urlTemporal = result;
    });
    $("#txtnombreArchivo").keyup(function () {
        var value = $(this).val();
        var urltem = pathname.substr(0,17) ;
        var item = $("#txtnombreCarpeta").val();
        var resultado = urltem +"/"+ item +"/"+ value;
        $("#txtUrl").val(resultado);
    });
    $("#btnGuardarPages").click(function(){
        agregarPaginas();
    })
    $('#mdlPaginas').on('hidden.bs.modal', function (e) {
        limpiarCampos();
    });
    $("#cmbPerfilM").attr('disabled', true);
    $("#cmbTipoMenu").change(function () {
        var idtipo = this.value;
        if (idtipo == 2) {
            $('#cmbPerfilM').attr('disabled', false);
        } else {
            $('#cmbPerfilM').val('');
            $('#cmbPerfilM').attr('disabled', true);
        }
    });
    $("#btnGuardarMenu").click(function(){
        agregarMenu();
    });
    visualizarMenu();
    listarTipoMenu();
});
var listadoPaginas = "";
function visualizarPaginas() {
    $("#tbl_visualizaer_usuarios").html("<label style='float:left; margin-left:48%; margin-top:15%; font-size:15px;'>Cargando...</label><img src=''  style='float:left; margin-top:%; margin-left:49%; width:5%;'>");
    var ur = CONTROLLER_PAGES;
    var op = 1;
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
                        if (ret.hasOwnProperty("error")) {
                            alertify.error(ret.error);
                        } else {
                            tbodyPaginas = $("#tbodyPages");
                            tbodyPaginas.html('');
                            $("#tbodyPages").append(tbodyPaginas);
                            listadoPaginas = ret;
                            for (var i = 0; i < ret.length; i++) {
                                var tr = $("<tr class='tblFiltroPaginas' id='trPrincipal" + ret[i].ID + "'  oncontextmenu=\"obtenerDatosPaginas('" + i + "');colorCeldas(this,2);\" style  = 'cursor:pointer;'></tr>");
                                tbodyPaginas.append(tr);
                                var td = $("<td style='text-align: center;'>" + (ret[i].hasOwnProperty("ID") ? ret[i].ID : "") + "</td>");
                                tr.append(td);
                                var td = $("<td style='text-align: center;'>" + (ret[i].hasOwnProperty("MENU") ? ret[i].MENU : "") + ' ' + (ret[i].hasOwnProperty("apellidos") ? ret[i].apellidos : "") + "</td>");
                                tr.append(td);
                                var td = $("<td style='text-align: center;'>" + (ret[i].hasOwnProperty("SUB_MENU") ? ret[i].SUB_MENU : "") + "</td>");
                                tr.append(td);
                                var td = $("<td style='text-align: center;'>" + (ret[i].hasOwnProperty("PAGINA") ? ret[i].PAGINA : "") + "</td>");
                                tr.append(td);
                                var td = $("<td  onclick =\"eliminarPagina('" + ret[i].ID + "');\" style='text-align: center'><i class='fa fa-trash-o' aria-hidden='true' title=''></i></td>");
                                tr.append(td);
                                var td = $("<td  onclick =\"editarPaginas('" + i + "');\" style='text-align: center'><i class='fa fa-pencil-square' aria-hidden='true'></i></td>");
                                tr.append(td);
                            }
                            $(".fijoTable").tableHeadFixer();
                        }
                    } catch (e) {
                    }
                },
        error: function (objeto, error, error2) {
            alertify.alert(error);
        }
    });
}
function listarMenu() {
    var ur = CONTROLLER_PAGES;
    var op = 2;
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
                        $listarCombo = $("#cmbPerfil,#cmbPerfilM");
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
function listarcomboSubmenu() {
    var codigo = $("#cmbPerfil").val();
    var ur = CONTROLLER_PAGES;
    var op = 3;
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
function agregarPaginas(){
  var estado = $("#cmbEstado").val();
  var menu = $("#cmbPerfil").val();
  var submenu = $("#cmdSubmenu").val();
  var url = $("#txtUrl").val();
  var icono = $("#txtIcono").val();
  var carpetas = $("#txtnombreCarpeta").val();
  var archivo = $("#txtnombreArchivo").val();
  var pagina = $("#txtnombrePagina").val();
  var editable = $("#txtIdPagina").val();
  if (carpetas.length == 0) {
        alertify.error("<strong><label>Debe digitar un Nombre de Carpeta .</strong></label>");
    }else if (archivo.length == 0) {
        alertify.error("<strong><label>Debe digitar un Nombre de un Archivo .</strong></label>");
    }else  if (pagina.length == 0) {
        alertify.error("<strong><label>Debe digitar un Nombre de la Pagina .</strong></label>");
    }else if(menu.length == 0) {
        alertify.error("<strong><label>Debe seleccionar un menu  .</strong></label>");
    } else if (estado.length == 0) {
        alertify.error("<strong><label>Debe selecionar un estado .</strong></label>");
    } else {
        var ur = CONTROLLER_PAGES;
        var op = 4;
        $.ajax({
            type: "POST",
            url: ur,
            data: ({
                op: op,
                menu: menu,
                estado: estado,
                submenu: submenu,
                url:url,
                icono:icono,
                pagina:pagina,
                archivo:archivo,
                editar:editable

            }),
            success:
                    function (data) {
                        try {
                            var ret = eval('(' + data + ')');
                            if (ret.hasOwnProperty("success")) {
                                limpiarCampos();
                                visualizarPaginas();
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
function limpiarCampos(){
    $("#mdlPaginas").modal("hide");
    $("#cmbEstado").val('');
    $("#cmbPerfil").val('');
    $("#cmdSubmenu").val('');
    $("#txtUrl").val('');
    $("#txtIcono").val('');
    $("#txtnombreCarpeta").val('');
    $("#txtnombreArchivo").val('');
    $("#txtnombrePagina").val('');
    $("#txtnombreArchivo").attr('disabled', true);
    $("#txtIdPagina").val('');
}

function editarPaginas(index){
    var carpeta = listadoPaginas[index].URL.split("/")[3];
    var archivo = listadoPaginas[index].URL.split("/")[4];
    var menu = listadoPaginas[index].IDMENU;
    var submenu = listadoPaginas[index].IDSUB_MENU;
    var pagina = listadoPaginas[index].PAGINA
    var url  = listadoPaginas[index].URL
    var icono = listadoPaginas[index].ICONO;
    var estado = listadoPaginas[index].ESTADO;
    var id = listadoPaginas[index].ID;
    $("#mdlPaginas").modal("show");
    $("#cmbEstado").val(estado);
    $("#cmbPerfil").val(menu).change();
    //setTimeout(function(){ 
        $("#cmdSubmenu").val(submenu);
        $("#txtUrl").val(url); 
    //}, 1);
    $("#txtIdPagina").val(id);
    $("#txtIcono").val(icono);
    $("#txtnombreCarpeta").val(carpeta);
    $("#txtnombreArchivo").val(archivo);
    $("#txtnombrePagina").val(pagina);
    $("#txtnombreArchivo").attr('disabled', false);
    $("#btnGuardarPages").text("Actualizar");
}
function eliminarPagina(codigo){
    alertify.confirm('Mensaje', 'Esta seguro que desea eliminar la Perfil seleccionada ?', function () {
        var ur = CONTROLLER_PAGES;
        var op = 5;
        $.ajax({
            type: "POST",
            url: ur,
            data: ({
                op: op,
                idpagina: codigo
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
function agregarMenu(){
    var nombre = $("#txtnombreMenu").val();
    var tipo = $("#cmbTipoMenu").val();
    var menuPadre = $("#cmbPerfilM").val();
    var estadoMenu = $("#cmbEstadoMen").val();
    var tipoMenu = $("#cmbTipoMenuDas").val(); 
    var editable = $("#txtIdMenu").val();
    if (nombre.length == 0) {
        alertify.error("<strong><label>Debe digitar un Nombre .</strong></label>");
    }else if (tipo.length == 0) {
         alertify.error("<strong><label>Debe seleccionar un Tipo  .</strong></label>");
    }else if(tipo == 2 && menuPadre.length == 0) {
        alertify.error("<strong><label>Debe seleccionar un menu  .</strong></label>");
    } else if (estadoMenu.length == 0) {
        alertify.error("<strong><label>Debe selecionar un estado .</strong></label>");
    }else{
        var ur = CONTROLLER_PAGES;
        var op = 6;
        $.ajax({
            type: "POST",
            url: ur,
            data: ({
                op: op,
                menu: menuPadre,
                estado: estadoMenu,
                nombre: nombre,
                tipoMenu:tipoMenu,
                editar:editable
            }),
            success:
                    function (data) {
                        try {
                            var ret = eval('(' + data + ')');
                            if (ret.hasOwnProperty("success")) {
                                limpiarCamposMenu();
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
function limpiarCamposMenu(){
    $("#txtnombreMenu").val('');
    $("#cmbTipoMenu").val('');
    $("#cmbPerfilM").val('');
    $("#cmbEstadoMen").val('');
    $("#cmbTipoMenuDas").val('');
    $("#txtIdMenu").val('');
    listadoMenuP =[];
    visualizarMenu();
}
var listadoMenuP = "";
function visualizarMenu(){
    $("#divVisualizarMenu").html("<label style='float:left; margin-left:48%; margin-top:15%; font-size:15px;'>Cargando...</label><img src=''  style='float:left; margin-top:%; margin-left:49%; width:5%;'>");
    var ur = CONTROLLER_PAGES;
    var op = 7;
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
                        listadoMenuP = ret;
                        $("#divVisualizarMenu").html('');
                        $tablaMenu= $("<table id='tbl_visualizar_Menu'  style =' font-size: 11px;' class='table-condensed table-bordered  table table-bordered'> </table> ");
                        $("#divVisualizarMenu").append($tablaMenu);
                        var thead = $("<thead class=' '></thead>");
                        $tablaMenu.append(thead);
                        var tr = $("<tr class='info'></tr>");
                        thead.append(tr);
                        var th = $("<th style='text-align: center;'>CODIGO</th>");
                        tr.append(th);
                        var th = $("<th style='text-align: center;'>MENU</th>");
                        tr.append(th);
                        var th = $("<th style='text-align: center;'>ESTADO</th>");
                        tr.append(th);
                        var th = $("<th  style='width: 2%;text-align: center'><i class='fa fa-trash' aria-hidden='true'></i></th>");
                        tr.append(th);
                        var th = $("<th style='width: 2%;text-align: center' ><i class='fa fa-pencil-square'  aria-hidden='true'></i></th>");
                        tr.append(th);

                        var tbody = $("<tbody></tbody>");
                        $tablaMenu.append(tbody);
                            var j = 1;
                            for (var i = 0; i < ret.length; i++) {
                                
                                var tr = $("<tr class='tblFiltroPaginas' id='trMenuP" + ret[i].ID + "'  oncontextmenu=\"colorCeldas(this,2);\" style  = 'cursor:pointer;'></tr>");
                                tbody.append(tr);
                                var td = $("<td style='text-align: center;'>" + j + "</td>");
                                tr.append(td);
                                var td = $("<td style='text-align: center;'>" + (ret[i].hasOwnProperty("NOMBRE") ? ret[i].NOMBRE : "") + "</td>");
                                tr.append(td);
                                var td = $("<td style='text-align: center;'>" + (ret[i].hasOwnProperty("ESTADO") ? ret[i].ESTADO : "") + "</td>");
                                tr.append(td);
                                var td = $("<td  onclick =\"eliminarMenu('" + ret[i].ID + "');\" style='text-align: center'><i class='fa fa-trash-o' aria-hidden='true' title=''></i></td>");
                                tr.append(td);
                                var td = $("<td  onclick =\"editarMenu('" + i + "','" + ret[i].MEN_PADRE + "');\" style='text-align: center'><i class='fa fa-pencil-square' aria-hidden='true'></i></td>");
                                tr.append(td);
                                j++;
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
function editarMenu(index,tipo){
    var nombre = listadoMenuP[index].NOMBRE;
    var submenu = listadoMenuP[index].MEN_PADRE;
    var tipomenu = listadoMenuP[index].TIPO;
    var estado =  listadoMenuP[index].ESTADO;
    var id = listadoMenuP[index].ID;
    var tip = "";
    console.log(estado.substr(0,1));
    if( tipo === '0'){
        tip = 1;
        submenu = null;
        $('#cmbPerfilM').attr('disabled', true);
    }else{
        tip = 2;
        $('#cmbPerfilM').attr('disabled', false);
    }
    
    $("#txtnombreMenu").val(nombre);
    $("#cmbTipoMenu").val(tip);
    $("#cmbPerfilM").val(submenu);
    $("#cmbTipoMenuDas").val(tipomenu);
    $("#cmbEstadoMen").val(estado.substr(0,1));
    $("#txtIdMenu").val(id);
}
function listarTipoMenu(){
    var ur = CONTROLLER_PAGES;
    var op = 8;
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
                        $listarCombo = $("#cmbTipoMenuDas");
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
function eliminarMenu(codigo){
     alertify.confirm('Mensaje', 'Esta seguro que desea eliminar el Menu seleccionado ?', function () {
        var ur = CONTROLLER_PAGES;
        var op = 9;
        $.ajax({
            type: "POST",
            url: ur,
            data: ({
                op: op,
                idMenu: codigo
            }),
            success:
                    function (data) {
                        try {
                            var ret = eval('(' + data + ')');
                            if (ret.hasOwnProperty("success")) {
                                $('#trMenuP' + codigo + '').remove();
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