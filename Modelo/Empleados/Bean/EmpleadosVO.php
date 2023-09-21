<?php
class EmpleadosVO
{
    public $tipoDocumento;
    public $numDocumento;
    public $primerNombre;
    public $segundoNombre;
    public $primerApellido;
    public $segundoApellido;
    public $fechaNacimiento;
    public $departamento;
    public $ciudad;
    public $estadoCivil;
    public $sexo;
    public $grupoSanguineo;
    public $estratoSocial;
    public $correo;
    public $nivelEscolaridad;
    public $estado;
    public $idEmpleado;
    public $edad;
    public $telefono;
    public $direccion;
    public $barrio;

    function setEdad($edad)
    {
        $this->edad = $edad;
    }

    function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    function setBarrio($barrio)
    {
        $this->barrio = $barrio;
    }

    function setEstado($estado)
    {
        $this->estado = $estado;
    }

    function setNivelEscolaridad($nivelEscolaridad)
    {
        $this->nivelEscolaridad = $nivelEscolaridad;
    }

    function setCorreo($correo)
    {
        $this->correo = $correo;
    }
    function setEstratoSocial($estratoSocial)
    {
        $this->estratoSocial = $estratoSocial;
    }
    function setGrupoSanguineo($grupoSanguineo)
    {
        $this->grupoSanguineo = $grupoSanguineo;
    }
    function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }
    function setEstadoCivil($estadoCivil)
    {
        $this->estadoCivil = $estadoCivil;
    }
    function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;
    }
    function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
    }
    function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }
    function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $segundoApellido;
    }
    function setPrimerApellido($primerApellido)
    {
        $this->primerApellido = $primerApellido;
    }
    function setSegundoNombre($segundoNombre)
    {
        $this->segundoNombre = $segundoNombre;
    }
    function setPrimerNombre($primerNombre)
    {
        $this->primerNombre = $primerNombre;
    }
    function setNumDocumento($numDocumento)
    {
        $this->numDocumento = $numDocumento;
    }
    function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;
    }
    function setIdEmpleado($idEmpleado)
    {
        $this->idEmpleado = $idEmpleado;
    }
    //////////////////////////////////////////////////////////////////////////

    function getEdad()
    {
        return $this->edad;
    }

    function getTelefono()
    {
        return $this->telefono;
    }

    function getDireccion()
    {
        return $this->telefono;
    }

    function getBarrio()
    {
        return $this->barrio;
    }

    function getEstado()
    {
        return $this->estado;
    }

    function getNivelEscolaridad()
    {
        return $this->nivelEscolaridad;
    }

    function getCorreo()
    {
        return $this->correo;
    }

    function getEstratoSocial()
    {
        return $this->estratoSocial;
    }

    function getGrupoSanguineo()
    {
        return $this->grupoSanguineo;
    }

    function getSexo()
    {
        return $this->sexo;
    }

    function getEstadoCivil()
    {
        return $this->estadoCivil;
    }

    function getCiudad()
    {
        return $this->ciudad;
    }

    function getDepartamento()
    {
        return $this->departamento;
    }

    function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    function getIdEmpleado()
    {
        return $this->idEmpleado;
    }
    function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }
    function getNumDocumento()
    {
        return $this->numDocumento;
    }
    function getPrimerNombre()
    {
        return $this->primerNombre;
    }
    function getSegundoNombre()
    {
        return $this->segundoNombre;
    }
    function getPrimerApellido()
    {
        return $this->primerApellido;
    }
    function getSegundoApellido()
    {
        return $this->segundoApellido;
    }
}
