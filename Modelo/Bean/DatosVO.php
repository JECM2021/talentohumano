<?php

class DatosVO {
    public $paciente;
    public $medico;
    public $responsable;
    public $tipoCliente;
    public $orden;
    public $fecha;
    
    public $listadoProcedimientos = array();
    public $listadoDiagnosticos = array();
    public $listadoTerceros = array();
    public $tipoProdecimiento;
    public $fechaInicio;
    public $ambito;
    public $anestesia;
    public $descripcionProdecedimiento;
    public $disgnosticoPreoperatorio;
    public $descripcionMaterial;
    public $diagnosticoDefinitivo;
    public $fechaSalida;
    public $destinoSalida;
    public $patologia;
    public $formaRealizacion;
    public $diagnosticoPostoperatorio;
    public $descripcionQuirurgica;
    public $variable = array();
    public $acciones = array();
    
    function getPaciente() {
        return $this->paciente;
    }

    function getMedico() {
        return $this->medico;
    }

    function getResponsable() {
        return $this->responsable;
    }

    function getTipoCliente() {
        return $this->tipoCliente;
    }

    function getOrden() {
        return $this->orden;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getListadoProcedimientos() {
        return $this->listadoProcedimientos;
    }

    function getListadoDiagnosticos() {
        return $this->listadoDiagnosticos;
    }

    function getListadoTerceros() {
        return $this->listadoTerceros;
    }

    function getTipoProdecimiento() {
        return $this->tipoProdecimiento;
    }

    function getFechaInicio() {
        return $this->fechaInicio;
    }

    function getAmbito() {
        return $this->ambito;
    }

    function getAnestesia() {
        return $this->anestesia;
    }

    function getDescripcionProdecedimiento() {
        return $this->descripcionProdecedimiento;
    }

    function getDisgnosticoPreoperatorio() {
        return $this->disgnosticoPreoperatorio;
    }

    function getDescripcionMaterial() {
        return $this->descripcionMaterial;
    }

    function getDiagnosticoDefinitivo() {
        return $this->diagnosticoDefinitivo;
    }

    function getFechaSalida() {
        return $this->fechaSalida;
    }

    function getDestinoSalida() {
        return $this->destinoSalida;
    }

    function getPatologia() {
        return $this->patologia;
    }

    function getFormaRealizacion() {
        return $this->formaRealizacion;
    }

    function getDiagnosticoPostoperatorio() {
        return $this->diagnosticoPostoperatorio;
    }

    function getDescripcionQuirurgica() {
        return $this->descripcionQuirurgica;
    }

    function setPaciente($paciente) {
        $this->paciente = $paciente;
    }

    function setMedico($medico) {
        $this->medico = $medico;
    }

    function setResponsable($responsable) {
        $this->responsable = $responsable;
    }

    function setTipoCliente($tipoCliente) {
        $this->tipoCliente = $tipoCliente;
    }

    function setOrden($orden) {
        $this->orden = $orden;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setListadoProcedimientos($listadoProcedimientos) {
        $this->listadoProcedimientos = $listadoProcedimientos;
    }

    function setListadoDiagnosticos($listadoDiagnosticos) {
        $this->listadoDiagnosticos = $listadoDiagnosticos;
    }

    function setListadoTerceros($listadoTerceros) {
        $this->listadoTerceros = $listadoTerceros;
    }

    function setTipoProdecimiento($tipoProdecimiento) {
        $this->tipoProdecimiento = $tipoProdecimiento;
    }

    function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    function setAmbito($ambito) {
        $this->ambito = $ambito;
    }

    function setAnestesia($anestesia) {
        $this->anestesia = $anestesia;
    }

    function setDescripcionProdecedimiento($descripcionProdecedimiento) {
        $this->descripcionProdecedimiento = $descripcionProdecedimiento;
    }

    function setDisgnosticoPreoperatorio($disgnosticoPreoperatorio) {
        $this->disgnosticoPreoperatorio = $disgnosticoPreoperatorio;
    }

    function setDescripcionMaterial($descripcionMaterial) {
        $this->descripcionMaterial = $descripcionMaterial;
    }

    function setDiagnosticoDefinitivo($diagnosticoDefinitivo) {
        $this->diagnosticoDefinitivo = $diagnosticoDefinitivo;
    }

    function setFechaSalida($fechaSalida) {
        $this->fechaSalida = $fechaSalida;
    }

    function setDestinoSalida($destinoSalida) {
        $this->destinoSalida = $destinoSalida;
    }

    function setPatologia($patologia) {
        $this->patologia = $patologia;
    }

    function setFormaRealizacion($formaRealizacion) {
        $this->formaRealizacion = $formaRealizacion;
    }

    function setDiagnosticoPostoperatorio($diagnosticoPostoperatorio) {
        $this->diagnosticoPostoperatorio = $diagnosticoPostoperatorio;
    }

    function setDescripcionQuirurgica($descripcionQuirurgica) {
        $this->descripcionQuirurgica = $descripcionQuirurgica;
    }
    function getVariable() {
        return $this->variable;
    }

    function getAcciones() {
        return $this->acciones;
    }

    function setVariable($variable) {
        $this->variable = $variable;
    }

    function setAcciones($acciones) {
        $this->acciones = $acciones;
    }

}
