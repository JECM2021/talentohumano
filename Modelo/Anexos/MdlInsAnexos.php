<?php
require_once '../../Conexion/Conexion.php';

class mdlInsAnexo extends Conexion
{
    const RUTA_SQL = "../../Modelo/Anexos/sqlInsAnexo.xml";

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
                    "CONTRATO_ID" => $row['CONTRATO_ID'],
                    "AREA_TRABAJO_ID" => $row['AREA_TRABAJO_ID'],
                    "CENTRO_COSTO_ID" => $row['CENTRO_COSTO_ID']
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

    function registrarAnexos($nombreAnexo, $descripcionAnexo, $tamano, $destino, $fechaCaducidad, $tipoAnexo, $idEmpleado, $idContrato)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("INSERTAR_ANEXOS", self::RUTA_SQL));
            $respuesta->bind_param('ssssssss', $nombreAnexo, $descripcionAnexo, $tamano, $destino, $fechaCaducidad, $tipoAnexo, $idEmpleado, $idContrato);
            $filasAfectadas = $respuesta->execute() or die($respuesta->error);
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
}
