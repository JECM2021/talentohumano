<?php
require_once '../../validaSession.php';
require_once '../../Modelo/Vacaciones/MdlVacaciones.php';
require_once '../../Modelo/Vacaciones/Bean/VacacionesVO.php';
require_once '../../webPage/PHPJasperXML-master/tcpdf/tcpdf.php';
require_once '../../webPage/PHPJasperXML-master/PHPJasperXML.inc.php';

$op = addslashes(htmlspecialchars($_POST["op"]));
switch ($op) {
    case 1:
        visualizarEmpleados();
        break;
    case 2:
        registrarNovedadVacaciones();
        break;
    case 3:
        obtenerHistorial();
        break;
    case 4:
        actualizarDatos();
        break;
}

function visualizarEmpleados()
{
    $statusJson = array();
    $mdlVacaciones = new mdlVacaciones();
    try {
        $listarEmpleados = $mdlVacaciones->visualizarEmpleados();
        //die(var_dump($listarEmpleados));
        if (!empty($listarEmpleados)) {
            $json = json_encode($listarEmpleados);
            echo $json;
        } else {
            $statusJson["Mensaje"] = "No se encontraron empleados disponibles";
            echo json_encode($statusJson);
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function registrarNovedadVacaciones()
{
    $mdlVacaciones = new mdlVacaciones();
    $idEmpleado = addslashes(htmlspecialchars($_POST["idEmpleado"]));
    $perven_inicio = addslashes(htmlspecialchars($_POST["perven_inicio"]));
    $perven_fin = addslashes(htmlspecialchars($_POST["perven_fin"]));
    $vac_inicio = addslashes(htmlspecialchars($_POST["vac_inicio"]));
    $vac_fin = addslashes(htmlspecialchars($_POST["vac_fin"]));
    $observaciones = addslashes(htmlspecialchars($_POST["observaciones"]));
    $idNovVac = addslashes(htmlspecialchars($_POST["idNovVac"]));
    $VacacionesVO = new VacacionesVO();
    $VacacionesVO->setIdEmpleado($idEmpleado);
    $VacacionesVO->setPerVenInicio($perven_inicio);
    $VacacionesVO->setPerVenFin($perven_fin);
    $VacacionesVO->setIniVac($vac_inicio);
    $VacacionesVO->setFinVac($vac_fin);
    $VacacionesVO->setObservaciones($observaciones);
    $VacacionesVO->setIdNovVacaciones($idNovVac);
    $statusJson = array();
    try {
        $parametrosVacaciones = $mdlVacaciones->registrarNovedadVacaciones($VacacionesVO);
        $msj = "Novedad Vacaciones Guardadas Correctamente";
        if ($parametrosVacaciones > 0) {
            $statusJson["success"] = $msj;
        } else if ($parametrosVacaciones == -1) {
            $statusJson["error"] = "error";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function obtenerHistorial()
{
    $idVac = addslashes(htmlspecialchars($_POST["idVac"]));
    try {
        $mdlVacaciones = new mdlVacaciones();
        $listaHistorial = $mdlVacaciones->obtenerHistorial($idVac);
        echo json_encode($listaHistorial);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function actualizarDatos()
{
    $mdlVacaciones = new mdlVacaciones();
    $idVacacionesDetAct = addslashes(htmlspecialchars($_POST["idVacacionesDetAct"]));
    $fechaPerVenDesdeAct = addslashes(htmlspecialchars($_POST["fechaPerVenDesdeAct"]));
    $fechaPerVenHastaAct = addslashes(htmlspecialchars($_POST["fechaPerVenHastaAct"]));
    $fechaIncVacacionesAct = addslashes(htmlspecialchars($_POST["fechaIncVacacionesAct"]));
    $fechaFinVacacionesAct = addslashes(htmlspecialchars($_POST["fechaFinVacacionesAct"]));
    $observacionesAct = addslashes(htmlspecialchars($_POST["observacionesAct"]));
    $estadoAct = addslashes(htmlspecialchars($_POST["estadoAct"]));
    $VacacionesVO = new VacacionesVO();
    $VacacionesVO->setIdVacacionesDetalle($idVacacionesDetAct);
    $VacacionesVO->setPerVenInicio($fechaPerVenDesdeAct);
    $VacacionesVO->setPerVenFin($fechaPerVenHastaAct);
    $VacacionesVO->setIniVac($fechaIncVacacionesAct);
    $VacacionesVO->setFinVac($fechaFinVacacionesAct);
    $VacacionesVO->setObservaciones($observacionesAct);
    $VacacionesVO->setEstadoVacaciones($estadoAct);
    $statusJson = array();
    try {
        $listarDatos = $mdlVacaciones->actualizarDatos($VacacionesVO);
        if ($listarDatos > 0) {
            $statusJson["success"] = "Datos actualizados correctamente.";
        } else {
            $statusJson["error"] = "Error al intentar ejecutar la peticion.";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
