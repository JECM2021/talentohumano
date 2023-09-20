<?php
require_once '../../validaSession.php';
require_once '../../Modelo/Cargos/MdlCargos.php';
require_once '../../Modelo/Cargos/Bean/CargosVO.php';
$mdlCargos = new mdlCargos();
$op = addslashes(htmlspecialchars($_POST["op"]));
switch ($op) {
    case 1:
        registrarcargo();
        break;
    case 2:
        visualizarCargos();
        break;
    case 3:
        actualizarCargos();
        break;
}

function registrarcargo()
{
    global $mdlCargos;
    $codigo = addslashes(htmlspecialchars($_POST["codigo"]));
    $descripcion = addslashes(htmlspecialchars($_POST["descripcion"]));
    $fechaCreacion = addslashes(htmlspecialchars($_POST["fechaCreacion"]));
    $estado = addslashes(htmlspecialchars($_POST["estado"]));
    $CargosVO = new CargosVO();
    $CargosVO->setCodigo($codigo);
    $CargosVO->setNombreCargo($descripcion);
    $CargosVO->setFechaCreacion($fechaCreacion);
    $CargosVO->setEstadoCargo($estado);
    $statusJson = array();
    try {
        $parametrosCargos = $mdlCargos->registrarcargo($CargosVO);
        if ($parametrosCargos > 0) {
            $statusJson["success"] = "Cargo realizado correctamente.";
        } else {
            $statusJson["error"] = "Error al intentar ejecutar la peticion<br>";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function actualizarCargos()
{
    global $mdlCargos;
    $cargo_id = addslashes(htmlspecialchars($_POST["cargo"]));
    $codigo = addslashes(htmlspecialchars($_POST["codigo"]));
    $descripcion = addslashes(htmlspecialchars($_POST["descripcion"]));
    $fecha = addslashes(htmlspecialchars($_POST["fecha"]));
    $estado = addslashes(htmlspecialchars($_POST["estado"]));
    $statusJson = array();
    $CargosVO = new CargosVO();
    $CargosVO->setCargoId($cargo_id);
    $CargosVO->setCodigo($codigo);
    $CargosVO->setNombreCargo($descripcion);
    $CargosVO->setFechaCreacion($fecha);
    $CargosVO->setEstadoCargo($estado);
    try {
        $respuesta = $mdlCargos->actualizarCargos($CargosVO);
        if ($respuesta > 0) {
            $statusJson["success"] = "Cargo actualizado correctamente.";
        } else {
            $statusJson["error"] = "Error al intentar ejecutar la peticion.";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function visualizarCargos()
{
    global $mdlCargos;
    $form = $_REQUEST;
    $paramet = $_POST["columns"];
    $dt_params = [
        "order" => $_POST["order"],
        "start" => $_POST["start"],
        "length" => $_POST["length"]
    ];
    try {
        $listarRegistros = $mdlCargos->visualizarCargos($form, $dt_params);
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
