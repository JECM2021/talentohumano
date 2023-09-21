<?php
require_once '/../../../Modelo/MdlClinica.php';
require_once '/../../../validaSession.php';
$mdlPacientes = new mdlClinica();
$idSu = isset($_GET["pageSub"]) ? $_GET["pageSub"] : 'sin definir';
$idMenu = isset($_GET["pageMenu"]) ? $_GET["pageMenu"] : 'sin definir';
$idPaginas = isset($_GET["page"]) ? $_GET["page"] : 'sin definir';
$class = isset($_GET["page"]) ? $_GET["page"] : 'treeview active';
?>
<script>
    var controlerHistoria = "/../../talentohumano/Controlador/HistoriaClinica/CtlHistoriaClinica";
</script>

<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding: 0px !important;">
    <ul class="nav navbar-nav ">
        <!-- <li data-toggle="modal" data-toggle="modal" data-target="#modalAnexos"><a href="#"><i class="fa fa-paperclip" aria-hidden="true"></i> Anexos</a></li>-->
        <?php
        foreach ($listaMenu as $rsListado) {
        ?>
            <li id="menuPrincipal<?php echo $rsListado['menu_id']; ?>" class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="<?php echo $rsListado['icono_menu']; ?> "></i> <span><?php echo $rsListado['pagina_menu']; ?></span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <?php
                    foreach ($mdlPacientes->obtenerPaginas($rsListado['menu_id'], $usuPerfil, $usuId) as $subMenu) {
                    ?>
                        <li class="" id="subPagina<?php echo $subMenu['pag_id'] ?>"><a style="font-size: 11px;" href="<?php echo $subMenu['url'] ?>?page=<?php echo $subMenu['pag_id'] ?>&pageMenu=<?php echo $rsListado['menu_id']; ?>"><i class="<?php echo $subMenu['icono'] ?>"></i> <?php echo $subMenu['nombre']; ?></a></li>
                    <?php
                    }
                    foreach ($mdlPacientes->obtenerSubMenu($rsListado['menu_id'], $usuPerfil, $usuId) as $subMenu) {
                    ?>
                        <li id="subMenu<?php echo $subMenu['menu_id'] ?>" class="dropdown-submenu">
                            <a href="" class="dropdown-submenu-toggle"><i class="<?php echo $subMenu['icono']; ?>"></i> <?php echo $subMenu['nombre']; ?>

                            </a>
                            <ul class="dropdown-menu">
                                <?php
                                foreach ($mdlPacientes->obtenerPaginas($subMenu['menu_id'], $usuPerfil, $usuId) as $subMenuSubPaginas) {
                                ?>
                                    <li class="" id="subPagina<?php echo $subMenuSubPaginas['pag_id'] ?>"><a style="font-size: 11px;" href="<?php echo $subMenuSubPaginas['url'] ?>?page=<?php echo $subMenuSubPaginas['pag_id'] ?>&pageMenu=<?php echo $rsListado['menu_id']; ?>&pageSub=<?php echo $subMenu['menu_id']; ?>"><i class="<?php echo $subMenuSubPaginas['icono'] ?>"></i> <?php echo $subMenuSubPaginas['nombre']; ?></a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </li>
        <?php
        }
        ?>
    </ul>
    <div class="navbar-custom-menu" style="font-size: 11px;    float: right;">
        <ul class="nav navbar-nav">
            <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <span class="label label-danger" id="spanAlertas"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">No Tiene notificaciones.</li>
                    <li>
                        <ul class="menu" id="menuAlertas">
                            <li data-toggle="modal" data-target="#modalOrdenes">
                                <!--<a href="#">
                                                                        <i class="fa fa-users text-aqua" ></i> Modificacion de pacientes
                                                                    </a>-->
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <i class="fa fa-flag-o"></i>
                    <span class="label label-danger" id="spanTareas"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header tasks">You have 0 tasks</li>
                    <li>
                        <ul class="menu" id="menutareas">
                            <li>

                        </ul>
                    </li>

                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?php echo $nombreUsuario ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li data-toggle="modal" data-toggle="modal" data-target="#modalConfiguracionUser"><a href="#"><i class="fa fa-user-circle" aria-hidden="true"></i> Seguridad</a></li>
                    <li><a href="/talentohumano/php_cerrar"><i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar sesión</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
</header>
<div class="modal fade " id="modalConfiguracionUser" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id=""><strong>Perfil de usuario.</strong></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label><strong>Nombre usuario:</strong></label>
                        <input type="text" class="form-control input-sm" disabled="" value=" <?php echo $nombreUsuario ?>">
                        <br>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Cambio de clave
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <form name="login" method="post" action="/" autocomplete="off">
                                        <div class="col-md-4">
                                            <label><strong>Contraseña Anterior:</strong></label>
                                            <input type="text" style="-webkit-text-security: disc;" autocomplete="off" class="form-control input-sm" name="txtContrasenaAnterior" id="txtContrasenaAnterior">
                                        </div>
                                        <div class="col-md-4">
                                            <label><strong>Nueva Contraseña:</strong></label>
                                            <input type="text" style="-webkit-text-security: disc;" autocomplete="off" class="form-control input-sm" name="txtContrasenaNueva" id="txtContrasenaNueva">
                                        </div>
                                        <div class="col-md-4">
                                            <label><strong>Confirmar Contraseña:</strong></label>
                                            <input type="text" style="-webkit-text-security: disc;" autocomplete="off" spellcheck="false" class="form-control input-sm" name="txtConfirmarContraena" id="txtConfirmarContraena">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" name="btnGuardarConfiguraion" onclick="cambiarContrasena();" id="btnGuardarConfiguraion" class="btn btn-primary btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Salir.</button>
            </div>
        </div>
    </div>
</div>
<!--Modal Anexos-->
<div class="modal fade" id="modalAnexos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><i class="fas fa-file-pdf" aria-hidden="true"></i><strong> Documentos Anexos.</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fromAnexo" action="/../../clinicasv/Controlador/Anexos/CtlAnexos.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="op" id="op" value="1">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Documento</label>
                            <div class="">
                                <input type="text" name="txtDocumentoManillas" id="txtDocumentoManillas" class="input-sm form-control solo-numero">
                                <input type="hidden" name="txtEventoManilla" id="txtEventoManilla" class="form-control input-sm ">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label>Nombre Paciente</label>
                            <div class="">
                                <input type="text" name="txtNombrePaciente" id="txtNombrePaciente" class="input-sm form-control" disabled="">
                                <input name="idPac" id="idPac" type="hidden" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Fecha del Documento</label>
                            <div class="">
                                <input type="date" class="form-control input-sm" name="txtFechaDocumento" id="txtFechaDocumento" value="<?php echo date(" Y-m-d"); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <label>Tipo de Anexo</label>
                            <select class="form-control input-sm" id="" name="">
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Nombre o Descripcion</label>
                            <div class="">
                                <input type="text" name="" id="" class="input-sm form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 ">
                            <label>Seleccionar Documento</label>
                            <input id="" data-show-upload="false" name="" multiple type="file" class="file" data-allowed-file-extensions='["pdf"]'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Detalle del Documento</label>
                            <div class="">
                                <textarea class="form-control" id="" name="" rows="3"></textarea>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" name="guardarAnexo" id="guardarAnexo">Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var idMenu = "<?php echo $idMenu ?>";
        var idSubMenu = "<?php echo $idSu; ?>";
        var idPaginas = "<?php echo $idPaginas; ?>";
        $("#menuPrincipal" + idMenu).addClass("active");
        $("#subMenu" + idSubMenu).addClass("active");
        $("#subPagina" + idPaginas).addClass("active");
        //  listarComboAnexo('cmbTipoAnexo');
        $("#guardarAnexo").click(function() {
            guardarAnexos();
        });
        $("#txtDocumentoManillas").autoComplete({
            minLength: 0,
            minChars: 1,
            delay: 300,
            source: function(request, response) {
                var dat = $("#txtDocumentoManillas").val();
                $.ajax({
                    type: "POST",
                    url: controlerHistoria,
                    dataType: "json",
                    data: {
                        q: request.term,
                        op: 44,
                        pat: dat
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.nombre,
                                value: item.documento,
                                id: item.evento
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
                return '<div class="autocomplete-suggestion" data-evento="' + itemurl + '"  data-val="' + itemvalue + '"><span style="color:blue;font-weight:bold">' + itemurl + '</span> - ' + itemlabel + '</div>';
            },
            onSelect: function(e, term, item) {
                var evento = $(item[0]).attr("data-evento");
                $("#txtEventoManilla").val(evento);
                var paciente = $(item[0]).text().split("-")[1];
                $("#txtNombrePaciente").val(paciente);
            }

        });
    });

    function activar(valor, tipoMenu) {
        //        var idObtenido = valor;
        //        $(".active").removeClass("active");
        //        $("#subMenu" + idObtenido).addClass("active");
        //        switch (tipoMenu) {
        //            case 1:
        //                $("#menuPrincipal" + idObtenido).addClass("active");
        //                break;
        //            case 2:
        //                break;
    }

    /*function guardarAnexos() {
        var documento = $("#txtDocumentoManillas").val();
        var tipoAnexo = $("#cmbTipoAnexo").val();
        var anexoDocumento = $("#archivo").val();
        var nombreAnexo = $("#txtNombreAnexo").val();
        var descripcion = $("#txtDetalle").val();
        toastr.options = {
            "positionClass": "toast-bottom-right",
        };
        if (documento.length === 0) {

            toastr.warning('El Documento del paciente no puede quedar vacio');
        } else if (tipoAnexo.length === 0) {
            toastr.warning('selecciones un tipo de anexo');
        } else if (nombreAnexo.length === 0) {
            toastr.warning('El Nombre o Descripcion no Pueden Quedar Vacio');
        } else if (anexoDocumento === 0) {
            toastr.option = {
                "positionClass": "toast-bottom-right",
            };
            toastr.warning('Se Debe Cargar un Documento (PDF)');
        } else if (descripcion.length === 0) {
            toastr.warning('El Detalle del Documento no Puede Quedar Vacio');
        } else {
            $("#fromAnexo").submit();
        }
    }*/
    //    }
</script>