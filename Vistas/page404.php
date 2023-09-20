
<?php
include_once '../validaSession.php';
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SISV | Admisiones</title>
        <?php
        include '../webPage/imports/imports.php';
        ?>
    </head>
    <body class="skin-blue sidebar-mini" >
        <div class="wrapper">
            <?php
            include_once "../webPage/plantilla/cabezote_principal.php";
            include_once "../webPage/plantilla/lateral/menu_principal.php";
            ?>
            <div class="content-wrapper" >
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-body">
                                    <div class="alert alert-danger">
                                        <center><label> La pagina que intenta ejecutar se encuentra en mantenimiento, por favor comuniquese con el administrador del sistemas.</label></center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php
            include "../webPage/plantilla/footer.php";
            ?>
        </div>
    </body>
</html>
