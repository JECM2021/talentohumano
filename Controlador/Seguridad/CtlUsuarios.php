<?php

require_once '../../validaSession.php';
include_once "../../Vistas/funciones.php";
require_once '../../Modelo/Seguridad/MdlUsuarios.php';
require_once '../../Modelo/Seguridad/Bean/PerfilesVO.php';

$op = filter_input(INPUT_POST, 'op', FILTER_DEFAULT);
$mdlUsuarios = new MdlUsuarios();
$isDefinidida = isset($op) ? true : false;  // indica si la variable esta definida o no;

if ($isDefinidida) {
    $usuarioSession = $usuUsuario;
    switch ($op) {
        case 1:
            listarComboPerfiles();
            break;
        case 2:
            registrarUsuarios();
            break;
        case 3:
            visualizarUsuarios();
            break;
        case 4:
            visualRoles();
            break;
        case 5:
            visualizarPaginas();
            break;
        case 6:
            guardarPaginasPerfiles();
            break;
        case 7 :
            visualizarMenu();
            break;
        case 8:
            visualizarPaginasMenu();
            break;
        case 9:
            movientosPaginasMenu();
            break;
        case 10:
            eliminarPaginas();
            break;
        case 11:
            visualizarSubmenu();
            break;
        case 12:
            guardarPerfiles();
            break;
        case 13:
            eliminarPerfil();
            break;
        case 14:
            actualizarUsuario();
            break;
        case 15:
            restablecerContrasena();
            break;
        case 16:
            visualizarPermisosUsuario();
            break;
        case 17:
            agregarOrQuitarOperacionesUsuario();
            break;
    }
}

function listarComboPerfiles() {
    global $mdlUsuarios;
    try {
        $listaComboPerfiles = $mdlUsuarios->listarComboPerfiles();
        if ($listaComboPerfiles !== null) {
            $json = json_encode($listaComboPerfiles);
            echo $json;
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function registrarUsuarios() {
    $documento = addslashes(htmlspecialchars($_POST["documento"]));
    $primerNombre = addslashes(htmlspecialchars($_POST["primerNombre"]));
    $segundoNombre = addslashes(htmlspecialchars($_POST["segundoNombre"]));
    $primerApellido = addslashes(htmlspecialchars($_POST["primerApellido"]));
    $segundoApellido = addslashes(htmlspecialchars($_POST["segundoApellido"]));
    $usuario = addslashes(htmlspecialchars($_POST["usuario"]));
    $perfil = addslashes(htmlspecialchars($_POST["perfil"]));
    $contraseyaEncriptada = claves($documento);

    global $mdlUsuarios;
    global $usuUsuario;
    $usuariosVO = new UsuariosVO();
    $usuariosVO->setDocumento($documento);
    $usuariosVO->setPrmerNombre($primerNombre);
    $usuariosVO->setSegundoNombre($segundoNombre);
    $usuariosVO->setPrimerApellido($primerApellido);
    $usuariosVO->setSegundoApellido($segundoApellido);
    $usuariosVO->setUsuusuario($usuario);
    $usuariosVO->setIdPeril($perfil);
    $usuariosVO->setContrasena($contraseyaEncriptada);
    $statusJson = array();
    try {
        $verificausuario = $mdlUsuarios->consultarUsuario($usuariosVO);
        if ($verificausuario === null) {
            $parametrosAfectados = $mdlUsuarios->registrarUsuarios($usuariosVO, $usuUsuario);
            if ($parametrosAfectados > 0) {
                $statusJson["success"] = "Usuario registrado correctamente";
            } else {
                $statusJson["error"] = "<label> Error al intentar ejecutar la peticion <br>" . $parametrosAfectados . "</label>";
            }
        } else {
            $statusJson["error"] = "<label>El usuario que intenta registrar ya existe.<br> Por favor verifique el " . "usuario(" . $verificausuario->getUsuusuario() . ") o documento(" . $verificausuario->getDocumento() . ")</label>";
            "";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function visualizarUsuarios() {
    global $mdlUsuarios;
    try {
        $listaRegistro = $mdlUsuarios->listarUsuarios();
        if ($listaRegistro !== null) {
            $json = json_encode($listaRegistro);
            echo $json;
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function visualRoles() {
    global $mdlUsuarios;
    try {
        $datos = $mdlUsuarios->listarComboPerfiles();
        if ($datos !== null) {
            echo json_encode($datos);
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function visualizarPaginas() {
    $codigo = addslashes(htmlspecialchars($_POST["id"]));
    global $mdlUsuarios;
    try {
        $paginas = $mdlUsuarios->visualizarPaginasCodigo($codigo);
        if ($paginas !== null) {
            echo json_encode($paginas);
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function eliminarPaginas() {
    $pagina = addslashes(htmlspecialchars($_POST["pagina"]));
    $perfil = addslashes(htmlspecialchars($_POST["perfil"]));
    $menu = addslashes(htmlspecialchars($_POST["menu"]));

    global $mdlUsuarios;
    $statusJson = array();

    try {
        $parametros = $mdlUsuarios->eliminarPaginas($pagina, $perfil, $menu);
        if ($parametros > 0) {
            $statusJson["success"] = "Pagina eliminada correctamente";
        } else {
            $statusJson["error"] = "Error al intentar eliminar la orden";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function guardarPaginasPerfiles() {
    $listaPaginas = json_decode(filter_input(INPUT_POST, 'tablePaginas', FILTER_DEFAULT));
    global $mdlUsuarios;
    $statusJson = array();

    try {
        $parametosAfectados = $mdlUsuarios->guardarPaginasPer($listaPaginas);
        if ($parametosAfectados > 0) {
            $statusJson["success"] = "Paginas agregadas correctamente.";
        } else {
            $statusJson["error"] = "la pagina que intentas crear ya se encuentra agregada";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function visualizarMenu() {
    global $mdlUsuarios;
    try {
        $listarMenu = $mdlUsuarios->listarMenu();
        if ($listarMenu !== null) {
            $json = json_encode($listarMenu);
            echo $json;
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function visualizarSubmenu() {
    $codigo = addslashes(htmlspecialchars($_POST["id"]));
    global $mdlUsuarios;
    try {
        $paginas = $mdlUsuarios->visualizarSubMenu($codigo);
        if ($paginas !== null) {
            echo json_encode($paginas);
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function visualizarPaginasMenu() {
    $menu = addslashes(htmlspecialchars($_POST["menu"]));
    $subMenu = addslashes(htmlspecialchars($_POST["submenu"]));
    $menuActual = $subMenu === "" ? $menu : $subMenu;
    global $mdlUsuarios;
    try {
        $paginas = $mdlUsuarios->visualizarPaginasSubMenu($menuActual);
        if ($paginas !== null) {
            echo json_encode($paginas);
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function movientosPaginasMenu() {
    $pagina = addslashes(htmlspecialchars($_POST["pagina"]));
    $perfil = addslashes(htmlspecialchars($_POST["perfil"]));
    $menu = addslashes(htmlspecialchars($_POST["menu"]));
    $submenu = addslashes(htmlspecialchars($_POST["submenu"]));
    $estado = addslashes(htmlspecialchars($_POST["estado"]));
    global $mdlUsuarios;
    $statusJson = array();
    try {
        $parametros = $mdlUsuarios->actualizarPaginas($pagina, $perfil, $menu, $submenu, $estado);
        if ($parametros > 0) {
            $statusJson["success"] = "Pagina actualizada correctamente";
        } else {
            $statusJson["error"] = "Error al intentar actualizar la orden";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function guardarPerfiles() {
    $nombrePerfil = addslashes(htmlspecialchars($_POST["nombrePerfil"]));
    $estado = addslashes(htmlspecialchars($_POST["estado"]));
    $idPerfil = addslashes(htmlspecialchars($_POST["idperfil"]));
    global $mdlUsuarios;
    $statusJson = array();

    try {
        if (empty($idPerfil)) {
            $parametosAfectados = $mdlUsuarios->guardarPerfil($nombrePerfil, $estado);
            if ($parametosAfectados > 0) {
                $statusJson["success"] = "<label>Perfil Agregado correctamente.</label>";
            } else {
                $statusJson["error"] = "<label>El nombre del perfil ya se existe </label>";
            }
        } else {
            $updateAfectados = $mdlUsuarios->actualizarPerfil($nombrePerfil, $estado, $idPerfil);
            if ($updateAfectados > 0) {
                $statusJson["success"] = "<label>Actualizado correctamente.</label>";
            } else {
                $statusJson["error"] = "<label>No se puede actualizar </label>";
            }
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function eliminarPerfil() {
    $perfil = addslashes(htmlspecialchars($_POST["idperfil"]));

    global $mdlUsuarios;
    $statusJson = array();

    try {
        $parametros = $mdlUsuarios->eliminarPerfil($perfil);
        if ($parametros > 0) {
            $statusJson["success"] = "Perfil eliminada correctamente";
        } else {
            $statusJson["error"] = "No se puede eliminar el perfil tiene paginas agregadas";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function actualizarUsuario() {

    $documento = addslashes(htmlspecialchars($_POST["documento"]));
    $primerNombre = addslashes(htmlspecialchars($_POST["primerNombre"]));
    $segundoNombre = addslashes(htmlspecialchars($_POST["segundoNombre"]));
    $primerApellido = addslashes(htmlspecialchars($_POST["primerApellido"]));
    $segundoApellido = addslashes(htmlspecialchars($_POST["segundoApellido"]));
    $usuario = addslashes(htmlspecialchars($_POST["usuario"]));
    $perfil = addslashes(htmlspecialchars($_POST["perfil"]));
    $idUsuario = addslashes(htmlspecialchars($_POST["idUsuario"]));
    $estado = addslashes(htmlspecialchars($_POST["estado"]));
    global $mdlUsuarios;
    global $usuUsuario;

    $usuariosVO = new UsuariosVO();
    $usuariosVO->setDocumento($documento);
    $usuariosVO->setPrmerNombre($primerNombre);
    $usuariosVO->setSegundoNombre($segundoNombre);
    $usuariosVO->setPrimerApellido($primerApellido);
    $usuariosVO->setSegundoApellido($segundoApellido);
    $usuariosVO->setUsuusuario($usuario);
    $usuariosVO->setIdPeril($perfil);
    $usuariosVO->setUsuarioSession($usuUsuario);
    $usuariosVO->setIdUsuario($idUsuario);
    $usuariosVO->setEstado($estado);
    $statusJson = array();
    try {
        $verificausuario = $mdlUsuarios->consultarUsuario($usuariosVO);
        if ($verificausuario->getIdUsuario() == $usuariosVO->getIdUsuario()) {
            $datos = $mdlUsuarios->actualizarUsuario($usuariosVO);
            if ($datos > 0) {
                $statusJson["success"] = "usuario actualizado correctamente.";
            } else {
                $statusJson["error"] = "Error al intentar ejecutar la peticion" . $datos;
            }
        } else {
            $statusJson["error"] = "<label>El usuario que intenta registrar ya existe.<br> Por favor verifique el " . "usuario(" . $verificausuario->getUsuusuario() . ") o documento(" . $verificausuario->getDocumento() . ")</label>";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function restablecerContrasena() {
    $documento = addslashes(htmlspecialchars($_POST["documento"]));
    $contraseyaEncriptada = claves($documento);
    $idUsuario = addslashes(htmlspecialchars($_POST["idUsuario"]));
    global $mdlUsuarios;
    $usuariosVO = new UsuariosVO();
    $usuariosVO->setIdUsuario($idUsuario);
    $usuariosVO->setContrasena($contraseyaEncriptada);
    $statusJson = array();
    try {
        $parametrosAfectados = $mdlUsuarios->restablecerContrasena($usuariosVO);
        if ($parametrosAfectados > 0) {
            $statusJson["success"] = "Contrasena restablecida correctamente.";
        } else {
            $statusJson["error"] = "<label> Error al intentar ejecutar la peticion <br>" . $parametrosAfectados . "</label>";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function visualizarPermisosUsuario() {
    $idUsuario = addslashes(htmlspecialchars($_POST["usuId"]));
    global $mdlUsuarios;
    try {
        $listaPermiso = $mdlUsuarios->visualizarPermisosUsuario($idUsuario);
        if ($listaPermiso !== null) {
            $json = json_encode($listaPermiso);
            echo $json;
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function agregarOrQuitarOperacionesUsuario() {
    $idOperacion = addslashes(htmlspecialchars($_POST["idoperacion"]));
    $idUsuario = addslashes(htmlspecialchars($_POST["idUsuario"]));
    $estado = addslashes(htmlspecialchars($_POST["estado"]));
    global $mdlUsuarios;
    $statusJson = array();
    try {
        switch ($estado) {
            case "desactivado":
                $parametrosAfectados = $mdlUsuarios->agregarOperacionesUsuario($idOperacion, $idUsuario);
                break;
            case "activado":
                $parametrosAfectados = $mdlUsuarios->quitarOperacionUsuario($idOperacion, $idUsuario);
                break;
        }
        $estadoOperacion = $estado === "desactivado" ? "activado" : "desactivado";
        if ($parametrosAfectados > 0) {
            $statusJson["success"] = "Permiso " . $estadoOperacion . " correctamente";
        } else {
            $statusJson["error"] = "<label> Error al intentar ejecutar la peticion <br>" . $parametrosAfectados . "</label>";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
