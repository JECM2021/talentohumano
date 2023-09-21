<?php
include_once '../../validaSession.php';
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SISV | Paginas</title>
        <?php
        include '../../webPage/imports/imports.php';
        ?>
        <style>
            input{
                text-transform: uppercase;
            }
        </style>
        <script>
            var CONTROLLER_PAGES = "../../Controlador/Seguridad/CtlPaginas";
        </script>
        <script src="Paginas.js?v=<?php echo(rand()); ?>"></script>

    </head>
    <body class="skin-blue sidebar-mini" >
        <div class="wrapper" style="">
            <?php
            include_once "../../webPage/plantilla/cabezote_principal.php";
            include_once "../../webPage/plantilla/lateral/menu_principal.php";
            ?>
            <div class="content-wrapper" >
                <section class="content-header">
                    <h1>
                        <i class=""></i> Paginas
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="../../principal"><i class="fa fa-dashboard"></i> Principal</a></li>
                        <li class="">Seguridad</li>
                        <li class="">Paginas</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="box">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form name="frmPacientes" method="" action="" id="frmPacientes">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label><strong>Filtrar Paginas </strong></label>
                                                <input type="text" name="txtFiltroPaginas" id="txtFiltroPaginas" class="form-control input-sm" onclick="filtrarDatos('txtFiltroPaginas', 'tblFiltroPaginas')" placeholder="Buscar Paginas...">
                                            </div>
                                            <div class="col-md-2" style="padding-right: 20px;"><br>
                                                <button type="button" class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#mdlPaginas" style="margin-top: 4px;">Agregar Paginas</button>
                                            </div>
                                            <div class="col-md-2" style="padding-right: 20px;"><br>
                                                <button type="button" class="btn btn-success  btn-block btn-sm" data-toggle="modal" data-target="#mdlMenus" style="margin-top: 4px;">Agregar Menu</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div>
                                <hr style="margin-top: 1px;margin-bottom: 1px; ">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-body">
                                        <div id="divVisualizarPaginas" style="overflow: auto; width: 100%; height:500px">
                                            <table id="datatable_pages" class="table-condensed table-bordered  table table-bordered fijoTable" cellspacing="0" width="100%" style="font-size: 11px;">
                                                <thead>
                                                    <tr class='info'>
                                                        <th style='text-align: center;'>CODIGO</th>
                                                        <th style='text-align: center;' >MENU</th>
                                                        <th style='text-align: center;' >SUB MENU</th>
                                                        <th style='text-align: center;'>PAGINAS</th>
                                                        <th style='width: 2%;text-align: center' ><i class='fa fa-trash' aria-hidden='true' title='Eliminar Pagina'></i></th>
                                                        <th style='width: 2%;text-align: center' ><i class='fa fa-pencil-square'  aria-hidden='true'></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbodyPages"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="mdlPaginas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <span class="modal-title" style="font-size: 20px;font-weight: 600;">Crear Paginas</span>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Carpetas</label> 
                                                <input type="text" style="text-transform: capitalize;" class="form-control input-sm" name="txtnombreCarpeta"  id="txtnombreCarpeta"  >
                                                <input type="hidden"  class="form-control input-sm" name="txtIdPagina"  id="txtIdPagina" >
                                            </div>
                                            <div class="col-md-2">
                                                <label>Archivo</label> 
                                                <input type="text" style="text-transform: capitalize;" class="form-control input-sm" name="txtnombreArchivo"  id="txtnombreArchivo" disabled="" >
                                            </div>
                                            <div class="col-md-2">
                                                <label>Menu</label> 
                                                <select class="form-control input-sm"  id="cmbPerfil" name="cmbPerfil" style="width: 100%;" >
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Sub Menu</label> 
                                                <select class="form-control input-sm"  id="cmdSubmenu" name="cmdSubmenu" style="width: 100%;" >
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Nombre de Pagina</label> 
                                                <input type="text" style="text-transform: capitalize;" class="form-control input-sm" name="txtnombrePagina"  id="txtnombrePagina"  >
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Ruta de Url (archivo)</label>
                                                <input type="text"  style="text-transform: capitalize;"  class="form-control input-sm" name="txtUrl"  id="txtUrl" disabled="disabled" >
                                                <input type="hidden"  class="form-control input-sm" name="txtUrlTemp"  id="txtUrlTemp" >
                                            </div>
                                            <div class="col-md-3">
                                                <label>Icono</label> 
                                                <input type="text"  class="form-control input-sm" name="txtIcono"  id="txtIcono" >
                                            </div>
                                            <div class="col-md-3">
                                                <label>Estado</label> 
                                                <select class="form-control input-sm" id="cmbEstado" name="cmbEstado">
                                                    <option value="">Seleccione</option>
                                                    <option value="A"> Activo</option>
                                                    <option value="I"> Inactivo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary btn-sm" id="btnGuardarPages">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="mdlMenus" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <span class="modal-title" style="font-size: 20px;font-weight: 600;">Crear Menu</span>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Nombre</label> 
                                                <input type="text" style="text-transform: capitalize;" class="form-control input-sm" name="txtnombreMenu"  id="txtnombreMenu" >
                                                <input type="hidden"  class="form-control input-sm" name="txtIdMenu"  id="txtIdMenu" >
                                            </div>
                                            <div class="col-md-2">
                                                <label>Tipo</label> 
                                                <select class="form-control input-sm" id="cmbTipoMenu" name="cmbTipoMenu">
                                                    <option value="">Seleccione</option>
                                                    <option value="1">Menu</option>
                                                    <option value="2">Submenu</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Menu</label> 
                                                <select class="form-control input-sm"  id="cmbPerfilM" name="cmbPerfilM" style="width: 100%;" >
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Tipo Menu</label> 
                                                <select class="form-control input-sm" id="cmbTipoMenuDas" name="cmbTipoMenuDas">
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Estado</label> 
                                                <select class="form-control input-sm" id="cmbEstadoMen" name="cmbEstadoMen">
                                                    <option value="">Seleccione</option>
                                                    <option value="A"> Activo</option>
                                                    <option value="I"> Inactivo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="divVisualizarMenu" style="overflow: auto; width: 100%; height:250px" class="">
                                                    <table id='tbl_visualizar_Menu'  style ='font-size: 11px;' class='table-condensed table-bordered  table table-bordered callback1 table-hover'> 
                                                        <thead class="">
                                                            <tr class="info">
                                                                <th style="text-align: center">CODIGO </th>
                                                                <th style="text-align: center">MENU</th>
                                                                <th style="text-align: center">ESTADO</th>
                                                                <th style='width: 2%;text-align: center' ><i class='fa fa-pencil-square'  aria-hidden='true'></i></th>
                                                                <th  style="width: 2%;text-align: center"><i class="fa fa-trash" aria-hidden='true'></i></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tboBodyMenu" style="cursor: pointer"></tbody>
                                                    </table> 
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary" id="btnGuardarMenu">Guardar</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                </section>
            </div>
            <?php
            include "../../webPage/plantilla/footer.php";
            ?>
            <script>
                $(function () {
                    //Initialize Select2 Elements
                    $('.select2').select2();
                });
            </script>
        </div>
    </body>
</html>

