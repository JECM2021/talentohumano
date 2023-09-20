<?php

class PaginasVO {
    public $menu;
    public $estado;
    public $submenu;
    public $pagina;
    public $url;
    public $icono;
    public $archivo;
    public $id_pagina;
            
    function getMenu() {
        return $this->menu;
    }

    function getEstado() {
        return $this->estado;
    }

    function getSubmenu() {
        return $this->submenu;
    }

    function getPagina() {
        return $this->pagina;
    }

    function getUrl() {
        return $this->url;
    }

    function getIcono() {
        return $this->icono;
    }

    function getArchivo() {
        return $this->archivo;
    }

    function setMenu($menu) {
        $this->menu = $menu;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setSubmenu($submenu) {
        $this->submenu = $submenu;
    }

    function setPagina($pagina) {
        $this->pagina = $pagina;
    }

    function setUrl($url) {
        $this->url = $url;
    }

    function setIcono($icono) {
        $this->icono = $icono;
    }

    function setArchivo($archivo) {
        $this->archivo = $archivo;
    }
    function getId_pagina() {
        return $this->id_pagina;
    }

    function setId_pagina($id_pagina) {
        $this->id_pagina = $id_pagina;
    }


}

