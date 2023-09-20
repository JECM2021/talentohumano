<?php
require_once '../../Conexion/Conexion.php';

class mdlArl extends Conexion
{
    const RUTA_SQL = "../../Modelo/Arl/sqlArl.xml";

    function listarTipoFondo()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
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

    function listarComboTipoDocumento()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_TIPO_DOCUMENTO", self::RUTA_SQL));
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


    function registrarArl(ArlVO $arlVO)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $codigo = $arlVO->getCodigoArl();
            $nombreArl = $arlVO->getNombreArl();
            $tipoDocumentoArl = $arlVO->getTipoDocumento();
            $numDocumentoArl = $arlVO->getNumDocumento();
            $codAdministradora = $arlVO->getCodAministradorArl();
            $riesgoCero = $arlVO->getRiesgoCero();
            $riesgoUno = $arlVO->getRiesgoUno();
            $riesgoDos = $arlVO->getRiesgoDos();
            $riesgoTres = $arlVO->getRiesgoTres();
            $riesgoCuatro = $arlVO->getRiesgoCuatro();
            $riesgoCinco = $arlVO->getRiesgoCinco();
            $riesgoSeis = $arlVO->getRiesgoSeis();
            $riesgoSiete = $arlVO->getRiesgoSiete();
            /*$auxContableArl = $arlVO->getAuxContableArl();
            $auxFiscalArl = $arlVO->getAuxFiscalArl();
            $auxNormasArl = $arlVO->getAuxNormasArl();
            $fuenteContable = $arlVO->getFuenteContable();*/
            $tipoFondo = $arlVO->getTipoFondo();
            $estadoFondo = $arlVO->getEstadoFondo();
            /* if (empty($auxNormasArl)) {
                $auxNormasArl = null;
            }
            if (empty($auxContableArl)) {
                $auxContableArl = null;
            }
            if (empty($auxFiscalArl)) {
                $auxFiscalArl = null;
            }*/
            $respuesta = $conexion->prepare($this->getSql("CONSULTAR_CODIGO_ARL", self::RUTA_SQL));
            $respuesta->bind_param('ss', $nombreArl, $codigo);
            $respuesta->execute();
            $resultado = $respuesta->get_result();
            $row = $resultado->fetch_assoc();
            if (count($row) === 0) {
                $respuesta = $conexion->prepare($this->getSql("REGISTRAR_ARL", self::RUTA_SQL));
                $respuesta->bind_param('sssssss', $codigo, $nombreArl, $tipoDocumentoArl, $numDocumentoArl, $tipoFondo, $codAdministradora, $estadoFondo);
                $filasAfectadas = $respuesta->execute();
                $idArl = mysqli_insert_id($conexion);
                //die(var_dump($filasAfectadas));
                if ($filasAfectadas > 0) {
                    $respuesta = $conexion->prepare($this->getSql("REGISTRAR_ARL_DETALLE", self::RUTA_SQL));
                    // die(var_dump($idArl, $riesgoCero, $riesgoUno, $riesgoDos, $riesgoTres, $riesgoCuatro, $riesgoCinco, $riesgoSeis, $riesgoSiete, $auxContableArl, $auxFiscalArl, $auxNormasArl, $fuenteContable));
                    $respuesta->bind_param('sssssssss', $idArl, $riesgoCero, $riesgoUno, $riesgoDos, $riesgoTres, $riesgoCuatro, $riesgoCinco, $riesgoSeis, $riesgoSiete);

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


    function visualizarArl($dt_parram, $params)
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $filters = $dt_parram['columns'];
            $columns = array(
                0 => 'ARL_ID',
                1 => 'CODIGO',
                2 => 'RAZON_SOCIAL',
                3 => 'TIPO_DOCUMENTO',
                4 => 'NUMERO_DOCUMENTO'
            );
            $sql = "SELECT
                    ARL.ARL_ID AS ARL_ID,
                    ARL.ARL_CODIGO AS CODIGO,
                    ARL.ARL_DESCRIPCION AS RAZON_SOCIAL,
                    TIP.TIP_DESCRIPCION AS TIPO_DOCUMENTO,
                    ARL.TIP_ID AS TIPO_DOCUMENTO_ID,
                    ARL.ARL_DOCUMENTO AS NUMERO_DOCUMENTO,
                    TPF.TPF_DESCRIPCION AS TIPO_DE_FONDO,
                    TPF.TPF_ID AS TIPO_DE_FONDO_ID,
                    ARL.ARL_CODADMIN AS COD_ADMINISTRADORA,
                    CASE
                    WHEN ARL.ARL_ESTADO = 'A' THEN
                    'ACTIVO' 
                    WHEN ARL.ARL_ESTADO = 'I' THEN
                    'INACTIVO' 
                    END AS ESTADO_ARL,
                    ARL.ARL_ESTADO AS ESTADO_ARL_ID,
                    ARLD.ARLD_RIESGO_CERO AS RIESGO_CERO,
                    ARLD.ARLD_RIESGO_UNO AS RIESGO_UNO,
                    ARLD.ARLD_RIESGO_DOS AS RIESGO_DOS,
                    ARLD.ARLD_RIESGO_TRES AS RIESGO_TRES,
                    ARLD.ARLD_RIESGO_CUATRO AS RIESGO_CUATRO,
                    ARLD.ARLD_RIESGO_CINCO AS RIESGO_CINCO,
                    ARLD.ARLD_RIESGO_SEIS AS RIESGO_SEIS,
                    ARLD.ARLD_RIESGO_SIETE AS RIESGO_SIETE 
                    FROM
                    ARL ARL
                    INNER JOIN ARL_DETALLE ARLD ON ARLD.ARL_ID = ARL.ARL_ID
                    INNER JOIN TIPO_DOCUMENTO TIP ON TIP.TIP_ID = ARL.TIP_ID
                    INNER JOIN TIPO_DE_FONDO TPF ON TPF.TPF_ID = ARL.TPF_ID";
            $query = mysqli_query($conexion, $sql) or die("error");
            $totalData = mysqli_num_rows($query);
            $totalFiltered = $totalData;
            if (!empty($dt_parram['search']['value'])) {
                $sql .= " WHERE (ARL.ARL_CODIGO LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR ARL.ARL_DESCRIPCION LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR ARL.ARL_DOCUMENTO LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR  TPF.TPF_DESCRIPCION LIKE '" . $dt_parram['search']['value'] . "%' )";
            }
            $sql .= " ORDER BY " . $columns[$dt_parram['order'][0]['column']] . "   " . $dt_parram['order'][0]['dir'] . "   LIMIT " . $dt_parram['start'] . " ," . $dt_parram['length'] . "   ";
            $query = mysqli_query($conexion, $sql) or die("error");
            $rawdata = array();
            while ($row = mysqli_fetch_array($query)) {
                $rawdata[] = array(
                    "ARL_ID" => $row['ARL_ID'],
                    "CODIGO" => $row['CODIGO'],
                    "RAZON_SOCIAL" => $row['RAZON_SOCIAL'],
                    "TIPO_DOCUMENTO" => $row['TIPO_DOCUMENTO'],
                    "TIPO_DOCUMENTO_ID" => $row['TIPO_DOCUMENTO_ID'],
                    "NUMERO_DOCUMENTO" => $row['NUMERO_DOCUMENTO'],
                    "TIPO_DE_FONDO" => $row['TIPO_DE_FONDO'],
                    "TIPO_DE_FONDO_ID" => $row['TIPO_DE_FONDO_ID'],
                    "COD_ADMINISTRADORA" => $row['COD_ADMINISTRADORA'],
                    "ESTADO_ARL" => $row['ESTADO_ARL'],
                    "ESTADO_ARL_ID" => $row['ESTADO_ARL_ID'],
                    "RIESGO_CERO" => $row['RIESGO_CERO'],
                    "RIESGO_UNO" => $row['RIESGO_UNO'],
                    "RIESGO_DOS" => $row['RIESGO_DOS'],
                    "RIESGO_TRES" => $row['RIESGO_TRES'],
                    "RIESGO_CUATRO" => $row['RIESGO_CUATRO'],
                    "RIESGO_CINCO" => $row['RIESGO_CINCO'],
                    "RIESGO_SEIS" => $row['RIESGO_SEIS'],
                    "RIESGO_SIETE" => $row['RIESGO_SIETE']
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

    function actualizarArl(ArlVO $arlVO)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $conexion->begin_transaction();
            $conexion->autocommit(false);
            $codigo = $arlVO->getCodigoArl();
            $nombreArl = $arlVO->getNombreArl();
            $tipoDocumentoArl = $arlVO->getTipoDocumento();
            $numDocumentoArl = $arlVO->getNumDocumento();
            $codAdministradora = $arlVO->getCodAministradorArl();
            $riesgoCero = $arlVO->getRiesgoCero();
            $riesgoUno = $arlVO->getRiesgoUno();
            $riesgoDos = $arlVO->getRiesgoDos();
            $riesgoTres = $arlVO->getRiesgoTres();
            $riesgoCuatro = $arlVO->getRiesgoCuatro();
            $riesgoCinco = $arlVO->getRiesgoCinco();
            $riesgoSeis = $arlVO->getRiesgoSeis();
            $riesgoSiete = $arlVO->getRiesgoSiete();
            /*$auxContableArl = $arlVO->getAuxContableArl();
            $auxFiscalArl = $arlVO->getAuxFiscalArl();
            $auxNormasArl = $arlVO->getAuxNormasArl();
            $fuenteContable = $arlVO->getFuenteContable();*/
            $tipoFondo = $arlVO->getTipoFondo();
            $estadoFondo = $arlVO->getEstadoFondo();
            $idArl = $arlVO->getIdArl();
            /* if (empty($auxNormasArl)) {
                $auxNormasArl = null;
            }
            if (empty($auxContableArl)) {
                $auxContableArl = null;
            }
            if (empty($auxNormasArl)) {
                $$auxNormasArl = null;
            }*/
            $respuesta = $conexion->prepare($this->getSql("ACTUALIZAR_ARL", self::RUTA_SQL));
            $respuesta->bind_param('ssssssss', $codigo, $nombreArl, $tipoDocumentoArl, $numDocumentoArl, $codAdministradora, $tipoFondo, $estadoFondo, $idArl);
            $filasAfectadas = $respuesta->execute() or dir($respuesta->error);
            if ($filasAfectadas > 0) {
                $respuesta = $conexion->prepare($this->getSql("ACTUALIZAR_ARL_DETALLE", self::RUTA_SQL));
                $respuesta->bind_param('sssssssss', $riesgoCero, $riesgoUno, $riesgoDos, $riesgoTres, $riesgoCuatro, $riesgoCinco, $riesgoSeis, $riesgoSiete, $idArl);
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

    function eliminarArl(ArlVO $ArlVO)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("ELIMINAR_ARL_DETALLE", self::RUTA_SQL));
            $idArl = $ArlVO->getIdArl();
            $respuesta->bind_param('s', $idArl);
            $filasAfectadas = $respuesta->execute() or ($respuesta->error);
            if ($filasAfectadas > 0) {
                $respuesta = $conexion->prepare($this->getSql("ELIMINAR_ARL", self::RUTA_SQL));
                $respuesta->bind_param('s', $idArl);
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
}
