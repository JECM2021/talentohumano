<?php

require_once '../../Conexion/Conexion.php';
require_once '../../Modelo/Seguridad/Bean/UsuariosVO.php';

class MdlUsuarios extends conexion {

    const RUTA_SQL = "../../Modelo/Seguridad/sqlUsuarios.xml";

    function listarComboPerfiles() {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_COMBO_PERFILES", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID'],
                    "NOMBRE" => $row['NOMBRE']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function consultarUsuario(UsuariosVO $usuariosVO) {
        $usuarioVO = null;
        try {
            $conexion = $this->conectarBd(self::CONFIGURACION);
            $respuesta = $conexion->prepare($this->getSql("CONSULTAR_USUARIO", self::RUTA_SQL));
            $usuario = $usuariosVO->getUsuusuario();
            $documento = $usuariosVO->getDocumento();
            $respuesta->bind_param('ss', $documento, $usuario);
            $respuesta->execute();
            $res = $respuesta->get_result();
            $row = $res->fetch_assoc();
            if ($row) {
                $usuarioVO = new UsuariosVO();
                $usuarioVO->setIdUsuario($row['USU_ID']);
                $usuarioVO->setUsuusuario($row['USUARIO']);
                $usuarioVO->setDocumento($row['DOCUMENTO']);
            }
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $usuarioVO;
    }

    function registrarUsuarios(UsuariosVO $usuariosVO, $usuarioCreacion) {
        try {
            $con = $this->conectarBd(self::CONFIGURACION);
            $ps = $con->prepare($this->getSql("REGISTRAR_USUARIOS", self::RUTA_SQL));
            $documento = $usuariosVO->getDocumento();
            $primerNombre = $usuariosVO->getPrmerNombre();
            $segundoNombre = $usuariosVO->getSegundoNombre();
            $primerApellido = $usuariosVO->getPrimerApellido();
            $segundoApellido = $usuariosVO->getSegundoApellido();
            $usuario = $usuariosVO->getUsuusuario();
            $perfil = $usuariosVO->getIdPeril();
            $cnotrasena = $usuariosVO->getContrasena();
            $usuarioCrea = $usuarioCreacion;
            $ps->bind_param('sssssssss', $documento, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $usuario, $perfil, $cnotrasena, $usuarioCrea);
            $filasAfectadas = $ps->execute();
            if ($filasAfectadas <= 0) {
                $filasAfectadas = $ps->error;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } try {
            $this->descconectarBd($con);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $filasAfectadas;
    }

    function agregarOperacionesUsuario($idOperacion, $idUsuario) {
        try {
            $con = $this->conectarBd(self::CONFIGURACION);
            $ps = $con->prepare($this->getSql("AGREGAR_OPERACION_USUARIO", self::RUTA_SQL));
            $operacion = $idOperacion;
            $usuario = $idUsuario;
            $ps->bind_param('ss', $operacion, $usuario);
            $filasAfectadas = $ps->execute();
            if ($filasAfectadas <= 0) {
                $filasAfectadas = $ps->error;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } try {
            $this->descconectarBd($con);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $filasAfectadas;
    }

    function quitarOperacionUsuario($idOperacion, $idUsuario) {
        try {
            $con = $this->conectarBd(self::CONFIGURACION);
            $ps = $con->prepare($this->getSql("QUITAR_OPERACION_USUARIO", self::RUTA_SQL));
            $operacion = $idOperacion;
            $usuario = $idUsuario;
            $ps->bind_param('ss', $operacion, $usuario);
            $filasAfectadas = $ps->execute();
            if ($filasAfectadas <= 0) {
                $filasAfectadas = $ps->error;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } try {
            $this->descconectarBd($con);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $filasAfectadas;
    }

    function listarUsuarios() {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::CONFIGURACION);
            $respuesta = $conexion->prepare($this->getSql("VISUALIZAR_USUARIOS", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "usu_id" => $row['USU_ID'],
                    "documento" => $row['DOCUMENTO'],
                    "nombres" => $row['NOMBRES'],
                    "usuario" => $row['USUARIO'],
                    "perfil" => $row['PERFIL'],
                    "estado" => $row['ESTADO'],
                    "creacion" => $row['CREACION'],
                    "primer" => $row['PRIMER'],
                    "segundo" => $row['SEGUNDO'],
                    "primer_api" => $row['PRIMER_API'],
                    "segundo_api" => $row['SEGUNDO_API'],
                    "per_id" => $row['PER_ID']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function visualizarPaginasCodigo($id) {
        $dataraw = array();
        try {
            $con = $this->conectarBd(self::ASISTENCIAL);
            $ps = $con->prepare($this->getSql("CARGAR_PAGINAS_CODIGOS", self::RUTA_SQL));
            $codigo = intval($id);
            $ps->bind_param('s', $codigo);
            $ps->execute();
            $res = $ps->get_result();
            while ($row = $res->fetch_assoc()) {
                $dataraw[] = $row;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }try {
            $this->descconectarBd($con);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $dataraw;
    }

    function eliminarPaginas($pagina, $perfil, $menu) {
        $rawdata = array();
        try {
            $con = $this->conectarBd(self::ASISTENCIAL);
            $con->begin_transaction();
            $con->autocommit(false);
            $ps = null;
            /* Consultar Menu en Perfil Paginas por Menu */
            $ps = $con->prepare($this->getSql("CONSULTAR_PERFIL_PAGINAS_MENU", self::RUTA_SQL));
            $ps->bind_param('ssss', $perfil, $menu, $perfil, $menu);
            $ps->execute();
            $res = $ps->get_result();
            while ($row = mysqli_fetch_array($res)) {
                $rawdata[] = $row;
            }
            //die(var_dump($rawdata));
            if (count($rawdata) == 1) {
                $ps = $con->prepare($this->getSql("ELIMINAR_PERFIL_MENU", self::RUTA_SQL));
                $ps->bind_param('ssss', $perfil, $menu, $perfil, $menu);
                $filasAfectadasMenu = $ps->execute() or die($ps->error);
            } else {
                $filasAfectadasMenu = 1;
            }
            if ($filasAfectadasMenu > 0) {
                $ps = $con->prepare($this->getSql("ELIMINAR_PERFIL_PAGINAS", self::RUTA_SQL));
                $ps->bind_param('ss', $pagina, $perfil);
                $filasAfectadas = $ps->execute() or die($ps->error);
                if ($filasAfectadas > 0) {
                    $afectaRegistros = true;
                } else {
                    $afectaRegistros = false;
                }
            } else {
                $afectaRegistros = false;
            }
            if ($afectaRegistros) {
                $con->autocommit(true);
            } else {
                $filasAfectadas = $ps->error;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } try {
            $this->descconectarBd($con);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $filasAfectadas;
    }

    function guardarPaginasPer($tablePaginas) {
        try {
            $afectaRegistros = false;
            $con = $this->conectarBd(self::ASISTENCIAL);
            $con->begin_transaction();
            $con->autocommit(false);
            $ps = null;

            foreach ($tablePaginas as $listado) {
                $idPagina = $listado->idpagina;
                $idMenu = $listado->idmenu;
                $perfil = $listado->idPerfil;
                $idsubmenu = $listado->idSubmenu;
                /* Consultar Menu en Perfil Menu */
                $ps = $con->prepare($this->getSql("CONSULTAR_MENU_PADRE", self::RUTA_SQL));
                $ps->bind_param('ss', $perfil, $idMenu);
                $ps->execute();
                $res = $ps->get_result();
                $row = $res->fetch_assoc();

                $val = null;
                if (count($row) == 0) {
                    /* Insertar  Menu en Perfil Menu  */
                    $ps = $con->prepare($this->getSql("REGISTRAR_PERFILES_MENU", self::RUTA_SQL));
                    $ps->bind_param('sss', $perfil, $val, $idMenu);
                    $filasAfectadas = $ps->execute() or $ps->error;
                    if ($filasAfectadas > 0) {
                        $filasAfectadas = $con->insert_id;
                        $afectaRegistros = true;
                    } else {
                        $afectaRegistros = false;
                    }
                }

                if ($idsubmenu != '') {
                    /* Consultar Submenu en Perfil Menu */
                    $menuReal = $idsubmenu;
                    $ps = $con->prepare($this->getSql("CONSULTAR_MENU_HIJO", self::RUTA_SQL));
                    $ps->bind_param('ss', $perfil, $idsubmenu);
                    $ps->execute();
                    $res = $ps->get_result();
                    $row = $res->fetch_assoc();
                    $val = null;
                    if (count($row) == 0) {
                        /* Insertar SubMenu en Perfil Menu  */
                        $ps = $con->prepare($this->getSql("REGISTRAR_PERFILES_MENU", self::RUTA_SQL));
                        $ps->bind_param('sss', $perfil, $idsubmenu, $val);
                        $filasAfectadas = $ps->execute() or $ps->error;
                        if ($filasAfectadas > 0) {
                            $filasAfectadas = $con->insert_id;
                            $afectaRegistros = true;
                        } else {
                            $afectaRegistros = false;
                        }
                    }
                } else {
                    $menuReal = $idMenu;
                }
                /* Consultar Pagina en Perfil Pagina */
                $ps = $con->prepare($this->getSql("CONSULTAR_PAGINA_MENU", self::RUTA_SQL));
                $ps->bind_param('ss', $perfil, $idPagina);
                $ps->execute();
                $res = $ps->get_result();
                $rowp = $res->fetch_assoc();
                if (count($rowp) == 0) {
                    /* Insertar Pagina en Perfil Pagina */
                    $ps = $con->prepare($this->getSql("REGISTRAR_PERFIL_PAGINAS", self::RUTA_SQL));
                    $ps->bind_param('sss', $idPagina, $perfil, $menuReal);
                    $filasAfectadas = $ps->execute() or $ps->error;
                    if ($filasAfectadas > 0) {
                        $filasAfectadas = $con->insert_id;
                        $afectaRegistros = true;
                    } else {
                        $afectaRegistros = false;
                    }
                }

                if ($afectaRegistros) {
                    $con->autocommit(true);
                } else {
                    $filasAfectadas = $ps->error;
                }
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }try {
            $this->descconectarBd($con);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $filasAfectadas;
    }

    function listarMenu() {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::CONFIGURACION);
            $respuesta = $conexion->prepare($this->getSql("VISUALIZAR_MENU", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID_MENU'],
                    "NOMBRE" => $row['NOMBRE_MENU'],
                    "MEN_PADRE" => $row['MENU_PADRE'],
                    "ESTADO" => $row['ESTADO']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function visualizarSubMenu($id) {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::CONFIGURACION);
            $respuesta = $conexion->prepare($this->getSql("VISUALIZAR_SUBMENU", self::RUTA_SQL));
            $codigo = intval($id);
            $respuesta->bind_param('s', $codigo);
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID_MENU'],
                    "NOMBRE" => $row['NOMBRE_MENU'],
                    "MEN_PADRE" => $row['MENU_PADRE']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

    function visualizarPaginasSubMenu($menuActual) {
        $dataraw = array();
        try {
            $con = $this->conectarBd(self::ASISTENCIAL);
            $ps = $con->prepare($this->getSql("CARGAR_PAGINAS_MENU", self::RUTA_SQL));
            $menu = intval($menuActual);
            $ps->bind_param('s', $menu);
            $ps->execute();
            $res = $ps->get_result();
            while ($row = $res->fetch_assoc()) {
                $dataraw[] = $row;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }try {
            $this->descconectarBd($con);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $dataraw;
    }

    function actualizarPaginas($pagina, $perfil, $menu, $submenu, $estado) {
        try {
            $con = $this->conectarBd(self::CONFIGURACION);
            $ps = $con->prepare($this->getSql("GENERAR_MOVIEMIENTO_PERFIL", self::RUTA_SQL));
            $idPerfil = $perfil;
            $idPagina = $pagina;
            $idMenu = $menu;
//            die(var_dump($idPerfil,$idPagina,$estado,$idMenu,$submenu));
            $ps->bind_param('sssss', $idPerfil, $idPagina, $estado, $idMenu, $submenu);
            $ps->execute();
            $res = $ps->get_result();
            $rsAfectadas = $res->fetch_field();
            if ($rsAfectadas) {
                $filasAfectadas = $rsAfectadas->name;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } try {
            $this->descconectarBd($con);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $filasAfectadas;
    }

    function guardarPerfil($nombre, $estado) {
        try {
            $con = $this->conectarBd(self::ASISTENCIAL);
            $status = $estado;
            $nomPerfil = strtoupper($nombre);
            $ps = $con->prepare($this->getSql("CONSULTAR_PERFIL_EXISTENCIA", self::RUTA_SQL));
            $ps->bind_param('s', $nomPerfil);
            $ps->execute();
            $res = $ps->get_result();
            $row = $res->fetch_assoc();
            if (count($row) === 0) {
                $ps = $con->prepare($this->getSql("REGISTRAR_PERFIL", self::RUTA_SQL));
                $ps->bind_param('ss', $nomPerfil, $status);
                $filasAfectadas = $ps->execute() or ( $ps->error);
                if ($filasAfectadas > 0) {
                    $filasAfectadas = mysqli_insert_id($con);
                } else {
                    $filasAfectadas = $ps->error;
                }
            } else {
                $filasAfectadas = $ps->error;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }try {
            $this->descconectarBd($con);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $filasAfectadas;
    }

    function eliminarPerfil($codigo) {
        try {
            $con = $this->conectarBd(self::ASISTENCIAL);
            $ps = $con->prepare($this->getSql("CONSULTAR_PERFIL_EXISTENCIA_PAGINA", self::RUTA_SQL));
            $ps->bind_param('s', $codigo);
            $ps->execute();
            $res = $ps->get_result();
            $row = $res->fetch_assoc();
            if (count($row) === 0) {
                $ps = $con->prepare($this->getSql("ELIMINAR_PERFIL", self::RUTA_SQL));
                $ps->bind_param('s', $codigo);
                $filasAfectadas = $ps->execute() or ( $ps->error);
                if ($filasAfectadas > 0) {
                    $filasAfectadas = true;
                } else {
                    $filasAfectadas = $ps->error;
                }
            } else {
                $filasAfectadas = $ps->error;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }try {
            $this->descconectarBd($con);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $filasAfectadas;
    }

    function actualizarPerfil($nombre, $status, $idperfil) {
        try {
            $con = $this->conectarBd(self::ASISTENCIAL);
            $ps = $con->prepare($this->getSql("ACTUALIZAR_PERFIL", self::RUTA_SQL));
            $ps->bind_param('ss', $nombre, $idperfil);
            $filasAfectadas = $ps->execute() or ( $ps->error);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }try {
            $this->descconectarBd($con);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $filasAfectadas;
    }

    function actualizarUsuario(UsuariosVO $usuariosVO) {
        try {
            $con = $this->conectarBd(self::CONFIGURACION);
            $ps = $con->prepare($this->getSql("ACTUALIZAR_USUARIO", self::RUTA_SQL));
            $documento = $usuariosVO->getDocumento();
            $primerNombre = $usuariosVO->getPrmerNombre();
            $segundoNombre = $usuariosVO->getSegundoNombre();
            $primerApellido = $usuariosVO->getPrimerApellido();
            $segundoApellido = $usuariosVO->getSegundoApellido();
            $usuario = $usuariosVO->getUsuusuario();
            $perfil = $usuariosVO->getIdPeril();
            $usuarioCrea = $usuariosVO->getUsuarioSession();
            $estado = $usuariosVO->getEstado();
            $usuId = $usuariosVO->getIdUsuario();
            $ps->bind_param('ssssssssss', $documento, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $usuario, $perfil, $usuarioCrea, $estado, $usuId);
            $filasAfectadas = $ps->execute();
            if ($filasAfectadas <= 0) {
                $filasAfectadas = $ps->error;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } try {
            $this->descconectarBd($con);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $filasAfectadas;
    }

    function restablecerContrasena(UsuariosVO $usuariosVO) {
        try {
            $con = $this->conectarBd(self::CONFIGURACION);
            $ps = $con->prepare($this->getSql("RESTABLECER_CONTRASENA", self::RUTA_SQL));
            $contrasena = $usuariosVO->getContrasena();
            $usuId = $usuariosVO->getIdUsuario();
            $ps->bind_param('ss', $contrasena, $usuId);
            $filasAfectadas = $ps->execute();
            if ($filasAfectadas <= 0) {
                $filasAfectadas = $ps->error;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } try {
            $this->descconectarBd($con);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $filasAfectadas;
    }

    function visualizarPermisosUsuario($usuId) {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::CONFIGURACION);
            $respuesta = $conexion->prepare($this->getSql("PERMISOS_USUARIO", self::RUTA_SQL));
            $idUsuario = $usuId;
            $respuesta->bind_param('ss', $idUsuario, $idUsuario);
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "id" => $row['id'],
                    "permiso" => $row['permiso'],
                    "estado" => $row['estado'],
                    "icono" => $row['icono']
                );
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } try {
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $rawdata;
    }

}
