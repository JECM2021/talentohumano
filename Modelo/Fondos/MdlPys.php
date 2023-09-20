<?php
require_once '../../Conexion/Conexion.php';

class mdlFondos extends Conexion
{
    const RUTA_SQL = "../../Modelo/Fondos/sqlPys.xml";

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

    function listarcomboFondo()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::CONTABLE);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_FONDOS", self::RUTA_SQL));
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

    function listarcomboFondoEps()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::CONTABLE);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_FONDOS", self::RUTA_SQL));
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

    function listarComboTipoDocumentoEps()
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

    function registrarfondo(FondosVO $fondosVO)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $fondoDe = $fondosVO->getFondeDe();
            $codigo = $fondosVO->getCodigo();
            $nombre = $fondosVO->getNombreFondo();
            $tipoDocumento = $fondosVO->getTipoDocumento();
            $numDocumento = $fondosVO->getNumDocumento();
            $codAdmin = $fondosVO->getCodAdministrador();
            $porcPension = $fondosVO->getPorcPension();
            /*$auxContablePension = $fondosVO->getAuxContablePension();
            $auxFiscalPension = $fondosVO->getAuxFiscalPension();
            $auxNormasPension = $fondosVO->getAuxNormasPension();*/
            $porcFsp = $fondosVO->getPorcFsp();
            /* $auxContableFsp = $fondosVO->getAuxContableFsp();
            $auxFiscalFsp = $fondosVO->getAuxFiscalFsp();
            $auxNormasFsp = $fondosVO->getAuxNormasFsp();*/
            $porcEdu = $fondosVO->getPorcEdu();
            /*$auxContableEdu = $fondosVO->getAuxContableEdu();
            $auxFiscalEdu = $fondosVO->getAuxFiscalEdu();
            $auxNormasEdu = $fondosVO->getAuxNormasEdu();*/
            $tipoDeFondo = $fondosVO->getTipoFondo();
            $estadoFondo = $fondosVO->getEstadoFondo();
            $respuesta = $conexion->prepare($this->getSql("CONSULTAR_CODIGO_FONDO", self::RUTA_SQL));
            $respuesta->bind_param('ss', $nombre, $codigo);
            $respuesta->execute();
            $resultado = $respuesta->get_result();
            $row = $resultado->fetch_assoc();
            //  die(var_dump($row));
            if (count($row) === 0) {
                $respuesta = $conexion->prepare($this->getSql("REGISTRAR_FONDOS", self::RUTA_SQL));
                $respuesta->bind_param('ssssssss', $fondoDe, $codAdmin, $nombre, $tipoDocumento, $numDocumento, $codigo, $estadoFondo, $tipoDeFondo);
                $filasAfectadas = $respuesta->execute();
                $idFondo = mysqli_insert_id($conexion);
                //die(var_dump($idFondo));
                if ($filasAfectadas > 0) {
                    $respuesta = $conexion->prepare($this->getSql("REGISTRAR_FONDOS_DETALLE", self::RUTA_SQL));
                    $respuesta->bind_param('ssss', $idFondo, $porcPension, $porcFsp, $porcEdu);
                    $filasAfectadas = $respuesta->execute();
                    //  die(var_dump($filasAfectadas));
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

    function actualizarfondo(FondosVO $fondosVO)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $conexion->begin_transaction();
            $conexion->autocommit(false);
            $fondoDe = $fondosVO->getFondeDe();
            $codigo = $fondosVO->getCodigo();
            $nombre = $fondosVO->getNombreFondo();
            $tipoDocumento = $fondosVO->getTipoDocumento();
            $numDocumento = $fondosVO->getNumDocumento();
            $codAdmin = $fondosVO->getCodAdministrador();
            $porcPension = $fondosVO->getPorcPension();
            /*$auxContablePension = $fondosVO->getAuxContablePension();
            $auxFiscalPension = $fondosVO->getAuxFiscalPension();
            $auxNormasPension = $fondosVO->getAuxNormasPension();*/
            $porcFsp = $fondosVO->getPorcFsp();
            /*$auxContableFsp = $fondosVO->getAuxContableFsp();
            $auxFiscalFsp = $fondosVO->getAuxFiscalFsp();
            $auxNormasFsp = $fondosVO->getAuxNormasFsp();*/
            $porcEdu = $fondosVO->getPorcEdu();
            /*$auxContableEdu = $fondosVO->getAuxContableEdu();
            $auxFiscalEdu = $fondosVO->getAuxFiscalEdu();
            $auxNormasEdu = $fondosVO->getAuxNormasEdu();*/
            $tipoDeFondo = $fondosVO->getTipoFondo();
            $estadoFondo = $fondosVO->getEstadoFondo();
            $idFondo = $fondosVO->getIdFondo();
            // die(var_dump($porcPension, $porcFsp, $porcEdu, $idFondo));
            $respuesta = $conexion->prepare($this->getSql("ACTUALIZAR_FONDOS", self::RUTA_SQL));
            $respuesta->bind_param('sssssssss', $fondoDe, $codAdmin, $nombre, $tipoDocumento, $numDocumento, $codigo, $estadoFondo, $tipoDeFondo, $idFondo);
            $filasAfectadas = $respuesta->execute() or dir($respuesta->error);
            if ($filasAfectadas > 0) {
                $respuesta = $conexion->prepare($this->getSql("ACTUALIZAR_FONDOS_DETALLE", self::RUTA_SQL));
                $respuesta->bind_param('ssss', $porcPension, $porcFsp, $porcEdu, $idFondo);
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

    function eliminarDatosFondoPension(FondosVO $fondosVO)
    {
        try {
            $conexion = $this->conectarBd(self::CONTABLE);
            $respuesta = $conexion->prepare($this->getSql("ELIMINAR_PENSION_DETALLE", self::RUTA_SQL));
            $idFondo = $fondosVO->getIdFondo();
            $respuesta->bind_param('s', $idFondo);
            $filasAfectadas = $respuesta->execute() or ($respuesta->error);
            if ($filasAfectadas > 0) {
                $respuesta = $conexion->prepare($this->getSql("ELIMINAR_PENSION", self::RUTA_SQL));
                $respuesta->bind_param('s', $idFondo);
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

    function eliminarDatosFondoEps(FondosVO $fondosVO)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("ELIMINAR_EPS_DETALLE", self::RUTA_SQL));
            $idFondo = $fondosVO->getIdFondo();
            $respuesta->bind_param('s', $idFondo);
            $filasAfectadas = $respuesta->execute() or ($respuesta->error);
            if ($filasAfectadas > 0) {
                $respuesta = $conexion->prepare($this->getSql("ELIMINAR_EPS", self::RUTA_SQL));
                $respuesta->bind_param('s', $idFondo);
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

    function actualizarfondoeps(FondosVO $fondosVO)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $conexion->begin_transaction();
            $conexion->autocommit(false);
            $fondoDe = $fondosVO->getFondeDe();
            $codigoEps = $fondosVO->getCodigo();
            $nombreEps = $fondosVO->getNombreFondo();
            $tipoDocumentoEps = $fondosVO->getTipoDocumento();
            $numeroDocumentoEps = $fondosVO->getNumDocumento();
            $codAdminEps = $fondosVO->getCodAdministrador();
            $porcSalud = $fondosVO->getPorcSalud();
            /*$auxContableEps = $fondosVO->getAuxContableEps();
            $auxFiscalEps = $fondosVO->getAuxFiscalEps();
            $auxNormasEps = $fondosVO->getAuxNormasEps();*/
            $tipoDeFondoEps = $fondosVO->getTipoFondo();
            $estadoFondoEps = $fondosVO->getEstadoFondo();
            $idFondoEps = $fondosVO->getIdFondo();

            $respuesta = $conexion->prepare($this->getSql("ACTUALIZAR_FONDOS_EPS", self::RUTA_SQL));
            $respuesta->bind_param('sssssssss', $fondoDe, $codAdminEps, $nombreEps, $tipoDocumentoEps, $numeroDocumentoEps, $codigoEps, $estadoFondoEps, $tipoDeFondoEps, $idFondoEps);
            $filasAfectadas = $respuesta->execute() or dir($respuesta->error);
            if ($filasAfectadas > 0) {
                $respuesta = $conexion->prepare($this->getSql("ACTUALIZAR_FONDOS_DETALLE_EPS", self::RUTA_SQL));
                $respuesta->bind_param('ss', $porcSalud, $idFondoEps);
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


    function registrarfondoEps(FondosVO $fondosVO)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $fondoDe = $fondosVO->getFondeDe();
            $codigo = $fondosVO->getCodigo();
            $nombre = $fondosVO->getNombreFondo();
            $tipoDocumento = $fondosVO->getTipoDocumento();
            $numDocumento = $fondosVO->getNumDocumento();
            $codAdmin = $fondosVO->getCodAdministrador();
            $porcSalud = $fondosVO->getPorcSalud();
            /*$auxContableEps = $fondosVO->getAuxContableEps();*/
            $tipoDeFondoEps = $fondosVO->getTipoFondo();
            $estadoFondoEps = $fondosVO->getEstadoFondo();
            /*$auxFiscalEps = $fondosVO->getAuxFiscalEps();
            $auxNormasEps = $fondosVO->getAuxNormasEps();*/
            $respuesta = $conexion->prepare($this->getSql("CONSULTAR_CODIGO_FONDO_EPS", self::RUTA_SQL));
            $respuesta->bind_param('ss', $nombre, $codigo);
            $respuesta->execute();
            $resultado = $respuesta->get_result();
            $row = $resultado->fetch_assoc();
            //die(var_dump($row));
            if (count($row) === 0) {
                $respuesta = $conexion->prepare($this->getSql("REGISTRAR_FONDOS_EPS", self::RUTA_SQL));
                $respuesta->bind_param('ssssssss', $fondoDe, $codAdmin, $nombre, $tipoDocumento, $numDocumento, $codigo, $estadoFondoEps, $tipoDeFondoEps);
                $filasAfectadas = $respuesta->execute();
                $idFondo = mysqli_insert_id($conexion);
                if ($filasAfectadas > 0) {
                    $respuesta = $conexion->prepare($this->getSql("REGISTRAR_FONDOS_DETALLE_EPS", self::RUTA_SQL));
                    $respuesta->bind_param('ss', $idFondo, $porcSalud);
                    $filasAfectadas = $respuesta->execute();
                    //  die(var_dump($filasAfectadas));
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

    function visualizarFondosPension($dt_parram, $params)
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $filters = $dt_parram['columns'];
            $columns = array(
                0 => 'FONDO_ID',
                1 => 'CODIGO',
                2 => 'RAZON_SOCIAL',
                3 => 'ESTADO'

            );
            $sql = "SELECT
            FD.FOND_ID AS FONDO_ID,
            FD.FOND_CODIGO AS CODIGO,
            FD.FOND_DESCRIPCION AS RAZON_SOCIAL,
            TD.TIP_DESCRIPCION AS TIPO_DOCUMENTO,
            TD.TIP_ID AS TIPO_DOCUMENTO_ID,
            FD.FOND_DOCUMENTO AS NUMERO_DOCUMENTO,
            TPF.TPF_DESCRIPCION AS TIPO_DE_FONDO,
            TPF.TPF_ID AS TIPO_DE_DONDO_ID,
            FD.FOND_COD_ADMIN AS COD_ADMISINISTRADORA,
            CASE
            WHEN FD.FOND_ESTADO = 'A' THEN
            'ACTIVO' 
            WHEN FD.FOND_ESTADO = 'I' THEN
            'INACTIVO' 
            END AS ESTADO_FONDO,
            FD.FOND_ESTADO AS ESTADO,
            FDD.POR_PENSION AS PORC_PENSION,
            FDD.POR_FSP AS PORC_FSP,
            FDD.POR_EDU AS PORC_EDU 
            FROM
            FONDOS FD
            INNER JOIN TIPO_DOCUMENTO TD ON TD.TIP_ID = FD.TIP_ID
            INNER JOIN TIPO_DE_FONDO TPF ON TPF.TPF_ID = FD.TPF_ID
            INNER JOIN FONDOS_DETALLE FDD ON FDD.FOND_ID = FD.FOND_ID 
            WHERE
            FD.TFOE_ID = 1";
            $query = mysqli_query($conexion, $sql) or die("error");
            $totalData = mysqli_num_rows($query);
            $totalFiltered = $totalData;
            if (!empty($dt_parram['search']['value'])) {
                $sql .= " AND (FD.FOND_CODIGO LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR FD.FOND_DESCRIPCION LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR FD.FOND_ESTADO LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR FD.FOND_DOCUMENTO LIKE '" . $dt_parram['search']['value'] . "%' )";
            }
            $sql .= " ORDER BY " . $columns[$dt_parram['order'][0]['column']] . "   " . $dt_parram['order'][0]['dir'] . "   LIMIT " . $dt_parram['start'] . " ," . $dt_parram['length'] . "   ";
            $query = mysqli_query($conexion, $sql) or die("error");
            $rawdata = array();
            while ($row = mysqli_fetch_array($query)) {
                $rawdata[] = array(
                    "FONDO_ID" => $row['FONDO_ID'],
                    "CODIGO" => $row['CODIGO'],
                    "RAZON_SOCIAL" => $row['RAZON_SOCIAL'],
                    "TIPO_DOCUMENTO" => $row['TIPO_DOCUMENTO'],
                    "TIPO_DOCUMENTO_ID" => $row['TIPO_DOCUMENTO_ID'],
                    "NUMERO_DOCUMENTO" => $row['NUMERO_DOCUMENTO'],
                    "TIPO_DE_FONDO" => $row['TIPO_DE_FONDO'],
                    "TIPO_DE_DONDO_ID" => $row['TIPO_DE_DONDO_ID'],
                    "COD_ADMISINISTRADORA" => $row['COD_ADMISINISTRADORA'],
                    "ESTADO_FONDO" => $row['ESTADO_FONDO'],
                    "ESTADO" => $row['ESTADO'],
                    "PORC_PENSION" => $row['PORC_PENSION'],
                    "PORC_FSP" => $row['PORC_FSP'],
                    "PORC_EDU" => $row['PORC_EDU']
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


    function visualizarFondosEps($dt_parram, $params)
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $filters = $dt_parram['columns'];
            $columns = array(
                0 => 'FONDO_ID',
                1 => 'CODIGO',
                2 => 'RAZON_SOCIAL',
                3 => 'ESTADO'

            );
            $sql = "SELECT
            FD.FOND_ID AS FONDO_ID,
            FD.FOND_CODIGO AS CODIGO,
            FD.FOND_DESCRIPCION AS RAZON_SOCIAL,
            TD.TIP_DESCRIPCION AS TIPO_DOCUMENTO,
            TD.TIP_ID AS TIPO_DOCUMENTO_ID,
            FD.FOND_DOCUMENTO AS NUMERO_DOCUMENTO,
            TPF.TPF_DESCRIPCION AS TIPO_DE_FONDO,
            TPF.TPF_ID AS TIPO_DE_DONDO_ID,
            FD.FOND_COD_ADMIN AS COD_ADMISINISTRADORA,
            CASE
            WHEN FD.FOND_ESTADO = 'A' THEN
            'ACTIVO' 
            WHEN FD.FOND_ESTADO = 'I' THEN
            'INACTIVO' 
            END AS ESTADO_FONDO,
            FD.FOND_ESTADO AS ESTADO,
            FDD.POR_SALUD AS PORC_SALUD
            FROM
            FONDOS FD
            INNER JOIN CLINICASV.TIPO_DOCUMENTO TD ON TD.TIP_ID = FD.TIP_ID
            INNER JOIN TIPO_DE_FONDO TPF ON TPF.TPF_ID = FD.TPF_ID
            INNER JOIN FONDOS_DETALLE FDD ON FDD.FOND_ID = FD.FOND_ID
            WHERE
            FD.TFOE_ID = 2";
            $query = mysqli_query($conexion, $sql) or die("error");
            $totalData = mysqli_num_rows($query);
            $totalFiltered = $totalData;
            if (!empty($dt_parram['search']['value'])) {
                $sql .= " AND (FD.FOND_CODIGO LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR FD.FOND_DESCRIPCION LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR FD.FOND_ESTADO LIKE '" . $dt_parram['search']['value'] . "%' ";
                $sql .= " OR FD.FOND_DOCUMENTO LIKE '" . $dt_parram['search']['value'] . "%' )";
            }
            $sql .= " ORDER BY " . $columns[$dt_parram['order'][0]['column']] . "   " . $dt_parram['order'][0]['dir'] . "   LIMIT " . $dt_parram['start'] . " ," . $dt_parram['length'] . "   ";
            $query = mysqli_query($conexion, $sql) or die("error");
            $rawdata = array();
            while ($row = mysqli_fetch_array($query)) {
                $rawdata[] = array(
                    "CODIGO" => $row['CODIGO'],
                    "RAZON_SOCIAL" => $row['RAZON_SOCIAL'],
                    "TIPO_DOCUMENTO" => $row['TIPO_DOCUMENTO'],
                    "TIPO_DE_DONDO_ID" => $row['TIPO_DE_DONDO_ID'],
                    "NUMERO_DOCUMENTO" => $row['NUMERO_DOCUMENTO'],
                    "TIPO_DE_FONDO" => $row['TIPO_DE_FONDO'],
                    "COD_ADMISINISTRADORA" => $row['COD_ADMISINISTRADORA'],
                    "ESTADO_FONDO" => $row['ESTADO_FONDO'],
                    "ESTADO" => $row['ESTADO'],
                    "PORC_SALUD" => $row['PORC_SALUD'],
                    "TIPO_DOCUMENTO_ID" => $row['TIPO_DOCUMENTO_ID'],
                    "FONDO_ID" => $row['FONDO_ID']
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
}
