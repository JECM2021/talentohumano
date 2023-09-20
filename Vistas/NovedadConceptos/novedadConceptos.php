<?php
include_once '../../validaSession.php';
include_once '../../Operaciones.php';
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SISV | Novedades por Conceptos</title>
    <?php
    include '../../webPage/imports/imports.php';
    ?>
    <script>
        var CONTROLLERNOVEDADES = "../../Controlador/NovedadConceptos/CtlNovedadConceptos.php";
    </script>

    <script src="novedadConceptos.js?v=<?php echo (rand()); ?>"></script>
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
                        <i class=""></i> Novedades por Conceptos
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="../../principal"><i class="fa fa-dashboard"></i> Principal</a></li>
                        <li class="">Nomina</li>
                        <li class="">Crear Nomina</li>
                    </ol>
                </section><br>
                <section>
                    <div id="contect2">
                        <div class="panel panel-default">
                            <div class="panel-heading">Seleccione las novedades</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Concepto de nomina</label>
                                        <div class="">
                                            <select id="cmbConceptoNomina" name="cmbConceptoNomina" class="form-control input-sm select2"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Mes de Concepto</label>
                                        <div class="">
                                            <select id="cmbMesConcepto" name="cmbMesConcepto" class="form-control input-sm select2"></select>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="">
                                    <div id="divVisualizarNovedades" style="overflow: auto; height:200px">
                                        <table id="tbl_visualizar_detalle_novedades" style="font-size: 11px;" class="table-condensed table-bordered  table table-bordered">
                                            <thead>
                                                <tr class="Info">
                                                    <th style="width: 5px;"><input type="checkbox" id="seleccionAll" value=""></th>
                                                    <th style="width: 15%;">IDENTIFICACION</th>
                                                    <th style="width: 34%;">NOMBRES Y APELLIDOS</th>
                                                    <th style="width: 19%;">SALARIO</th>
                                                    <th style="width: 19%;">VALOR EN HORAS</th>
                                                    <th style="width: 19%;">VALOR EN PESOS</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-12">
                                <div align="right" style="">
                                    <button type="button" id="btnLiquidar" name="btnLiquidar" class="btn btn-primary btn-sm">Guardar Novedades</button>
                                    <button type="reset" id="btnCancelar" name="btnCancelar" class="btn btn-warning btn-sm">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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