<?php

require_once '/../../Modelo/Bean/TercerosVO.php';

class EventoVO extends TercerosVO {

    public $idEvento;
    public $idConvenio;
    public $fechaEvento;
    public $numeroEvento;
    public $ambulancia;
    public $tipoAcompanante;
    public $idAcompanante;
    public $convenio;
    public $responsable;
    public $numeroDePoliza;
    public $fechaVencimiento;
    public $fechaTriage;
    public $fechaAtencion;

    function getNumeroDePoliza() {
        return $this->numeroDePoliza;
    }

    function getFechaTriage() {
        return $this->fechaTriage;
    }

    function getFechaAtencion() {
        return $this->fechaAtencion;
    }

    function setFechaTriage($fechaTriage) {
        $this->fechaTriage = $fechaTriage;
    }

    function setFechaAtencion($fechaAtencion) {
        $this->fechaAtencion = $fechaAtencion;
    }

    function getFechaVencimiento() {
        return $this->fechaVencimiento;
    }

    function setNumeroDePoliza($numeroDePoliza) {
        $this->numeroDePoliza = $numeroDePoliza;
    }

    function setFechaVencimiento($fechaVencimiento) {
        $this->fechaVencimiento = $fechaVencimiento;
    }

    function getResponsable() {
        return $this->responsable;
    }

    function setResponsable($responsable) {
        $this->responsable = $responsable;
    }

    function getConvenio() {
        return $this->convenio;
    }

    function setConvenio($convenio) {
        $this->convenio = $convenio;
    }

    function getidAcompanante() {
        return $this->idAcompanante;
    }

    function setidAcompanante($idAcompanante) {
        $this->ida = $idAcompanante;
    }

    function gettipoAcompanante() {
        return $this->tipoAcompanante;
    }

    function settipoAcompanante($tipoAcompanante) {
        $this->tipoAcompanante = $tipoAcompanante;
    }

    function getAmbulancia() {
        return $this->ambulancia;
    }

    function setAmbulancia($ambulancia) {
        $this->ambulancia = $ambulancia;
    }

    function getIdEvento() {
        return $this->idEvento;
    }

    function getIdConvenio() {
        return $this->idConvenio;
    }

    function getFechaEvento() {
        return $this->fechaEvento;
    }

    function getNumeroEvento() {
        return $this->numeroEvento;
    }

    function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
    }

    function setIdConvenio($idConvenio) {
        $this->idConvenio = $idConvenio;
    }

    function setFechaEvento($fechaEvento) {
        $this->fechaEvento = $fechaEvento;
    }

    function setNumeroEvento($numeroEvento) {
        $this->numeroEvento = $numeroEvento;
    }

}
