<?php

class CargosVO{
    public $codigo;
    public $nombreCargo;
    public $fechaCreacion;
    public $estadoCargo;
    public $cargoId;

    function getCargoId(){
        return $this->cargoId;
    }
    function setCargoId($cargoId){
        $this->cargoId = $cargoId;
    }

    function getCodigo(){
        return $this->codigo;
    }
    function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    function getNombreCargo(){
        return $this->nombreCargo;
    }
    function setNombreCargo($nombreCargo){
        $this->nombreCargo = $nombreCargo;
    }

    function getFechaCreacion(){
        return $this->fechaCreacion;
    }
    function setFechaCreacion($fechaCreacion){
        $this->fechaCreacion =  $fechaCreacion;
    }
    function getEstadoCargo(){
        return $this->estadoCargo;
    }
    function setEstadoCargo($estadoCargo){
        $this->estadoCargo = $estadoCargo;
    }
}