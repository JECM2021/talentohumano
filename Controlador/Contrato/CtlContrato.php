<?php
require_once '../../validaSession.php';
require_once '../../Modelo/Contrato/MdlContrato.php';
require_once '../../Modelo/Contrato/Bean/ContratoVO.php';
require_once '../../webPage/PHPJasperXML-master/tcpdf/tcpdf.php';
require_once '../../webPage/PHPJasperXML-master/PHPJasperXML.inc.php';

$op = addslashes(htmlspecialchars($_POST["op"]));
switch ($op) {
    case 1:
        visualizarEmpleados();
        break;
    case 2:
        listarTipoDocumento();
        break;
    case 3:
        listarCargos();
        break;
    case 4:
        listarTipoContrato();
        break;
    case 5:
        listarMotivoRetiro();
        break;
    case 6:
        listarFormaDePago();
        break;
    case 7:
        listarTipoCotizante();
        break;
    case 8:
        listarArl();
        break;
    case 9:
        listarArl();
        break;
    case 10:
        listarCajaCompensacion();
        break;
    case 11:
        listarFonCesantia();
        break;
    case 12:
        ciudadDondeLabora();
        break;
    case 13:
        listarFondoSalud();
        break;
    case 14:
        listarFondoPension();
        break;
    case 15:
        listarBancos();
        break;
    case 16:
        listarTipoDeCuenta();
        break;
    case 17:
        listarCentroDeCosto();
        break;
    case 18:
        asignarContrato();
        break;
    case 19:
        // actualizarContrato();
        break;
    case 20:
        listarTipoAnexo();
        break;
    case 21:
        listarAreaTrabajo();
        break;
    case 22:
        listarParentesco();
        break;
}

function visualizarEmpleados()
{
    $statusJson = array();
    $mdlEmpleado = new mdlContrato();
    try {
        $listarEmpleados = $mdlEmpleado->visualizarEmpleados();
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

function listarTipoDocumento()
{
    $mdlContrato = new mdlContrato();
    try {
        $listarTipoDocumento = $mdlContrato->listarTipoDocumento();
        //die(var_dump($listarTipoDocumento));
        if ($listarTipoDocumento !== null) {
            $json = json_encode($listarTipoDocumento);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarCargos()
{
    $mdlContrato = new mdlContrato();
    try {
        $listarCargos =  $mdlContrato->listarCargos();
        //die(var_dump($listarCargos));
        if ($listarCargos !== null) {
            $json = json_encode($listarCargos);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarTipoContrato()
{
    $mdlContrato = new mdlContrato();
    try {
        $listarTipoContrato =  $mdlContrato->listarTipoContrato();
        if ($listarTipoContrato !== null) {
            $json = json_encode($listarTipoContrato);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarMotivoRetiro()
{
    $mdlContrato = new mdlContrato();
    try {
        $listarMotivoRetiro =  $mdlContrato->listarMotivoRetiro();
        if ($listarMotivoRetiro !== null) {
            $json = json_encode($listarMotivoRetiro);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarFormaDePago()
{
    $mdlContrato = new mdlContrato();
    try {
        $listarFormaDePago =  $mdlContrato->listarFormaDePago();
        if ($listarFormaDePago !== null) {
            $json = json_encode($listarFormaDePago);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarTipoCotizante()
{
    $mdlContrato = new mdlContrato();
    try {
        $listarTipoCotizante =  $mdlContrato->listarTipoCotizante();
        if ($listarTipoCotizante !== null) {
            $json = json_encode($listarTipoCotizante);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarArl()
{
    $mdlContrato = new mdlContrato();
    try {
        $listarCombo =  $mdlContrato->listarArl();
        if ($listarCombo !== null) {
            $json = json_encode($listarCombo);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarCajaCompensacion()
{
    $mdlContrato = new mdlContrato();
    try {
        $listarCombo =  $mdlContrato->listarCajaCompensacion();
        if ($listarCombo !== null) {
            $json = json_encode($listarCombo);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarFonCesantia()
{
    $mdlContrato = new mdlContrato();
    try {
        $listarCombo =  $mdlContrato->listarFonCesantia();
        if ($listarCombo !== null) {
            $json = json_encode($listarCombo);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
function ciudadDondeLabora()
{
    $mdlContrato = new mdlContrato();
    try {
        $listarCombo =  $mdlContrato->ciudadDondeLabora();
        if ($listarCombo !== null) {
            $json = json_encode($listarCombo);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarFondoSalud()
{
    $mdlContrato = new mdlContrato();
    try {
        $listarCombo =  $mdlContrato->listarFondoSalud();
        if ($listarCombo !== null) {
            $json = json_encode($listarCombo);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarFondoPension()
{
    $mdlContrato = new mdlContrato();
    try {
        $listarCombo =  $mdlContrato->listarFondoPension();
        if ($listarCombo !== null) {
            $json = json_encode($listarCombo);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarBancos()
{
    $mdlContrato = new mdlContrato();
    try {
        $listarCombo =  $mdlContrato->listarBancos();
        if ($listarCombo !== null) {
            $json = json_encode($listarCombo);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarTipoDeCuenta()
{
    $mdlContrato = new mdlContrato();
    try {
        $listarCombo =  $mdlContrato->listarTipoDeCuenta();
        if ($listarCombo !== null) {
            $json = json_encode($listarCombo);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarCentroDeCosto()
{
    $mdlContrato = new mdlContrato();
    try {
        $listarCombo =  $mdlContrato->listarCentroDeCosto();
        if ($listarCombo !== null) {
            $json = json_encode($listarCombo);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function asignarContrato()
{
    $mdlContrato = new mdlContrato();
    $idEmpleado = addslashes(htmlspecialchars($_POST["idEmpleado"]));
    $numContrato = addslashes(htmlspecialchars($_POST["numContrato"]));
    $tipoContrato = addslashes(htmlspecialchars($_POST["tipoContrato"]));
    $cargos = addslashes(htmlspecialchars($_POST["cargos"]));
    $fechaInicioContrato = addslashes(htmlspecialchars($_POST["fechaInicioContrato"]));
    $fechaCulminacionContrato = addslashes(htmlspecialchars($_POST["fechaCulminacionContrato"]));
    $motivoRetiro = addslashes(htmlspecialchars($_POST["motivoRetiro"]));
    $salarioTotal = addslashes(htmlspecialchars($_POST["salarioTotal"]));
    $salarioDia = addslashes(htmlspecialchars($_POST["salarioDia"]));
    $formaPago = addslashes(htmlspecialchars($_POST["formaPago"]));
    $tipoCotizante = addslashes(htmlspecialchars($_POST["tipoCotizante"]));
    $arl = addslashes(htmlspecialchars($_POST["arl"]));
    $porcentajeArl = addslashes(htmlspecialchars($_POST["porcentajeArl"]));
    $cajaCompensacion = addslashes(htmlspecialchars($_POST["cajaCompensacion"]));
    $fondoCesantias = addslashes(htmlspecialchars($_POST["fondoCesantias"]));
    $centroCosto = addslashes(htmlspecialchars($_POST["centroCosto"]));
    $ciudad = addslashes(htmlspecialchars($_POST["ciudad"]));
    $fondoSalud = addslashes(htmlspecialchars($_POST["fondoSalud"]));
    $porcentajeSalud = addslashes(htmlspecialchars($_POST["porcentajeSalud"]));
    $fechaInicioSalud = addslashes(htmlspecialchars($_POST["fechaInicioSalud"]));
    $fondoPension = addslashes(htmlspecialchars($_POST["fondoPension"]));
    $porcentajePension = addslashes(htmlspecialchars($_POST["porcentajePension"]));
    $fechaInicioPension = addslashes(htmlspecialchars($_POST["fechaInicioPension"]));
    $bancos = addslashes(htmlspecialchars($_POST["bancos"]));
    $tipoCuetaBanco = addslashes(htmlspecialchars($_POST["tipoCuetaBanco"]));
    $numeroCuentaBanco = addslashes(htmlspecialchars($_POST["numeroCuentaBanco"]));
    $editar = addslashes(htmlspecialchars($_POST["editar"]));
    $areaTrabajo = addslashes(htmlspecialchars($_POST["areaTrabajo"]));
    $primNombre = addslashes(htmlspecialchars($_POST["primNombre"]));
    $segNombre = addslashes(htmlspecialchars($_POST["segNombre"]));
    $primApellido = addslashes(htmlspecialchars($_POST["primApellido"]));
    $segApellido = addslashes(htmlspecialchars($_POST["segApellido"]));
    $celularAcomp = addslashes(htmlspecialchars($_POST["celularAcomp"]));
    $fijoAcomp = addslashes(htmlspecialchars($_POST["fijoAcomp"]));
    $parentesco = addslashes(htmlspecialchars($_POST["parentesco"]));

    $ContratoVO = new ContratoVO();
    $ContratoVO->setIdEmpleado($idEmpleado);
    $ContratoVO->setNumContrato($numContrato);
    $ContratoVO->setTipoContrato($tipoContrato);
    $ContratoVO->setCargos($cargos);
    $ContratoVO->setFechaInicioContrato($fechaInicioContrato);
    $ContratoVO->setFechaCulminacionContrato($fechaCulminacionContrato);
    $ContratoVO->setMotivoRetiro($motivoRetiro);
    $ContratoVO->setSalarioTotal($salarioTotal);
    $ContratoVO->setSalarioDia($salarioDia);
    $ContratoVO->setFormaPago($formaPago);
    $ContratoVO->setTipoCotizante($tipoCotizante);
    $ContratoVO->setArl($arl);
    $ContratoVO->setPorcentajeArl($porcentajeArl);
    $ContratoVO->setCajaCompensacion($cajaCompensacion);
    $ContratoVO->setFondoCesantias($fondoCesantias);
    $ContratoVO->setCentroCosto($centroCosto);
    $ContratoVO->setCiudad($ciudad);
    $ContratoVO->setFondoSalud($fondoSalud);
    $ContratoVO->setPorcentajeSalud($porcentajeSalud);
    $ContratoVO->setFechaInicioSalud($fechaInicioSalud);
    $ContratoVO->setFondoPension($fondoPension);
    $ContratoVO->setPorcentajePension($porcentajePension);
    $ContratoVO->setFechaInicioPension($fechaInicioPension);
    $ContratoVO->setBancos($bancos);
    $ContratoVO->setTipoCuentaBanco($tipoCuetaBanco);
    $ContratoVO->setNumeroCuentaBanco($numeroCuentaBanco);
    $ContratoVO->setAreaTrabajo($areaTrabajo);
    $ContratoVO->setPrimerNombre($primNombre);
    $ContratoVO->setSegundoNombre($segNombre);
    $ContratoVO->setPrimerApellido($primApellido);
    $ContratoVO->setSegundoApellido($segApellido);
    $ContratoVO->setCelular($celularAcomp);
    $ContratoVO->setFijo($fijoAcomp);
    $ContratoVO->setParentesco($parentesco);
    $statusJson = array();
    try {
        if ($editar == 1) {
            $parametrosContrato = $mdlContrato->actualizarContrato($ContratoVO);

            $msj = "Contrato Actualizado Correctamente";
        } else {
            $parametrosContrato = $mdlContrato->asignarContrato($ContratoVO);
            $msj = "Contrato Asignado Correctamente";
        }
        if ($parametrosContrato > 0) {
            $statusJson["success"] = $msj;
        } else if ($parametrosContrato == -1) {
            $statusJson["error"] = "El Empleado ya Cuenta con un contrato";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}


function listarTipoAnexo()
{
    $mdlContrato = new mdlContrato();
    try {
        $listarTipoAnexo = $mdlContrato->listarTipoAnexo();
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

function listarAreaTrabajo()
{
    $mdlContrato = new mdlContrato();
    try {
        $listarAreaTrabajo = $mdlContrato->listarAreaTrabajo();
        //die(var_dump($listarTipoDocumento));
        if ($listarAreaTrabajo !== null) {
            $json = json_encode($listarAreaTrabajo);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarParentesco()
{
    $mdlContrato = new mdlContrato();
    try {
        $listarParentesco = $mdlContrato->listarParentesco();
        //die(var_dump($listarTipoDocumento));
        if ($listarParentesco !== null) {
            $json = json_encode($listarParentesco);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
