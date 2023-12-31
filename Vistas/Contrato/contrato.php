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
        var CONTROLLERCONTRATO = "../../Controlador/Contrato/CtlContrato.php";
    </script>

    <script src="contrato.js?v=<?php echo (rand()); ?>"></script>
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
                                    <div class="col-md-6">
                                        <label>Empleados:</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button" data-toggle="modal" data-target="#mdlEmpleados">Buscar</button>
                                            </span>
                                            <input type="text" name="txtNombreEmpleado" id="txtNombreEmpleado" class="form-control input" disabled="true" value="" onkeyup="this.value = this.value.toUpperCase();">
                                            <input type="hidden" id="txtIdEmpleado" name="txtIdEmpleado" />
                                            <input type="hidden" id="txtIdContrato" name="txtIdContrato" />
                                            <input type="hidden" id="txtEditar" name="txtEditar" value="0" />


                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Tipo Documento:</label>
                                        <select id="cmbTipoDocumento" name="cmbTipoDocumento" disabled="true" class="form-control input"></select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>No Documento:</label>
                                        <input type="text" name="txtNumDocumento" id="txtNumDocumento" disabled="true" class="form-control input" value="">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Estado Empleado</label>
                                        <select id="cmbEstadoEmpleado" name="cmbEstadoEmpleado" disabled="true" class="form-control input">
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
                        <div class="row">
                            <!-------------------------------------------------------------------------------------------->
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title">
                                            <i class=""></i> Datos Generales
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="" role="tabpanel" aria-labelledby="headingTwo">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>N° de contrato:</label>
                                                    <input type="text" name="txtNumContrato" id="txtNumContrato" class="form-control input-sm " value="" onkeyup="this.value = this.value.toUpperCase();">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Tipo de contrato:</label>
                                                    <select id="cmbTipoContrato" name="cmbTipoContrato" class="form-control input-sm "></select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Cargo:</label>
                                                    <select id="cmbTipoCargo" name="cmbTipoCargo" class="form-control input-sm select2"></select>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Fecha de Inicio</label>
                                                    <input type="date" class="form-control input-sm" name="txtFechaDeInicio" id="txtFechaDeInicio">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Fecha de Culminacion</label>
                                                    <input type="date" class="form-control input-sm" name="txtFechaDeTerminacion" id="txtFechaDeTerminacion">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Motivo de Retiro:</label>
                                                    <!-- <select id="cmbMotivoRetiro" name="cmbMotivoRetiro" class="form-control input-sm "></select>-->
                                                    <input type="text" name="cmbMotivoRetiro" id="cmbMotivoRetiro" class="form-control input-sm " value="" onkeyup="this.value = this.value.toUpperCase();">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Salario Actual:</label>
                                                    <input type="text" name="txtSalarioActual" id="txtSalarioActual" class="form-control input-sm " value="" onkeyup="calcularSueldoDiario()">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Salario Actual Diario:</label>
                                                    <input type="text" name="txtSalarioActualDiario" id="txtSalarioActualDiario" class="form-control input-sm" value="">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Forma de pago:</label>
                                                    <select id="cmbFormaDePago" name="cmbFormaDePago" class="form-control input-sm "></select>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Tipo de cotizante:</label>
                                                    <select id="cmbTipoDeCotizante" name="cmbTipoDeCotizante" class="form-control input-sm "></select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Arl:</label>
                                                    <select id="cmbArl" name="cmbArl" class="form-control input-sm "></select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Porcentaje Arl:</label>
                                                    <input type="text" name="txtPorcentajeArl" id="txtPorcentajeArl" class="form-control input-sm" value="">
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Caja de Compensacion:</label>
                                                    <select id="cmbCajaDeCompensacion" name="cmbCajaDeCompensacion" class="form-control input-sm "></select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Fondo de Cesantias:</label>
                                                    <select id="cmbFondoCesantias" name="cmbFondoCesantias" class="form-control input-sm "></select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Centro de Trabajo:</label>
                                                    <select id="cmbCentroDeCosto" name="cmbCentroDeCosto" class="form-control input-sm "></select>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <!--<div class="col-md-4">
                                                        <label>Fecha Inicio de Vacaciones:</label>
                                                        <input type="date" class="form-control input-sm" name="txtFechaDeInicioVacaciones" id="txtFechaDeInicioVacaciones">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Fecha Fin de Vacaciones:</label>
                                                        <input type="date" class="form-control input-sm" name="txtFechaFinDeVacaciones" id="txtFechaFinDeVacaciones">
                                                    </div>-->
                                                <div class="col-md-4">
                                                    <label>Area de Trabajo:</label>
                                                    <select id="cmbAreaTrabajo" name="cmbAreaTrabajo" class="form-control input-sm select2"></select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Cuidad Donde Labora:</label>
                                                    <select id="cmbCiudadDondeLabora" name="cmbCiudadDondeLabora" class="form-control input-sm select2"></select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ROW2>-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingThree">
                                        <h4 class="panel-title">
                                            <i class=""></i> Datos de Salud y Pension
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="" role="tabpanel" aria-labelledby="headingThree">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Fondo de Salud :</label>
                                                    <select id="cmbFondoDeSalud" name="cmbFondoDeSalud" class="form-control input-sm "></select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Porcentaje de Salud:</label>
                                                    <input type="text" name="txtPorcentajeSalud" id="txtPorcentajeSalud" class="form-control input-sm" value="">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Fecha Inicio Fondo de Salud</label>
                                                    <input type="date" class="form-control input-sm" name="txtFechaInicioSalud" id="txtFechaInicioSalud">
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Fondo de Pension:</label>
                                                    <select id="cmbFondoDePension" name="cmbFondoDePension" class="form-control input-sm "></select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Porcentaje de Pension:</label>
                                                    <input type="text" name="txtPorcentajePension" id="txtPorcentajePension" class="form-control input-sm" value="">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Fecha Inicio Fondo de Pension</label>
                                                    <input type="date" class="form-control input-sm" name="txtFechaInicioPension" id="txtFechaInicioPension">
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
                                            <i class=""></i> Datos de Pagos Electronicos
                                        </h4>
                                    </div>
                                    <div id="collapseFour" class="" role="tabpanel" aria-labelledby="headingFour">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Bancos:</label>
                                                    <select id="cmbBancos" name="cmbBancos" class="form-control input-sm select2"></select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Tipo de Cuenta:</label>
                                                    <select id="cmbTipoCuentaBancaria" name="cmbTipoCuentaBancaria" class="form-control input-sm "></select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>N° de Cuenta:</label>
                                                    <input type="text" name="txtNumCuenta" id="txtNumCuenta" class="form-control input-sm" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingFour">
                                        <h4 class="panel-title">
                                            <i class=""></i> Contactos de Emergencia
                                        </h4>
                                    </div>
                                    <div id="collapseFour" class="" role="tabpanel" aria-labelledby="headingFour">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Primer Nombre:</label>
                                                    <input type="text" name="txtPnombreAcomp" id="txtPnombreAcomp" class="form-control input-sm" value="">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Segundo Nombre:</label>
                                                    <input type="text" name="txtSnombreAcomp" id="txtSnombreAcomp" class="form-control input-sm" value="">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Primer Apellido:</label>
                                                    <input type="text" name="txtPapellidoAcomp" id="txtPapellidoAcomp" class="form-control input-sm" value="">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Segundo Apellido:</label>
                                                    <input type="text" name="txtSapellidoAcomp" id="txtSapellidoAcomp" class="form-control input-sm" value="">
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Parentesco:</label>
                                                    <select id="cmbParentesco" name="cmbParentesco" class="form-control input-sm "></select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Numero Celular:</label>
                                                    <input type="text" name="txtCelularAcomp" id="txtCelularAcomp" class="form-control input-sm" value="">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Numero Fijo:</label>
                                                    <input type="text" name="txtFijoAcomp" id="txtFijoAcomp" class="form-control input-sm" value="">
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
                        <?php include "modal/modalContrato.php"; ?>

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