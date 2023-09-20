<?php
require_once '../../Conexion/Conexion.php';

class mdlNovedadConceptos extends Conexion
{
    const RUTA_SQL = "../../Modelo/NovedadConceptos/sqlNovedadConceptos.xml";

    function listarConceptoNomina()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_CONCEPTO_NOMINA", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID'],
                    "DESCRIPCION" => $row['DESCRIPCION'],
                    "TIPOCONCEPTO_ID" => $row['TIPOCONCEPTO_ID']
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

    function listarComboMes()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_CONCEPTO_MES", self::RUTA_SQL));
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

    function visualizarEmpleados()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_EMPLEADO_DETALLE", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID_EMPLEADO" => $row['ID_EMPLEADO'],
                    "PRIMER_NOMBRE" => $row['PRIMER_NOMBRE'],
                    "SEGUNDO_NOMBRE" => $row['SEGUNDO_NOMBRE'],
                    "PRIMER_APELLIDO" => $row['PRIMER_APELLIDO'],
                    "SEGUNDO_APELLIDO" => $row['SEGUNDO_APELLIDO'],
                    "NOMBRE_COMPLETO" => $row['NOMBRE_COMPLETO'],
                    "SALARIO" => $row['SALARIO'],
                    "DOCUMENTO" => $row['DOCUMENTO']
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

    function registrarNovedades(novedadConceptosVO $novedadConceptosVO)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $conexion->begin_transaction();
            $conexion->autocommit(false);
            $ConceptoId = $novedadConceptosVO->getTipoConcepto();
            $tipoconcepId = $novedadConceptosVO->getTipoConceptoId();
            $mesConcepto = $novedadConceptosVO->getMesConcepto();
            $listadoNovedades = $novedadConceptosVO->getListadoNovedades();
            //die(var_dump($tipoConcepto, $tipoconcepId));
            $respuesta = $conexion->prepare($this->getSql("CREAR_NOVEDAD", self::RUTA_SQL));
            $respuesta->bind_param('sss', $ConceptoId, $tipoconcepId, $mesConcepto);
            $filasAfectadas = $respuesta->execute();
            $idNovedad = mysqli_insert_id($conexion);
            if ($filasAfectadas > 0) {
                $respuesta = $conexion->prepare($this->getSql("CREAR_NOVEDAD_DETALLE", self::RUTA_SQL));
                foreach ($listadoNovedades as $lisNov) {
                    $idEmpleado = $lisNov->idEmpleado;
                    $cantidad = $lisNov->cantidad;
                    $valor = $lisNov->valor;
                    $valor = str_replace(',', '', $valor);
                    $respuesta->bind_param('ssss', $idNovedad, $valor, $idEmpleado, $cantidad);
                    $filasAfectadas = $respuesta->execute();
                }
                if ($filasAfectadas > 0) {
                    $filasAfectadas = $idNovedad;
                    $conexion->autocommit(true);
                } else {
                    $conexion->rollback();
                    $filasAfectadas = $respuesta->error;
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
























    /*  function listarCabeceraNovedades()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_CABEZERA", self::RUTA_SQL));
            // die(var_dump($respuesta));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "NOVEDADES" => $row['NOVEDADES'],
                    "CON_NOM_ID" => $row['CON_NOM_ID'],
                    "ALIAS" => $row['ALIAS'],
                    "TIPO_CONCEPTO_ID" => $row['TIPO_CONCEPTO_ID']
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

    function listarNovedadDetalle()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_NOVEDAD_DETALLE", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID_EMPLEADO" => $row['ID_EMPLEADO'],
                    "NUMERO_DOCUMENTO" => $row['NUMERO_DOCUMENTO'],
                    "NOMBRE_COMPLETO" => $row['NOMBRE_COMPLETO'],
                    "SALARIO" => $row['SALARIO']

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

    function registrarNovedades(novedadConceptosVO $novedadConceptosVO)
    {
        /*try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $listadoNovedades = $novedadConceptosVO->getListadoNovedades();
            die(var_dump($listadoNovedades));
            $respuesta = $conexion->prepare($this->getSql("CREAR_NOVEDAD_CONCEPTO", self::RUTA_SQL));
            foreach ($listadoNovedades as $lisNov) {
                $idEmpleado = $lisNov->idEmpleado;
                $valor = $lisNov->valor;
                $respuesta->bind_param('ss', $idEmpleado, $valor);
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
        return $filasAfectadas;/*

        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $conexion->begin_transaction();
            $conexion->autocommit(false);
            $listadoNovedades = $novedadConceptosVO->getListadoNovedades();
            foreach ($listadoNovedades as  $lisNov) {
                $idEmpleado = $lisNov->idEmpleado;
                $idConcepto = $lisNov->idConcepto;
                $idTipoConcepto = $lisNov->idTipoConcepto;
                $valor = $lisNov->valor;
                $respuesta = $conexion->prepare($this->getSql("CREAR_NOVEDAD", self::RUTA_SQL));
                $respuesta->bind_param('sss', $idEmpleado, $idTipoConcepto, $idConcepto);
                $filasAfectadas = $respuesta->execute();
                $idNovedad = mysqli_insert_id($conexion);
                if ($filasAfectadas > 0) {
                    $respuesta = $conexion->prepare($this->getSql("CREAR_NOVEDAD_DETALLE", self::RUTA_SQL));
                    //die(var_dump($idNovedad, $valor));
                    $respuesta->bind_param('ss', $idNovedad, $valor);
                    $filasAfectadas = $respuesta->execute();
                }
            }
            if ($filasAfectadas > 0) {
                $filasAfectadas = $idNovedad;
                $conexion->autocommit(true);
            } else {
                $conexion->rollback();
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
    }*/
}
