<?php
require_once '../../validaSession.php';
require_once '../../Modelo/Arl/MdlArl.php';
require_once '../../Modelo/Arl/Bean/ArlVO.php';
require_once '../../webPage/PHPJasperXML-master/tcpdf/tcpdf.php';
require_once '../../webPage/PHPJasperXML-master/PHPJasperXML.inc.php';

$op = addslashes(htmlspecialchars($_POST["op"]));
switch ($op) {
    case 1:
        listarTipoFondo();
        break;
    case 2:
        listarComboTipoDocumento();
        break;
    case 3:
        cuentacontable();
        break;
    case 4:
        registrarArl();
        break;
    case 5:
        visualizarArl();
        break;
    case 6:
        eliminarArl();
        break;
}

function listarTipoFondo()
{
    $mdlArl = new mdlArl();
    $statusJson = array();
    try {
        $tipoFondo = $mdlArl->listarTipoFondo();
        if (!empty($tipoFondo)) {
            $json = json_encode($tipoFondo);
            echo $json;
        } else {
            $statusJson["Mensaje"] = "No se encontraron registros.";
            echo json_encode($statusJson);
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarComboTipoDocumento()
{
    $mdlArl = new mdlArl();
    $statusJson = array();
    try {
        $listarTipoDocumento = $mdlArl->listarComboTipoDocumento();
        if (!empty($listarTipoDocumento)) {
            $json = json_encode($listarTipoDocumento);
            echo $json;
        } else {
            $statusJson["Mensaje"] = "No se encontraron registros.";
            echo json_encode($statusJson);
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function cuentacontable()
{
    $param = addslashes(htmlspecialchars($_POST["pat"]));
    $mdlArl = new mdlArl();
    try {
        $listaRegistro = $mdlArl->cuentacontable($param);
        if ($listaRegistro !== null) {
            $json = json_encode($listaRegistro);
            echo $json;
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function registrarArl()
{
    $mdlArl = new mdlArl();
    $codigo = addslashes(htmlspecialchars($_POST["codigo"]));
    $nombreArl = addslashes(htmlspecialchars($_POST["nombreArl"]));
    $tipoDocumentoArl = addslashes(htmlspecialchars($_POST["tipoDocumentoArl"]));
    $numDocumentoArl = addslashes(htmlspecialchars($_POST["numDocumentoArl"]));
    $codAdministradora = addslashes(htmlspecialchars($_POST["codAdministradora"]));
    $riesgoCero = addslashes(htmlspecialchars($_POST["riesgoCero"]));
    $riesgoUno = addslashes(htmlspecialchars($_POST["riesgoUno"]));
    $riesgoDos = addslashes(htmlspecialchars($_POST["riesgoDos"]));
    $riesgoTres = addslashes(htmlspecialchars($_POST["riesgoTres"]));
    $riesgoCuatro = addslashes(htmlspecialchars($_POST["riesgoCuatro"]));
    $riesgoCinco = addslashes(htmlspecialchars($_POST["riesgoCinco"]));
    $riesgoSeis = addslashes(htmlspecialchars($_POST["riesgoSeis"]));
    $riesgoSiete = addslashes(htmlspecialchars($_POST["riesgoSiete"]));
    /* $auxContableArl = addslashes(htmlspecialchars($_POST["auxContableArl"]));
    $auxFiscalArl = addslashes(htmlspecialchars($_POST["auxFiscalArl"]));
    $auxNormasArl = addslashes(htmlspecialchars($_POST["auxNormasArl"]));
    $fuenteContable = addslashes(htmlspecialchars($_POST["fuenteContable"]));*/
    $tipoFondo = addslashes(htmlspecialchars($_POST["tipoFondo"]));
    $estadoFondo = addslashes(htmlspecialchars($_POST["estadoFondo"]));
    $editar = addslashes(htmlspecialchars($_POST["editar"]));
    $idArl = addslashes(htmlspecialchars($_POST["idArl"]));

    $ArlVO = new ArlVO();
    $ArlVO->setCodigoArl($codigo);
    $ArlVO->setNombreArl($nombreArl);
    $ArlVO->setTipoDocumento($tipoDocumentoArl);
    $ArlVO->setNumDocumentoArl($numDocumentoArl);
    $ArlVO->setCodAdministradorArl($codAdministradora);
    $ArlVO->setRiesgoCero($riesgoCero);
    $ArlVO->setRiesgoUno($riesgoUno);
    $ArlVO->setRiesgoDos($riesgoDos);
    $ArlVO->setRiesgoTres($riesgoTres);
    $ArlVO->setRiesgoCuatro($riesgoCuatro);
    $ArlVO->setRiesgoCinco($riesgoCinco);
    $ArlVO->setRiesgoSeis($riesgoSeis);
    $ArlVO->setRiesgoSiete($riesgoSiete);
    /*$ArlVO->setAuxContableArl($auxContableArl);
    $ArlVO->setAuxFiscalArl($auxFiscalArl);
    $ArlVO->setAuxNormasArl($auxNormasArl);
    $ArlVO->setFuenteContable($fuenteContable);*/
    $ArlVO->setTipoFondo($tipoFondo);
    $ArlVO->setEstadoFondo($estadoFondo);
    $ArlVO->setIdArl($idArl);
    $statusJson = array();
    try {
        if ($editar == 1) {
            $parametrosArl = $mdlArl->actualizarArl($ArlVO);
            $msj =  "Fondo Actualizado correctamente";
        } else {
            $parametrosArl = $mdlArl->registrarArl($ArlVO);
            $msj =  "Fondo guardando correctamente";
        }

        if ($parametrosArl > 0) {
            $statusJson["success"] = $msj;
        } else {
            $statusJson["error"] = "El codigo ya se encentra creado";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function visualizarArl()
{
    $mdlArl = new mdlArl();
    $form = $_REQUEST;
    $paramet = $_POST["columns"];
    $dt_params = [
        "order" => $_POST["order"],
        "start" => $_POST["start"],
        "length" => $_POST["length"]
    ];
    try {
        $listarRegistros = $mdlArl->visualizarArl($form, $dt_params);
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

function eliminarArl()
{
    $mdlArl = new mdlArl();
    $idArl = addslashes(htmlspecialchars($_POST["arlEliminar"]));
    $ArlVO = new ArlVO();
    $ArlVO->setIdArl($idArl);
    try {
        $eliminarCargo = $mdlArl->eliminarArl($ArlVO);
        $msj = "Arl eliminada correctamente";
        if ($eliminarCargo > 0) {
            $statusJson["success"] = $msj;
        } else {
            $statusJson["error"] = "Error al momento de eliminar el registro";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
