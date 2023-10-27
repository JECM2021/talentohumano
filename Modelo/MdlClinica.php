<?php

require_once '/../Modelo/Bean/MenuVO.php';
require_once '/../Conexion/Conexion.php';

class MdlClinica extends Conexion
{

    const RUTA_SQL = "../Modelo/sqlPublic.xml";

    function loguearUsuario(UsuariosVO $usuario)
    {
        $usuarioVO = null;
        try {
            $conexion = $this->conectarBd(self::CONFIGURACION);
            $respuesta = $conexion->prepare($this->getSql("LOGUEAR_USUARIO", self::RUTA_SQL));
            $emp = $usuario->getEmpresa();
            $usu = $usuario->getUsuusuario();
            $contrase = $usuario->getContrasena();
            $respuesta->bind_param('ss',  $usu, $contrase);
            $respuesta->execute();
            $res = $respuesta->get_result();
            $row = $res->fetch_assoc();
            if ($row) {
                $usuarioVO = new UsuariosVO();
                $usuarioVO->setIdUsuario($row['USU_ID']);
                $usuarioVO->setDocumento($row['USU_DOCUMENTO']);
                $usuarioVO->setNombreUsuario($row['NOMBRE']);
                $usuarioVO->setIdPeril($row['PER_ID']);
                /*$usuarioVO->setTerId($row['TER_ID']);*/
                $usuarioVO->setUsuusuario($row['USU_USUARIO']);
                /*$usuarioVO->setEmpresa($row['NOMBRE_EMPRESA']);
                $usuarioVO->setBdClinica($row['BD']);
                $usuarioVO->setLogo($row["LOGO"]);*/
            }
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $usuarioVO;
    }
    function obtenerMenu(UsuariosVO $usuariosVO)
    {
        $rawdata = array();
        try {
            $idUsuario = $usuariosVO->getIdUsuario();
            $idPerfil = $usuariosVO->getIdPeril();
            $conexion = $this->conectarBd(self::CONFIGURACION);
            $respuesta = $conexion->prepare($this->getSql("OBTENER_MENU_USUARIO", self::RUTA_SQL));
            $respuesta->bind_param('ss', $idUsuario, $idPerfil);
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "menu_id" => $row['MENU_ID'],
                    "pagina_menu" => $row['PAGINA_MENU'],
                    "icono_menu" => $row['ICONO_MENU']
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

    function obtenerPaginas($idMenu, $idPerfil, $usuId)
    {
        $rawdata = array();
        $i = 0;
        try {
            $conexion = $this->conectarBd(self::CONFIGURACION);
            $respuesta = $conexion->query("    
                                        SELECT perfil_paginas.pag_id,sof_nombre AS nombre, sof_url as url,sof_icono  as icono  
                                        FROM  configuracionesnom.perfil_paginas
                                        INNER JOIN configuracionesnom.paginas USING(pag_id)
                                        INNER JOIN configuracionesnom.menu men on men.men_id = paginas.men_id
                                        INNER JOIN configuracionesnom.perfil USING(per_id)
                                        INNER JOIN configuracionesnom.usuario USING(per_id)
                                        WHERE  men.tip_menu = 1 AND perfil.per_id = $idPerfil  AND usuario.usu_id = $usuId
                                        AND perfil_paginas.men_id =$idMenu AND perfil_paginas.prs_estado='A'
                                            ORDER by 2;
                                        ");
            while ($row = mysqli_fetch_array($respuesta)) {
                $rawdata[$i] = $row;
                $i++;
            }
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return $rawdata;
    }

    function obtenerSubMenu($idMenu, $idPerfil, $usuId)
    {
        $rawdata = array();
        $i = 0;
        try {
            $conexion = $this->conectarBd(self::CONFIGURACION);
            $respuesta = $conexion->query("    
                                        SELECT  
                                        menu.men_id as menu_id, menu.men_nombre   AS nombre,men_icono AS icono  FROM menu menu 
                                        INNER JOIN perfil_menu perfil_menu  
                                        ON  menu.men_id   =  perfil_menu.men_id
                                        INNER JOIN  usuario usu on perfil_menu.per_id =  usu.per_id
                                        WHERE menu.tip_menu = 1 AND  usu_id = $usuId AND perfil_menu.per_id = $idPerfil and menu.men_padre = $idMenu
                                        AND  prm_estado =  'A'  ORDER BY  men_order;
                                        ");
            while ($row = mysqli_fetch_array($respuesta)) {
                $rawdata[$i] = $row;
                $i++;
            }
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return $rawdata;
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


    function obtenerConsecutivoDocumento($tipoConsecutivo)
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->query("SELECT (consecutivo_documento.con_numero + 1) as consecutivo  FROM  consecutivo_documento WHERE  consecutivo_documento.doc_id = '$tipoConsecutivo';");
            if ($row = mysqli_fetch_array($respuesta)) {
                $rawdata[0] = $row;
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
    function visualizarMenuReportes(UsuariosVO $usuariosVO)
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::CONFIGURACION);
            $idUsuario = $usuariosVO->getIdUsuario();
            $idPerfil = $usuariosVO->getIdPeril();
            $respuesta = $conexion->prepare($this->getSql("VISUALIZAR_MENU_REPORTES", self::RUTA_SQL));
            $respuesta->bind_param('ii', $idUsuario, $idPerfil);
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "menu_id" => $row['menu_id'],
                    "pagina_menu" => $row['pagina_menu'],
                    "icono_menu" => $row['icono_menu']
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

    function visualizarPaginasReportes(UsuariosVO $usuariosVO)
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::CONFIGURACION);
            $respuesta = $conexion->prepare($this->getSql("VISUALIZAR_PAGINA_REPORTES", self::RUTA_SQL));
            $perfil = $usuariosVO->getIdPeril();
            $usuario = $usuariosVO->getIdUsuario();
            $respuesta->bind_param('ss', $perfil, $usuario);
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "pag_id" => $row['pag_id'],
                    "nombre" => $row['nombre'],
                    "url" => $row['url'],
                    "icono" => $row['icono'],
                    "men_id" => $row['men_id']
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

    function verificarUsuario($usuUsuario, $contraActual)
    {
        $usuarioVO = null;
        try {
            $conexion = $this->conectarBd(self::CONFIGURACION);
            $respuesta = $conexion->prepare($this->getSql("VERIFICAR_USUARIO", self::RUTA_SQL));
            $usuario = $usuUsuario;
            $contrasena = $contraActual;
            $respuesta->bind_param('ss', $usuario, $contrasena);
            $respuesta->execute();
            $res = $respuesta->get_result();
            $row = $res->fetch_assoc();
            if ($row) {
                $usuarioVO = new UsuariosVO();
                $usuarioVO->setUsuusuario($row['USUARIO']);
            }
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $usuarioVO;
    }

    function actualizarContrasena($usuUsuario, $contraNueva)
    {
        try {
            $con = $this->conectarBd(self::ASISTENCIAL);
            $ps = $con->prepare($this->getSql("ACTUALIZAR_CONTRASENA", self::RUTA_SQL));
            $usuario = $usuUsuario;
            $contrasena = $contraNueva;
            $ps->bind_param('ss', $contrasena, $usuario);
            $filasAfectadas = $ps->execute() or $ps->error;
            if ($filasAfectadas > 0) {
                $filasAfectadas = $con->affected_rows;
            }
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


    function operacionesUsuario(UsuariosVO $usuariosVO)
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::CONFIGURACION);
            $respuesta = $conexion->prepare($this->getSql("OPERACIOENS_USUARIO", self::RUTA_SQL));
            if ($respuesta) {
                $usuario = $usuariosVO->getIdUsuario();
                $respuesta->bind_param('s', $usuario);
                $respuesta->execute();
                $result = $respuesta->get_result();
                while ($row = $result->fetch_assoc()) {
                    $rawdata[] = array(
                        "OPE_NUMERO" => $row['OPE_NUMERO']
                    );
                }
            } else {
                echo 'error al intentar cargar las operaciones' . $conexion->error;
                exit;
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

    function menuContextualUsuario(UsuariosVO $usuariosVO)
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::CONFIGURACION);
            $respuesta = $conexion->prepare($this->getSql("MENU_CONTEXTUAL", self::RUTA_SQL));
            $usuario = $usuariosVO->getIdUsuario();
            $respuesta->bind_param('s', $usuario);
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "MEN_ID" => $row['MEN_ID'],
                    "NOMBRE" => $row['NOMBRE'],
                    "ICONO" => $row['ICONO']
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

    function listarComboEmpresa()
    {
        $rawdata = array();
        $i = 0;
        try {
            $conexion = $this->conectarBd(self::CONFIGURACION);
            $respuesta = $conexion->query("SELECT  REPLACE(EMP_RAZON_SOCIAL,'s.a.s','') as empresa, cod_empresa as codigo FROM EMPRESA");
            while ($row = mysqli_fetch_array($respuesta)) {
                $rawdata[$i] = $row;
                $i++;
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


    function obtenerConfiguracionEmpresa($usuario)
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::CONFIGURACION);
            $respuesta = $conexion->prepare($this->getSql("OBTENER_EMPRESA_USUARIOS", self::RUTA_SQL));
            $respuesta->bind_param('s', $usuario);
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "EMPRESA" => $row['NOMBRE_EMPRESA'],
                    "LOGO" => $row['LOGO'],
                    "ID" => $row['ID_EMPRESA'],
                    "BD" => $row['BD']
                );
            }
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function optenertercero($usuario)
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);

            $respuesta = $conexion->prepare($this->getSql("CONSULTAR_TERCERO_EMPRESA", self::RUTA_SQL));
            $respuesta->bind_param('s', $usuario);
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "TER_ID" => $row['TER_ID'],
                    "DOCUMENTO" => $row['DOCUMENTO'],
                    "PACIENTE" => $row['PACIENTE'],
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

    function contratosvencer()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_CONTRATOS_VENCER", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID_CONTRATO" => $row['ID_CONTRATO'],
                    "NUMERO_CONTRATO" => $row['NUMERO_CONTRATO'],
                    "EMPLEADO" => $row['EMPLEADO'],
                    "CARGO" => $row['CARGO'],
                    "FECHA_ACTUAL" => $row['FECHA_ACTUAL'],
                    "FECHA_CULMINACION" => $row['FECHA_CULMINACION'],
                    "DIAS_RESTANTES" => $row['DIAS_RESTANTES']
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

    function documentosVencidos()
    {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("DOCUMENTOS_VENCIDOS", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "DIAS" => $row['DIAS'],
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
