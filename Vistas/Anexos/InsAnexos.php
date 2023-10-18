<?php
include_once '../../validaSession.php';
include_once '../../Operaciones.php';
?>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style>
        .modal-lg {
            width: 70% !important;
        }
    </style>
    <title>SISV | Insertar Anexos</title>
    <?php
    include '../../webPage/imports/imports.php';
    ?>
    <script src="InsAnexos.js?v=<?php echo (rand()); ?>"></script>
    <script>
        var CONTROLER_INSANEXOS = "../../Controlador/Anexos/CtlInsAnexo.php";
    </script>
</head>

<body class="skin-blue sidebar-mini">

    <div class="wrapper">
        <?php
        include_once "../../webPage/plantilla/cabezote_principal.php";
        include_once "../../webPage/plantilla/lateral/menu_principal.php";
        ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <i class="fa fa-folder-open"></i> Insertar Anexos
                </h1>

            </section>
            <section class="content">
                <form id="frmAnexosIns" action="../../Controlador/Anexos/CtlInsAnexo.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="op" id="op" value="3">
                    <div class="box">
                        <div class="box-body">
                            <div class="panel panel-default">
                                <div class="panel-heading"><strong>Datos de Entrada</strong></div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong><label>Buscar Empleado</label></strong>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default btn-sm" id="btnModal" type="button" data-toggle="modal" data-target="#mdlEmpleados">Buscar</button>
                                                </span>
                                                <input type="text" name="txtNombreEmpleado" id="txtNombreEmpleado" disabled="" class="form-control input-sm" placeholder="Nombres y Apellidos">
                                                <input type="hidden" id="txtIdEmpleado" name="txtIdEmpleado">
                                                <input type="hidden" id="txtIdContrato" name="txtIdContrato">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Tipo de Anexo</label>
                                            <select class="form-control input-sm" id="cmbTipoAnexo" name="cmbTipoAnexo"></select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Nombre o Descripcion</label>
                                            <div class="">
                                                <input type="text" name="txtNombreAnexo" id="txtNombreAnexo" class="input-sm form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Fecha de Caducidad Documento</label>
                                            <input type="date" class="form-control input-sm" name="txtFechaDeCaducidad" id="txtFechaDeCaducidad">
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <label>Seleccionar Documento</label>
                                            <input id="archivo" data-show-upload="false" name="archivo" multiple type="file" class="file" data-allowed-file-extensions='["pdf"]'>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Detalle del Documento</label>
                                            <div class="">
                                                <textarea class="form-control" id="txtDetalle" name="txtDetalle" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div><br><br><br><br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div align="right" style="">
                                                <!-- <button type="button" id="btnActualizar" name="btnActualizar" class="btn btn btn-success btn-sm">Actualizar</button>-->
                                                <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-primary btn-sm">Guardar</button>
                                                <button type="reset" id="btnCancelar" name="btnCancelar" class="btn btn-warning btn-sm">Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </section><br><br><br><br><br><br><br><br><br><br><br>
            <style>
                .selected {
                    background-color: rgb(168, 204, 236) !important;
                }
            </style>
            <?php include "modal/Empleados.php"; ?>
        </div>
        <?php
        include "../../webPage/plantilla/footer.php";
        ?>

    </div>
</body>

</html>