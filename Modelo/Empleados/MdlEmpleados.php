<?php
require_once '../../Conexion/Conexion.php';
class mdlEmpleados extends Conexion
{
    const RUTA_SQL = "../../Modelo/Empleados/sqlEmpleados.xml";

    function listarComboTipoDocumento()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            //die(var_dump($conexion));
            $respuesta = $conexion->prepare($this->getSql("LISTAR_COMBO_TIPO_DOCUMENTO", self::RUTA_SQL));
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

    function listarComboEstadoCivil()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_COMBO_ESTADO_CIVIL", self::RUTA_SQL));
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

    function listarComboSexo()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_COMBO_SEXO", self::RUTA_SQL));
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

    function listarComboGrupoSanguineo()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_COMBO_GRUPO_SANGUINEO", self::RUTA_SQL));
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

    function listarComboEscolaridad()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_COMBO_ESCOLARIDAD", self::RUTA_SQL));
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

    function listarComboNivelSocioEconomico()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_NIVEL_SOCIOECONOMICO", self::RUTA_SQL));
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

    function listarComboDepartamento()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_DEPARTAMENTOS", self::RUTA_SQL));
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

    function listarComboCiudad($idDepartamento)
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_CIUDAD", self::RUTA_SQL));
            $respuesta->bind_param('s', $idDepartamento);
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

    function registrarEmpleados(EmpleadosVO $empleadosVO)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $tipoDocumento = $empleadosVO->getTipoDocumento();
            $numDocumento = $empleadosVO->getNumDocumento();
            $primerNombre = $empleadosVO->getPrimerNombre();
            $segundoNombre = $empleadosVO->getSegundoNombre();
            $primerApellido = $empleadosVO->getPrimerApellido();
            $segundoApellido = $empleadosVO->getSegundoApellido();
            $fechaNacimiento = $empleadosVO->getFechaNacimiento();
            $departamento = $empleadosVO->getDepartamento();
            $ciudad = $empleadosVO->getCiudad();
            $estadoCivil = $empleadosVO->getEstadoCivil();
            $sexo = $empleadosVO->getSexo();
            $grupoSanguineo = $empleadosVO->getGrupoSanguineo();
            $estratoSocial = $empleadosVO->getEstratoSocial();
            $correo = $empleadosVO->getCorreo();
            $nivelEscolaridad = $empleadosVO->getNivelEscolaridad();
            $estado = $empleadosVO->getEstado();
            $idEmpleado = $empleadosVO->getIdEmpleado();
            $edad = $empleadosVO->getEdad();
            $telefono = $empleadosVO->getTelefono();
            $direccion = $empleadosVO->getDireccion();
            $barrio = $empleadosVO->getBarrio();

            $respuesta = $conexion->prepare($this->getSql("CONSULTAR_DOCUMENTO_EMPLEADO", self::RUTA_SQL));
            $respuesta->bind_param('s', $numDocumento);
            $respuesta->execute();
            $resultado = $respuesta->get_result();
            $row = $resultado->fetch_assoc();
            if (count($row) === 0) {
                $respuesta = $conexion->prepare($this->getSql("REGISTRAR_DOCUMENTO", self::RUTA_SQL));
                // die(var_dump($tipoDocumento, $numDocumento, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fechaNacimiento, $departamento, $ciudad, $estadoCivil, $sexo, $grupoSanguineo, $estratoSocial, $correo, $nivelEscolaridad, $estado));
                $respuesta->bind_param('ssssssssssssssssssss', $tipoDocumento, $numDocumento, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fechaNacimiento, $departamento, $ciudad, $estadoCivil, $sexo, $grupoSanguineo, $estratoSocial, $correo, $nivelEscolaridad, $estado, $edad, $telefono, $direccion, $barrio);
                $filasAfectadas = $respuesta->execute() or ($respuesta->error);
                if ($filasAfectadas > 0) {
                    $filasAfectadas = mysqli_insert_id($conexion);
                } else {
                    $filasAfectadas = $respuesta->error;
                }
            } else {
                $filasAfectadas = -1;
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

    function buscarEmpleados(EmpleadosVO $empleadosVO)
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $numDocumento = $empleadosVO->getNumDocumento();
            $respuesta = $conexion->prepare($this->getSql("CONSULTAR_EMPLEADOS", self::RUTA_SQL));
            $respuesta->bind_param('s', $numDocumento);
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "IDEMPLEADO" => $row['IDEMPLEADO'],
                    "TIPODOCUMENTO" => $row['TIPODOCUMENTO'],
                    "NUMDOCUMENTO" => $row['NUMDOCUMENTO'],
                    "PRIMERNOMBRE" => $row['PRIMERNOMBRE'],
                    "SEGUNDONOMBRE" => $row['SEGUNDONOMBRE'],
                    "PRIMERAPELLIDO" => $row['PRIMERAPELLIDO'],
                    "SEGUNDOAPELLIDO" => $row['SEGUNDOAPELLIDO'],
                    "FECHANACIMIENTO" => $row['FECHANACIMIENTO'],
                    "DEPARTAMENTO" => $row['DEPARTAMENTO'],
                    "CIUDAD" => $row['CIUDAD'],
                    "ESTADOCIVIL" => $row['ESTADOCIVIL'],
                    "SEXO" => $row['SEXO'],
                    "GRUPOSANGUINEO" => $row['GRUPOSANGUINEO'],
                    "ESTRATOSOCIAL" => $row['ESTRATOSOCIAL'],
                    "EMAIL" => $row["EMAIL"],
                    "NIVELESCOLAR" => $row['NIVELESCOLAR'],
                    "ESTADO" => $row['ESTADO'],
                    "EDAD" => $row['EDAD'],
                    "TELEFONO" => $row['TELEFONO'],
                    "DIRECCION" => $row['DIRECCION'],
                    "BARRIO" => $row['BARRIO']
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

    function actulizarDatosEmpleado(EmpleadosVO $empleadosVO)
    {
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $tipoDocumento = $empleadosVO->getTipoDocumento();
            $numDocumento = $empleadosVO->getNumDocumento();
            $primerNombre = $empleadosVO->getPrimerNombre();
            $segundoNombre = $empleadosVO->getSegundoNombre();
            $primerApellido = $empleadosVO->getPrimerApellido();
            $segundoApellido = $empleadosVO->getSegundoApellido();
            $fechaNacimiento = $empleadosVO->getFechaNacimiento();
            $departamento = $empleadosVO->getDepartamento();
            $ciudad = $empleadosVO->getCiudad();
            $estadoCivil = $empleadosVO->getEstadoCivil();
            $sexo = $empleadosVO->getSexo();
            $grupoSanguineo = $empleadosVO->getGrupoSanguineo();
            $estratoSocial = $empleadosVO->getEstratoSocial();
            $correo = $empleadosVO->getCorreo();
            $nivelEscolaridad = $empleadosVO->getNivelEscolaridad();
            $estado = $empleadosVO->getEstado();
            $idEmpleado = $empleadosVO->getIdEmpleado();
            $edad = $empleadosVO->getEdad();
            $telefono = $empleadosVO->getTelefono();
            $direccion = $empleadosVO->getDireccion();
            $barrio = $empleadosVO->getBarrio();
            $respuesta = $conexion->prepare($this->getSql("ACTUALIZAR_EMPLEADO", self::RUTA_SQL));
            // die(var_dump($numDocumento));
            //die(var_dump($tipoDocumento, $numDocumento, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fechaNacimiento, $departamento, $ciudad, $estadoCivil, $sexo, $grupoSanguineo, $estratoSocial, $correo, $nivelEscolaridad, $estado, $idEmpleado));
            $respuesta->bind_param('sssssssssssssssssssss', $tipoDocumento, $numDocumento, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $fechaNacimiento, $departamento, $ciudad, $estadoCivil, $sexo, $grupoSanguineo, $estratoSocial, $correo, $nivelEscolaridad, $estado, $edad, $telefono, $direccion, $barrio, $idEmpleado);
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
    function visualizarEmpleados($dt_parram, $params)
    {
        $conexion = $this->conectarBd(self::ASISTENCIAL);
        $filters = $dt_parram['columns'];
        $columns = array(
            0 => 'TIP.TIP_DESCRIPCION',
            1 => 'EMPL.EMPL_PRIMER_APELLIDO',
            2 => 'NVE.NDE_DESCRIPCION',
            3 => 'EMPL.EMPL_CORREO',
            4 => 'EMPL.EMPL_ESTADO'
        );
        $sql = "SELECT
                EMPL.EMPL_ID AS EMPLEADO_ID,
                UPPER(TIP.TIP_DESCRIPCION) AS TIPO_DOCUMENTO,
                EMPL.NUM_DOCUMENTO AS NUMERO_DOCUMENTO,
                UPPER(CONCAT(EMPL.EMPL_PRIMER_APELLIDO,' ',EMPL.EMPL_SEGUNDO_APELLIDO,' ',EMPL.EMPL_PRIMER_NOMBRE,' ',EMPL.EMPLE_SEGUNDO_NOMBRE)) AS NOMBRES_APELLIDOS,
                UPPER(NVE.NDE_DESCRIPCION) AS NIVEL_ESCOLARIDAD,
                UPPER(EMPL.EMPL_CORREO) AS EMAIL,
                CASE
                WHEN EMPL.EMPL_ESTADO = 'A'THEN 'ACTIVO'
                WHEN EMPL.EMPL_ESTADO = 'I'THEN 'INACTIVO'
                END AS ESTADO
                FROM
                EMPLEADOS EMPL
                INNER JOIN TIPO_DOCUMENTO TIP ON TIP.TIP_ID = EMPL.TIP_ID
                INNER JOIN NIVEL_DE_ESCOLARIDAD NVE ON NVE.NDE_ID = EMPL.NDE_ID";
        $query = mysqli_query($conexion, $sql) or die("error");
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;
        if (!empty($dt_parram['search']['value'])) {
            $sql .= " WHERE (EMPL.NUM_DOCUMENTO LIKE '" . $dt_parram['search']['value'] . "%' ";
            $sql .= " OR TIP.TIP_DESCRIPCION LIKE '" . $dt_parram['search']['value'] . "%' ";
            $sql .= " OR EMPL.EMPL_PRIMER_APELLIDO LIKE '" . $dt_parram['search']['value'] . "%' ";
            $sql .= " OR EMPL.EMPL_PRIMER_NOMBRE LIKE '" . $dt_parram['search']['value'] . "%' ";
            $sql .= " OR EMPL.EMPL_SEGUNDO_APELLIDO LIKE '" . $dt_parram['search']['value'] . "%' ";
            $sql .= " OR EMPL.EMPLE_SEGUNDO_NOMBRE LIKE '" . $dt_parram['search']['value'] . "%' ";
            $sql .= " OR NVE.NDE_DESCRIPCION LIKE '" . $dt_parram['search']['value'] . "%' ";
            $sql .= " OR EMPL.EMPL_CORREO LIKE '" . $dt_parram['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$dt_parram['order'][0]['column']] . "   " . $dt_parram['order'][0]['dir'] . "   LIMIT " . $dt_parram['start'] . " ," . $dt_parram['length'] . "   ";
        $query = mysqli_query($conexion, $sql) or die("error");
        $rawdata = array();
        while ($row = mysqli_fetch_array($query)) {
            $rawdata[] = array(
                "TIPO_DOCUMENTO" => $row['TIPO_DOCUMENTO'],
                "NOMBRES_APELLIDOS" => $row['NOMBRES_APELLIDOS'],
                "NIVEL_ESCOLARIDAD" => $row['NIVEL_ESCOLARIDAD'],
                "EMAIL" => $row['EMAIL'],
                "ESTADO" => $row['ESTADO'],
                "NUMERO_DOCUMENTO" => $row['NUMERO_DOCUMENTO']
            );
        }
        $json_data = array(
            "draw" => intval($dt_parram['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $rawdata

        );

        return json_encode($json_data);
    }
}
