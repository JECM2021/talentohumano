<?php

/*
  ING. AROBLES
 */

class UsuariosVO {

    public $idUsuario;
    public $documento;
    public $contrasena;
    public $nombreUsuario;
    public $apellidosUsuarios;
    public $cargo;
    public $tipo;
    public $idPeril;
    public $terId;
    public $usuusuario;
    public $empresa;
    public $bdClinica;
    public $codigoEmpresa;
    public $prmerNombre;
    public $segundoNombre;
    public $primerApellido;
    public $segundoApellido;
    public $usuarioSession;
    public $estado;
    public $logo;
    public $empresas;

    function getEstado() {
        return $this->estado;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function getUsuarioSession() {
        return $this->usuarioSession;
    }

    function setUsuarioSession($usuarioSession) {
        $this->usuarioSession = $usuarioSession;
    }

    function getPrmerNombre() {
        return $this->prmerNombre;
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

    function setPrmerNombre($prmerNombre) {
        $this->prmerNombre = $prmerNombre;
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

    function getCodigoEmpresa() {
        return $this->codigoEmpresa;
    }

    function setCodigoEmpresa($codigoEmpresa) {
        $this->codigoEmpresa = $codigoEmpresa;
    }

    function getBdClinica() {
        return $this->bdClinica;
    }

    function setBdClinica($bdClinica) {
        $this->bdClinica = $bdClinica;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function getApellidosUsuarios() {
        return $this->apellidosUsuarios;
    }

    function setApellidosUsuarios($apellidosUsuarios) {
        $this->apellidosUsuarios = $apellidosUsuarios;
    }

    function getTerId() {
        return $this->terId;
    }

    function getUsuusuario() {
        return $this->usuusuario;
    }

    function setUsuusuario($usuusuario) {
        $this->usuusuario = $usuusuario;
    }

    function setTerId($terId) {
        $this->terId = $terId;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdPeril() {
        return $this->idPeril;
    }

    function setIdPeril($idPeril) {
        $this->idPeril = $idPeril;
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
    function getLogo() {
        return $this->logo;
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
    function setLogo($logo) {
        $this->logo = $logo;
    }

    function getEmpresas() {
        return $this->empresas;
    }

    function setEmpresas($empresas) {
        $this->empresas = $empresas;
    }


}
