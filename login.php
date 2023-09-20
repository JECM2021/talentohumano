<!DOCTYPE html>
<?php
require_once './Modelo/MdlClinica.php';
$mdlClinica = new mdlClinica();
?>
<html lang="en" class="no-js">

<head>
    <meta charset="utf-8">
    <title>Ingreso al Sistema</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="webPage/plantilla/login/css/reset.css?v=<?php echo (rand()); ?>">
    <link rel="stylesheet" href="webPage/plantilla/login/css/login.css?v=<?php echo (rand()); ?>">
    <!--<link rel="stylesheet" href="webPage/plantilla/login/css/supersized.css?v=<?php echo (rand()); ?>">
       <link rel="stylesheet" href="webPage/plantilla/login/css/style.css?v=<?php echo (rand()); ?>">-->
    <link rel="stylesheet" href="webPage/plantilla/toastr/css/toastr.css">
    <link rel="stylesheet" href="webPage/plantilla/toastr/css/toastr.min.css">
    <!--<link rel="stylesheet" href="webPage/plantilla/toastr/css/themes/semantic.css">-->
    <script src="webPage/plantilla/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="webPage/plantilla/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="webPage/plantilla/toastr/js/toastr.min.js"></script>

    <?php
    session_start();
    $mensaje = isset($_SESSION['invalido']) ? $_SESSION['invalido'] : "";
    ?>
    <script>
        $(document).ready(function() {
            var mensaje = '<?php echo ($mensaje) ?>';
            if (mensaje !== "") {
                toastr.options = {
                    "positionClass": "toast-bottom-right",
                    "timeOut": "900",
                }
                toastr.error("<strong><label>" + mensaje + "</label></strong>");;
            }
        });
    </script>

</head>

<body>
    <div class="loginBox">
        <h2>Iniciar Sesion</h2>
        <form method="post" action="controlador/CtlOperacionesPublics">
            <input type="hidden" name="op" id="op" value="7">
            <p>Usuario</p>
            <input type="text" autocomplete="off" placeholder="Usuario" class="username" name="usu" id="usu">
            <p>Contraseña</p>
            <input type="password" class="password" name="con" id="con" placeholder="Contraseña">
            <?php
            $arrayEmpresas = $mdlClinica->listarComboEmpresa();
            ?>
            <!--<select class="empresa" <?php echo count($arrayEmpresas) === 1 ? "hidden" : "" ?> name="empresa">
                <?php
                foreach ($arrayEmpresas as $empresas) {
                ?>
                    <option value="<?php echo $empresas['codigo'] ?>"><?php echo $empresas['empresa'] ?></option>
                <?php
                }
                ?>
            </select>-->
            <input type="submit" name="btnIngresar" id="btnIngresar" value="Ingresar" class="">
        </form>

    </div>
    <script src="webPage/plantilla/login/js/jquery-1.8.2.min.js?v=<?php echo (rand()); ?>"></script>
    <script src="webPage/plantilla/login/js/supersized.3.2.7.min.js?v=<?php echo (rand()); ?>"></script>
    <!--<script src="webPage/plantilla/login/js/supersized-init.js?v=<?php echo (rand()); ?>"></script>-->
    <script src="webPage/plantilla/login/js/scripts.js?v=<?php echo (rand()); ?>"></script>
</body>

</html>