<?php

require_once '../../validaSession.php';
include_once "../../Vistas/funciones.php";
require_once '../../Modelo/Seguridad/MdlPaginas.php';
require_once '../../Modelo/Seguridad/MdlUsuarios.php';
require_once '../../Modelo/Seguridad/Bean/PaginaVO.php';
        
$op = filter_input(INPUT_POST, 'op', FILTER_DEFAULT);
$mdlPaginas = new MdlPaginas();
$mdlUsuarios = new MdlUsuarios();
$isDefinidida = isset($op) ? true : false;  // indica si la variable esta definida o no;

if ($isDefinidida) {
    $usuarioSession = $usuUsuario;
    switch ($op) {
        case 1:
            listarPaginas();
            break;
        case 2 :
            visualizarMenu();
            break;
        case 3 :
            visualizarSubmenu();
            break;
        case 4 :
            guardarPaginas();
            break;
        case 5 :
            eliminarPaginasT();
            break;
        case 6 :
            guardarMenu();
            break;
        case 7 :
            visualizarMenuP();
            break;
         case 8 :
            listarTipoMenu();
            break;
        case 9:
            eliminarMenu();
            break;
    }
}

function listarPaginas() {
    global $mdlPaginas;
    try {
        $listaPaginas = $mdlPaginas->listarPaginas();
        //die(var_dump($listaPaginas));
        if ($listaPaginas !== null) {
            $json = json_encode($listaPaginas);
            echo $json;
        }
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
function guardarPaginas() {
    $menu = addslashes(htmlspecialchars($_POST["menu"]));
    $estado = addslashes(htmlspecialchars($_POST["estado"]));
    $submenu = addslashes(htmlspecialchars($_POST["submenu"]));
    $pagina = addslashes(htmlspecialchars($_POST["pagina"]));
    $url = addslashes(htmlspecialchars($_POST["url"]));
    $icono = addslashes(htmlspecialchars($_POST["icono"]));
    $archivo = addslashes(htmlspecialchars($_POST["archivo"]));
    $editar = addslashes(htmlspecialchars($_POST["editar"]));
    global $mdlPaginas;
    $paginasVO = new PaginasVO();
    $paginasVO->setMenu($menu);
    $paginasVO->setEstado($estado);
    $paginasVO->setSubmenu($submenu);
    $paginasVO->setPagina($pagina);
    $paginasVO->setUrl($url);
    $paginasVO->setIcono($icono);
    $paginasVO->setArchivo($archivo);
    $paginasVO->setId_pagina($editar);
    $statusJson = array();
    try {
        if (empty($editar)) {
        $parametosAfectados = $mdlPaginas->guardarPaginaMenu($paginasVO);
        if ($parametosAfectados > 0) {
            $statusJson["success"] = "<label>Pagina Creada correctamente.</label>";
        } else {
            $statusJson["error"] = "<label>El nombre de la pagina ya se existe </label>";
        }
        } else {
            $updateAfectados = $mdlPaginas->actualizarPaginas($paginasVO);
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
function eliminarPaginasT() {
    $idpagina = addslashes(htmlspecialchars($_POST["idpagina"]));
    global $mdlPaginas;
    $statusJson = array();

    try {
        $parametros = $mdlPaginas->eliminarPaginasP($idpagina);
        if ($parametros > 0) {
            $statusJson["success"] = "Pagina eliminada correctamente";
        } else {
            $statusJson["error"] = "Error al intentar eliminar la Pagina";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
function guardarMenu() {
    $nombre = addslashes(htmlspecialchars($_POST["nombre"]));
    $menu = addslashes(htmlspecialchars($_POST["menu"]));
    $tipo = addslashes(htmlspecialchars($_POST["tipoMenu"]));
    $estado = addslashes(htmlspecialchars($_POST["estado"]));
    $editar = addslashes(htmlspecialchars($_POST["editar"]));
    
    global $mdlPaginas;
    $paginasVO = new PaginasVO();
    $paginasVO->setMenu($menu);
    $paginasVO->setEstado($estado);
    $paginasVO->setPagina($tipo);
    $paginasVO->setArchivo($nombre);
    $paginasVO->setId_pagina($editar);
    $statusJson = array();
    try {
        if (empty($editar)) {
        $parametosAfectados = $mdlPaginas->guardarMenu($paginasVO);
        if ($parametosAfectados > 0) {
            $statusJson["success"] = "<label>Menu Creado correctamente.</label>";
        } else {
            $statusJson["error"] = "<label>El nombre del  Menu ya se existe </label>";
        }
        } else {
            $updateAfectados = $mdlPaginas->actualizarMenu($paginasVO);
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
function visualizarMenuP() {
    global $mdlPaginas;
    try {
        $listarMenu = $mdlPaginas->listarMenuP();
        if ($listarMenu !== null) {
            $json = json_encode($listarMenu);
            echo $json;
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
function listarTipoMenu(){
    global $mdlPaginas;
    try {
        $listarTipoMenu = $mdlPaginas->listarTipoMenu();
        if ($listarTipoMenu !== null) {
            $json = json_encode($listarTipoMenu);
            echo $json;
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
function eliminarMenu() {
    $idMenu = addslashes(htmlspecialchars($_POST["idMenu"]));
    global $mdlPaginas;
    $statusJson = array();

    try {
            $parametros = $mdlPaginas->eliminarMenu($idMenu);
            if ($parametros > 0) {
                $statusJson["success"] = "Pagina eliminada correctamente";
            } else {
                $statusJson["error"] = "No se Puede Eliminar el Menu Tiene Paginas Agregadas";
            }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
