<?php
require_once '../../Conexion/Conexion.php';

class mdlVacaciones extends Conexion
{
    const RUTA_SQL = "../../Modelo/Vacaciones/sqlVacaciones.xml";

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
                    "EMPLEADO_ID" => $row['EMPLEADO_ID'],
                    "TIPO_DOCUMENTO" => $row['TIPO_DOCUMENTO'],
                    "NUMDOCUMENTO" => $row['NUMDOCUMENTO'],
                    "TIPO_CONTRATACION" => $row['TIPO_CONTRATACION'],
                    "NOMBRE_COMPLETO" => $row['NOMBRE_COMPLETO'],
                    "AREA" => $row['AREA'],
                    "CARGO" => $row['CARGO'],
                    "PER_VENC_INICIO" => $row['PER_VENC_INICIO'],
                    "PER_VENC_FIN" => $row['PER_VENC_FIN'],
                    "INICIO_VACACIONES" => $row['INICIO_VACACIONES'],
                    "FIN_VACACIONES" => $row['FIN_VACACIONES'],
                    "ID_EMPL_ESTADO" => $row['ID_EMPL_ESTADO'],
                    "VAC_ID" => $row['VAC_ID']
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

    function registrarNovedadVacaciones(VacacionesVO $VacacionesVO)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $idEmpleado = $VacacionesVO->getIdEmpleado();
            $perven_inicio = $VacacionesVO->getPerVenInicio();
            $perven_fin  = $VacacionesVO->getPerVenFin();
            $vac_inicio = $VacacionesVO->getIniVac();
            $vac_fin = $VacacionesVO->getFinVac();
            $observaciones = $VacacionesVO->getObservaciones();
            $idNovVac = $VacacionesVO->getIdNovVacaciones();
            //die(var_dump($idNovVac));
            if ($idNovVac > 0) {
                $respuesta =  $conexion->prepare($this->getSql("VACACIONES_DETALLE", self::RUTA_SQL));
                $respuesta->bind_param('ssssss', $idNovVac, $perven_inicio, $perven_fin, $vac_inicio, $vac_fin, $observaciones);
                $filasAfectadas = $respuesta->execute();
            } else {
                $respuesta =  $conexion->prepare($this->getSql("REGISTRAR_VACACIONES", self::RUTA_SQL));
                $respuesta->bind_param('s', $idEmpleado);
                $filasAfectadas = $respuesta->execute();
                $idVac = mysqli_insert_id($conexion);
                if ($filasAfectadas > 0) {
                    $respuesta =  $conexion->prepare($this->getSql("VACACIONES_DETALLE", self::RUTA_SQL));
                    $respuesta->bind_param('ssssss', $idVac, $perven_inicio, $perven_fin, $vac_inicio, $vac_fin, $observaciones);
                    $filasAfectadas = $respuesta->execute();
                }
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

    function obtenerHistorial($idVac)
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("OBTENER_HISTORIAL", self::RUTA_SQL));
            $respuesta->bind_param('s', $idVac);
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID_VAC" => $row['ID_VAC'],
                    "ID_EMPL" => $row['ID_EMPL'],
                    "PERIODO_VENCIDO_DESDE" => $row['PERIODO_VENCIDO_DESDE'],
                    "PERIODO_VENCIDO_HASTA" => $row['PERIODO_VENCIDO_HASTA'],
                    "FECHA_INICIO_VACACIONES" => $row['FECHA_INICIO_VACACIONES'],
                    "FECHA_FIN_VACACIONES" => $row['FECHA_FIN_VACACIONES'],
                    "OBSERVACIONES" => $row['OBSERVACIONES'],
                    "ID_VACD" => $row['ID_VACD'],
                    "VACD_ESTADO" => $row['VACD_ESTADO']
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

    function actualizarDatos(VacacionesVO $VacacionesVO)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $idVacacionesDetAct = $VacacionesVO->getIdVacacionesDetalle();
            $fechaPerVenDesdeAct = $VacacionesVO->getPerVenInicio();
            $fechaPerVenHastaAct = $VacacionesVO->getPerVenFin();
            $fechaIncVacacionesAct = $VacacionesVO->getIniVac();
            $fechaFinVacacionesAct = $VacacionesVO->getFinVac();
            $observacionesAct = $VacacionesVO->getObservaciones();
            $estadoAct = $VacacionesVO->getEstadoVacaciones();
            $respuesta = $conexion->prepare($this->getSql("ACTUALIZAR_DATOS", self::RUTA_SQL));
            //die(var_dump($fechaPerVenDesdeAct, $fechaPerVenHastaAct, $fechaIncVacacionesAct, $fechaFinVacacionesAct, $observacionesAct, $idVacacionesDetAct));
            $respuesta->bind_param('sssssss', $fechaPerVenDesdeAct, $fechaPerVenHastaAct, $fechaIncVacacionesAct, $fechaFinVacacionesAct, $observacionesAct, $estadoAct, $idVacacionesDetAct);
            $filasAfectadas = $respuesta->execute() or dir($respuesta->error);
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
