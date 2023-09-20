<?php

class PerfilesVO {

    public $idPerfil;
    public $nombrePerfil;
    public $estadoPerfil;

    function getIdPerfil() {
        return $this->idPerfil;
    }

    function getNombrePerfil() {
        return $this->nombrePerfil;
    }

    function getEstadoPerfil() {
        return $this->estadoPerfil;
    }

    function setIdPerfil($idPerfil) {
        $this->idPerfil = $idPerfil;
    }

    function setNombrePerfil($nombrePerfil) {
        $this->nombrePerfil = $nombrePerfil;
    }

    function setEstadoPerfil($estadoPerfil) {
        $this->estadoPerfil = $estadoPerfil;
    }

}
