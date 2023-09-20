<?php
include_once '../../validaSession.php';
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IntegralSoft | Fondos Pension</title>
    <?php
    include '../../webPage/imports/imports.php';
    ?>
    <script>
        var CONTROLLERFONDOS = "../../Controlador/Fondos/CtlPys.php";
    </script>

    <script src="pys.js?v=<?php echo (rand()); ?>"></script>
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
                        <i class=""></i>Fondo Pension
                    </h1>
                </section>
                <div class="content">
                    <div class="box">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Codigo:</label>
                                    <input type="text" name="txtCodigo" id="txtCodigo" class="form-control input" onkeyup="this.value = this.value.toUpperCase();" value="">
                                    <input type="hidden" id="txtIdFondoPension" name="txtIdFondoPension" value="" />
                                    <input type="hidden" id="txtFondoPension" name="txtFondoPension" value="1" />
                                    <input type="hidden" id="txtEditar" name="txtEditar" value="0" />
                                </div>
                                <div class="col-md-3">
                                    <label>Nombre:</label>
                                    <input type="text" name="txtNombre" id="txtNombre" class="form-control input" onkeyup="this.value = this.value.toUpperCase();" value="">
                                </div>
                                <div class="col-md-2">
                                    <label>Tipo Documento:</label>
                                    <select id="cmbTipoDocumento" name="cmbTipoDocumento" class="form-control input"></select>
                                </div>
                                <div class="col-md-2">
                                    <label>No Documento:</label>
                                    <input type="text" name="txtNumDocumento" id="txtNumDocumento" class="form-control input solo-numero" value="">
                                </div>

                                <div class="col-md-2">
                                    <label>Codigo de Adminsitradora:</label>
                                    <input type="text" name="txtCodAdmin" id="txtCodAdmin" class="form-control input" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">

                                </div>
                                <div class="col-md-2">

                                </div>
                            </div><br>
                            <div class=" row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td>

                                                </td>
                                                <td align="center">
                                                    <label>pension</label>
                                                </td>
                                                <td align="center">
                                                    <label>F.S.P.</label>
                                                </td>
                                                <td align="center">
                                                    <label>Edu/Ahorro</label>
                                                </td>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="width: 10%;">
                                                    <label>Porcentaje</label>
                                                </td>
                                                <td>
                                                    <input type="text" name="txtPorcePension" id="txtPorcePension" class="form-control input-sm solo-numero" value="" placeholder="%">
                                                </td>
                                                <td>
                                                    <input type="text" name="txtPorceFsp" id="txtPorceFsp" class="form-control input-sm solo-numero" value="" placeholder="%">
                                                </td>
                                                <td>
                                                    <input type="text" name="txtPorceEduAhorro" id="txtPorceEduAhorro" class="form-control input-sm solo-numero" value="" placeholder="%">
                                                </td>

                                            </tr>
                                            <!--<tr>
                                                <td>
                                                    <label>% F.S.P.</label>
                                                </td>
                                                <td>
                                                    <input type="text" name="txtPorceFsp" id="txtPorceFsp" class="form-control input-sm solo-numero" value="" placeholder="%">
                                                </td>
                                                <td>
                                                    <input type="text" name="txtFspAuxContable" id="txtFspAuxContable" class="form-control input-sm solo-numero" value="" placeholder="No. Cuenta">
                                                    <input type="hidden" id="txtIdFspAuxContable" name="txtIdFspAuxContable">
                                                </td>
                                                <td>
                                                    <input type="text" name="txtFspAuxFiscal" id="txtFspAuxFiscal" class="form-control input-sm solo-numero" value="" placeholder="No. Cuenta">
                                                    <input type="hidden" id="txtIdFspAuxFiscal" name="txtIdFspAuxFiscal">
                                                </td>
                                                <td>
                                                    <input type="text" name="txtFspAuxNormas" id="txtFspAuxNormas" class="form-control input-sm solo-numero" value="" placeholder="No. Cuenta">
                                                    <input type="hidden" id="txtIdFspAuxNormas" name="txtIdFspAuxNormas">
                                                </td>
                                            </tr>-->
                                            <!-- <tr>
                                                <td>
                                                    <label>% Edu/ Ahorro</label>
                                                </td>
                                                <td>
                                                    <input type="text" name="txtPorceEduAhorro" id="txtPorceEduAhorro" class="form-control input-sm solo-numero" value="" placeholder="%">
                                                </td>
                                                <td>
                                                    <input type="text" name="txtEduAuxContable" id="txtEduAuxContable" class="form-control input-sm solo-numero" value="" placeholder="No. Cuenta">
                                                    <input type="hidden" id="txtIdEduAuxContable" name="txtIdEduAuxContable">
                                                </td>
                                                <td>
                                                    <input type="text" name="txtEduAuxFiscal" id="txtEduAuxFiscal" class="form-control input-sm solo-numero" value="" placeholder="No. Cuenta">
                                                    <input type="hidden" id="txtIdEduAuxFiscal" name="txtIdEduAuxFiscal">
                                                </td>
                                                <td>
                                                    <input type="text" name="txtEduAuxNormas" id="txtEduAuxNormas" class="form-control input-sm solo-numero" value="" placeholder="No. Cuenta">
                                                    <input type="hidden" id="txtIdEduAuxNormas" name="txtIdEduAuxNormas">
                                                </td>
                                            </tr>-->

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table" border="0">
                                        <tbody>
                                            <tr>
                                                <td style="width: 10%;">
                                                    <label>Tipo de Fondo:</label>
                                                </td>
                                                <td style="width: 30%;">
                                                    <select id="cmbFondo" name="cmbFondo" class="form-control input-sm "></select>
                                                </td>
                                                <td style="width: 10%;">
                                                    <label>Estado Fondo</label>
                                                </td>
                                                <td style="width: 30%;">
                                                    <select id="cmbEstadoFondo" name="cmbEstadoFondo" class="form-control input-sm ">
                                                        <option value="">Seleccione</option>
                                                        <option value="A">Activo</option>
                                                        <option value="I">Inactivo</option>
                                                    </select>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="col-md-12">
                        <div class="panel-body">
                            <table id="tbl_visualizar_pension" style="width:100%;font-size: 12px;" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="Info">
                                        <th class='center'>#</th>
                                        <th class='center'>CODIGO</th>
                                        <th class='center'>RAZON SOCIAL</th>
                                        <th class='center'>TIPO DE DOCUMENTO</th>
                                        <th class='center'>NUMERO DE DOCUMENTO</th>
                                        <th class="center">TIPO DE FONDO</th>
                                        <th class='center'>ESTADO</th>
                                        <th style='width: 2%;'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></th>
                                        <th style='width: 2%;'><i class='fa fa-trash' aria-hidden='true'></i></th>
                                    </tr>
                                </thead>
                                <tbody id="tblBodyListaPension"></tbody>
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
    </div>
    <?php include "modal/modalFondos.php"; ?>
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