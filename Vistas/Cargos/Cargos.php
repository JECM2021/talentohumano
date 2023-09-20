<?php
include_once '../../validaSession.php';
?>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SISV | Creacion de Cargos </title>
    <?php
    include '../../webPage/imports/imports.php';
    ?>
    <script src="../../vistas/Cargos/Cargos.js?v=<?php echo (rand()); ?>"></script>
    <script type="text/javascript">
        var CONTROLLERCARGOS = "../../Controlador/Cargos/CtlCargos.php";
    </script>
</head>

<body class="skin-blue sidebar-mini">
    <div class="wrapper" style="">
        <?php
        include_once "../../webPage/plantilla/cabezote_principal.php";
        include_once "../../webPage/plantilla/lateral/menu_principal.php";
        ?>
        <style>
            .selected {
                background-color: #a8ccec !important;
                color: #FFF;
            }
        </style>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <i class="fa fa-medkit"></i> Cargos

                </h1>
                <ol class="breadcrumb">
                    <li><a href="../../principal"><i class="fa fa-dashboard"></i> Principal</a></li>
                    <li class="">Cargos</li>
                    <li class="active">Cargos</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Codigo:</label>
                                        <div class="">
                                            <input type="text" class="form-control input-sm" id="txtCodigo" name="txtCodigo" value="" placeholder="">
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <label>Nombre o Descripcion:</label>
                                        <div class="">
                                            <input type="text" class="form-control input-sm" id="txtNombre" name="txtNombre" value="" placeholder="">
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <label>Fecha Creacion:</label>
                                        <div class="">
                                            <input type="date" class="form-control input-sm" name="fechaCreacion" id="fechaCreacion" placeholder="Digite fecha">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Estado del Cargo:</label>
                                        <div class="">
                                            <select id="cmbTipoEstado" name="cmbTipoEstado" class="form-control input-sm ">
                                                <option value="">Seleccione</option>
                                                <option value="A">Activo</option>
                                                <option value="I">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="content">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel-body">
                                            <table id="tbl_visualizar_cargos" style="font-size: 10px;" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr class="Info">
                                                        <th class='center'>#</th>
                                                        <th class='center'>CODIGO</th>
                                                        <th class='center'>DESCRIPCION</th>
                                                        <th class='center'>FECHA DE CREACION</th>
                                                        <th class='center'>ESTADO</th>
                                                        <th style='width: 2%;'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tblBodyListaCargos"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div align="right">
            <button type="button" id="btnGuardar" class="btn btn-primary btn-sm">Guardar</button>
            <button type="button" id="btnCancelar" class="btn btn-warning btn-sm">Cancelar</button>
        </div><br>

        <?php include "modal/modalActualizar.php"; ?>
        <?php
        include "../../webPage/plantilla/footer.php";
        ?>

    </div>
</body>

</html>