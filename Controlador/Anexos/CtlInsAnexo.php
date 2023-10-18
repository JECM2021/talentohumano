<?php

require_once '../../validaSession.php';
require_once '../../Modelo/Anexos/MdlInsAnexos.php';
require_once '../../Modelo/Contrato/Bean/ContratoVO.php';
$op = addslashes(htmlspecialchars($_POST["op"]));
switch ($op) {

    case 1:
        visualizarEmpleados();
        break;
    case 2:
        listarTipoAnexo();
        break;
    case 3:
        registrarAnexo();
        break;
}

function visualizarEmpleados()
{
    $statusJson = array();
    $mdlInsAnexo = new mdlInsAnexo();
    try {
        $listarEmpleados = $mdlInsAnexo->visualizarEmpleados();
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

function listarTipoAnexo()
{
    $mdlInsAnexo = new mdlInsAnexo();
    try {
        $listarTipoAnexo = $mdlInsAnexo->listarTipoAnexo();
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

function registrarAnexo()
{
    $mdlInsAnexo = new mdlInsAnexo();
    $idEmpleado = addslashes(htmlspecialchars($_POST["txtIdEmpleado"]));
    $idContrato = addslashes(htmlspecialchars($_POST["txtIdContrato"]));
    $tipoAnexo = addslashes(htmlspecialchars($_POST["cmbTipoAnexo"]));
    $nombreAnexo = addslashes(htmlspecialchars($_POST["txtNombreAnexo"]));
    $descripcionAnexo = addslashes(htmlspecialchars($_POST["txtDetalle"]));
    $fechaCaducidad = addslashes(htmlspecialchars($_POST["txtFechaDeCaducidad"]));
    $target_dir = "../../webPage/anexos/";
    $target_file = $target_dir . basename($_FILES["archivo"]["name"]);
    $statusJson = array();

    try {
        $referer = $_SERVER['HTTP_REFERER'];
        if (!empty($_FILES["archivo"]["name"])) {
            $check = getimagesize($_FILES["archivo"]["tmp_name"]);
            $nombreAnexo = $_FILES['archivo']['name'];
            $tamano = $_FILES['archivo']['size'];
            $ruta = $_FILES['archivo']['tmp_name'];
            $destino = "../../webPage/anexos/" . $nombreAnexo;
            if ($nombreAnexo != "") {
                if (copy($ruta, $destino)) {
                    $parametros = $mdlInsAnexo->registrarAnexos($nombreAnexo, $descripcionAnexo, $tamano, $destino, $fechaCaducidad, $tipoAnexo, $idEmpleado, $idContrato);
                    if ($parametros > 0) {
                        $statusJson["success"] = "<span>El Archivo se Guardo Correctamente</span>";
                    } else {
                        $statusJson["success"] = "Error en la Ejecucion de la Consulta";
                    }
                }
            }
        } else {
            $statusJson["error"] = "<label>No existe imagen.</label>";
        }
        echo '<script>alert("El Archivo se Guardo Correctamente");  window.history.back();</script>';
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
