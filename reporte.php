<?php
include_once './validaSession.php';
?>
<html>
    <head>
        <title>SISV | Panel Principal</title>
        <?php
        include './webPage/imports/imports.php';
        ?>
        <script>
            var CONTROLLERPUBLIC = "./Controlador/CtlOperacionesPublics.php";
        </script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini"  >
        <div class="wrapper">
            <?php  include_once "webPage/plantilla/cabezote_principal.php";
        include_once "webPage/plantilla/lateral/menu_principal.php";?>           
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Reportes.
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href=""><i class="fa fa-dashboard"></i> Principal</a></li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <?php
                        include "webPage/plantilla/inicio/cajas_superiores.php";
                        ?>
                    </div>
                </section>
            </div>
            <?php
            include "webPage/plantilla/footer.php";
            ?>
            <div class="control-sidebar-bg"></div>
        </div>
    </body>
</html>
