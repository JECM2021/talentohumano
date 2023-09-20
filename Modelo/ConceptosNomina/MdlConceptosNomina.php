<?php
require_once '../../Conexion/Conexion.php';
class MdlConceptosNomina extends Conexion
{
    const RUTA_SQL = "../../Modelo/ConceptosNomina/sqlConceptosNomina.xml";


    function listarTipoConcepto()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_TIPO_CONCEPTO", self::RUTA_SQL));
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

    function registrarConceptoNomina(ConceptosNominaVO $ConceptosNominaVO)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $codigo = $ConceptosNominaVO->getCodigo();
            $tipoConceptos = $ConceptosNominaVO->getTipoConceptos();
            $descripcion = $ConceptosNominaVO->getDescripcion();
            $estado = $ConceptosNominaVO->getEstado();
            $respuesta = $conexion->prepare($this->getSql("CONSULTAR_TIPO_CONCEPTO", self::RUTA_SQL));
            $respuesta->bind_param('ss', $codigo, $descripcion);
            $respuesta->execute();
            $resultado = $respuesta->get_result();
            $row = $resultado->fetch_assoc();
            if (count($row) === 0) {
                $respuesta = $conexion->prepare($this->getSql("REGISTRAR_TIPO_CONCEPTO", self::RUTA_SQL));
                $respuesta->bind_param('ssss', $codigo, $tipoConceptos, $descripcion, $estado);
                $filasAfectadas = $respuesta->execute();
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

    function visualizarConceptosNomina($dt_parram, $params)
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $filters = $dt_parram['columns'];
            $columns = array(
                0 => 'CONCEPTO_ID',
                1 => 'CODIGO',
                2 => 'DESCRIPCION',
                3 => 'TIPO_CONCEPTO',
                4 => 'ESTADO'
            );
            $sql = "SELECT
                    CDN.CPTN_ID AS CONCEPTO_ID,
                    CDN.CPTN_CODIGO AS CODIGO,
                    CDN.CPTN_DESCRIPCION AS DESCRIPCION,
                    TPC.TPCPT_DESCRIPCION AS TIPO_CONCEPTO,
                    CDN.TPCPT_ID AS TIPO_CONCEPTO_ID,
                    CDN.CPTN_ESTADO AS ESTADO_ID,
                    CASE 
                    WHEN CDN.CPTN_ESTADO = 'A' THEN 'ACTIVO'
                    ELSE 'INACTIVO'
                    END AS ESTADO
                    FROM
                    CONCEPTOS_DE_NOMINA CDN
                    INNER JOIN TIPO_CONCEPTO TPC ON TPC.TPCPT_ID = CDN.TPCPT_ID";
            $query = mysqli_query($conexion, $sql) or die("error");
            $totalData = mysqli_num_rows($query);
            $totalFiltered = $totalData;
            if (!empty($dt_parram['search']['value'])) {
                $sql .= " AND (CODIGO LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR DESCRIPCION LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR ESTADO LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR TIPO_CONCEPTO LIKE '" . $dt_parram['search']['value'] . "%' )";
            }
            $sql .= " ORDER BY " . $columns[$dt_parram['order'][0]['column']] . "   " . $dt_parram['order'][0]['dir'] . "   LIMIT " . $dt_parram['start'] . " ," . $dt_parram['length'] . "   ";
            $query = mysqli_query($conexion, $sql) or die("error");
            $rawdata = array();
            while ($row = mysqli_fetch_array($query)) {
                $rawdata[] = array(
                    "CONCEPTO_ID" => $row['CONCEPTO_ID'],
                    "CODIGO" => $row['CODIGO'],
                    "DESCRIPCION" => $row['DESCRIPCION'],
                    "ESTADO" => $row['ESTADO'],
                    "ESTADO_ID" => $row['ESTADO_ID'],
                    "TIPO_CONCEPTO" => $row['TIPO_CONCEPTO'],
                    "TIPO_CONCEPTO_ID" => $row['TIPO_CONCEPTO_ID']
                );
            }
            $json_data = array(
                "draw" => intval($dt_parram['draw']),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $rawdata

            );
            // die(var_dump($rawdata));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return json_encode($json_data);
    }


    function actualizarConcepto(ConceptosNominaVO $ConceptosNominaVO)
    {
        $filasAfectadas = false;
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("ACTUALIZAR_CONCEPTOS", self::RUTA_SQL));
            $concepto_id = $ConceptosNominaVO->getConceptoId();
            $codigo = $ConceptosNominaVO->getCodigo();
            $tipoConceptos = $ConceptosNominaVO->getTipoConceptos();
            $nombre = $ConceptosNominaVO->getDescripcion();
            $estado = $ConceptosNominaVO->getEstado();
            $respuesta->bind_param('sssss', $codigo, $tipoConceptos, $nombre, $estado, $concepto_id);
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
