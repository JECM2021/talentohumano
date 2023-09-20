<?php

class CirugiaVO {

    public $evento;
    public $documento;
    public $paciente;
    public $medico;
    public $responsable;
    public $tipoCliente;
    /* ---------------- */
    public $idorden;
    public $idtercero;
    public $cirujano;
    public $idtipoproced;
    public $idprocedimiento = array();
    public $diagnostico;
    public $fecha;
    public $ambito;
    public $anestecia;
    public $enfermedad;
    public $numorden;
    public $descdiagnostico;
    public $descmaterial;
    public $descdiagrama;
    public $medicos = array();
    public $fechaentrada;
    public $fechasalida;
    public $destinosalida;
    public $patologia;
    public $formarealizacion;
    public $postoperatorio;
    public $quirurgica;
    public $finalida;
    public $realizacion;
    public $atiende;
    public $procedimiento;
    public $terceroMedico;
    public $descripcionProcedimiento;
    public $fechaIncial;
    public $fechaFinal;
    public $idOrdenConsecutivo;
    public $estado;
    public $tipoTratamiento;
    public $ordenPadre;


    function getTipoTratamiento() {
        return $this->tipoTratamiento;
    }

    function setTipoTratamiento($tipoTratamiento) {
        $this->tipoTratamiento = $tipoTratamiento;
    }
    function getEstado() {
        return $this->estado;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function getIdOrdenConsecutivo() {
        return $this->idOrdenConsecutivo;
    }

    function setIdOrdenConsecutivo($idOrdenConsecutivo) {
        $this->idOrdenConsecutivo = $idOrdenConsecutivo;
    }

    function getFechaIncial() {
        return $this->fechaIncial;
    }

    function getFechaFinal() {
        return $this->fechaFinal;
    }

    function setFechaIncial($fechaIncial) {
        $this->fechaIncial = $fechaIncial;
    }

    function setFechaFinal($fechaFinal) {
        $this->fechaFinal = $fechaFinal;
    }

    function getDescripcionProcedimiento() {
        return $this->descripcionProcedimiento;
    }

    function setDescripcionProcedimiento($descripcionProcedimiento) {
        $this->descripcionProcedimiento = $descripcionProcedimiento;
    }

    function getTerceroMedico() {
        return $this->terceroMedico;
    }

    function setTerceroMedico($terceroMedico) {
        $this->terceroMedico = $terceroMedico;
    }

    function getEvento() {
        return $this->evento;
    }

    function getDocumento() {
        return $this->documento;
    }

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

    function setEvento($evento) {
        $this->evento = $evento;
    }

    function setDocumento($documento) {
        $this->documento = $documento;
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

    /* -------------------------------------------------- */

    function getIdorden() {
        return $this->idorden;
    }

    function getIdtercero() {
        return $this->idtercero;
    }

    function getCirujano() {
        return $this->cirujano;
    }

    function getIdtipoproced() {
        return $this->idtipoproced;
    }

    function getIdprocedimiento() {
        return $this->idprocedimiento;
    }

    function getDiagnostico() {
        return $this->diagnostico;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getAmbito() {
        return $this->ambito;
    }

    function getAnestecia() {
        return $this->anestecia;
    }

    function getEnfermedad() {
        return $this->enfermedad;
    }

    function setIdorden($idorden) {
        $this->idorden = $idorden;
    }

    function setIdtercero($idtercero) {
        $this->idtercero = $idtercero;
    }

    function setCirujano($cirujano) {
        $this->cirujano = $cirujano;
    }

    function setIdtipoproced($idtipoproced) {
        $this->idtipoproced = $idtipoproced;
    }

    function setIdprocedimiento($idprocedimiento) {
        $this->idprocedimiento = $idprocedimiento;
    }

    function setDiagnostico($diagnostico) {
        $this->diagnostico = $diagnostico;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setAmbito($ambito) {
        $this->ambito = $ambito;
    }

    function setAnestecia($anestecia) {
        $this->anestecia = $anestecia;
    }

    function setEnfermedad($enfermedad) {
        $this->enfermedad = $enfermedad;
    }

    function getNumorden() {
        return $this->numorden;
    }

    function setNumorden($numorden) {
        $this->numorden = $numorden;
    }

    function getDescdiagnostico() {
        return $this->descdiagnostico;
    }

    function getDescmaterial() {
        return $this->descmaterial;
    }

    function getDescdiagrama() {
        return $this->descdiagrama;
    }

    function setDescdiagnostico($descdiagnostico) {
        $this->descdiagnostico = $descdiagnostico;
    }

    function setDescmaterial($descmaterial) {
        $this->descmaterial = $descmaterial;
    }

    function setDescdiagrama($descdiagrama) {
        $this->descdiagrama = $descdiagrama;
    }

    function getMedicos() {
        return $this->medicos;
    }

    function getFechasalida() {
        return $this->fechasalida;
    }

    function getDestinosalida() {
        return $this->destinosalida;
    }

    function getPatologia() {
        return $this->patologia;
    }

    function getFormarealizacion() {
        return $this->formarealizacion;
    }

    function getPostoperatorio() {
        return $this->postoperatorio;
    }

    function getQuirurgica() {
        return $this->quirurgica;
    }

    function setMedicos($medicos) {
        $this->medicos = $medicos;
    }

    function setFechasalida($fechasalida) {
        $this->fechasalida = $fechasalida;
    }

    function setDestinosalida($destinosalida) {
        $this->destinosalida = $destinosalida;
    }

    function setPatologia($patologia) {
        $this->patologia = $patologia;
    }

    function setFormarealizacion($formarealizacion) {
        $this->formarealizacion = $formarealizacion;
    }

    function setPostoperatorio($postoperatorio) {
        $this->postoperatorio = $postoperatorio;
    }

    function setQuirurgica($quirurgica) {
        $this->quirurgica = $quirurgica;
    }

    function getFinalida() {
        return $this->finalida;
    }

    function getRealizacion() {
        return $this->realizacion;
    }

    function getAtiende() {
        return $this->atiende;
    }

    function getProcedimiento() {
        return $this->procedimiento;
    }

    function setFinalida($finalida) {
        $this->finalida = $finalida;
    }

    function setRealizacion($realizacion) {
        $this->realizacion = $realizacion;
    }

    function setAtiende($atiende) {
        $this->atiende = $atiende;
    }

    function setProcedimiento($procedimiento) {
        $this->procedimiento = $procedimiento;
    }

    function getFechaentrada() {
        return $this->fechaentrada;
    }

    function setFechaentrada($fechaentrada) {
        $this->fechaentrada = $fechaentrada;
    }
    function getOrdenPadre() {
        return $this->ordenPadre;
    }

    function setOrdenPadre($ordenPadre) {
        $this->ordenPadre = $ordenPadre;
    }
}
