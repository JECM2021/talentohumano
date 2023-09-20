<?php
require_once '../../validaSession.php';
require_once '../../Modelo/Parafiscales/MdlParafiscales.php';
require_once '../../Modelo/Parafiscales/Bean/ParafiscalesVO.php';
require_once '../../webPage/PHPJasperXML-master/tcpdf/tcpdf.php';
require_once '../../webPage/PHPJasperXML-master/PHPJasperXML.inc.php';

$op = addslashes(htmlspecialchars($_POST["op"]));
switch ($op) {
    case 1:
        cuentacontable();
        break;
    case 2:
        ListarTipoFondo();
        break;
    case 3:
        registrarParafiscal();
        break;
    case 4:
        visualizarParaf();
        break;
    case 5:
        eliminarParafiscal();
        break;
}

function cuentacontable()
{
    $param = addslashes(htmlspecialchars($_POST["pat"]));
    $mdlParafiscales = new MdlParafiscales();
    try {
        $listaRegistro = $mdlParafiscales->cuentacontable($param);
        if ($listaRegistro !== null) {
            $json = json_encode($listaRegistro);
            echo $json;
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function ListarTipoFondo()
{
    $mdlParafiscales = new MdlParafiscales();
    $statusJson = array();
    try {
        $tipoFondos = $mdlParafiscales->ListarTipoFondo();
        if (!empty($tipoFondos)) {
            $json = json_encode($tipoFondos);
            echo $json;
        } else {
            $statusJson["Mensaje"] = "No se encontraron registros.";
            echo json_encode($statusJson);
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function registrarParafiscal()
{
    $mdlParafiscales = new MdlParafiscales();
    $codigo = addslashes(htmlspecialchars($_POST["codigo"]));
    $idParafiscal = addslashes(htmlspecialchars($_POST["idParafiscal"]));
    $editar = addslashes(htmlspecialchars($_POST["editar"]));
    $nombreParafiscal = addslashes(htmlspecialchars($_POST["nombreParafiscal"]));
    $porcSubfam = addslashes(htmlspecialchars($_POST["porcSubfam"]));
    /*$auxContableSubfam = addslashes(htmlspecialchars($_POST["auxContableSubfam"]));
    $auxFicalSubfam = addslashes(htmlspecialchars($_POST["auxFicalSubfam"]));
    $auxNormasSubfam = addslashes(htmlspecialchars($_POST["auxNormasSubfam"]));*/
    $nitSubfam = addslashes(htmlspecialchars($_POST["nitSubfam"]));
    $codAdminSubfam = addslashes(htmlspecialchars($_POST["codAdminSubfam"]));
    $porcIcbf = addslashes(htmlspecialchars($_POST["porcIcbf"]));
    /*$auxContableIcbf = addslashes(htmlspecialchars($_POST["auxContableIcbf"]));
    $auxFiscalIcbf = addslashes(htmlspecialchars($_POST["auxFiscalIcbf"]));
    $auxNormasIcbf = addslashes(htmlspecialchars($_POST["auxNormasIcbf"]));*/
    $nitIcbf = addslashes(htmlspecialchars($_POST["nitIcbf"]));
    $codAdminIcbf = addslashes(htmlspecialchars($_POST["codAdminIcbf"]));
    $porcSena = addslashes(htmlspecialchars($_POST["porcSena"]));
    /*$auxcontableSena = addslashes(htmlspecialchars($_POST["auxcontableSena"]));
    $auxFiscalSena = addslashes(htmlspecialchars($_POST["auxFiscalSena"]));
    $auxNormasSena = addslashes(htmlspecialchars($_POST["auxNormasSena"]));*/
    $nitSena = addslashes(htmlspecialchars($_POST["nitSena"]));
    $codAdminSena = addslashes(htmlspecialchars($_POST["codAdminSena"]));
    $tipoFondo = addslashes(htmlspecialchars($_POST["tipoFondo"]));
    $estadoFondo = addslashes(htmlspecialchars($_POST["estadoFondo"]));
    $ParafiscalesVO = new ParafiscalesVO();
    $ParafiscalesVO->setCodigoParafiscal($codigo);
    $ParafiscalesVO->setIdParafiscal($idParafiscal);
    $ParafiscalesVO->setNombreParafiscal($nombreParafiscal);
    $ParafiscalesVO->setSubfam($porcSubfam);
    /*$ParafiscalesVO->setAuxContableSubfam($auxContableSubfam);
    $ParafiscalesVO->setAuxFiscalSubfam($auxFicalSubfam);
    $ParafiscalesVO->setAuxNormasSubfam($auxNormasSubfam);*/
    $ParafiscalesVO->setNitSubfam($nitSubfam);
    $ParafiscalesVO->setCodAdminSubfam($codAdminSubfam);
    $ParafiscalesVO->setIcbf($porcIcbf);
    /* $ParafiscalesVO->setAuxContableIcbf($auxContableIcbf);
    $ParafiscalesVO->setAuxFiscalIcbf($auxFiscalIcbf);
    $ParafiscalesVO->setAuxNormasIcbf($auxNormasIcbf);*/
    $ParafiscalesVO->setNitIcbf($nitIcbf);
    $ParafiscalesVO->setCodAdminIcbf($codAdminIcbf);
    $ParafiscalesVO->setSena($porcSena);
    /*$ParafiscalesVO->setAuxContableSena($auxcontableSena);
    $ParafiscalesVO->setAuxFiscalSena($auxFiscalSena);
    $ParafiscalesVO->setAuxNormasSena($auxNormasSena);*/
    $ParafiscalesVO->setNitSena($nitSena);
    $ParafiscalesVO->setCodAdminSena($codAdminSena);
    $ParafiscalesVO->setTipoFondo($tipoFondo);
    $ParafiscalesVO->setEstadoFondo($estadoFondo);
    $statusJson = array();
    try {
        if ($editar == 1) {
            $parametrosPfiscal = $mdlParafiscales->actualizarParafical($ParafiscalesVO);
            $msj = "Actualizado Correctamente";
        } else {
            $parametrosPfiscal = $mdlParafiscales->registrarParafiscal($ParafiscalesVO);
            $msj =  "Guardando correctamente";
        }

        if ($parametrosPfiscal > 0) {
            $statusJson["success"] = $msj;
        } else {
            $statusJson["error"] = "El codigo ya se encentra creado";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function visualizarParaf()
{
    $mdlParafiscales = new MdlParafiscales();
    $form = $_REQUEST;
    $paramet = $_POST["columns"];
    $dt_params = [
        "order" => $_POST["order"],
        "start" => $_POST["start"],
        "length" => $_POST["length"]
    ];
    try {
        $listarRegistros = $mdlParafiscales->visualizarParaf($form, $dt_params);
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

function eliminarParafiscal()
{
    $mdlParafiscales = new MdlParafiscales();
    $idParaf = addslashes(htmlspecialchars($_POST["parfe"]));
    $ParafiscalesVO = new ParafiscalesVO();
    $ParafiscalesVO->setIdParafiscal($idParaf);
    try {
        $eliminarParaf = $mdlParafiscales->eliminarParafiscal($ParafiscalesVO);
        $msj = "El fondo parafiscal fue eliminado correctamente";

        if ($eliminarParaf > 0) {
            $statusJson["success"] = $msj;
        } else {
            $statusJson["error"] = "Error al momento de eliminar el registro";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
