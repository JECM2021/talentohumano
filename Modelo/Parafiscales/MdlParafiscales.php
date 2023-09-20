<?php
require_once '../../Conexion/Conexion.php';
class MdlParafiscales extends Conexion
{
    const RUTA_SQL = "../../Modelo/Parafiscales/sqlParafiscales.xml";

    function cuentacontable($parametro)
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::CONTABLE);
            $respuesta = $conexion->prepare($this->getSql("CONSULTAR_CUENTA_CONTABLE", self::RUTA_SQL));
            $pm = $parametro;
            $respuesta->bind_param('ss', $pm, $pm);
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "cuenta" => $row["CUENTA"],
                    "nombre" => $row["NOMBRE"],
                    "idcuenta" => $row["ID_CUENTA"]
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


    function ListarTipoFondo()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::CONTABLE);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_TIPO_FONDOS", self::RUTA_SQL));
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

    function registrarParafiscal(ParafiscalesVO $parafiscalesVO)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $codigo = $parafiscalesVO->getCodigoParafiscal();
            $idParafiscal = $parafiscalesVO->getIdParafiscal();
            $nombreParafiscal = $parafiscalesVO->getNombreParafiscal();
            $porcSubfam = $parafiscalesVO->getSubfam();
            /*$auxContableSubfam = $parafiscalesVO->getAuxContableSubfam();
            $auxFicalSubfam = $parafiscalesVO->getAuxFiscalSubfam();
            $auxNormasSubfam = $parafiscalesVO->getAuxNormasSubfam();*/
            $nitSubfam = $parafiscalesVO->getNitSubfam();
            $codAdminSubfam = $parafiscalesVO->getCodAdminSubfam();
            $porcIcbf = $parafiscalesVO->getIcbf();
            /*$auxContableIcbf = $parafiscalesVO->getAuxContableIcbf();
            $auxFiscalIcbf = $parafiscalesVO->getAuxFiscalIcbf();
            $auxNormasIcbf = $parafiscalesVO->getAuxNormasIcbf();*/
            $nitIcbf = $parafiscalesVO->getNitIcbf();
            $codAdminIcbf = $parafiscalesVO->getCodAdminIcbf();
            $porcSena = $parafiscalesVO->getSena();
            /*$auxcontableSena = $parafiscalesVO->getAuxContableSena();
            $auxFiscalSena = $parafiscalesVO->getAuxFiscalSena();
            $auxNormasSena = $parafiscalesVO->getAuxNormasSena();*/
            $nitSena = $parafiscalesVO->getNitSena();
            $codAdminSena = $parafiscalesVO->getCodAdminSena();
            $tipoFondo = $parafiscalesVO->getTipoFondo();
            $estadoFondo = $parafiscalesVO->getEstadoFondo();
            /*if (empty($auxContableSubfam)) {
                $auxContableSubfam = null;
            }
            if (empty($auxFicalSubfam)) {
                $auxFicalSubfam = null;
            }
            if (empty($auxNormasSubfam)) {
                $auxNormasSubfam = null;
            }
            if (empty($auxContableIcbf)) {
                $auxContableIcbf = null;
            }
            if (empty($auxFiscalIcbf)) {
                $auxFiscalIcbf = null;
            }
            if (empty($auxNormasIcbf)) {
                $auxNormasIcbf = null;
            }
            if (empty($auxcontableSena)) {
                $auxcontableSena = null;
            }
            if (empty($auxFiscalSena)) {
                $auxFiscalSena = null;
            }
            if (empty($auxNormasSena)) {
                $auxNormasSena = null;
            }*/
            $respuesta = $conexion->prepare($this->getSql("CONSULTAR_CODIGO_PARAFISCALES", self::RUTA_SQL));
            $respuesta->bind_param('ss', $nombreParafiscal, $codigo);
            $respuesta->execute();
            $resultado = $respuesta->get_result();
            $row = $resultado->fetch_assoc();
            if (count($row) === 0) {
                $respuesta = $conexion->prepare($this->getSql("REGISTRAR_PARAFISCAL", self::RUTA_SQL));
                $respuesta->bind_param('ssss', $codigo, $nombreParafiscal, $tipoFondo, $estadoFondo);
                $filasAfectadas = $respuesta->execute();
                $idParaf = mysqli_insert_id($conexion);
                if ($filasAfectadas > 0) {
                    $respuesta = $conexion->prepare($this->getSql("REGISTRAR_PARAFISCAL_DETALLE", self::RUTA_SQL));
                    $respuesta->bind_param('ssssssssss', $idParaf, $porcSubfam, $nitSubfam, $codAdminSubfam, $porcIcbf, $nitIcbf, $codAdminIcbf, $porcSena, $nitSena, $codAdminSena);
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

    function visualizarParaf($dt_parram, $params)
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $filters = $dt_parram['columns'];
            $columns = array(
                0 => 'PARAF_ID',
                1 => 'PARAF_CODIGO',
                2 => 'PARAF_NOMBRE',
                3 => 'ESTADO'
            );
            $sql = "SELECT
            PF.PARAF_ID AS PARAF_ID,
            PF.PARAF_CODIGO AS PARAF_CODIGO,
            PF.PARAF_NOMBRE AS PARAF_NOMBRE,
            PFD.PORC_SUBMAN AS PORC_SUBMAN,
            PFD.PORC_ICBF AS PORC_ICBF,
            PFD.PORC_SENA AS PORC_SENA,
            PFD.DOCUMENTO_SUBFAM AS NITSUBFAM,
            PFD.DOCUMENTO_ICBF AS NITICBF,
            PFD.DOCUMENTO_SENA AS NITSENA,
            PFD.CODADMIN_SUBFAM AS CODADMIN_SUBFAM,
            PFD.CODADMIN_ICBF AS CODADMIN_ICBF,
            PFD.CODADMIN_SENA AS CODADMIN_SENA, 
            PF.TPF_ID AS TIPO_FONDO,
            CASE
            WHEN PF.PARAF_ESTADO = 'A' THEN
            'ACTIVO' 
            WHEN PF.PARAF_ESTADO = 'I' THEN
            'INACTIVO' 
            END AS ESTADO,
            PF.PARAF_ESTADO AS ESTADO_ID 
            FROM
            PARAFISCALES PF
            INNER JOIN PARAFISCALES_DETALLE PFD ON PFD.PARAF_ID = PF.PARAF_ID";
            $query = mysqli_query($conexion, $sql) or die("error");
            $totalData = mysqli_num_rows($query);
            $totalFiltered = $totalData;
            if (!empty($dt_parram['search']['value'])) {
                $sql .= " WHERE (PF.PARAF_CODIGO LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR PF.PARAF_NOMBRE LIKE '" . $dt_parram['search']['value'] . "%' )";
            }
            $sql .= " ORDER BY " . $columns[$dt_parram['order'][0]['column']] . "   " . $dt_parram['order'][0]['dir'] . "   LIMIT " . $dt_parram['start'] . " ," . $dt_parram['length'] . "   ";
            $query = mysqli_query($conexion, $sql) or die("error");
            $rawdata = array();
            while ($row = mysqli_fetch_array($query)) {
                $rawdata[] = array(
                    "PARAF_ID" => $row['PARAF_ID'],
                    "PARAF_CODIGO" => $row['PARAF_CODIGO'],
                    "PARAF_NOMBRE" => $row['PARAF_NOMBRE'],
                    "PORC_SUBMAN" => $row['PORC_SUBMAN'],
                    "PORC_ICBF" => $row['PORC_ICBF'],
                    "PORC_SENA" => $row['PORC_SENA'],
                    "TIPO_FONDO" => $row['TIPO_FONDO'],
                    "ESTADO" => $row['ESTADO'],
                    "ESTADO_ID" => $row['ESTADO_ID'],
                    "NITSUBFAM" => $row['NITSUBFAM'],
                    "NITICBF" => $row['NITICBF'],
                    "NITSENA" => $row['NITSENA'],
                    "CODADMIN_SUBFAM" => $row['CODADMIN_SUBFAM'],
                    "CODADMIN_ICBF" => $row['CODADMIN_ICBF'],
                    "CODADMIN_SENA" => $row['CODADMIN_SENA']
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


    function actualizarParafical(ParafiscalesVO $parafiscalesVO)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $conexion->begin_transaction();
            $conexion->autocommit(false);
            $codigo = $parafiscalesVO->getCodigoParafiscal();
            $idParafiscal = $parafiscalesVO->getIdParafiscal();
            $nombreParafiscal = $parafiscalesVO->getNombreParafiscal();
            $porcSubfam = $parafiscalesVO->getSubfam();
            /*$auxContableSubfam = $parafiscalesVO->getAuxContableSubfam();
            $auxFicalSubfam = $parafiscalesVO->getAuxFiscalSubfam();
            $auxNormasSubfam = $parafiscalesVO->getAuxNormasSubfam();*/
            $nitSubfam = $parafiscalesVO->getNitSubfam();
            $codAdminSubfam = $parafiscalesVO->getCodAdminSubfam();
            $porcIcbf = $parafiscalesVO->getIcbf();
            /*$auxContableIcbf = $parafiscalesVO->getAuxContableIcbf();
            $auxFiscalIcbf = $parafiscalesVO->getAuxFiscalIcbf();
            $auxNormasIcbf = $parafiscalesVO->getAuxNormasIcbf();*/
            $nitIcbf = $parafiscalesVO->getNitIcbf();
            $codAdminIcbf = $parafiscalesVO->getCodAdminIcbf();
            $porcSena = $parafiscalesVO->getSena();
            /* $auxcontableSena = $parafiscalesVO->getAuxContableSena();
            $auxFiscalSena = $parafiscalesVO->getAuxFiscalSena();
            $auxNormasSena = $parafiscalesVO->getAuxNormasSena();*/
            $nitSena = $parafiscalesVO->getNitSena();
            $codAdminSena = $parafiscalesVO->getCodAdminSena();
            $tipoFondo = $parafiscalesVO->getTipoFondo();
            $estadoFondo = $parafiscalesVO->getEstadoFondo();
            /*if (empty($auxContableSubfam)) {
                $auxContableSubfam = null;
            }
            if (empty($auxFicalSubfam)) {
                $auxFicalSubfam = null;
            }
            if (empty($auxNormasSubfam)) {
                $auxNormasSubfam = null;
            }
            if (empty($auxContableIcbf)) {
                $auxContableIcbf = null;
            }
            if (empty($auxFiscalIcbf)) {
                $auxFiscalIcbf = null;
            }
            if (empty($auxNormasIcbf)) {
                $auxNormasIcbf = null;
            }
            if (empty($auxcontableSena)) {
                $auxcontableSena = null;
            }
            if (empty($auxFiscalSena)) {
                $auxFiscalSena = null;
            }
            if (empty($auxNormasSena)) {
                $auxNormasSena = null;
            }*/
            $respuesta = $conexion->prepare($this->getSql("ACTUALIZAR_PARAFISCALES", self::RUTA_SQL));
            $respuesta->bind_param('sssss', $codigo, $nombreParafiscal, $tipoFondo, $estadoFondo, $idParafiscal);
            $filasAfectadas = $respuesta->execute() or dir($respuesta->error);
            if ($filasAfectadas > 0) {
                $respuesta = $conexion->prepare($this->getSql("ACTUALIZAR_PARAFISCALES_DETALLE", self::RUTA_SQL));
                $respuesta->bind_param('ssssssssss', $porcSubfam, $nitSubfam, $codAdminSubfam, $porcIcbf, $nitIcbf, $codAdminIcbf, $porcSena, $nitSena, $codAdminSena, $idParafiscal);
                $filasAfectadas = $respuesta->execute();
                if ($filasAfectadas > 0) {
                    $conexion->autocommit(true);
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

    function eliminarParafiscal(ParafiscalesVO $parafiscalesVO)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("ELIMINAR_PARAFISCAL_DETALLE", self::RUTA_SQL));
            $idParaf = $parafiscalesVO->getIdParafiscal();
            $respuesta->bind_param('s', $idParaf);
            $filasAfectadas = $respuesta->execute() or ($respuesta->error);
            if ($filasAfectadas > 0) {
                $respuesta = $conexion->prepare($this->getSql("ELIMINAR_PARAFISCAL", self::RUTA_SQL));
                $idParaf = $parafiscalesVO->getIdParafiscal();
                $respuesta->bind_param('s', $idParaf);
                $filasAfectadas = $respuesta->execute() or ($respuesta->error);
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
}
