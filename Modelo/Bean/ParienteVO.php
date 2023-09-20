<?php
class ParienteVO {

 
    public $tipoDocumentos;
    public $documento;
    public $telefono;
    public $celualar;
    public $primerNombre;
    public $segundoNombre;
    public $primerApellido;
    public $segundoApellido;
    public $ciudad;
    public $departamento;
    public $direccion;
    public $identificacion;
    public $parentesco;
    public $idtercero;



    function setDocumento($documento) {
        $this->documento = $documento;
    }

    function getDocumento() {
        return $this->documento;
    }

    function setIdentificacion($identificacion) {
        $this->identificacion = $identificacion;
    }

    function getIdentificacion() {
        return $this->identificacion;
    }

    function getTerceroMedico() {
        return $this->terceroMedico;
    }

   function setTerceroMedico($terceroMedico) {
        $this->terceroMedico = $terceroMedico;
    }
    
    function getidtercero() {
        return $this->idtercero;
    }

    function setidtercero($idtercero) {
        $this->idtercero = $idtercero;

    }
    function getAmbulancia() {
        return $this->ambulancia;
    }
   
    function setAmbulancia($ambulancia) {
        $this->ambulancia = $ambulancia;
    }
  
    function setParentesco($parentesco) {
        $this->parentesco = $parentesco;
    }
    function getParentesco() {
        return $this->parentesco;
    }

    function getTipoDocumentos() {
        return $this->tipoDocumentos;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function setCelualar($celualar) {
        $this->celualar = $celualar;
    }

    function getCelualar() {
        return $this->celualar;
    }

    function getPrimerNombre() {
        return $this->primerNombre;
    }

    function getSegundoNombre() {
        return $this->segundoNombre;
    }

    function getPrimerApellido() {
        return $this->primerApellido;
    }

    function getSegundoApellido() {
        return $this->segundoApellido;
    }

    function getDireccion() {
        return $this->direccion;
    }
    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    function setPrimerNombre($primerNombre) {
        $this->primerNombre = $primerNombre;
    }

    function setSegundoNombre($segundoNombre) {
        $this->segundoNombre = $segundoNombre;
    }

    function setPrimerApellido($primerApellido) {
        $this->primerApellido = $primerApellido;
    }

    function setSegundoApellido($segundoApellido) {
        $this->segundoApellido = $segundoApellido;
    }
    function setTipoDocumentos($tipoDocumentos) {
        $this->tipoDocumentos = $tipoDocumentos;
    }

}
