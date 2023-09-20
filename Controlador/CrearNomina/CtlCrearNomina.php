<?php
require_once '../../validaSession.php';
require_once '../../Modelo/CrearNomina/MdlCrearNomina.php';
require_once '../../Modelo/CrearNomina/Bean/CrearNominaVO.php';
require_once '../../webPage/PHPJasperXML-master/tcpdf/tcpdf.php';
require_once '../../webPage/PHPJasperXML-master/PHPJasperXML.inc.php';

//$op = addslashes(htmlspecialchars($_POST["op"]));
$op = filter_input(INPUT_POST, 'op', FILTER_DEFAULT);
$isDefinidida = isset($op) ? true : false;  // indica si la variable esta definida o no;
if ($isDefinidida) {
    switch ($op) {
        case 1:
            visualizarDetalleEmpleado();
            break;
        case 2:
            listarTipoLiquidacionNomina();
            break;
        case 3:
            listarMesesdelano();
            break;
        case 4:
            registrarNomina();
            break;
        case 5:
            generPdfNomina();
            break;
        case 6:
            novedadesNomina();
            break;
    }
}


function visualizarDetalleEmpleado()
{
    $mdlCrearNomina = new mdlCrearNomina();
    $statusJson = array();
    try {
        $listarCrearNomina = $mdlCrearNomina->visualizarDetalleEmpleado();
        //die(var_dump($listarCrearNomina));
        if (!empty($listarCrearNomina)) {
            $json = json_encode($listarCrearNomina);
            echo $json;
        } else {
            $statusJson["Mensaje"] = "Error de parametros";
            echo json_encode($statusJson);
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarTipoLiquidacionNomina()
{
    $mdlCrearNomina = new mdlCrearNomina();
    try {
        $listarTipoLiquidacionNomina = $mdlCrearNomina->listarTipoLiquidacionNomina();
        if ($listarTipoLiquidacionNomina !== null) {
            $json = json_encode($listarTipoLiquidacionNomina);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarMesesdelano()
{
    $mdlCrearNomina = new mdlCrearNomina();
    try {
        $listarMesesdelano = $mdlCrearNomina->listarMesesdelano();
        if ($listarMesesdelano !== null) {
            $json = json_encode($listarMesesdelano);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function registrarNomina()
{
    $tipoLiquidacion = addslashes(htmlspecialchars($_POST["tipoLiquidacion"]));
    $descripcion = addslashes(htmlspecialchars($_POST["descripcion"]));
    $mes = addslashes(htmlspecialchars($_POST["mes"]));
    $year = addslashes(htmlspecialchars($_POST["year"]));
    $listadoNomina = json_decode(filter_input(INPUT_POST, 'listado', FILTER_DEFAULT));
    die(var_dump($listadoNomina));
    $mdlCrearNomina = new mdlCrearNomina();
    $CrearNominaVO = new CrearNominaVO();
    $CrearNominaVO->setTipoLiquidacion($tipoLiquidacion);
    $CrearNominaVO->setDescripcion($descripcion);
    $CrearNominaVO->setMes($mes);
    $CrearNominaVO->setYear($year);
    $CrearNominaVO->setListadoNomina($listadoNomina);

    $statusJson = array();

    try {
        $parametrosNomina = $mdlCrearNomina->registrarNomina($CrearNominaVO);
        if ($parametrosNomina > 0) {
            $statusJson["success"] = "Liquidacion realiada";
            $statusJson["data"] =  $parametrosNomina;
        } else {
            $statusJson["error"] = "Error al intentar ejecutar la peticion";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function generPdfNomina()
{
    $idNomina = addslashes(htmlspecialchars($_POST["idNomina"]));
    $mdlCrearNomina = new mdlCrearNomina();
    try {
        $credenciales = $mdlCrearNomina->obtenerCredencialesBd();
        if (count($credenciales) > 0) {
            $xml = simplexml_load_file("../../Vistas/CrearNomina/Reports/compago.jrxml");

            $PHPJasperXML = new PHPJasperXML();
            // $PHPJasperXML->AddPage();
            $PHPJasperXML->debugsql = false;
            $PHPJasperXML->arrayParameter = array("idp" => $idNomina);
            $PHPJasperXML->xml_dismantle($xml);
            $PHPJasperXML->transferDBtoArray($credenciales['host'], $credenciales['usuario'], $credenciales['pass'], $credenciales['BD']);
            $PHPJasperXML->outpage("I");
        } else {
            echo 'Problemas al cargar la configuracion.';
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function novedadesNomina()
{
    $mdlCrearNomina = new mdlCrearNomina();
    $statusJson = array();

    try {
        $listarNovedadNomina = $mdlCrearNomina->novedadesNomina();
        if (!empty($listarNovedadNomina)) {
            $statusJson["data"] = $listarNovedadNomina;
        } else {
            $statusJson["Mensaje"] = "No se encontraron registros";
            echo json_encode($statusJson);
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
