<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuariosVO
 *
 * @author Desarollo
 */
class MenuVO {

    public $idUsuario;
    public $documento;
    public $contrasena;
    public $nombreUsuario;
    public $cargo;
    public $tipo;
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getDocumento() {
        return $this->documento;
    }

    function getContrasena() {
        return $this->contrasena;
    }

    function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    function getCargo() {
        return $this->cargo;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setDocumento($documento) {
        $this->documento = $documento;
    }

    function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }

    function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }



}
