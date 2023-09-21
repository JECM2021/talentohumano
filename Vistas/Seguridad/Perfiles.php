<?php
include_once '../../validaSession.php';
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SISV | Perfiles</title>
        <?php
        include '../../webPage/imports/imports.php';
        ?>
        <style>
            input{
                text-transform: uppercase;
            }
        </style>
        <script>
            var CONTROLLER_USER = "../../Controlador/Seguridad/CtlUsuarios";
        </script>
        <script src="Usuarios.js?v=<?php echo(rand()); ?>"></script>

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
                        <i class=""></i> Perfiles
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="../../principal"><i class="fa fa-dashboard"></i> Principal</a></li>
                        <li class="">Seguridad</li>
                        <li class="">Perfiles</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="box">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form name="frmPacientes" method="" action="" id="frmPacientes">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label><strong>Filtra Perfiles </strong></label>
                                                <input type="text" name="txtFiltroPrincipal" id="txtFiltroPrincipal" class="form-control input-sm" onclick="filtrarDatos('txtFiltroPrincipal', 'tblFiltroPrincipal')" placeholder="Buscar Perfil..."><br>
                                            </div>
                                            <div class="col-md-3">
                                                <label><strong>Nombre Perfil:</strong></label>
                                                <input type="text" name="txtPerfil" id="txtPerfil"  class="form-control  input-sm">
                                                <input type="hidden" name="txtidPerfil" id="txtidPerfil"  class="form-control  input-sm">
                                            </div>
                                            <div class="col-md-2">
                                                <label><strong>Estado </strong></label>
                                                <select class="form-control input-sm" id="cmbEstado" name="cmbEstado">
                                                    <option value="">Seleccione</option>
                                                    <option value="A"> Activo</option>
                                                    <option value="I"> Inactivo</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2" style="padding-right: 20px;"><br>
                                                <button type="button" class="btn btn-primary btn-block btn-sm" id="btnAddPerfil" name="btnAddPerfil" style="margin-top: 4px;">Guardar</button>
                                            </div>
                                            <div class="col-md-1" style="padding-left: 4px;"><br>
                                                <button type="button" class="btn btn-warning btn-sm" id="btnCancelar" name="btnCancelar" style="margin-top: 4px;">Cancelar</button>
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
                                        <div id="divVisualizarPerfil" style="overflow: auto; width: 100%; height:500px">
                                            <table id="datatable_roles" class="table" cellspacing="0" width="100%" style="font-size: 11px;">
                                                <thead>
                                                    <tr class='info'>
                                                        <th class='center'>CODIGO</th>
                                                        <th class='center'>DESCRIPCION</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbodyRoles"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="mdlpaginas" class="modal fade">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form id="frmorden">
                                        <div class="modal-header">						
                                            <span class="modal-title" style="font-size: 25px;font-weight: 600;">
                                                Lista Paginas</span>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>Nombre de Perfil</label> 
                                                    <input type="text" style="text-transform: capitalize;" class="form-control input-sm" name="txtNomPerfil"  id="txtNomPerfil" disabled >
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Menu</label> 
                                                    <select class="form-control input-sm"  id="cmbPerfil" name="cmbPerfil" style="width: 100%;" >
                                                    </select>
                                                    <input type="hidden" class="form-control input-sm" name="idPrincipal"  id="idPrincipal" >                                                
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Sub Menu</label> 
                                                    <select class="form-control input-sm"  id="cmdSubmenu" name="cmdSubmenu" style="width: 100%;" >
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Paginas</label> 
                                                    <select class="form-control input-sm"  id="cmbPaginas" name="cmbPaginas" style="width: 100%;" >
                                                    </select>                                                
                                                </div>
                                                <div class="col-md-2"><br>
                                                    <button type="button" class="btn btn-primary btn-block" id="btnAgregarPaginas" name="btnAgregarPaginas" style="margin-top: 4px;"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="tablePaginas" style="overflow: auto; width: 100%; height:190px" >
                                                        <table  style ="font-size: 11px;" class="table-condensed table-bordered  table table-bordered">
                                                            <thead>
                                                                <tr class="info">
                                                                    <th  class="center">Codigo</th>
                                                                    <th  class="center">Menu</th>
                                                                    <th  class="center">SubMenu</th>
                                                                    <th  class="center">Pagina</th>
                                                                    <th  style="width: 2%;"><i class="fa fa-trash" aria-hidden='true'></i></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbodyPaginas"></tbody>
                                                        </table>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel">
                                                <input type="button" class="btn btn-primary btn-sm" value="Ingresar" id="agregarPaginas" >
                                            </div>
                                    </form>
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
