<?php
include_once './validaSession.php';
$empresa = $_SESSION['empEmpresa'];
?>
<html>

<head>
    <title>SISV | Panel Principal</title>

    <script>
        var CONTROLLERPUBLIC = "./Controlador/CtlOperacionesPublics.php";
    </script>
    <link href="webpage/plantilla/css/estiloPrincipal.css" rel="stylesheet" />
    <link rel="stylesheet" href="/talentohumano/webPage/plantilla/assets/bower_components/font-awesome/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    </script>

</head>

<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">IntegralSoft.</a>

        <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">

                    <div class="dropdown-divider"></div>
                    <a href="../talentohumano/php_cerrar.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar sesión</a>
                </div>
            </li>
        </ul>
    </nav>
    <br>
    <br>
    <div id="layoutSidenav">

    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Empresas</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"></li>
                </ol>
                <div class="row">
                    <?php
                    foreach ($empresa as $rsEmpresa) {
                        $dat = explode('../../', $rsEmpresa['LOGO']);
                        //echo  $dat[1];
                    ?>
                        <div class="col-md-3">
                            <form method="post" action="controlador/CtlOperacionesPublics">
                                <input type="hidden" name="op" id="op" value="55">
                                <input type="hidden" name="bd" id="bd" value="<?= $rsEmpresa['BD'] ?>">
                                <input type="hidden" name="idEmpresa" id="idEmpresa" value="<?= $rsEmpresa['ID'] ?>">
                                <div class="card test" style="width:18rem;">
                                    <img style="height: 144px;" class="card-img-top" src="<?= $dat[1] ?>" alt="Card Image Cap">
                                    <div class="card-body">
                                        <br>
                                        <input type="submit" name="btnIngresar" id="btnIngresar" value="Ingresar" class="btn btn-success btn-block">
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </main>
    </div>
</body>

</html>