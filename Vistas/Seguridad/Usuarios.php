<?php
include_once '../../validaSession.php';
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SISV | Usuarios</title>
        <?php
        include '../../webPage/imports/imports.php';
        ?>
        <style>
            input{
                text-transform: uppercase;
            }
        </style>
        <script>
            var CONTROLLER_USER = "../../Controlador/Seguridad/CtlUsuarios";
        </script>
        <script src="Usuarios.js?v=<?php echo(rand()); ?>"></script>
        <style>
            .modal-lg {
                /*width: 75% !important;*/
            }
        </style>
    </head>
    <body class="skin-blue sidebar-mini" >
        <div class="wrapper" style="">
            <?php
            include_once "../../webPage/plantilla/cabezote_principal.php";
            include_once "../../webPage/plantilla/lateral/menu_principal.php";
            ?>
            <div class="content-wrapper" >
                <section class="content-header">
                    <h1>
                        <i class=""></i> Usuarios
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="../../principal"><i class="fa fa-dashboard"></i> Principal</a></li>
                        <li class="">Seguridad</li>
                        <li class="">Usuarios</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form name="frmPacientes" method="" action="" id="frmPacientes">
                                                <div class="row">
                                                    <!--                                                    <div class="col-md-2">
                                                                                                            <label><strong>Tipo documento:</strong></label>
                                                                                                            <select class="form-control input-sm " id="cmbTipoDocumento" name="cmbTipoDocumento">
                                                                                                            </select>
                                                                                                        </div>-->
                                                    <div class="col-md-2">
                                                        <label><strong>Documento:</strong></label>
                                                        <input type="number" name="txtDocumento" id="txtDocumento" onclick="filtrarDatos('txtDocumento', 'tblFiltrarUsuario')" class="form-control  input-sm">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label><strong>Primer nombre: </strong></label>
                                                        <input type="text" name="txtPrimerNombre"onkeyup="this.value = this.value.toUpperCase();" id="txtPrimerNombre" class="form-control  input-sm">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label><strong>Segundo nombre: </strong></label>
                                                        <input type="text" name="txtSegundoNombre"onkeyup="this.value = this.value.toUpperCase();" id="txtSegundoNombre" class="form-control  input-sm">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label><strong>Primer apellido: </strong></label>
                                                        <input type="text" name="txtPrimerApellido"onkeyup="this.value = this.value.toUpperCase();" id="txtPrimerApellido" class="form-control  input-sm">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label><strong>Segundo apellido: </strong></label>
                                                        <input type="text" name="txtSegundoApellido"onkeyup="this.value = this.value.toUpperCase();" id="txtSegundoApellido" class="form-control  input-sm">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label><strong>Usuario:</strong></label>
                                                        <input type="text" name="txtUsuario" onkeyup="this.value = this.value.toUpperCase();" id="txtUsuario" class="form-control  input-sm">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <label><strong>Filtro rapido:</strong></label>
                                                        <input type="text" name="txtFiltro" onkeyup="this.value = this.value.toUpperCase();" id="txtFiltroUsuarios"  onclick="filtrarDatos('txtFiltroUsuarios', 'tblFiltrarUsuario')" class="form-control  input-sm">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><strong> perfil</strong></label>
                                                        <select class="form-control select2 input-sm" id="cmbPerfiles" style="width: 100%; ">
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label><strong> Estado</strong></label>
                                                        <select class="form-control input-sm" id="cmbEstado">
                                                            <option value="A">Activo</option>
                                                            <option value="I">Inactivo</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br> <br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div id="divVisualizarUsuarios" style="overflow: auto; width: 100%; height: 320px">
                                                            <table id='tbl_visualizaer_usuarios' style =' font-size: 11px;' class='table-hover table-condensed table-striped table-bordered  table  callback1'> </table> 
                                                        </div> 
                                                    </div>
                                                </div>

                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12 text-right">
                                                        <button type="button" name="btnGuardar"  id="btnGuardar" class="btn btn-primary btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                                                        <button type="reset" name="btnCancelUser"  id="btnCancelUser" class="btn btn-warning btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Cancelar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div id="callbackmenu1">   <!-- NOTAS DE ENFERMERIA -->
                <ul >
                    <li id="MenuItem1"><img  src="../../webPage/imagenes/acciones.png"><a href="#">Acciones</a>
                        <ul>
                            <li id="MenuItem1"><img src="../../webPage/imagenes/reset.png"> <a href="#2"> Restablecer contraseña.</a></li>
                            <li id="MenuItem1"><img src="../../webPage/imagenes/medicamentos.png"> <a href="#3"> Modificar usuario.</a></li>
                            <li id="MenuItem1"><img src="../../webPage/imagenes/permisos.png"> <a href="#4"> Permisos.</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="modal fade" id="modalOperaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="lblTitutlo"><strong>Permisos:  Andres Felipe Robles Solano</strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input  type="text" class="form-control input-sm" placeholder="Buscar..." id="txtFilPermisos" name="txtFilPermisos" onclick="filtrarDatos('txtFilPermisos', 'tblfilOperaciones')"><br>
                                    <div id="divVisualizarOperaciones"  style="overflow: auto; width: 100%; height: 300px" >
                                        <table id='tbl_visualizaer_operaciones' style =' font-size: 11px;' class='table-hover table-condensed table-striped table-bordered  table  '> </table> 

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>-->
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include "../../webPage/plantilla/footer.php";
            ?>
            <script>
                $(function () {
                    //Initialize Select2 Elements
                    $('.select2').select2();

                });
            </script>
        </div>
    </body>
</html>
