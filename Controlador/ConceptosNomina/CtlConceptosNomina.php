<?php
require_once '../../validaSession.php';
require_once '../../Modelo/ConceptosNomina/MdlConceptosNomina.php';
require_once '../../Modelo/ConceptosNomina/Bean/ConceptosNominaVO.php';
require_once '../../webPage/PHPJasperXML-master/tcpdf/tcpdf.php';
require_once '../../webPage/PHPJasperXML-master/PHPJasperXML.inc.php';

$op = addslashes(htmlspecialchars($_POST["op"]));
switch ($op) {
    case 1:
        listarTipoConcepto();
        break;
    case 2:
        registrarConceptoNomina();
        break;
    case 3:
        visualizarConceptosNomina();
        break;
    case 4:
        actualizarConcepto();
        break;
}

function listarTipoConcepto()
{
    $mdlConceptosNomina = new MdlConceptosNomina();
    try {
        $listarTipoConcepto = $mdlConceptosNomina->listarTipoConcepto();
        if ($listarTipoConcepto !== null) {
            $json = json_encode($listarTipoConcepto);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function registrarConceptoNomina()
{
    $mdlConceptosNomina = new MdlConceptosNomina();
    $codigo = addslashes(htmlspecialchars($_POST["codigo"]));
    $tipoConceptos = addslashes(htmlspecialchars($_POST["tipoConceptos"]));
    $descripcion = addslashes(htmlspecialchars($_POST["descripcion"]));
    $estado = addslashes(htmlspecialchars($_POST["estado"]));

    $ConceptosNominaVO = new ConceptosNominaVO();
    $ConceptosNominaVO->setCodigo($codigo);
    $ConceptosNominaVO->setTipoConceptos($tipoConceptos);
    $ConceptosNominaVO->setDescripcion($descripcion);
    $ConceptosNominaVO->setEstado($estado);

    $statusJson = array();
    try {
        $parametros = $mdlConceptosNomina->registrarConceptoNomina($ConceptosNominaVO);
        if ($parametros > 0) {
            $statusJson["success"] = "Cargo realizado correctamente.";
        } else {
            $statusJson["error"] = "Error al intentar ejecutar la peticion<br>";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function visualizarConceptosNomina()
{
    $mdlConceptosNomina = new MdlConceptosNomina();
    $form = $_REQUEST;
    $paramet = $_POST["columns"];
    $dt_params = [
        "order" => $_POST["order"],
        "start" => $_POST["start"],
        "length" => $_POST["length"]
    ];
    try {
        $listarRegistros = $mdlConceptosNomina->visualizarConceptosNomina($form, $dt_params);
        //die(var_dump($listarRegistros));
        if ($listarRegistros !== null) {
            $json = $listarRegistros;
            echo $json;
        } else {
            echo "lista vacia";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function actualizarConcepto()
{
    $mdlConceptosNomina = new MdlConceptosNomina();
    $concepto_id = addslashes(htmlspecialchars($_POST["concepId"]));
    $codigo = addslashes(htmlspecialchars($_POST["codigo"]));
    $tipoConceptos = addslashes(htmlspecialchars($_POST["tipoConceptos"]));
    $nombre = addslashes(htmlspecialchars($_POST["nombre"]));
    $estado = addslashes(htmlspecialchars($_POST["estado"]));

    $ConceptosNominaVO = new ConceptosNominaVO();
    $ConceptosNominaVO->setConceptoId($concepto_id);
    $ConceptosNominaVO->setCodigo($codigo);
    $ConceptosNominaVO->setTipoConceptos($tipoConceptos);
    $ConceptosNominaVO->setDescripcion($nombre);
    $ConceptosNominaVO->setEstado($estado);

    try {
        $respuesta = $mdlConceptosNomina->actualizarConcepto($ConceptosNominaVO);
        if ($respuesta > 0) {
            $statusJson["success"] = "Concepto actualizado correctamente.";
        } else {
            $statusJson["error"] = "Error al intentar ejecutar la peticion.";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
