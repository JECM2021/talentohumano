<?php
include_once '../../validaSession.php';
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IntegralSoft | Parafiscales</title>
    <?php
    include '../../webPage/imports/imports.php';
    ?>
    <script>
        var CONTROLLERPARAFISCALES = "../../Controlador/Parafiscales/CtlParafiscales.php";
    </script>

    <script src="parafiscales.js?v=<?php echo (rand()); ?>"></script>
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
                        <i class=""></i> Crear Parafiscales
                    </h1>
                </section>
                <div class="content">
                    <div class="box">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Codigo:</label>
                                    <input type="text" name="txtCodigo" id="txtCodigo" class="form-control input " onkeyup="this.value = this.value.toUpperCase();" value="">
                                    <input type="hidden" id="txtEditarParafiscal" name="txtEditarParafiscal" value="0" />
                                    <input type="hidden" id="txtIdParafiscal" name="txtIdParafiscal" />
                                </div>
                                <div class="col-md-10">
                                    <label>Nombre:</label>
                                    <input type="text" name="txtNombre" id="txtNombre" class="form-control input" onkeyup="this.value = this.value.toUpperCase();" value="">
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
                                    <table class="table" style="font-size:14px;">
                                        <thead>
                                            <tr>
                                                <td>

                                                </td>

                                                <td align="center">
                                                    <label>(%)</label>
                                                </td>
                                                <!--<td align="center">
                                                    <label>Aux. Contable</label>
                                                </td>
                                                <td align="center">
                                                    <label>Auxiliar Fiscal</label>
                                                </td>
                                                <td align="center">
                                                    <label>Aux. Normas</label>
                                                </td>-->
                                                <td align="center">
                                                    <label>Nit.</label>
                                                </td>
                                                <td align="center">
                                                    <label>Cod. Admi</label>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="width: 10%;">
                                                    <label>SUBFAM</label>
                                                </td>
                                                <td>
                                                    <input type="text" name="txtPorceSubfam" id="txtPorceSubfam" class="form-control input solo-numero" value="" placeholder="%">
                                                </td>
                                                <!--  <td>
                                                    <input type="text" name="txtAuxContableSubfam" id="txtAuxContableSubfam" class="form-control input solo-numero " value="" placeholder="No. Cuenta">
                                                    <input type="hidden" id="txtIdAuxContableSubfam" name="txtIdAuxContableSubfam">
                                                </td>
                                                <td>
                                                    <input type="text" name="txtAuxFiscalSubfam" id="txtAuxFiscalSubfam" class="form-control input solo-numero" value="" placeholder="No. Cuenta">
                                                    <input type="hidden" id="txtIdAuxFiscalSubfam" name="txtIdAuxFiscalSubfam">
                                                </td>
                                                <td>
                                                    <input type="text" name="txtAuxNormasSubfam" id="txtAuxNormasSubfam" class="form-control input solo-numero" value="" placeholder="No. Cuenta">
                                                    <input type="hidden" id="txtIdAuxNormasSubfam" name="txtIdAuxNormasSubfam">
                                                </td>-->
                                                <td>
                                                    <input type="text" name="txtNumDocumentoSubfam" id="txtNumDocumentoSubfam" class="form-control input solo-numero" value="" placeholder="Numero">

                                                </td>
                                                <td>
                                                    <input type="text" name="txtCodAdminSubfam" id="txtCodAdminSubfam" class="form-control input" onkeyup="this.value = this.value.toUpperCase();" value="" placeholder="Cod. Admin">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>I.C.B.F.</label>
                                                </td>
                                                <td>
                                                    <input type="text" name="txtPorceIcbf" id="txtPorceIcbf" class="form-control input solo-numero" value="" placeholder="%">
                                                </td>
                                                <!-- <td>
                                                    <input type="text" name="txtAuxContableIcbf" id="txtAuxContableIcbf" class="form-control input solo-numero" value="" placeholder="No. Cuenta">
                                                    <input type="hidden" id="txtIdAuxContableIcbf" name="txtIdAuxContableIcbf">
                                                </td>
                                                <td>
                                                    <input type="text" name="txtAuxFiscalIcbf" id="txtAuxFiscalIcbf" class="form-control input solo-numero" value="" placeholder="No. Cuenta">
                                                    <input type="hidden" id="txtIdAuxFiscalIcbf" name="txtIdAuxFiscalIcbf">
                                                </td>
                                                <td>
                                                    <input type="text" name="txtAuxNormasIcbf" id="txtAuxNormasIcbf" class="form-control input solo-numero" value="" placeholder="No. Cuenta">
                                                    <input type="hidden" id="txtIdAuxNormasIcbf" name="txtIdAuxNormasIcbf">
                                                </td>-->
                                                <td>
                                                    <input type="text" name="txtNumDocumentoIcbf" id="txtNumDocumentoIcbf" class="form-control input solo-numero" value="" placeholder="Numero">

                                                </td>
                                                <td>
                                                    <input type="text" name="txtCodAdminIcbf" id="txtCodAdminIcbf" class="form-control input" onkeyup="this.value = this.value.toUpperCase();" value="" placeholder="Cod. Admin">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>SENA</label>
                                                </td>
                                                <td>
                                                    <input type="text" name="txtPorceSena" id="txtPorceSena" class="form-control input solo-numero" value="" placeholder="%">
                                                </td>
                                                <!--<td>
                                                    <input type="text" name="txtAuxContableSena" id="txtAuxContableSena" class="form-control input solo-numero" value="" placeholder="No. Cuenta">
                                                    <input type="hidden" id="txtIdAuxContableSena" name="txtIdAuxContableSena">
                                                </td>
                                                <td>
                                                    <input type="text" name="txtAuxFiscalSena" id="txtAuxFiscalSena" class="form-control input solo-numero" value="" placeholder="No. Cuenta">
                                                    <input type="hidden" id="txtIdAuxFiscalSena" name="txtIdAuxFiscalSena">
                                                </td>
                                                <td>
                                                    <input type="text" name="txtAuxNormasSena" id="txtAuxNormasSena" class="form-control input solo-numero" value="" placeholder="No. Cuenta">
                                                    <input type="hidden" id="txtIdAuxNormasSena" name="txtIdAuxNormasSena">
                                                </td>-->
                                                <td>
                                                    <input type="text" name="txtNumDocumentoSena" id="txtNumDocumentoSena" class="form-control input solo-numero" value="" placeholder="Numero">

                                                </td>
                                                <td>
                                                    <input type="text" name="txtCodAdminSena" id="txtCodAdminSena" class="form-control input" onkeyup="this.value = this.value.toUpperCase();" value="" placeholder="Cod. Admin">

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
                                                    <label>Tipo de Fondo:</label>
                                                </td>
                                                <td style="width: 23%;">
                                                    <select id="cmbTipoFondo" name="cmbTipoFondo" class="form-control input"></select>
                                                </td>
                                                <td style="width: 10%;">
                                                    <label>Estado Fondo</label>
                                                </td>
                                                <td style="width: 23%;">
                                                    <select id="cmbEstadoFondo" name="cmbEstadoFondo" class="form-control input">
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
                    <div class="">
                        <div class="col-md-12">
                            <div class="panel-body">
                                <table id="tbl_visualizar_parafiscales" style="width:100%;font-size: 12px;" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="Info">
                                            <th class='center'>#</th>
                                            <th class='center'>CODIGO</th>
                                            <th class='center'>RAZON SOCIAL</th>
                                            <th class='center'>TIPO DE FONDO</th>
                                            <th class='center'>ESTADO</th>
                                            <th style='width: 2%;'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></th>
                                            <th style='width: 2%;'><i class='fa fa-trash' aria-hidden='true'></i></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tblBodyListaParafiscales"></tbody>
                                </table>
                            </div>


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
    <?php include "modal/modalParaf.php"; ?>
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