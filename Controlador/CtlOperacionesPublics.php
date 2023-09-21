<?php

require_once '/../Modelo/Seguridad/Bean/UsuariosVO.php';
require_once '../validaSession.php';
require_once '../Modelo/MdlClinica.php';
include_once "../Vistas/funciones.php";
$mdlPacientes = new MdlClinica();
$op = addslashes(htmlspecialchars($_POST["op"]));
switch ($op) {
    case 7:
        loguerarUsuario();
        break;

    case 55:
        logueraEmpresas();
        break;
    case 60:
        contratosvencer();
        break;
}

function loguerarUsuario()
{
    global $mdlPacientes;
    $usuarios = addslashes(htmlspecialchars($_POST["usu"]));
    $contrasena = addslashes(htmlspecialchars($_POST["con"]));
    $empresa = addslashes(htmlspecialchars($_POST["empresa"]));

    $contraseyaEncriptada = claves($contrasena);
    $usuarioVO = new UsuariosVO();
    $usuarioVO->setUsuusuario($usuarios);
    $usuarioVO->setContrasena($contraseyaEncriptada);
    $usuarioVO->setEmpresa($empresa);
    // die(var_dump($empresa));
    try {

        $usuariosVO = $mdlPacientes->loguearUsuario($usuarioVO);
        $empresaVO = $mdlPacientes->obtenerConfiguracionEmpresa($usuariosVO->getIdUsuario());
        session_start();
        //die(var_dump($empresaVO));
        if ($usuariosVO !== null) {
            //$lo =explode( '../../', $usuariosVO->getLogo());
            $_SESSION['user_name'] = $usuariosVO->getNombreUsuario();
            $_SESSION['usu_id'] = $usuariosVO->getIdUsuario();
            $_SESSION['usu_perfil'] = $usuariosVO->getIdPeril();
            //$_SESSION['tercero'] = $usuariosVO->getTerId();
            $_SESSION['usuUsuario'] = $usuariosVO->getUsuusuario();
            $_SESSION['empEmpresa'] = $empresaVO;
            /*$_SESSION['cod_empresa'] = $empresaVO ;
            /*$_SESSION['cod_empresa'] = $empresa;*/
            $listaMenu = $mdlPacientes->obtenerMenu($usuariosVO);
            $listMenuReporte = $mdlPacientes->visualizarMenuReportes($usuariosVO);
            $listMenuPagReporte = $mdlPacientes->visualizarPaginasReportes($usuariosVO);
            $operacionesUsuario = $mdlPacientes->operacionesUsuario($usuariosVO);
            $_SESSION['listaMenu'] = $listaMenu;
            $_SESSION['lisMenReport'] = $listMenuReporte;
            $_SESSION['lisMenPagReport'] = $listMenuPagReporte;
            $_SESSION['operacionesUsuario'] = $operacionesUsuario;
            $_SESSION['validate'] = true;
            $_SESSION['invalido'] = "";
            header("Location: /talentohumano/Principal");
        } else {
            $_SESSION['invalido'] = "Usuario o contraseña incorrecta. Por favor verifique.";
            header("Location: /talentohumano/login");
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function cambiarContrasenaUsuario()
{
    $contrasenaAnterior = addslashes(htmlspecialchars($_POST["contraActual"]));
    $contrasenanNueva = addslashes(htmlspecialchars($_POST["contrasenaNueva"]));
    $contraActual = claves($contrasenaAnterior);
    $contraNueva = claves($contrasenanNueva);
    global $usuUsuario;
    global $mdlPacientes;
    $statusJson = array();
    try {
        $rsDatosusuario = $mdlPacientes->verificarUsuario($usuUsuario, $contraActual);
        if ($rsDatosusuario !== NULL) {
            $rsActualizacion = $mdlPacientes->actualizarContrasena($usuUsuario, $contraNueva);
            if ($rsActualizacion > 0) {
                $statusJson["success"] = "Contraseña cambiada correctamente.";
            }
        } else {
            $statusJson["mensaje"] = "La contraseña actual es incorrecta, por favor intente de nuevo.";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
function obtenerConsecutivo()
{
    global $mdlPacientes;
    $tipoConsecutivo = addslashes(htmlspecialchars($_POST["tipoConsecutivo"]));

    try {
        $listaRegistro = $mdlPacientes->obtenerConsecutivoDocumento($tipoConsecutivo);
        if ($listaRegistro !== null) {
            $json = json_encode($listaRegistro);
            echo $json;
        } else {
            echo "Lista vacia";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function logueraEmpresas()
{
    global $mdlPacientes;
    $baseDatos = addslashes(htmlspecialchars($_POST["bd"]));
    $idEmpresa = addslashes(htmlspecialchars($_POST["idEmpresa"]));
    try {
        global $mdlPacientes;
        //die(var_dump($baseDatos,$idEmpresa));
        session_start();
        $_SESSION['bd'] = $baseDatos;
        $_SESSION['cod_empresa'] = $idEmpresa;

        $usuario = $_SESSION['usu_id'];
        //$tercero = $mdlPacientes->optenertercero($usuario);
        //$_SESSION['tercero'] = $tercero[0]['TER_ID'];
        //die(var_dump($_SESSION));
        header("Location: /talentohumano/index");
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function contratosvencer()
{
    global $mdlPacientes;
    try {
        $listadocontratovencer = $mdlPacientes->contratosvencer();
        //die(var_dump($listadocontratovencer));
        if (!empty($listadocontratovencer)) {
            $json = json_encode($listadocontratovencer);
            echo $json;
        } else {
            echo 0;
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
