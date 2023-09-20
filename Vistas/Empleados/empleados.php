<?php
include_once '../../validaSession.php';
include_once '../../Operaciones.php';
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SISV | Crear Empleados</title>
    <?php
    include '../../webPage/imports/imports.php';
    $empresa = $_SESSION['cod_empresa'];
    //die(var_dump($empresa));
    ?>
    <script>
        var CONTROLLEREMPLEADO = "../../Controlador/Empleados/CtlEmpleado.php";
    </script>

    <script src="empleados.js?v=<?php echo (rand()); ?>"></script>
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
                        <i class=""></i> Crear Empleados
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="../../principal"><i class="fa fa-dashboard"></i> Principal</a></li>
                        <li class="">Empleados</li>
                        <li class="">Crear Empleados</li>
                    </ol>
                </section><br>
                <section>
                    <div id="contect1">
                        <div class="panel panel-default">
                            <div class="panel-heading">Datos Basicos</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Tipo Documento:</label>
                                        <select id="cmbTipoDocumento" name="cmbTipoDocumento" class="form-control select2 input-sm "></select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>No Documento:</label>
                                        <input type="text" name="txtNumDocumento" id="txtNumDocumento" class="form-control input-sm" value="">
                                        <input type="hidden" id="txtEditar" name="txtEditar" value="0" />
                                        <input type="hidden" id="txtIdEmpleado" name="txtIdEmpleado" value="" />
                                    </div>
                                    <div class=" col-md-2">
                                        <label>Primer Nombre</label>
                                        <input type="text" name="txtPrimerNombre" id="txtPrimerNombre" class="form-control input-sm" onkeyup="this.value = this.value.toUpperCase();" value="">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Segundo Nombre</label>
                                        <input type="text" name="txtSegundoNombre" id="txtSegundoNombre" class="form-control input-sm" onkeyup="this.value = this.value.toUpperCase();" value="">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Primer Apellido</label>
                                        <input type="text" name="txtPrimerApellido" id="txtPrimerApellido" class="form-control input-sm" onkeyup="this.value = this.value.toUpperCase();" value="">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Segundo Apellido</label>
                                        <input type="text" name="txtSegundoApellido" id="txtSegundoApellido" class="form-control input-sm" onkeyup="this.value = this.value.toUpperCase();" value="">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Fecha de Nacimiento</label>
                                        <input type="date" class="form-control input-sm" name="txtfechaDeNacimiento" id="txtfechaDeNacimiento" max="<?php echo date("Y-m-d"); ?>">
                                    </div>
                                    <div class=" col-md-2">
                                        <label>Departamento</label>
                                        <select class="form-control select2 input-sm" id="cmbDepartamento" onchange="listarComboCiudad(this, 'cmbCiudad')">
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Ciudad</label>
                                        <select class="form-control select2 input-sm" id="cmbCiudad" name="cmbCiudad">
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Estado Civil</label>
                                        <select class="form-control select2 input-sm" id="cmbEstadoCivil" name="cmbEstadoCivil">
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Sexo</label>
                                        <select class="form-control select2 input-sm" id="cmbSexo" name="cmbSexo">
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Grupo Sanguineo</label>
                                        <select class="form-control select2 input-sm" id="cmbGrupoSanguineo" name="cmbGrupoSanguineo">
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Nivel Socio-Economico</label>
                                        <select class="form-control select2 input-sm" id="cmbEstratoSocial" name="cmbEstratoSocial">
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Email</label>
                                        <input type="text" name="txtEmail" id="txtEmail" class="form-control input-sm" onkeyup="this.value = this.value.toUpperCase();" value="">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Nivel de Escolaridad</label>
                                        <select class="form-control select2 input-sm" id="cmbNivelEscolaridad" name="cmbNivelEscolaridad">
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Estado del Empleado</label>
                                        <select class="form-control select2 input-sm" id="cmbEstadoEmpleado" name="cmbEstadoEmpleado">
                                            <option value=" ">Seleccione</option>
                                            <option value="A">Activo</option>
                                            <option value="I"> inactivo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="col-md-12">
                            <div id="divVisualizarEmpleados" style="overflow: auto; width: 100%; height:350px" class="">
                                <table id="tbl_visualizar_Empleados" style="width:100%;font-size: 12px;" class="table">
                                    <thead>
                                        <tr class="Info">
                                            <th class='center'>#</th>
                                            <th class='center'>TIPO DOCUMENTO</th>
                                            <th class='center'>NUMERO DOCUMENTO</th>
                                            <th class='center'>NOMBRES Y APELLIDOS</th>
                                            <th class='center'>NIVEL ESCOLARIDAD</th>
                                            <th class='center'>EMAIL</th>
                                            <th class='center'>ESTADO</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tblBodyEmpleados">
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
                    <div class="content">
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-12">
                                <div align="right" style="">
                                    <button type="button" id="btnActualizar" name="btnActualizar" class="btn btn btn-success btn-sm">Actualizar</button>
                                    <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-primary btn-sm">Guardar</button>
                                    <button type="reset" id="btnCancelar" name="btnCancelar" class="btn btn-warning btn-sm">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div><br>
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