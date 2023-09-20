<?php

include_once '../../Modelo/HistoriaClinica/Bean/HistotriaClinicaVO.php';

class OrdenesVO extends HistoriaClinicaVO {

    public $razonSocialCliente;
    public $tipoCliente;
    public $terceroMedico;
    public $documento;
    public $idEventoHistoria;
    public $idOrden;
    public $tercero;
    public $descripcion;
    public $listaOrdenes = array();
    public $listaCodigosControles = array();
    
    function getTercero() {
        return $this->tercero;
    }

    function setTercero($tercero) {
        $this->tercero = $tercero;
    }

        function getRazonSocialCliente() {
        return $this->razonSocialCliente;
    }

    function getTipoCliente() {
        return $this->tipoCliente;
    }

    function getTerceroMedico() {
        return $this->terceroMedico;
    }

    function getDocumento() {
        return $this->documento;
    }

    function getIdEventoHistoria() {
        return $this->idEventoHistoria;
    }

    function getIdOrden() {
        return $this->idOrden;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getListaOrdenes() {
        return $this->listaOrdenes;
    }

    function getListaCodigosControles() {
        return $this->listaCodigosControles;
    }

    function setRazonSocialCliente($razonSocialCliente) {
        $this->razonSocialCliente = $razonSocialCliente;
    }

    function setTipoCliente($tipoCliente) {
        $this->tipoCliente = $tipoCliente;
    }

    function setTerceroMedico($terceroMedico) {
        $this->terceroMedico = $terceroMedico;
    }

    function setDocumento($documento) {
        $this->documento = $documento;
    }

    function setIdEventoHistoria($idEventoHistoria) {
        $this->idEventoHistoria = $idEventoHistoria;
    }

    function setIdOrden($idOrden) {
        $this->idOrden = $idOrden;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setListaOrdenes($listaOrdenes) {
        $this->listaOrdenes = $listaOrdenes;
    }

    function setListaCodigosControles($listaCodigosControles) {
        $this->listaCodigosControles = $listaCodigosControles;
    }



}
