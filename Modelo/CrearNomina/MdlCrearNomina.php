<?php
require_once '../../Conexion/Conexion.php';

class mdlCrearNomina extends Conexion
{
    const RUTA_SQL = "../../Modelo/CrearNomina/sqlCrearNomina.xml";

    function visualizarDetalleEmpleado()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_EMPLEADO_DETALLE", self::RUTA_SQL));
            // die(var_dump($respuesta));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID_EMPLEADO" => $row['ID_EMPLEADO'],
                    "TIPO_DOCUMNETO_ID" => $row['TIPO_DOCUMNETO_ID'],
                    "TIPO_DOCUMENTO" => $row['TIPO_DOCUMENTO'],
                    "NUMERO_DOCUMENTO" => $row['NUMERO_DOCUMENTO'],
                    "PRIMER_NOMBRE" => $row['PRIMER_NOMBRE'],
                    "SEGUNDO_NOMBRE" => $row['SEGUNDO_NOMBRE'],
                    "PRIMER_APELLIDO" => $row['PRIMER_APELLIDO'],
                    "SEGUNDO_APELIIDO" => $row['SEGUNDO_APELIIDO'],
                    "NOMBRE_COMPLETO" => $row['NOMBRE_COMPLETO'],
                    "EMAIL" => $row['EMAIL'],
                    "NUMERO_CONTRATO" => $row['NUMERO_CONTRATO'],
                    "TIPO_CONTRATO_ID" => $row['TIPO_CONTRATO_ID'],
                    "TIPO_CONTRATO" => $row['TIPO_CONTRATO'],
                    "SALARIO_TOTAL" => $row['SALARIO_TOTAL'],
                    "SALARIO_DIA" => $row['SALARIO_DIA'],
                    "PORCENTAJE_SALUD" => $row['PORCENTAJE_SALUD'],
                    "PORCENTAJE_PENSION" => $row['PORCENTAJE_PENSION'],
                    "CARGOS_ID" => $row['CARGOS_ID'],
                    "CARGOS" => $row['CARGOS'],
                    "FECHA_CONTRATO" => $row['FECHA_CONTRATO'],
                    "TOTAL_PENSION" => $row['TOTAL_PENSION'],
                    "TOTAL_SALUD" => $row['TOTAL_SALUD'],
                    "TOTAL_DEDUCIONES" => $row['TOTAL_DEDUCIONES'],
                    "DEVENGADO" => $row['DEVENGADO'],
                    "FSP" => $row['FSP'],
                    "NETOPAGAR" => $row['NETOPAGAR'],


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

    function listarTipoLiquidacionNomina()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_TIPO_LIQUIDACION_NOMINA", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(

                    "ID" => $row['ID'],
                    "DESCRIPCION" => $row['DESCRIPCION'],
                    "VALOR_DIAS" => $row['VALOR_DIAS']
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

    function listarMesesdelano()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_MESES_ANO", self::RUTA_SQL));
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

    function registrarNomina(CrearNominaVO $crearNominaVO)
    {

        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $conexion->begin_transaction();
            $conexion->autocommit(false);
            $tipoLiquidacion = $crearNominaVO->getTipoLiquidacion();
            $descripcion = $crearNominaVO->getDescripcion();
            $mes  = $crearNominaVO->getMes();
            $year = $crearNominaVO->getYear();
            $listadoNomina = $crearNominaVO->getListadoNomina();
            $respuesta = $conexion->prepare($this->getSql("CREAR_NOMINA", self::RUTA_SQL));
            $respuesta->bind_param('ssss', $tipoLiquidacion, $descripcion, $mes, $year);
            $filasAfectadas = $respuesta->execute();
            // die(var_dump($filasAfectadas));
            $idNomina = mysqli_insert_id($conexion);
            //die(var_dump($idNomina));
            if ($filasAfectadas > 0) {
                $respuesta = $conexion->prepare($this->getSql("NOMINA_DETALLE", self::RUTA_SQL));
                die(var_dump($listadoNomina));
                foreach ($listadoNomina as $listNom) {
                    $idEmpleado = $listNom->idEmpleado;
                    $totalNovedad = $listNom->totalNovedad;
                    $salario = $listNom->salario;
                    $salarioDia = $listNom->salarioDia;
                    $pension = $listNom->pension;
                    $salud = $listNom->salud;
                    $totalDeduciones = $listNom->totalDeduciones;
                    $devengado = $listNom->devengado;
                    $netopagar = $listNom->netopagar;
                    $fsp = $listNom->fsp;
                    $auxTransporte = $listNom->auxTransporte;
                    //die(var_dump($idNomina, $idEmpleado, $devengado, $salud, $pension, $netopagar, $fsp, $salario, $auxTransporte, $totalDeduciones, $totalNovedad));
                    $respuesta->bind_param('sssssssssss', $idNomina, $idEmpleado, $devengado, $salud, $pension, $netopagar, $fsp, $salario, $auxTransporte, $totalDeduciones, $totalNovedad);
                    $filasAfectadas = $respuesta->execute();
                }

                if ($filasAfectadas > 0) {
                    $filasAfectadas = $idNomina;
                    $conexion->autocommit(true);
                } else {
                    $conexion->rollback();
                    $filasAfectadas = $respuesta->error;
                }
            }
            if ($filasAfectadas > 0) {
                $respuesta = $conexion->prepare($this->getSql("ASIGNAR_ID_NOMINA", self::RUTA_SQL));
                foreach ($listadoNomina as $listNom) {
                    $idnovedad = $listNom->idNovedad;
                    $respuesta->bind_param('ss', $idNomina, $idnovedad);
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


    function obtenerCredencialesBd()
    {
        try {
            $bd = $_SESSION['bd'];
            $arryBd = array("host" => self::HOST, "usuario" => self::USUARIO, "pass" => self::PASS, "BD" => $bd);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return $arryBd;
    }

    function novedadesNomina()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("NOVEDADES_NOMINA", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(

                    "NOVEDAD_ID" => $row['NOVEDAD_ID'],
                    "EMPLEADONOV_ID" => $row['EMPLEADONOV_ID'],
                    "CANTIDAD" => $row['CANTIDAD'],
                    "VALOR" => $row['VALOR'],
                    "TIPO_CONCEPTO_ID" => $row['TIPO_CONCEPTO_ID'],
                    "TIPO_CONCEPTO" => $row['TIPO_CONCEPTO'],
                    "CONCEPTO_ID" => $row['CONCEPTO_ID'],
                    "CONCEPTO" => $row['CONCEPTO'],
                    "MES" => $row['MES']

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
