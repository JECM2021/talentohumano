<?php

require_once '../../Conexion/Conexion.php';

class MdlAnexos extends Conexion
{

    const RUTA_SQL = "../../Modelo/Anexos/sqlAnexos.xml";

    function visualizarPacientesAnexos($dt_parram)
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $filters = $dt_parram['columns'];
            $columns = array(
                0 => 'ID_EMPLEADO',
                1 => 'CTR.CTRA_NUMERO',
                2 => 'EMPL.NUM_DOCUMENTO',
                3 => 'EMPL.EMPL_PRIMER_APELLIDO',
                4 => 'EMPL.EMPL_SEGUNDO_APELLIDO',
                5 => 'EMPL.EMPL_PRIMER_NOMBRE',
                6 => 'EMPL.EMPLE_SEGUNDO_NOMBRE',
                7 => 'CC.CDC_DESCRIPCION'
            );
            $sql = "SELECT
            EMPL.EMPL_ID AS ID_EMPLEADO,
            CTR.CTRA_NUMERO AS NUMERO_CONTRATO,
            EMPL.NUM_DOCUMENTO AS NUMERO_DOCUMENTO,
            CONCAT(EMPL.EMPL_PRIMER_APELLIDO,' ',EMPL.EMPL_SEGUNDO_APELLIDO) AS APELLIDOS,
            CONCAT(EMPL.EMPL_PRIMER_NOMBRE,' ',EMPL.EMPLE_SEGUNDO_NOMBRE) AS NOMBRES,
            CC.CDC_DESCRIPCION AS CENTRO_COSTO,
	        CONCAT(EMPL.EMPL_PRIMER_NOMBRE,' ',EMPL.EMPLE_SEGUNDO_NOMBRE, ' ',EMPL.EMPL_PRIMER_APELLIDO,' ',EMPL.EMPL_SEGUNDO_APELLIDO) AS NOMBRE_COMPLETO
            FROM
            EMPLEADOS EMPL
            INNER JOIN CONTRATO CTR ON CTR.EMPL_ID = EMPL.EMPL_ID
            INNER JOIN CENTRO_DE_COSTO CC ON CC.CDC_ID = CTR.CTDC_ID 
            WHERE 1=1";
            //die(var_dump($sql));
            $query = mysqli_query($conexion, $sql) or die("error");
            $totalData = mysqli_num_rows($query);
            $totalFiltered = $totalData;
            if (!empty($dt_parram['search']['value'])) {
                $sql .= " AND (CTR.CTRA_NUMERO LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR EMPL.NUM_DOCUMENTO LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR EMPL.EMPL_PRIMER_APELLIDO LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR EMPL.EMPL_SEGUNDO_APELLIDO LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR EMPL.EMPL_PRIMER_NOMBRE  LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR EMPL.EMPLE_SEGUNDO_NOMBRE LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR CC.CDC_DESCRIPCION LIKE '" . $dt_parram['search']['value'] . "%' )";
                //die( $sql);
            }
            $sql .= " ORDER BY " . $columns[$dt_parram['order'][0]['column']] . "   " . $dt_parram['order'][0]['dir'] . "   LIMIT " . $dt_parram['start'] . " ," . $dt_parram['length'] . "   ";
            //die( $sql);
            $query = mysqli_query($conexion, $sql) or die("error");
            $rawdata = array();
            while ($row = mysqli_fetch_array($query)) {
                $rawdata[] = array(
                    "NUMERO_CONTRATO" => $row['NUMERO_CONTRATO'],
                    "ID_EMPLEADO" => $row['ID_EMPLEADO'],
                    "NUMERO_DOCUMENTO" => $row['NUMERO_DOCUMENTO'],
                    "APELLIDOS" => $row['APELLIDOS'],
                    "NOMBRES" => $row['NOMBRES'],
                    "CENTRO_COSTO" => $row['CENTRO_COSTO'],
                    "NOMBRE_COMPLETO" => $row['NOMBRE_COMPLETO']
                );
            }
            $json_data = array(
                "draw" => intval($dt_parram['draw']),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $rawdata
            );
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
    function detalleAnexos($contrato)
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("CONSULTAR_DETALLE_ANEXOS", self::RUTA_SQL));
            $respuesta->bind_param('s', $contrato);
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = $row;
            }
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }
    function actualizarDatosAnexos($idAnexo, $fecha, $tipoAnexo, $detalle)
    {
        try {
            $con = $this->conectarBd(self::ASISTENCIAL);
            $ps = $con->prepare($this->getSql("UPDATE_ANEXOS", self::RUTA_SQL));
            //$evento = 250 ;
            //die(var_dump($idAnexo, $fecha, $tipoAnexo, $detalle));
            $ps->bind_param('ssss', $fecha, $detalle, $tipoAnexo, $idAnexo);
            $filasAfectadas = $ps->execute() or die($ps->error);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($con);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $filasAfectadas;
    }
    function eliminarAnexo($idAnexo)
    {
        try {
            $con = $this->conectarBd(self::ASISTENCIAL);
            $ps = $con->prepare($this->getSql("ELIMINAR_ANEXOS", self::RUTA_SQL));

            $ps->bind_param('s', $idAnexo);
            $filasAfectadas = $ps->execute() or die($ps->error);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        try {
            $this->descconectarBd($con);
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
