<?php
include_once '../../validaSession.php';
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IntegralSoft | Crear Arl</title>
    <?php
    include '../../webPage/imports/imports.php';
    ?>
    <script>
        var CONTROLLERARL = "../../Controlador/Arl/CtlArl.php";
    </script>

    <script src="arl.js?v=<?php echo (rand()); ?>"></script>
</head>

<body class="nav-md">
    <div class="skin-blue sidebar-mini">
        <div class="wrapper">
            <?php
            include_once "../../webPage/plantilla/cabezote_principal.php";
            include_once "../../webPage/plantilla/lateral/menu_principal.php";
            ?>
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        <i class=""></i> Crear Adminsitradora de Riesgos Laborales.
                    </h1>
                </section>
                <div class="content">
                    <div class="box">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Codigo:</label>
                                    <!--<span class="input-group-btn">
                                            <button class="btn btn-secondary btn-sm" type="button" data-toggle="modal" data-target="#mdlArl">Buscar</button>
                                        </span>-->
                                    <input type="text" name="txtCodigoArl" id="txtCodigoArl" class="form-control input-sm " value="" onkeyup="this.value = this.value.toUpperCase();">
                                    <input type="hidden" id="txtEditar" name="txtEditar" value="0" />
                                    <input type="hidden" id="txtIdFondoArl" name="txtIdFondoArl" />

                                </div>
                                <div class="col-md-4">
                                    <label>Nombre:</label>
                                    <input type="text" name="txtNombreArl" id="txtNombreArl" class="form-control input-sm " value="" onkeyup="this.value = this.value.toUpperCase();">
                                </div>
                                <div class="col-md-2">
                                    <label>Tipo Documento:</label>
                                    <select id="cmbTipoDocumento" name="cmbTipoDocumento" class="form-control input-sm "></select>
                                </div>
                                <div class="col-md-2">
                                    <label>No Documento:</label>
                                    <input type="text" name="txtNumDocumento" id="txtNumDocumento" class="form-control input-sm " value="">
                                </div>

                                <div class="col-md-2">
                                    <label>Codigo de Adminsitradora:</label>
                                    <input type="text" name="txtCodAdminArl" id="txtCodAdminArl" class="form-control input-sm " value="" onkeyup="this.value = this.value.toUpperCase();">
                                </div>
                            </div><br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table" border="0" style="font-size:14px;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 10%;">
                                                    <label>Riesgo No. 0:</label>
                                                </td>
                                                <td style="width:15%;">
                                                    <input type="text" name="txtRiesgoCero" id="txtRiesgoCero" class="form-control input-sm solo-numero" value="">
                                                </td>
                                                <td style="width: 10%;">
                                                    <label>Riesgo No. 1:</label>
                                                </td>
                                                <td style="width:15%;">
                                                    <input type="text" name="txtRiesgoUno" id="txtRiesgoUno" class="form-control input-sm solo-numero" value="">
                                                </td>
                                                <td style="width: 10%;">
                                                    <label>Riesgo No. 2:</label>
                                                </td>
                                                <td style="width:15%;">
                                                    <input type="text" name="txtRiesgoDos" id="txtRiesgoDos" class="form-control input-sm solo-numero" value="">
                                                </td>
                                                <td style="width: 10%;">
                                                    <label>Riesgo No. 3:</label>
                                                </td>
                                                <td style="width:15%;">
                                                    <input type="text" name="txtRiesgoTres" id="txtRiesgoTres" class="form-control input-sm solo-numero" value="">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table" border="0" style="font-size:14px;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 10%;">
                                                    <label>Riesgo No. 4:</label>
                                                </td>
                                                <td style="width:15%;">
                                                    <input type="text" name="txtRiesgoCuatro" id="txtRiesgoCuatro" class="form-control input-sm solo-numero" value="">
                                                </td>
                                                <td style="width: 10%;">
                                                    <label>Riesgo No. 5:</label>
                                                </td>
                                                <td style="width:15%;">
                                                    <input type="text" name="txtRiesgoCinco" id="txtRiesgoCinco" class="form-control input-sm solo-numero" value="">
                                                </td>
                                                <td style="width: 10%;">
                                                    <label>Riesgo No. 6:</label>
                                                </td>
                                                <td style="width:15%;">
                                                    <input type="text" name="txtRiesgoSeis" id="txtRiesgoSeis" class="form-control input-sm solo-numero" value="">
                                                </td>
                                                <td style="width: 10%;">
                                                    <label>Riesgo No. 7:</label>
                                                </td>
                                                <td style="width:15%;">
                                                    <input type="text" name="txtRiesgoSiete" id="txtRiesgoSiete" class="form-control input-sm solo-numero" value="">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <!--    <div class="col-md-2">
                                    <label>Auxiliar Contable</label>
                                    <input type="text" name="txtAuxContable" id="txtAuxContable" class="form-control input-sm " value="">
                                    <input type="hidden" id="txtIdAuxContable" name="txtIdAuxContable">
                                </div>
                                <div class="col-md-2">
                                    <label>Auxiliar Fiscal</label>
                                    <input type="text" name="txtAuxFiscal" id="txtAuxFiscal" class="form-control input-sm " value="">
                                    <input type="hidden" id="txtIdAuxFiscal" name="txtIdAuxFiscal">
                                </div>
                                <div class="col-md-2">
                                    <label>Auxiliar Normas</label>
                                    <input type="text" name="txtAuxNormas" id="txtAuxNormas" class="form-control input-sm " value="">
                                    <input type="hidden" id="txtIdAuxNormas" name="txtIdAuxNormas">
                                </div>
                                <div class="col-md-2">
                                    <label>Fuentes Contables</label>
                                    <input type="text" name="txtFuentesContables" id="txtFuentesContables" class="form-control input-sm " value="">
                                </div>-->
                                <div class="col-md-2">
                                    <label>Tipo de Fondo</label>
                                    <select id="cmbTipoFondo" name="cmbTipoFondo" class="form-control input-sm "></select>
                                </div>
                                <div class="col-md-2">
                                    <label>Estado Fondo</label>
                                    <select id="cmbEstadoFondo" name="cmbEstadoFondo" class="form-control input-sm ">
                                        <option value="">Seleccione</option>
                                        <option value="A">Activo</option>
                                        <option value="I">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="col-md-12">
                        <div class="panel-body">
                            <table id="tbl_visualizar_Arl" style="width:100%;font-size: 12px;" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="Info">
                                        <th class='center'>#</th>
                                        <th class='center'>CODIGO</th>
                                        <th class='center'>RAZON SOCIAL</th>
                                        <th class='center'>TIPO DE DOCUMENTO</th>
                                        <th class='center'>NUMERO DE DOCUMENTO</th>
                                        <th class="center">TIPO DE FONDO</th>
                                        <th class="center">ESTADO FONDO</th>
                                        <th style='width: 2%;'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></th>
                                        <th style='width: 2%;'><i class='fa fa-trash' aria-hidden='true'></i></th>
                                    </tr>
                                </thead>
                                <tbody id="tblBodyListaArl"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="content"><br><br><br><br><br><br>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-12">
                            <div align="right" style="">
                                <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-primary btn-sm">Guardar</button>
                                <button type="reset" id="btnCancelar" name="btnCancelar" class="btn btn-warning btn-sm">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "modal/modalArl.php"; ?>
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