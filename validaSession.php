<?php

//   =========  ESTO DEBE CONVERTIRSE EN UN OBJETO     ==== AROBLES  =========   
session_start();
if (isset($_SESSION['user_name'])) {
    $nombreUsuario = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "";
    $usuId = isset($_SESSION['usu_id']) ? $_SESSION['usu_id'] : "";
    $usuPerfil = isset($_SESSION['usu_perfil']) ? $_SESSION['usu_perfil'] : "";
    $usuUsuario = isset($_SESSION['usuUsuario']) ?  $_SESSION['usuUsuario'] : "";
    $empEmpresa = isset($_SESSION['empEmpresa']) ? $_SESSION['empEmpresa'] : "";
    $listaMenu = isset($_SESSION['listaMenu']) ? $_SESSION['listaMenu'] : "";
    $lisMenReport = isset($_SESSION['lisMenReport']) ? $_SESSION['lisMenReport'] : "";
    $lisMenPagReport = isset($_SESSION['lisMenPagReport']) ? $_SESSION['lisMenPagReport'] : "";
    $operacionesUsuario = isset($_SESSION['operacionesUsuario']) ? $_SESSION['operacionesUsuario'] : "";
  //  $tercero = isset($_SESSION['tercero']) ? $_SESSION['tercero'] : "";
    $empresa = isset($_SESSION['cod_empresa']) ? $_SESSION['cod_empresa'] : "";
    $logo = isset($_SESSION['logoEmpresa']) ? $_SESSION['logoEmpresa'] : "";
    $validate = isset($_SESSION['validate']) ? $_SESSION['validate'] : "";
    
} else {
    header("Location: /nomina/login");
}
