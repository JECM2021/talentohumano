<?php

include_once '../../Modelo/HistoriaClinica/Bean/HistotriaClinicaVO.php';

class TercerosVO extends HistoriaClinicaVO {

    public $idTercro;
    public $tipoDocumentos;
    public $documento;
    public $fechaIngreso;
    public $telefono;
    public $celualar;
    public $numeroEvento;
    public $primerNombre;
    public $segundoNombre;
    public $primerApellido;
    public $segundoApellido;
    public $paciente;
    public $ciudad;
    public $departamento;
    public $direccion;
    public $barrio;
    public $estadoCivil;
    public $direccionEmpresa;
    public $cargo;
    public $fecha;
    public $grupoSanguineo;
    public $idGrupo;
    public $sexo;
    public $fechaExpe;
    public $tipoPaciente;
    public $ocupacion;
    public $razonSocial;
    public $representante;
    public $estado;
    public $correo;
    public $idSexo;
    public $idCiudad;
    public $idEstadoCivil;
    public $idOcupacion;
    public $idDepartamento;
    public $plantel;
    public $nombrePlantel;
    public $dirreccionPlantel;
    public $tipoPlantel;
    public $ambulancia;
    public $terceroMedico;
    public $parentesco;
    public $idtercero;
    public $edad;
    public $razonSocialCliente;
    public $tipoCliente;
    public $tercerousuario;
    public $ambito;
    public $anestecia;
    public $tipoProcedimiento;
    public $fechaCreacion;
    public $evento;
    public $diagnosticos;
    public $idCargo;
    public $idConvenio;
    public $convenio;
    public $regingresaPaciente;
    public $listaDeReingresos = array();
    public $areaRural;
    public $nombreCompleto;

    function getNombreCompleto() {
        return $this->nombreCompleto;
    }

    function setNombreCompleto($nombreCompleto) {
        $this->nombreCompleto = $nombreCompleto;
    }

    function getListaDeReingresos() {
        return $this->listaDeReingresos;
    }

    function setListaDeReingresos($listaDeReingresos) {
        $this->listaDeReingresos = $listaDeReingresos;
    }

    function getRegingresaPaciente() {
        return $this->regingresaPaciente;
    }

    function setRegingresaPaciente($regingresaPaciente) {
        $this->regingresaPaciente = $regingresaPaciente;
    }

    function getIdConvenio() {
        return $this->idConvenio;
    }

    function getConvenio() {
        return $this->convenio;
    }

    function setIdConvenio($idConvenio) {
        $this->idConvenio = $idConvenio;
    }

    function setConvenio($convenio) {
        $this->convenio = $convenio;
    }

    function getIdCargo() {
        return $this->idCargo;
    }

    function setIdCargo($idCargo) {
        $this->idCargo = $idCargo;
    }

    function getDiagnosticos() {
        return $this->diagnosticos;
    }

    function setDiagnosticos($diagnosticos) {
        $this->diagnosticos = $diagnosticos;
    }

    function getPaciente() {
        return $this->paciente;
    }

    function setPaciente($paciente) {
        $this->paciente = $paciente;
    }

    function getEvento() {
        return $this->evento;
    }

    function setEvento($evento) {
        $this->evento = $evento;
    }

    function getTercerousuario() {
        return $this->tercerousuario;
    }

    function setTercerousuario($tercerousuario) {
        $this->tercerousuario = $tercerousuario;
    }

    function getTipoCliente() {
        return $this->tipoCliente;
    }

    function getEdad() {
        return $this->edad;
    }

    function setEdad($edad) {
        $this->edad = $edad;
    }

    function setTipoCliente($tipoCliente) {
        $this->tipoCliente = $tipoCliente;
    }

    function getRazonSocialCliente() {
        return $this->razonSocialCliente;
    }

    function setRazonSocialCliente($razonSocialCliente) {
        $this->razonSocialCliente = $razonSocialCliente;
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

    function getTipoPlantel() {
        return $this->tipoPlantel;
    }

    function setTipoPlantel($tipoPlantel) {
        $this->tipoPlantel = $tipoPlantel;
    }

    function getNombrePlantel() {
        return $this->nombrePlantel;
    }

    function getDirreccionPlantel() {
        return $this->dirreccionPlantel;
    }

    function setNombrePlantel($nombrePlantel) {
        $this->nombrePlantel = $nombrePlantel;
    }

    function setDirreccionPlantel($dirreccionPlantel) {
        $this->dirreccionPlantel = $dirreccionPlantel;
    }

    function getPlantel() {
        return $this->plantel;
    }

    function setPlantel($plantel) {
        $this->plantel = $plantel;
    }

    function getIdDepartamento() {
        return $this->idDepartamento;
    }

    function setIdDepartamento($idDepartamento) {
        $this->idDepartamento = $idDepartamento;
    }

    function getIdOcupacion() {
        return $this->idOcupacion;
    }

    function getIdGrupo() {
        return $this->idGrupo;
    }

    function setIdGrupo($idGrupo) {
        $this->idGrupo = $idGrupo;
    }

    function setIdOcupacion($idOcupacion) {
        $this->idOcupacion = $idOcupacion;
    }

    function getIdEstadoCivil() {
        return $this->idEstadoCivil;
    }

    function setIdEstadoCivil($idEstadoCivil) {
        $this->idEstadoCivil = $idEstadoCivil;
    }

    function getIdCiudad() {
        return $this->idCiudad;
    }

    function setIdCiudad($idCiudad) {
        $this->idCiudad = $idCiudad;
    }

    function getIdSexo() {
        return $this->idSexo;
    }

    function setIdSexo($idSexo) {
        $this->idSexo = $idSexo;
    }

    function getEstado() {
        return $this->estado;
    }

    function getCorreo() {
        return $this->correo;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function getRepresentante() {
        return $this->representante;
    }

    function setRepresentante($representante) {
        $this->representante = $representante;
    }

    function getRazonSocial() {
        return $this->razonSocial;
    }

    function setRazonSocial($razonSocial) {
        $this->razonSocial = $razonSocial;
    }

    function getIdTercro() {
        return $this->idTercro;
    }

    function getTipoDocumentos() {
        return $this->tipoDocumentos;
    }

    function getDocumento() {
        return $this->documento;
    }

    function getFechaIngreso() {
        return $this->fechaIngreso;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getCelualar() {
        return $this->celualar;
    }

    function getNumeroEvento() {
        return $this->numeroEvento;
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

    function getCiudad() {
        return $this->ciudad;
    }

    function getDepartamento() {
        return $this->departamento;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getBarrio() {
        return $this->barrio;
    }

    function getEstadoCivil() {
        return $this->estadoCivil;
    }

    function getDireccionEmpresa() {
        return $this->direccionEmpresa;
    }

    function getCargo() {
        return $this->cargo;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getGrupoSanguineo() {
        return $this->grupoSanguineo;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getFechaExpe() {
        return $this->fechaExpe;
    }

    function getTipoPaciente() {
        return $this->tipoPaciente;
    }

    function setIdTercro($idTercro) {
        $this->idTercro = $idTercro;
    }

    function setTipoDocumentos($tipoDocumentos) {
        $this->tipoDocumentos = $tipoDocumentos;
    }

    function setDocumento($documento) {
        $this->documento = $documento;
    }

    function setFechaIngreso($fechaIngreso) {
        $this->fechaIngreso = $fechaIngreso;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setCelualar($celualar) {
        $this->celualar = $celualar;
    }

    function setNumeroEvento($numeroEvento) {
        $this->numeroEvento = $numeroEvento;
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

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setBarrio($barrio) {
        $this->barrio = $barrio;
    }

    function setEstadoCivil($estadoCivil) {
        $this->estadoCivil = $estadoCivil;
    }

    function setDireccionEmpresa($direccionEmpresa) {
        $this->direccionEmpresa = $direccionEmpresa;
    }

    function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setGrupoSanguineo($grupoSanguineo) {
        $this->grupoSanguineo = $grupoSanguineo;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setFechaExpe($fechaExpe) {
        $this->fechaExpe = $fechaExpe;
    }

    function setTipoPaciente($tipoPaciente) {
        $this->tipoPaciente = $tipoPaciente;
    }

    function getOcupacion() {
        return $this->ocupacion;
    }

    function setOcupacion($ocupacion) {
        $this->ocupacion = $ocupacion;
    }

    function getAmbito() {
        return $this->ambito;
    }

    function getAnestecia() {
        return $this->anestecia;
    }

    function getTipoProcedimiento() {
        return $this->tipoProcedimiento;
    }

    function setAmbito($ambito) {
        $this->ambito = $ambito;
    }

    function setAnestecia($anestecia) {
        $this->anestecia = $anestecia;
    }

    function setTipoProcedimiento($tipoProcedimiento) {
        $this->tipoProcedimiento = $tipoProcedimiento;
    }

    function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;
    }

    function getAreaRural() {
        return $this->areaRural;
    }

    function setAreaRural($areaRural) {
        $this->areaRural = $areaRural;
    }

}
