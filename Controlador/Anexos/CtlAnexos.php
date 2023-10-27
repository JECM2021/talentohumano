<?php

require_once '../../validaSession.php';
require_once '../../Modelo/Anexos/MdlAnexos.php';
$op = addslashes(htmlspecialchars($_POST["op"]));
switch ($op) {

    case 2:
        visualizarPacienteAnexo();
        break;
    case 3:
        visualizarAnexos();
        break;
    case 4:
        actualizarDatosAnexos();
        break;
    case 5:
        eliminarAnexo();
        break;
    case 6:
        listarTipoAnexo();
        break;
}

function visualizarPacienteAnexo()
{
    $mdlAnexos = new MdlAnexos();
    $form = $_REQUEST;
    $paramet = $_POST["columns"];
    $dt_params = [
        "order" => $_POST["order"],
        "start" => $_POST["start"],
        "length" => $_POST["length"]
    ];
    try {

        $listaRegistro = $mdlAnexos->visualizarPacientesAnexos($form);
        if ($listaRegistro !== null) {
            $json = $listaRegistro;
            echo $json;
        } else {
            echo "Lista vacia";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
function visualizarAnexos()
{
    $contrato = addslashes(htmlspecialchars($_POST["contrato"]));
    $mdlAnexos = new MdlAnexos();
    try {
        $listarRegistro = $mdlAnexos->detalleAnexos($contrato);
        if ($listarRegistro !== null) {
            $json = json_encode($listarRegistro);
            echo $json;
        } else {
            echo "lista vacia";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
function actualizarDatosAnexos()
{
    $idAnexo = addslashes(htmlspecialchars($_POST["idAnexo"]));
    $fechaEditada = addslashes(htmlspecialchars($_POST["fechaEditada"]));
    $tipoAnexoEditado = addslashes(htmlspecialchars($_POST["tipoAnexoEditado"]));
    $DetalleEditado = addslashes(htmlspecialchars($_POST["DetalleEditado"]));
    $fechacadEdi = addslashes(htmlspecialchars($_POST["fechacadEdi"]));
    $mdlAnexos = new MdlAnexos();
    $statusJson = array();
    $parametros = $mdlAnexos->actualizarDatosAnexos($idAnexo, $fechaEditada, $fechacadEdi, $tipoAnexoEditado, $DetalleEditado);
    if ($parametros > 0) {
        $statusJson["success"] = "<label>Los datos del anexo han sido actualizado.</label>";
        $statusJson["data"] = $parametros;
    } else {
        $statusJson["error"] = "<label>Error al intentar ejecutar la peticion</label>";
    }
    echo json_encode($statusJson);
}

function eliminarAnexo()
{

    $idAnexo = addslashes(htmlspecialchars($_POST["idAnexo"]));
    $statusJson = array();
    $mdlAnexos = new MdlAnexos();
    try {
        $parametros = $mdlAnexos->eliminarAnexo($idAnexo);
        if ($parametros > 0) {
            $statusJson["success"] = "<label>El anexo ha sido eliminado.</label>";
            $statusJson["data"] = $parametros;
        } else {
            $statusJson["error"] = "<label>Error al intentar ejecutar la peticion</label>";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarTipoAnexo()
{
    $mdlAnexos = new MdlAnexos();
    try {
        $listarTipoAnexo = $mdlAnexos->listarTipoAnexo();
        //die(var_dump($listarTipoDocumento));
        if ($listarTipoAnexo !== null) {
            $json = json_encode($listarTipoAnexo);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
