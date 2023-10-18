<?php
include_once '../../validaSession.php';
include_once '../../Operaciones.php';
?>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style>
        .modal-lg {
            width: 70% !important;
        }
    </style>
    <title>SISV | Ver Anexos</title>
    <?php
    include '../../webPage/imports/imports.php';
    ?>
    <script src="anexos.js?v=<?php echo (rand()); ?>"></script>
    <script>
        var CONTROLER_ANEXOS = "../../Controlador/Anexos/CtlAnexos";
    </script>
</head>

<body class="skin-blue sidebar-mini">

    <div class="wrapper">
        <?php
        include_once "../../webPage/plantilla/cabezote_principal.php";
        include_once "../../webPage/plantilla/lateral/menu_principal.php";
        ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <i class="fa fa-folder-open"></i> Ver Anexos
                </h1>

            </section>
            <section class="content">
                <div class="box">
                    <div class="box-body">
                        <div class="panel panel-default">
                            <div class="panel-heading"><strong>Datos de Entrada</strong></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <strong><label>Buscar Empleado</label></strong>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default btn-sm" id="btnModal" type="button" data-toggle="modal" data-target="#mdlBuscarEmpleados">Buscar</button>
                                            </span>
                                            <input type="text" name="txtDocumentoAnexo" id="txtDocumentoAnexo" disabled="" class="form-control input-sm" placeholder="Documento....">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <strong><label>Nombre del Paciente</label></strong>
                                        <input type="text" name="txtNombrePacienteAnexo" id="txtNombrePacienteAnexo" class="form-control input-sm" disabled="">
                                    </div>
                                    <div class="col-md-3">
                                        <strong><label>Numero de Contrato</label></strong>
                                        <input type="text" name="txtNumEvento" id="txtNumEvento" class="form-control input-sm" disabled="">
                                        <input type="hidden" name="txtNumId" id="txtNumId" class="form-control input-sm" disabled="">
                                    </div>
                                </div>
                                <div>
                                    <hr />
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel-body">
                                            <table id="tbl_visualizar_anexos" style="font-size: 10px;" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style='width:2%;' class='center'>#</th>
                                                        <th style='width:12%;'>FECHA REGISTRO</th>
                                                        <th style='width:36%;' class='center'>NOMBRE O DESCRIPCION</th>
                                                        <th style='width:36%;' class='center'>TIPO ANEXOS</th>
                                                        <th style='width:5%;'><i class='fa fa-file-pdf-o' aria-hidden='true'></i></th>
                                                        <th style='width:5%;'><i class='fa fa-pencil-square' aria-hidden='true'></i></th>
                                                        <th style='width:5%;'><i class='fa fa-trash' aria-hidden='true'></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbodyPacientesAnexo" style="cursor: pointer"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <script>
                // $(document).ready(function() {
                //   visualizarPacienteAnexo();
                //   var table = $('#tbl_visualizar_Pacientes').DataTable();
                //   $('#tbl_visualizar_Pacientes tbody').on('click', 'tr', function() {
                //     var contrato = $(this).parent().find("td").eq(3).html();
                //     var documento = $(this).parent().find("td").eq(1).html();
                //     var nombre = $(this).parent().find("td").eq(2).html();
                //var evento = $(this).parent().find("td").eq(1).html();
                //      $("#txtDocumentoAnexo").val(documento);
                //      $("#txtNombrePacienteAnexo").val(nombre);
                //       $("#txtNumEvento").val(contrato);
                //        $("#mdlBuscarEmpleados").modal('hide');
                //        detalleAnexos(contrato);

                /*if ($(this).parents().hasClass('selected')) {
                   
                    $(this).removeClass('selected');
                    
                }else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }*/
                //  });
                // });
            </script>
            <style>
                .selected {
                    background-color: rgb(168, 204, 236) !important;
                }
            </style>
            <?php include "modal/index.php"; ?>
        </div>
        <?php
        include "../../webPage/plantilla/footer.php";
        ?>

    </div>
</body>

</html>