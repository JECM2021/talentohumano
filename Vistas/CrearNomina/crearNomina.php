<?php
include_once '../../validaSession.php';
include_once '../../Operaciones.php';
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SISV | Crear Nomina</title>
    <?php
    include '../../webPage/imports/imports.php';
    ?>
    <script>
        var CONTROLLERCREARNOMINA = "../../Controlador/CrearNomina/CtlCrearNomina.php";
    </script>

    <script src="crearNomina.js?v=<?php echo (rand()); ?>"></script>
</head>

<body class="skin-blue sidebar-mini">
    <div class="wrapper">
        <?php
        include_once "../../webPage/plantilla/cabezote_principal.php";
        include_once "../../webPage/plantilla/lateral/menu_principal.php";
        ?>
        <div class="content-wrapper">
            <div class="content">
                <section class="content-header">
                    <h1>
                        <i class=""></i> Crear Nomina
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="../../principal"><i class="fa fa-dashboard"></i> Principal</a></li>
                        <li class="">Nomina</li>
                        <li class="">Crear Nomina</li>
                    </ol>
                </section><br>
                <section>
                    <div id="contect1">
                        <div class="panel panel-default">
                            <div class="panel-heading">Datos Basicos</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Tipo de Liquidacion:</label>
                                        <select id="cmbTipoLiquidacion" name="cmbTipoLiquidacion" class="form-control input-sm "></select>
                                        <input type="hidden" name="txtIdNomina" id="txtIdNomina" class="form-control input-sm" value="" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Descripcion:</label>
                                        <input type="text" name="txtDescripcion" id="txtDescripcion" class="form-control input-sm" value="">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Mes:</label>
                                        <select id="cmbMes" name="cmbMes" class="form-control input-sm "></select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Año:</label>
                                        <select id="cmbAno" name="cmbAno" class="form-control input-sm "></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="contect2">
                        <div class="panel panel-default">
                            <div class="panel-heading">Selecciona los empleados que desean incluir en esta nomina</div>
                            <div class="panel-body">
                                <div id="divVisualizarEmpleados" style="overflow: auto; height:200px">
                                    <table id="tbl_visualizar_detalle_empleados" style="font-size: 11px;" class="table-condensed table-bordered  table table-bordered">
                                        <thead>
                                            <tr class="Info">
                                                <th style="width: 5px;"><input type="checkbox" id="cboxSeleccionarTodos" value=""></th>
                                                <th style="width: 15%;">Identificacion</th>
                                                <th style="width: 24%;">Nombre y Apellido</th>
                                                <th style="width: 19%;">Cargo</th>
                                                <th style="width: 19%;">Salario</th>
                                                <th style="width: 19%;">Fecha Inicio Contrato</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-12">
                                <div align="right" style="">
                                    <button type="button" id="btnLiquidar" name="btnLiquidar" class="btn btn-primary btn-sm">Liquidar Nomina</button>
                                    <button type="button" class="btn btn-light btn-sm" id="btnImprimir" name="btnImprimir">Imprimir</button>
                                    <button type="reset" id="btnCancelar" name="btnCancelar" class="btn btn-warning btn-sm">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div><br>

            <div class="modal fade " id="modalLoandig" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="width: 100px;margin-left: 39%;margin-top: 34%;">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="cargando">
                                        <label style='float:left;  margin-top:15%; font-size:15px;'>Cargando...</label>
                                        <div class='lds-dual-ring' style='float:left; margin-left:16%; width:5%;'></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include "../../webPage/plantilla/footer.php";
            ?>
        </div>
        <script>
            $(".solo-numero").keydown(function(event) {
                //alert(event.keyCode);
                if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event
                    .keyCode !== 190 && event.keyCode !== 110 && event.keyCode !== 8 && event.keyCode !== 9) {
                    return false;
                }
            });
            $(function() {
                $('.select2').select2();
            });
        </script>
</body>

</html>