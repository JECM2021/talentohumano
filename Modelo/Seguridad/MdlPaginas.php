<?php

require_once '../../Conexion/Conexion.php';
require_once '../../Modelo/Seguridad/Bean/PaginaVO.php';

class MdlPaginas extends conexion {

    const RUTA_SQL = "../../Modelo/Seguridad/sqlPaginas.xml";

    function listarPaginas() {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("LISTAR_REPORTE_PAGINAS", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = $row;
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

    function guardarPaginaMenu(PaginasVO $paginasVO) {
        try {
            $con = $this->conectarBd(self::ASISTENCIAL);
            $ps = $con->prepare($this->getSql("REGISTRAR_PAGINA_MENU", self::RUTA_SQL));
            $menu = $paginasVO->getMenu();
            $submenu = $paginasVO->getSubmenu();
            $pagina = $paginasVO->getPagina();
            $url = $paginasVO->getUrl();
            $icono = $paginasVO->getIcono();
            $archivo = $paginasVO->getArchivo();
            $estado = $paginasVO->getEstado();
            if (empty($submenu)) {
                $submenu = $menu;
            }
            $ps->bind_param('sssss', $submenu, $pagina, $icono, $url, $estado);
            $filasAfectadas = $ps->execute() or ( $ps->error);
            if ($filasAfectadas > 0) {
                $filasAfectadas = mysqli_insert_id($con);
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

    function actualizarPaginas(PaginasVO $paginasVO) {
        try {
            $con = $this->conectarBd(self::ASISTENCIAL);
            $ps = $con->prepare($this->getSql("ACTUALIZAR_PAGINAS", self::RUTA_SQL));
            $menu = $paginasVO->getMenu();
            $submenu = $paginasVO->getSubmenu();
            $pagina = $paginasVO->getPagina();
            $url = $paginasVO->getUrl();
            $icono = $paginasVO->getIcono();
            $archivo = $paginasVO->getArchivo();
            $estado = $paginasVO->getEstado();
            $id = $paginasVO->getId_pagina();
            if (empty($submenu)) {
                $submenu = $menu;
            }
            $ps->bind_param('ssssss', $submenu, $pagina, $icono, $url, $estado, $id);
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

    function eliminarPaginasP($idPagina) {
        try {
            $con = $this->conectarBd(self::ASISTENCIAL);
            $ps = $con->prepare($this->getSql("ELIMINAR_PAGINAS_PP", self::RUTA_SQL));
            $ps->bind_param('s', $idPagina);
            $filasAfectadas = $ps->execute() or die($ps->error);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } try {
            $this->descconectarBd($con);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $filasAfectadas;
    }

    function guardarMenu(PaginasVO $menuVO) {
        try {
            $con = $this->conectarBd(self::ASISTENCIAL);
            $ps = $con->prepare($this->getSql("REGISTRAR_MENU", self::RUTA_SQL));
            $menu = $menuVO->getMenu();
            $tipo = $menuVO->getPagina();
            $nombre = $menuVO->getArchivo();
            $estado = $menuVO->getEstado();
            
            if($menu === ''){
                $menu = null;
            }
            $ps->bind_param('ssss', $nombre,$estado, $menu,$tipo);
            $filasAfectadas = $ps->execute() or ( $ps->error);
            if ($filasAfectadas > 0) {
                $filasAfectadas = mysqli_insert_id($con);
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
    function listarMenuP() {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::CONFIGURACION);
            $respuesta = $conexion->prepare($this->getSql("VISUALIZAR_MENU_PADRES", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['ID_MENU'],
                    "NOMBRE" => $row['NOMBRE_MENU'],
                    "MEN_PADRE" => $row['MENU_PADRE'],
                    "ESTADO" => $row['ESTADO'],
                    "TIPO" => $row['TIPO']
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
    function listarTipoMenu() {
        $rawdata = array();
        try {
            $conexion = $this->conectarBd(self::CONFIGURACION);
            $respuesta = $conexion->prepare($this->getSql("VISUALIZAR_TIPO_MENU", self::RUTA_SQL));
            $respuesta->execute();
            $result = $respuesta->get_result();
            while ($row = $result->fetch_assoc()) {
                $rawdata[] = array(
                    "ID" => $row['TIP_ID'],
                    "NOMBRE" => $row['TIP_NOMBRE']
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
    
    function actualizarMenu(PaginasVO $menuVO){
        try {
            $con = $this->conectarBd(self::ASISTENCIAL);
            $ps = $con->prepare($this->getSql("ACTUALIZAR_MENU", self::RUTA_SQL));
            $menu = $menuVO->getMenu();
            $tipo = $menuVO->getPagina();
            $nombre = $menuVO->getArchivo();
            $estado = $menuVO->getEstado();
            $id = $menuVO->getId_pagina();
            if($menu === ''){
                $menu = null;
            }
            $ps->bind_param('sssss', $nombre,$estado, $menu,$tipo,$id);
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
    function  consultarMenu($id){
        $menu = null;
        try {
            $conexion = $this->conectarBd(self::ASISTENCIAL);
            $respuesta = $conexion->prepare($this->getSql("CONSULTAR_MENU_PAGINA", self::RUTA_SQL));
            $control = $idControl;
            $respuesta->bind_param('s', $id);
            $respuesta->execute();
            $res = $respuesta->get_result();
            $row = $res->fetch_assoc();
            if ($row) {
                $menu = $row['pag_id'];
            }
            $this->descconectarBd($conexion);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $menu;
    }
    
    function eliminarMenu($idMenu){
        try {
            $con = $this->conectarBd(self::ASISTENCIAL);
            $ps = $con->prepare($this->getSql("CONSULTAR_MENU_PAGINA", self::RUTA_SQL));
            $ps->bind_param('s', $idMenu);
            $ps->execute();
            $res = $ps->get_result();
            $row = $res->fetch_assoc();
            $id = $row['PAG_ID'];
           // die(var_dump($id));
            if($id === null){
                $ps = $con->prepare($this->getSql("ELIMINAR_MENU", self::RUTA_SQL));
                $ps->bind_param('s', $idMenu);
                $filasAfectadas = $ps->execute() or die($ps->error);
            }else{
                $filasAfectadas = false;
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

}
