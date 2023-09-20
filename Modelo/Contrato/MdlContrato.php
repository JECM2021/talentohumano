<?php
require_once '../../Conexion/Conexion.php';

class mdlContrato extends Conexion
{
    const RUTA_SQL = "../../Modelo/Contrato/sqlContrato.xml";

    function visualizarEmpleados()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("VISUALIZAR_EMPLEADOS", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "TIPODOCUMENTO" => $row['TIPODOCUMENTO'],
                    "NUMDOCUMENTO" => $row['NUMDOCUMENTO'],
                    "NOMBREYAPELLIDO" => $row['NOMBREYAPELLIDO'],
                    "ESTADOEMPLEADO" => $row['ESTADOEMPLEADO'],
                    "TIPODOCUMENTO_ID" => $row['TIPODOCUMENTO_ID'],
                    "ESTADO_ID" => $row['ESTADO_ID'],
                    "ID" => $row['ID'],
                    "NUM_CONTRATO" => $row['NUM_CONTRATO'],
                    "TIPO_CONTRATO" => $row['TIPO_CONTRATO'],
                    "CARGO" => $row['CARGO'],
                    "FECHA_INICIO" => $row['FECHA_INICIO'],
                    "FECHA_FINAL" => $row['FECHA_FINAL'],
                    "MOTIVO_RETIRO" => $row['MOTIVO_RETIRO'],
                    "SALARIO_ACTUAL" => $row['SALARIO_ACTUAL'],
                    "SALARIO_DIA" => $row['SALARIO_DIA'],
                    "FORMA_PAGO" => $row['FORMA_PAGO'],
                    "TIPO_COTIZANTE" => $row['TIPO_COTIZANTE'],
                    "ARL" => $row['ARL'],
                    "POCENTAJE_ARL" => $row['POCENTAJE_ARL'],
                    "PARAFISCAL_ID" => $row['PARAFISCAL_ID'],
                    "CESANTIAS_ID" => $row['CESANTIAS_ID'],
                    "CENTRO_COSTO" => $row['CENTRO_COSTO'],
                    "FECHA_INICIO_VACACIONES" => $row['FECHA_INICIO_VACACIONES'],
                    "FECHA_FIN_VACACIONES" => $row['FECHA_FIN_VACACIONES'],
                    "CIUDAD" => $row['CIUDAD'],
                    "FONDO_SALUD" => $row['FONDO_SALUD'],
                    "POCENTAJE_SALUD" => $row['POCENTAJE_SALUD'],
                    "FECHA_INICIO_SALUD" => $row['FECHA_INICIO_SALUD'],
                    "FONDO_PENSION" => $row['FONDO_PENSION'],
                    "PORCENTAJE_PENSION" => $row['PORCENTAJE_PENSION'],
                    "FECHA_INICIO_PENSION" => $row['FECHA_INICIO_PENSION'],
                    "BANCO_ID" => $row['BANCO_ID'],
                    "TIPO_CUENTA_BANCARIA" => $row['TIPO_CUENTA_BANCARIA'],
                    "NUM_CUENTA" => $row['NUM_CUENTA'],
                    "CONTRATO_ID" => $row['CONTRATO_ID']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function listarTipoDocumento()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_COMBO_TIPO_DOCUMENTO", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID'],
                    "DESCRIPCION" => $row['DESCRIPCION']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        // die(var_dump($rawdata));
        return $rawdata;
    }


    function listarCargos()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_COMBO_CARGOS", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID'],
                    "DESCRIPCION" => $row['DESCRIPCION']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function listarTipoContrato()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_COMBO_TIPO_CONTRATO", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID'],
                    "DESCRIPCION" => $row['DESCRIPCION']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function listarMotivoRetiro()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_COMBO_MOTIVO_RETIRO", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID'],
                    "DESCRIPCION" => $row['DESCRIPCION']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function listarFormaDePago()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_COMBO_FORMA_PAGO", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID'],
                    "DESCRIPCION" => $row['DESCRIPCION']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function listarTipoCotizante()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_COMBO_TIPO_COTIZANTE", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID'],
                    "DESCRIPCION" => $row['DESCRIPCION']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function listarArl()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_COMBO_ARL", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID'],
                    "DESCRIPCION" => $row['DESCRIPCION'],
                    "RIESGO" => $row['RIESGO']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function listarCajaCompensacion()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_COMBO_CAJA_COMPENSACION", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID'],
                    "DESCRIPCION" => $row['DESCRIPCION']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function listarFonCesantia()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_COMBO_CENSATIAS", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID'],
                    "DESCRIPCION" => $row['DESCRIPCION']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function ciudadDondeLabora()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_COMBO_CIUDAD_LABORAL", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID'],
                    "DESCRIPCION" => $row['DESCRIPCION']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function listarFondoSalud()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_COMBO_SALUD", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID'],
                    "DESCRIPCION" => $row['DESCRIPCION'],
                    "PORCENTAJE" => $row['PORCENTAJE']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function listarFondoPension()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_COMBO_PENSION", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID'],
                    "DESCRIPCION" => $row['DESCRIPCION'],
                    "PORCENTAJE" => $row['PORCENTAJE']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function listarBancos()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_BANCOS", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID'],
                    "DESCRIPCION" => $row['DESCRIPCION']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function listarTipoDeCuenta()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_TIPO_CUENTA", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID'],
                    "DESCRIPCION" => $row['DESCRIPCION']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function listarCentroDeCosto()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_CENTRO_COSTO", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID'],
                    "DESCRIPCION" => $row['DESCRIPCION']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function asignarContrato(ContratoVO $contratoVO, $nombreAnexo, $descripcionAnexo, $tamano, $destino, $tipoAnexo)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $idEmpleado = $contratoVO->getIdEmpleado();
            $numContrato = $contratoVO->getNumContrato();
            $tipoContrato = $contratoVO->getTipoContrato();
            $cargos = $contratoVO->getCargos();
            $fechaInicioContrato = $contratoVO->getFechaInicioContrato();
            $fechaCulminacionContrato = $contratoVO->getFechaCulminacionContrato();
            $motivoRetiro = $contratoVO->getMotivoRetiro();
            $salarioTotal = $contratoVO->getSalarioTotal();
            $salarioDia = $contratoVO->getSalarioDia();
            $formaPago = $contratoVO->getFormaPago();
            $tipoCotizante = $contratoVO->getTipoCotizante();
            $arl = $contratoVO->getArl();
            $porcentajeArl = $contratoVO->getPorcentajeArl();
            $cajaCompensacion = $contratoVO->getCajaCompensacion();
            $fondoCesantias = $contratoVO->getFondoCesantias();
            $centroCosto = $contratoVO->getCentroDeCosto();
            $fechaInicioVacaciones = $contratoVO->getFechaInicioVacaciones();
            $fechaFinVacaciones = $contratoVO->getFechaFinVacaciones();
            $ciudad = $contratoVO->getCiudad();
            $fondoSalud = $contratoVO->getFondoSalud();
            $porcentajeSalud = $contratoVO->getPorcentajeSalud();
            $fechaInicioSalud = $contratoVO->getFechaInicioSalud();
            $fondoPension = $contratoVO->getFondoPension();
            $porcentajePension = $contratoVO->getPorcentajePension();
            $fechaInicioPension = $contratoVO->getFechaInicioPension();
            $bancos = $contratoVO->getBancos();
            $tipoCuetaBanco = $contratoVO->getTipoCuentaBanco();
            $numeroCuentaBanco = $contratoVO->getNumeroCuentaBanco();
            if (empty($motivoRetiro)) {
                $motivoRetiro = null;
            }
            $respuesta = $conexion->prepare($this->getSql("CONSULTAR_CONTRATO_ASIGNADO", self::RUTA_SQL));
            $respuesta->bind_param('s', $idEmpleado);
            $respuesta->execute();
            $resultado = $respuesta->get_result();
            $row = $resultado->fetch_assoc();
            if (count($row) === 0) {
                $respuesta = $conexion->prepare($this->getSql("ASIGNAR_CONTRATO", self::RUTA_SQL));
                $respuesta->bind_param('ssssssssssssssssssssssssssss', $idEmpleado, $numContrato, $tipoContrato, $cargos, $fechaInicioContrato, $fechaCulminacionContrato, $motivoRetiro, $salarioTotal, $salarioDia, $formaPago, $tipoCotizante, $arl, $porcentajeArl, $cajaCompensacion, $fondoCesantias, $centroCosto, $fechaInicioVacaciones, $fechaFinVacaciones, $ciudad, $fondoSalud, $porcentajeSalud, $fechaInicioSalud, $fondoPension, $porcentajePension, $fechaInicioPension, $bancos, $tipoCuetaBanco, $numeroCuentaBanco);
                $filasAfectadas = $respuesta->execute() or ($respuesta->error);
                $idContato = mysqli_insert_id($conexion);
                if ($filasAfectadas > 0) {
                    $respuesta = $conexion->prepare($this->getSql("ASIGNAR_ANEXO", self::RUTA_SQL));
                    $respuesta->bind_param('sssssss', $nombreAnexo, $descripcionAnexo, $tamano, $destino, $tipoAnexo, $idContato, $idEmpleado);
                    $filasAfectadas = $respuesta->execute();
                }
            } else {
                $filasAfectadas = $respuesta->error;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $filasAfectadas;
    }


    function actualizarContrato(ContratoVO $contratoVO, $nombreAnexo, $descripcionAnexo, $tamano, $destino, $tipoAnexo)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $idEmpleado = $contratoVO->getIdEmpleado();
            $numContrato = $contratoVO->getNumContrato();
            $tipoContrato = $contratoVO->getTipoContrato();
            $cargos = $contratoVO->getCargos();
            $fechaInicioContrato = $contratoVO->getFechaInicioContrato();
            $fechaCulminacionContrato = $contratoVO->getFechaCulminacionContrato();
            $motivoRetiro = $contratoVO->getMotivoRetiro();
            $salarioTotal = $contratoVO->getSalarioTotal();
            $salarioDia = $contratoVO->getSalarioDia();
            $formaPago = $contratoVO->getFormaPago();
            $tipoCotizante = $contratoVO->getTipoCotizante();
            $arl = $contratoVO->getArl();
            $porcentajeArl = $contratoVO->getPorcentajeArl();
            $cajaCompensacion = $contratoVO->getCajaCompensacion();
            $fondoCesantias = $contratoVO->getFondoCesantias();
            $centroCosto = $contratoVO->getCentroDeCosto();
            $fechaInicioVacaciones = $contratoVO->getFechaInicioVacaciones();
            $fechaFinVacaciones = $contratoVO->getFechaFinVacaciones();
            $ciudad = $contratoVO->getCiudad();
            $fondoSalud = $contratoVO->getFondoSalud();
            $porcentajeSalud = $contratoVO->getPorcentajeSalud();
            $fechaInicioSalud = $contratoVO->getFechaInicioSalud();
            $fondoPension = $contratoVO->getFondoPension();
            $porcentajePension = $contratoVO->getPorcentajePension();
            $fechaInicioPension = $contratoVO->getFechaInicioPension();
            $bancos = $contratoVO->getBancos();
            $tipoCuetaBanco = $contratoVO->getTipoCuentaBanco();
            $numeroCuentaBanco = $contratoVO->getNumeroCuentaBanco();
            $idContrato = $contratoVO->getIdContrato();
            if (empty($motivoRetiro)) {
                $motivoRetiro = null;
            }
            $respuesta = $conexion->prepare($this->getSql("ACTUALIZAR_CONTRATO", self::RUTA_SQL));
            $respuesta->bind_param('ssssssssssssssssssssssssssss', $numContrato, $tipoContrato, $cargos, $fechaInicioContrato, $fechaCulminacionContrato, $motivoRetiro, $salarioTotal, $salarioDia, $formaPago, $tipoCotizante, $arl, $porcentajeArl, $cajaCompensacion, $fondoCesantias, $centroCosto, $fechaInicioVacaciones, $fechaFinVacaciones, $ciudad, $fondoSalud, $porcentajeSalud, $fechaInicioSalud, $fondoPension, $porcentajePension, $fechaInicioPension, $bancos, $tipoCuetaBanco, $numeroCuentaBanco, $idEmpleado);
            $filasAfectadas = $respuesta->execute() or dir($respuesta->error);
            if ($filasAfectadas > 0) {
                $respuesta = $conexion->prepare($this->getSql("ASIGNAR_ANEXO", self::RUTA_SQL));
                $respuesta->bind_param('sssssss', $nombreAnexo, $descripcionAnexo, $tamano, $destino, $tipoAnexo, $idContrato, $idEmpleado);
                $filasAfectadas = $respuesta->execute();
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $filasAfectadas;
    }

    function listarTipoAnexo()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_TIPO_ANEXO", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID'],
                    "DESCRIPCION" => $row['DESCRIPCION']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }
}
