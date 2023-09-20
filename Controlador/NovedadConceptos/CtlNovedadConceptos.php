<?php
require_once '../../validaSession.php';
require_once '../../Modelo/NovedadConceptos/MdlNovedadConceptos.php';
require_once '../../Modelo/NovedadConceptos/Bean/novedadConceptosVO.php';
require_once '../../webPage/PHPJasperXML-master/tcpdf/tcpdf.php';
require_once '../../webPage/PHPJasperXML-master/PHPJasperXML.inc.php';

$op = addslashes(htmlspecialchars($_POST["op"]));
switch ($op) {
    case 1:
        listarConceptoNomina();
        break;
    case 2:
        visualizarEmpleados();
        break;
    case 3:
        registrarNovedades();
        break;
    case 4:
        listarComboMes();
        break;
}

function listarConceptoNomina()
{
    $mdlNovedadConceptos = new mdlNovedadConceptos();

    try {
        $listarConceptoNomina = $mdlNovedadConceptos->listarConceptoNomina();
        if ($listarConceptoNomina !== null) {
            $json = json_encode($listarConceptoNomina);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function visualizarEmpleados()
{
    $mdlNovedadConceptos = new mdlNovedadConceptos();
    try {
        $listarEmpleados = $mdlNovedadConceptos->visualizarEmpleados();
        if (!empty($listarEmpleados)) {
            $json = json_encode($listarEmpleados);
            echo $json;
        } else {
            $statusJson["Mensaje"] = "Error de parametros";
            echo json_encode($statusJson);
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarComboMes()
{
    $mdlNovedadConceptos = new mdlNovedadConceptos();

    try {
        $listarConceptoMes = $mdlNovedadConceptos->listarComboMes();
        if ($listarConceptoMes !== null) {
            $json = json_encode($listarConceptoMes);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}


function registrarNovedades()
{
    $ConceptoId = addslashes(htmlspecialchars($_POST["ConceptoId"]));
    $tipoconcepId = addslashes(htmlspecialchars($_POST['tipoconcepId']));
    $mesConcepto = addslashes(htmlspecialchars($_POST["mesConcepto"]));
    $listadoNovedades = json_decode(filter_input(INPUT_POST, 'listado', FILTER_DEFAULT));
    //die(var_dump($ConceptoId, $tipoconcepId));
    $mdlNovedadConceptos = new mdlNovedadConceptos();
    $novedadConceptosVO = new novedadConceptosVO();
    $novedadConceptosVO->setTipoConcepto($ConceptoId);
    $novedadConceptosVO->setTipoConceptoId($tipoconcepId);
    $novedadConceptosVO->setMesConcepto($mesConcepto);
    $novedadConceptosVO->setListadoNovedades($listadoNovedades);
    $statusJson = array();

    try {
        $parametrosNovedades = $mdlNovedadConceptos->registrarNovedades($novedadConceptosVO);
        if ($parametrosNovedades > 0) {
            $statusJson["success"] = "Novedades Guardadas Correctamente";
            $statusJson["data"] =  $parametrosNovedades;
        } else {
            $statusJson["error"] = "Error al intentar ejecutar la peticion";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}






/*function listarCabeceraNovedades()
{
     $mdlNovedadConceptos = new mdlNovedadConceptos();
    $statusJson = array();
    try {
        $listarNovedadConceptos = $mdlNovedadConceptos->listarCabeceraNovedades();
        if (!empty($listarNovedadConceptos)) {
            $json = json_encode($listarNovedadConceptos);
            echo $json;
        } else {
            $statusJson["Mensaje"] = "Error de parametros";
            echo json_encode($statusJson);
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
    $mdlNovedadConceptos = new mdlNovedadConceptos();
    $statusJson = array();
    try {
        $listarNovedadConceptos = $mdlNovedadConceptos->listarCabeceraNovedades();
        if (!empty($listarNovedadConceptos)) {
            // $json = json_encode($listarNovedadConceptos);
            $statusJson["data1"] = $listarNovedadConceptos;
        }
        if ($listarNovedadConceptos != null) {
            $novDetalle = $mdlNovedadConceptos->listarNovedadDetalle();
            if (!empty($novDetalle)) {
                $statusJson["data2"] = $novDetalle;
            } else {
                $statusJson["Mensaje"] = "No se encontraron registro";
                echo json_encode($statusJson);
            }
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function registrarNovedades()
{
    $listadoNovedades = json_decode(filter_input(INPUT_POST, 'listado', FILTER_DEFAULT));
    $mdlNovedadConceptos = new mdlNovedadConceptos();
    $novedadConceptosVO = new novedadConceptosVO();

    $novedadConceptosVO->setListadoNovedades($listadoNovedades);
    die(var_dump($novedadConceptosVO));
    $statusJson = array();

    try {
        $parametrosNovedades = $mdlNovedadConceptos->registrarNovedades($novedadConceptosVO);
        if ($parametrosNovedades > 0) {
            $statusJson["success"] = "Novedades Guardadas Correctamente";
            $statusJson["data"] = $parametrosNovedades;
        } else {
            $statusJson["error"] = "Error al intentar ejecutar la peticion";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}*/
