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
  <script src="./webPage/js/cron.js?v=<?php echo (rand()); ?>"></script>
  <style>
    .adbn-wrap {
      display: none;
      justify-content: center;
      position: fixed;
      top: 0;
      bottom: 0;
      right: 0;
      left: 0;
      height: 100%;
      width: 100%;
      background: rgb(217 217 217/30%);
      backdrop-filter: blur(2px);
      z-index: 999;
    }

    .adbn-wrap div {
      align-self: center;
      width: 36vw;
      background: #078bf0;
      padding: 30px 20px;
      text-align: left;
      border-radius: 0 0 10px 10px;
      box-shadow: 0 35px 20px -20px #ababab;
      color: #fff;
      border-top: 2px solid #ff8d00;
      animation: .5s ease-out popupanim;
    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include_once "webPage/plantilla/cabezote_principal.php";
    include_once "webPage/plantilla/lateral/menu_principal.php"; ?>
    <div class="content-wrapper">
      <section class="content">
        <div class="container">
          <div class="panel panel-default">
            <div class="panel-heading"></div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-5">
                  <img src="webpage/imagenes/menu.png" style="width: 90%;">
                </div><br>
                <div class="col-md-6" align="left">
                  <h2 style="text-align: justify;">
                    Sistema de información <strong>INTEGRAL SOFT</strong> , es una plataforma desarrollada a
                    la medida para el cliente final que integra los Servicios de una IPS, tales como
                    Asistenciales, Contabilidad, Glosa, Facturación y Nomina Electrónica.</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <div class="adbn-wrap" style="display: flex;">
      <div id="pokeList">
        <h2 style="text-align: center;">Empleados Proximos a vencer contrato</h2><br><br>
        <ul>
        </ul>
      </div>
    </div>
    <?php
    include "webPage/plantilla/footer.php";
    ?>
    <div class="control-sidebar-bg"></div>
  </div>
</body>

</html>