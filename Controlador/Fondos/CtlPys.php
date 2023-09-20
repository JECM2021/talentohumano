<?php
require_once '../../validaSession.php';
require_once '../../Modelo/Fondos/MdlPys.php';
require_once '../../Modelo/Fondos/Bean/pysVO.php';
require_once '../../webPage/PHPJasperXML-master/tcpdf/tcpdf.php';
require_once '../../webPage/PHPJasperXML-master/PHPJasperXML.inc.php';

$op = addslashes(htmlspecialchars($_POST["op"]));
switch ($op) {
    case 1:
        ListarTipoFondo();
        break;
    case 2:
        listarcomboFondo();
        break;
    case 3:
        listarComboTipoDocumento();
        break;
    case 4:
        registrarfondo();
        break;
    case 5:
        listarComboTipoDocumentoEps();
        break;
    case 6:
        listarcomboFondoEps();
        break;
    case 7:
        registrarfondoEps();
        break;
    case 8:
        visualizarFondosPension();
        break;
    case 9:
        visualizarFondosEps();
        break;
    case 10:
        cuentacontable();
        break;
    case 11:
        eliminarDatosFondoPension();
        break;
    case 12:
        eliminarDatosFondoEps();
        break;
}

function ListarTipoFondo()
{
    $mdlFondos = new mdlFondos();
    $statusJson = array();
    try {
        $tipoFondos = $mdlFondos->ListarTipoFondo();
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

function listarcomboFondo()
{
    $mdlFondos = new mdlFondos();
    $statusJson = array();
    try {
        $listarComboFondo = $mdlFondos->listarcomboFondo();
        if (!empty($listarComboFondo)) {
            $json = json_encode($listarComboFondo);
            echo $json;
        } else {
            $statusJson["Mensaje"] = "No se encontraron registros.";
            echo json_encode($statusJson);
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarcomboFondoEps()
{
    $mdlFondos = new mdlFondos();
    $statusJson = array();
    try {
        $listarComboFondo = $mdlFondos->listarcomboFondoEps();
        if (!empty($listarComboFondo)) {
            $json = json_encode($listarComboFondo);
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
    $mdlFondos = new mdlFondos();
    $statusJson = array();
    try {
        $listarTipoDocumento = $mdlFondos->listarComboTipoDocumento();
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

function listarComboTipoDocumentoEps()
{
    $mdlFondos = new mdlFondos();
    $statusJson = array();
    try {
        $listarTipoDocumento = $mdlFondos->listarComboTipoDocumentoEps();
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

function registrarfondo()
{
    $mdlFondos = new mdlFondos();
    $fondoDe = addslashes(htmlspecialchars($_POST["fondoDe"]));
    $codigo = addslashes(htmlspecialchars($_POST["codigo"]));
    $nombre = addslashes(htmlspecialchars($_POST["nombre"]));
    $tipoDocumento = addslashes(htmlspecialchars($_POST["tipoDocumento"]));
    $numDocumento = addslashes(htmlspecialchars($_POST["numDocumento"]));
    $codAdmin = addslashes(htmlspecialchars($_POST["codAdmin"]));
    $porcPension = addslashes(htmlspecialchars($_POST["porcPension"]));
    /*$auxContablePension = addslashes(htmlspecialchars($_POST["auxContablePension"]));
    $auxFiscalPension = addslashes(htmlspecialchars($_POST["auxFiscalPension"]));
    $auxNormasPension = addslashes(htmlspecialchars($_POST["auxNormasPension"]));*/
    $porcFsp = addslashes(htmlspecialchars($_POST["porcFsp"]));
    /*$auxContableFsp = addslashes(htmlspecialchars($_POST["auxContableFsp"]));
    $auxFiscalFsp = addslashes(htmlspecialchars($_POST["auxFiscalFsp"]));
    $auxNormasFsp = addslashes(htmlspecialchars($_POST["auxNormasFsp"]));*/
    $porcEdu = addslashes(htmlspecialchars($_POST["porcEdu"]));
    /* $auxContableEdu = addslashes(htmlspecialchars($_POST["auxContableEdu"]));
    $auxFiscalEdu = addslashes(htmlspecialchars($_POST["auxFiscalEdu"]));
    $auxNormasEdu = addslashes(htmlspecialchars($_POST["auxNormasEdu"]));*/
    $tipoDeFondo = addslashes(htmlspecialchars($_POST["tipoDeFondo"]));
    $estadoFondo = addslashes(htmlspecialchars($_POST["estadoFondo"]));
    $editar = addslashes(htmlspecialchars($_POST["editar"]));
    $idFondo = addslashes(htmlspecialchars($_POST["idFondo"]));

    $FondosVO = new FondosVO();
    $FondosVO->setFondeDe($fondoDe);
    $FondosVO->setCodigo($codigo);
    $FondosVO->setNombreFondo($nombre);
    $FondosVO->setTipoDocumento($tipoDocumento);
    $FondosVO->setNumDocumento($numDocumento);
    $FondosVO->setCodAdministrador($codAdmin);
    $FondosVO->setPorcPension($porcPension);
    /*$FondosVO->setAuxContablePension($auxContablePension);
    $FondosVO->setAuxFiscalPension($auxFiscalPension);
    $FondosVO->setAuxNormasPension($auxNormasPension);*/
    $FondosVO->setPorcFsp($porcFsp);
    /* $FondosVO->setAuxContableFsp($auxContableFsp);
    $FondosVO->setauxFiscalFsp($auxFiscalFsp);
    $FondosVO->setAuxNormasFsp($auxNormasFsp);*/
    $FondosVO->setPorcEdu($porcEdu);
    /* $FondosVO->setAuxContableEdu($auxContableEdu);
    $FondosVO->setAuxFiscalEdu($auxFiscalEdu);
    $FondosVO->setAuxNormasEdu($auxNormasEdu);*/
    $FondosVO->setTipoFondo($tipoDeFondo);
    $FondosVO->setEstadoFondo($estadoFondo);
    $FondosVO->setIdFondo($idFondo);
    $statusJson = array();
    try {
        if ($editar == 1) {
            $parametrosFondo = $mdlFondos->actualizarfondo($FondosVO);
            $msj =  "Fondo de pension actualizado correctamente";
        } else {
            $parametrosFondo = $mdlFondos->registrarfondo($FondosVO);
            $msj =  "Fondo de pension guardando correctamente";
        }

        if ($parametrosFondo > 0) {
            $statusJson["success"] = $msj;
        } else {
            $statusJson["error"] = "El codigo ya se encentra creado";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function eliminarDatosFondoPension()
{
    $mdlFondos = new mdlFondos();
    $idFondo = addslashes(htmlspecialchars($_POST["elimPension"]));
    $FondosVO = new FondosVO();
    $FondosVO->setIdFondo($idFondo);
    try {
        $eliminarFondoPension = $mdlFondos->eliminarDatosFondoPension($FondosVO);
        $msj = "Fondo de Pension Eliminado Correctamente";
        if ($eliminarFondoPension > 0) {
            $statusJson["success"] = $msj;
        } else {
            $statusJson["error"] = "Error al momento de eliminar el registro";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function eliminarDatosFondoEps()
{
    $mdlFondos = new mdlFondos();
    $idFondoEps = addslashes(htmlspecialchars($_POST["elimeps"]));
    $FondosVO = new FondosVO();
    $FondosVO->setIdFondo($idFondoEps);
    try {
        $eliminarFondoEps = $mdlFondos->eliminarDatosFondoEps($FondosVO);
        $msj = "Fondo de salud Eliminado Correctamente";
        if ($eliminarFondoEps > 0) {
            $statusJson["success"] = $msj;
        } else {
            $statusJson["error"] = "Error al momento de eliminar el registro";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function registrarfondoEps()
{
    $mdlFondos = new mdlFondos();
    $fondoDe = addslashes(htmlspecialchars($_POST["fondoDe"]));
    $codigoEps = addslashes(htmlspecialchars($_POST["codigoEps"]));
    $nombreEps = addslashes(htmlspecialchars($_POST["nombreEps"]));
    $tipoDocumentoEps = addslashes(htmlspecialchars($_POST["tipoDocumentoEps"]));
    $numeroDocumentoEps = addslashes(htmlspecialchars($_POST["numeroDocumentoEps"]));
    $codAdminEps = addslashes(htmlspecialchars($_POST["codAdminEps"]));
    $porcSalud = addslashes(htmlspecialchars($_POST["porcSalud"]));
    /* $auxContableEps = addslashes(htmlspecialchars($_POST["auxContableEps"]));*/
    $tipoDeFondoEps = addslashes(htmlspecialchars($_POST["tipoDeFondoEps"]));
    $estadoFondoEps = addslashes(htmlspecialchars($_POST["estadoFondoEps"]));
    /* $auxFiscalEps = addslashes(htmlspecialchars($_POST["auxFiscalEps"]));
    $auxNormasEps = addslashes(htmlspecialchars($_POST["auxNormasEps"]));*/
    $editarEps = addslashes(htmlspecialchars($_POST["editarEps"]));
    $idFondoEps = addslashes(htmlspecialchars($_POST["idFondoEps"]));

    $FondosVO = new FondosVO();
    $FondosVO->setFondeDe($fondoDe);
    $FondosVO->setCodigo($codigoEps);
    $FondosVO->setNombreFondo($nombreEps);
    $FondosVO->setTipoDocumento($tipoDocumentoEps);
    $FondosVO->setNumDocumento($numeroDocumentoEps);
    $FondosVO->setCodAdministrador($codAdminEps);
    $FondosVO->setPorcSalud($porcSalud);
    /*$FondosVO->setAuxContableEps($auxContableEps);
    $FondosVO->setAuxFiscalEps($auxFiscalEps);
    $FondosVO->setAuxNormasEps($auxNormasEps);*/
    $FondosVO->setTipoFondo($tipoDeFondoEps);
    $FondosVO->setEstadoFondo($estadoFondoEps);
    $FondosVO->setIdFondo($idFondoEps);
    $statusJson = array();
    try {

        if ($editarEps == 1) {
            $parametrosFondo = $mdlFondos->actualizarfondoeps($FondosVO);
            $msj = "Fondo Actualizado Correctamente";
        } else {
            $parametrosFondo = $mdlFondos->registrarfondoEps($FondosVO);
            $msj = "Fondo Guardado Correctamente";
        }


        if ($parametrosFondo > 0) {
            $statusJson["success"] = $msj;
        } else {
            $statusJson["error"] = "El codigo ya se encentra creado";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}


function visualizarFondosPension()
{
    $mdlFondos = new mdlFondos();
    $form = $_REQUEST;
    $paramet = $_POST["columns"];
    $dt_params = [
        "order" => $_POST["order"],
        "start" => $_POST["start"],
        "length" => $_POST["length"]
    ];
    try {
        $listarRegistros = $mdlFondos->visualizarFondosPension($form, $dt_params);
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

function visualizarFondosEps()
{
    $mdlFondos = new mdlFondos();
    $form = $_REQUEST;
    $paramet = $_POST["columns"];
    $dt_params = [
        "order" => $_POST["order"],
        "start" => $_POST["start"],
        "length" => $_POST["length"]
    ];
    try {
        $listarRegistros = $mdlFondos->visualizarFondosEps($form, $dt_params);
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

function cuentacontable()
{
    $param = addslashes(htmlspecialchars($_POST["pat"]));
    $mdlFondos = new mdlFondos();
    try {
        $listaRegistro = $mdlFondos->cuentacontable($param);
        if ($listaRegistro !== null) {
            $json = json_encode($listaRegistro);
            echo $json;
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
