<?php
include_once '../../validaSession.php';
include_once '../../Operaciones.php';
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SISV | Asignacion de Contrato</title>
    <?php
    include '../../webPage/imports/imports.php';
    ?>
    <script>
        var CONTROLLERVACACIONES = "../../Controlador/Vacaciones/CtlVacaciones.php";
    </script>

    <script src="Vacaciones.js?v=<?php echo (rand()); ?>"></script>
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
                        <i class=""></i> Asignacion de Contrato
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="../../principal"><i class="fa fa-dashboard"></i> Principal</a></li>
                        <li class="">Empleados</li>
                        <li class="">Asignacion de Contrato</li>
                    </ol>
                </section><br>
                <section>

                    <div id="contect1">
                        <div class="panel panel-default">
                            <div class="panel-heading">Datos del Empleados </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Empleados:</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button" data-toggle="modal" data-target="#mdlEmpleados">Buscar</button>
                                            </span>
                                            <input type="text" name="txtNombreEmpleadoVac" id="txtNombreEmpleadoVac" class="form-control input" disabled="true" value="" onkeyup="this.value = this.value.toUpperCase();">
                                            <input type="hidden" id="txtIdEmpleadoVac" name="txtIdEmpleadoVac" />
                                            <input type="hidden" id="txtEditarVac" name="txtEditarVac" value="0" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label>No Documento:</label>
                                        <input type="text" name="txtNumDocumentoVac" id="txtNumDocumentoVac" disabled="true" class="form-control input" value="">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Tipo de Contratacion:</label>
                                        <input type="text" name="txtTipoContratacion" id="txtTipoContratacion" class="form-control input" disabled="true" value="">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Area:</label>
                                        <input type="text" name="txtArea" id="txtArea" class="form-control input" disabled="true" value="">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Cargo:</label>
                                        <input type="text" name="txtCargo" id="txtCargo" class="form-control input" disabled="true" value="">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Estado Empleado</label>
                                        <select id="cmbEstadoEmpleadoVac" name="cmbEstadoEmpleadoVac" disabled="true" class="form-control input">
                                            <option value="">Seleccione</option>
                                            <option value="A">Activo</option>
                                            <option value="I">Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--DATOS DEL CONTRATO-->
                    <div class="contect2">
                        <!-- ROW2>-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingThree">
                                        <h4 class="panel-title">
                                            <i class=""></i> Periodos Vencidos
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="" role="tabpanel" aria-labelledby="headingThree">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Fecha Inicio</label>
                                                    <input type="date" class="form-control input-sm" name="txtFechaInicioPv" id="txtFechaInicioPv">
                                                </div>

                                                <div class="col-md-6">
                                                    <label>Fecha Final</label>
                                                    <input type="date" class="form-control input-sm" name="txtFechaFinPv" id="txtFechaFinPv">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----------------------------------------------------->
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingFour">
                                        <h4 class="panel-title">
                                            <i class=""></i> Inicio de Vacaciones
                                        </h4>
                                    </div>
                                    <div id="collapseFour" class="" role="tabpanel" aria-labelledby="headingFour">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Fecha Inicio</label>
                                                    <input type="date" class="form-control input-sm" name="txtFechaInicioVac" id="txtFechaInicioVac">
                                                </div>

                                                <div class="col-md-6">
                                                    <label>Fecha Final</label>
                                                    <input type="date" class="form-control input-sm" name="txtFechaFinVac" id="txtFechaFinVac">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Observaciones</label>
                                <div class="">
                                    <textarea class="form-control" id="txtObservaciones" name="txtObservaciones" rows="3"></textarea>
                                </div>
                            </div>
                        </div><br>
                        <div class="">
                            <div class="col-md-12">
                                <div id="divVisualizarVacacones" style="overflow: auto; width: 100%; height:350px" class="">
                                    <table id="tbl_visualizar_Vacaciones" style="width:100%;font-size: 12px;" class="table">
                                        <thead>
                                            <tr class="Info">
                                                <th style='width: 2%;'><i style=' margin-left: 3px' class='fa fa-info' aria-hidden='true'></i></th>
                                                <th class='center'>PERIODO VENCIDO DESDE</th>
                                                <th class='center'>PERIODO VENCIDO HASTA</th>
                                                <th class='center'>FECHA INICIO VACACIONES</th>
                                                <th class='center'>FECHA FIN VACACIONES</th>
                                                <th class='center'>OBSERVACIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tblBodyVacaciones">
                                            <tr>
                                                <td colspan='9' style='text-align: center;'>

                                                    <div style="height:150px ;"></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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

                        <div class="content">
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-12">
                                    <div align="right" style="">
                                        <!-- <button type="button" id="btnActualizar" name="btnActualizar" class="btn btn btn-success btn-sm">Actualizar</button>-->
                                        <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-primary btn-sm">Guardar</button>
                                        <button type="reset" id="btnCancelar" name="btnCancelar" class="btn btn-warning btn-sm">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php include "modal/modalEmpleados.php"; ?>
                </section>
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