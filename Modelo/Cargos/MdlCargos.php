<?php
require_once '../../Conexion/Conexion.php';

class mdlCargos extends conexion
{
    const RUTA_SQL = "../../Modelo/Cargos/sqlCargos.xml";

    function registrarcargo(CargosVO $cargosVO)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("REGISTRAR_CARGOS", self::RUTA_SQL));
            $codigo = $cargosVO->getCodigo();
            $descripcion = $cargosVO->getNombreCargo();
            $fechaCreacion = $cargosVO->getFechaCreacion();
            $estadoCargo = $cargosVO->getEstadoCargo();
            $respuesta->bind_param('ssss', $codigo, $descripcion, $fechaCreacion, $estadoCargo);
            $filasAfectadas = $respuesta->execute() or ($respuesta->error);
            if ($filasAfectadas > 0) {
                $filasAfectadas = mysqli_insert_id($conexion);
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

    function actualizarCargos(CargosVO $cargosVO)
    {
        $filasAfectadas = false;
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("ACTUALIZAR_CARGOS", self::RUTA_SQL));
            $cargo_id = $cargosVO->getCargoId();
            $codigo = $cargosVO->getCodigo();
            $descripcion = $cargosVO->getNombreCargo();
            $fecha = $cargosVO->getFechaCreacion();
            $estado = $cargosVO->getEstadoCargo();
            $respuesta->bind_param('sssss', $codigo, $descripcion, $fecha, $estado, $cargo_id);
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




    function visualizarCargos($dt_parram, $params)
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $filters = $dt_parram['columns'];
            $columns = array(
                0 => 'CARGO_ID',
                1 => 'CODIGO',
                2 => 'DESCRIPCION',
                3 => 'FECHA_CREACION',
                4 => 'ESTADO'
            );
            $sql = "SELECT
            CRG_ID AS CARGO_ID,
            CRG_CODIGO AS CODIGO,
            CRG_DESCRIPCION AS DESCRIPCION,
            CRG_ESTADO AS ESTADO,
            DATE(crg_fecha_creacion) AS FECHA_CREACION
        FROM
            CARGOS";
            $query = mysqli_query($conexion, $sql) or die("error");
            $totalData = mysqli_num_rows($query);
            $totalFiltered = $totalData;
            if (!empty($dt_parram['search']['value'])) {
                $sql .= " AND (CODIGO LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR DESCRIPCION LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR ESTADO LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR FECHA_CREACION LIKE '" . $dt_parram['search']['value'] . "%' )";
            }
            $sql .= " ORDER BY " . $columns[$dt_parram['order'][0]['column']] . "   " . $dt_parram['order'][0]['dir'] . "   LIMIT " . $dt_parram['start'] . " ," . $dt_parram['length'] . "   ";
            $query = mysqli_query($conexion, $sql) or die("error");
            $rawdata = array();
            while ($row = mysqli_fetch_array($query)) {
                $rawdata[] = array(
                    "CARGO_ID" => $row['CARGO_ID'],
                    "CODIGO" => $row['CODIGO'],
                    "DESCRIPCION" => $row['DESCRIPCION'],
                    "ESTADO" => $row['ESTADO'],
                    "FECHA_CREACION" => $row['FECHA_CREACION']
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
}
