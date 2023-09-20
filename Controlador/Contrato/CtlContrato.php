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
        actualizarContrato();
        break;
    case 20:
        listarTipoAnexo();
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
    //die(var_dump($_POST));
    $mdlContrato = new mdlContrato();
    $idEmpleado = addslashes(htmlspecialchars($_POST["txtIdEmpleado"]));
    $numContrato = addslashes(htmlspecialchars($_POST["txtNumContrato"]));
    $tipoContrato = addslashes(htmlspecialchars($_POST["cmbTipoContrato"]));
    $cargos = addslashes(htmlspecialchars($_POST["cmbTipoCargo"]));
    $fechaInicioContrato = addslashes(htmlspecialchars($_POST["txtFechaDeInicio"]));
    $fechaCulminacionContrato = addslashes(htmlspecialchars($_POST["txtFechaDeTerminacion"]));
    $motivoRetiro = addslashes(htmlspecialchars($_POST["cmbMotivoRetiro"]));
    $salarioTotal = addslashes(htmlspecialchars($_POST["txtSalarioActual"]));
    $salarioDia = addslashes(htmlspecialchars($_POST["txtSalarioActualDiario"]));
    $formaPago = addslashes(htmlspecialchars($_POST["cmbFormaDePago"]));
    $tipoCotizante = addslashes(htmlspecialchars($_POST["cmbTipoDeCotizante"]));
    $arl = addslashes(htmlspecialchars($_POST["cmbArl"]));
    $porcentajeArl = addslashes(htmlspecialchars($_POST["txtPorcentajeArl"]));
    $cajaCompensacion = addslashes(htmlspecialchars($_POST["cmbCajaDeCompensacion"]));
    $fondoCesantias = addslashes(htmlspecialchars($_POST["cmbFondoCesantias"]));
    $centroCosto = addslashes(htmlspecialchars($_POST["cmbCentroDeCosto"]));
    $fechaInicioVacaciones = addslashes(htmlspecialchars($_POST["txtFechaDeInicioVacaciones"]));
    $fechaFinVacaciones = addslashes(htmlspecialchars($_POST["txtFechaFinDeVacaciones"]));
    $ciudad = addslashes(htmlspecialchars($_POST["cmbCiudadDondeLabora"]));
    $fondoSalud = addslashes(htmlspecialchars($_POST["cmbFondoDeSalud"]));
    $porcentajeSalud = addslashes(htmlspecialchars($_POST["txtPorcentajeSalud"]));
    $fechaInicioSalud = addslashes(htmlspecialchars($_POST["txtFechaInicioSalud"]));
    $fondoPension = addslashes(htmlspecialchars($_POST["cmbFondoDePension"]));
    $porcentajePension = addslashes(htmlspecialchars($_POST["txtPorcentajePension"]));
    $fechaInicioPension = addslashes(htmlspecialchars($_POST["txtFechaInicioPension"]));
    $bancos = addslashes(htmlspecialchars($_POST["cmbBancos"]));
    $tipoCuetaBanco = addslashes(htmlspecialchars($_POST["cmbTipoCuentaBancaria"]));
    $numeroCuentaBanco = addslashes(htmlspecialchars($_POST["txtNumCuenta"]));
    $tipoAnexo = addslashes(htmlspecialchars($_POST["cmbTipoAnexo"]));
    $nombreAnexo = addslashes(htmlspecialchars($_POST["txtNombreAnexo"]));
    $descripcionAnexo = addslashes(htmlspecialchars($_POST["txtDetalle"]));
    $idContrato = addslashes(htmlspecialchars($_POST["txtIdContrato"]));
    $editar = addslashes(htmlspecialchars($_POST["txtEditar"]));
    $target_dir = "../../webPage/anexos/";
    $target_file = $target_dir . basename($_FILES["archivo"]["name"]);
    $referer = $_SERVER['HTTP_REFERER'];
    if (!empty($_FILES["archivo"]["name"])) {
        $check = getimagesize($_FILES["archivo"]["tmp_name"]);
        $nombreAnexo = $_FILES['archivo']['name'];
        $tamano = $_FILES['archivo']['size'];
        $ruta = $_FILES['archivo']['tmp_name'];
        $destino = "../../webPage/anexos/" . $nombreAnexo;
        echo "ingreso";
    }
    //die(var_dump($_FILES["archivo"], "fdf"));
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
    $ContratoVO->setFechaInicioVacaciones($fechaInicioVacaciones);
    $ContratoVO->setFechaFinVacaciones($fechaFinVacaciones);
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
    $ContratoVO->setIdContrato($idContrato);
    //die(var_dump($editar));
    $statusJson = array();
    try {
        if ($editar == 1) {
            if (copy($ruta, $destino)) {
                $actualizarContrato = $mdlContrato->actualizarContrato($ContratoVO, $nombreAnexo, $descripcionAnexo, $tamano, $destino, $tipoAnexo);
                if ($actualizarContrato > 0) {
                    $statusJson["success"] = "<span>contrato actualizado correctamente.</span>";
                } else {
                    $statusJson["error"] = "<span>Error al intentar ejecutar la peticion.</span>";
                }
                echo '<script>alert("Contrato Actualizado Correctamente");  window.history.back();</script>';
                // echo json_encode($statusJson);
            } else {
                $actualizarContrato = $mdlContrato->actualizarContrato($ContratoVO, $nombreAnexo, $descripcionAnexo, $tamano, $destino, $tipoAnexo);
                if ($actualizarContrato > 0) {
                    $statusJson["success"] = "<span>contrato actualizado correctamente.</span>";
                } else {
                    $statusJson["error"] = "<span>Error al intentar ejecutar la peticion.</span>";
                }
                echo '<script>alert("Contrato Actualizado Correctamente");  window.history.back();</script>';
                // echo json_encode($statusJson);
            }
        } else {
            if (copy($ruta, $destino)) {
                $parametrosContrato = $mdlContrato->asignarContrato($ContratoVO, $nombreAnexo, $descripcionAnexo, $tamano, $destino, $tipoAnexo);
                $msj = "<span>Contrato Asignado Correctamente</span>";
                if ($parametrosContrato > 0) {
                    $statusJson["success"] = $msj;
                } else if ($parametrosContrato == -1) {
                    $statusJson["error"] = "<span>El Empleado ya Cuenta con un contrato</span>";
                }
                echo '<script>alert("Contrato Asignado Correctamente");  window.history.back();</script>';
                //echo json_encode($statusJson);
            } else {
                $parametrosContrato = $mdlContrato->asignarContrato($ContratoVO, $nombreAnexo, $descripcionAnexo, $tamano, $destino, $tipoAnexo);
                $msj = "<span>Contrato Asignado Correctamente</span>";
                if ($parametrosContrato > 0) {
                    $statusJson["success"] = $msj;
                } else if ($parametrosContrato == -1) {
                    $statusJson["error"] = "<span>El Empleado ya Cuenta con un contrato</span>";
                }
                echo '<script>alert("Contrato Asignado Correctamente");  window.history.back();</script>';
                //echo json_encode($statusJson);
            }
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

/*function actualizarContrato()
{
    $mdlContrato = new mdlContrato();
    $idEmpleado = addslashes(htmlspecialchars($_POST["txtIdEmpleado"]));
    $numContrato = addslashes(htmlspecialchars($_POST["txtNumContrato"]));
    $tipoContrato = addslashes(htmlspecialchars($_POST["cmbTipoContrato"]));
    $cargos = addslashes(htmlspecialchars($_POST["cmbTipoCargo"]));
    $fechaInicioContrato = addslashes(htmlspecialchars($_POST["txtFechaDeInicio"]));
    $fechaCulminacionContrato = addslashes(htmlspecialchars($_POST["txtFechaDeTerminacion"]));
    $motivoRetiro = addslashes(htmlspecialchars($_POST["cmbMotivoRetiro"]));
    $salarioTotal = addslashes(htmlspecialchars($_POST["txtSalarioActual"]));
    $salarioDia = addslashes(htmlspecialchars($_POST["txtSalarioActualDiario"]));
    $formaPago = addslashes(htmlspecialchars($_POST["cmbFormaDePago"]));
    $tipoCotizante = addslashes(htmlspecialchars($_POST["cmbTipoDeCotizante"]));
    $arl = addslashes(htmlspecialchars($_POST["cmbArl"]));
    $porcentajeArl = addslashes(htmlspecialchars($_POST["txtPorcentajeArl"]));
    $cajaCompensacion = addslashes(htmlspecialchars($_POST["cmbCajaDeCompensacion"]));
    $fondoCesantias = addslashes(htmlspecialchars($_POST["cmbFondoCesantias"]));
    $centroCosto = addslashes(htmlspecialchars($_POST["cmbCentroDeCosto"]));
    $fechaInicioVacaciones = addslashes(htmlspecialchars($_POST["txtFechaDeInicioVacaciones"]));
    $fechaFinVacaciones = addslashes(htmlspecialchars($_POST["txtFechaFinDeVacaciones"]));
    $ciudad = addslashes(htmlspecialchars($_POST["cmbCiudadDondeLabora"]));
    $fondoSalud = addslashes(htmlspecialchars($_POST["cmbFondoDeSalud"]));
    $porcentajeSalud = addslashes(htmlspecialchars($_POST["txtPorcentajeSalud"]));
    $fechaInicioSalud = addslashes(htmlspecialchars($_POST["txtFechaInicioSalud"]));
    $fondoPension = addslashes(htmlspecialchars($_POST["cmbFondoDePension"]));
    $porcentajePension = addslashes(htmlspecialchars($_POST["txtPorcentajePension"]));
    $fechaInicioPension = addslashes(htmlspecialchars($_POST["txtFechaInicioPension"]));
    $bancos = addslashes(htmlspecialchars($_POST["cmbBancos"]));
    $tipoCuetaBanco = addslashes(htmlspecialchars($_POST["cmbTipoCuentaBancaria"]));
    $numeroCuentaBanco = addslashes(htmlspecialchars($_POST["txtNumCuenta"]));
    $tipoAnexo = addslashes(htmlspecialchars($_POST["cmbTipoAnexo"]));
    $nombreAnexo = addslashes(htmlspecialchars($_POST["txtNombreAnexo"]));
    $descripcionAnexo = addslashes(htmlspecialchars($_POST["txtDetalle"]));
    $target_dir = "../../webPage/anexos/";
    $target_file = $target_dir . basename($_FILES["archivo"]["name"]);
    $referer = $_SERVER['HTTP_REFERER'];
    if (isset($_FILES["archivo"]["name"])) {
        $check = getimagesize($_FILES["archivo"]["tmp_name"]);
        $nombreAnexo = $_FILES['archivo']['name'];
        $tamano = $_FILES['archivo']['size'];
        $ruta = $_FILES['archivo']['tmp_name'];
        $destino = "../../webPage/anexos/" . $nombreAnexo;
    }
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
    $ContratoVO->setFechaInicioVacaciones($fechaInicioVacaciones);
    $ContratoVO->setFechaFinVacaciones($fechaFinVacaciones);
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
    $statusJson = array();
    try {
        $actualizarContrato = $mdlContrato->actualizarContrato($ContratoVO, $nombreAnexo, $descripcionAnexo, $tamano, $destino, $tipoAnexo);
        if ($actualizarContrato > 0) {
            $statusJson["success"] = "<span>contrato actualizado correctamente.</span>";
        } else {
            $statusJson["error"] = "<span>Error al intentar ejecutar la peticion.</span>";
        }
        echo '<script>alert("Contrato Actualizado Correctamente");  window.history.back();</script>';
        // echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}*/

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
