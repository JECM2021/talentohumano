<?php

class ContratoVO
{
    public $idEmpleado;
    public $numContrato;
    public $tipoContrato;
    public $cargos;
    public $fechaInicioContrato;
    public $fechaCulminacionContrato;
    public $motivoRetiro;
    public $salarioTotal;
    public $salarioDia;
    public $formaPago;
    public $tipoCotizante;
    public $arl;
    public $porcentajeArl;
    public $cajaCompensacion;
    public $fondoCesantias;
    public $centroCosto;
    public $fechaInicioVacaciones;
    public $fechaFinVacaciones;
    public $ciudad;
    public $fondoSalud;
    public $porcentajeSalud;
    public $fechaInicioSalud;
    public $fondoPension;
    public $porcentajePension;
    public $fechaInicioPension;
    public $bancos;
    public $tipoCuentaBanco;
    public $numeroCuentaBanco;
    public $idContrato;
    public $areaTrabajo;
    public $primNombre;
    public $segNombre;
    public $primApellido;
    public $segApellido;
    public $celularAcomp;
    public $fijoAcomp;
    public $parentesco;

    function setParentesco($parentesco)
    {
        $this->parentesco = $parentesco;
    }

    function setFijo($fijoAcomp)
    {
        $this->fijoAcomp = $fijoAcomp;
    }

    function setCelular($celularAcomp)
    {
        $this->celularAcomp = $celularAcomp;
    }

    function setSegundoApellido($segApellido)
    {
        $this->segApellido = $segApellido;
    }

    function setPrimerApellido($primApellido)
    {
        $this->primApellido = $primApellido;
    }

    function setSegundoNombre($segNombre)
    {
        $this->segNombre = $segNombre;
    }

    function setPrimerNombre($primNombre)
    {
        $this->primNombre = $primNombre;
    }

    function setAreaTrabajo($areaTrabajo)
    {
        $this->areaTrabajo = $areaTrabajo;
    }

    function setIdContrato($idContato)
    {
        $this->idContrato = $idContato;
    }

    function setNumeroCuentaBanco($numeroCuentaBanco)
    {
        $this->numeroCuentaBanco = $numeroCuentaBanco;
    }

    function setTipoCuentaBanco($tipoCuentaBanco)
    {
        $this->tipoCuentaBanco = $tipoCuentaBanco;
    }

    function setBancos($bancos)
    {
        $this->bancos = $bancos;
    }

    function setFechaInicioPension($fechaInicioPension)
    {
        $this->fechaInicioPension = $fechaInicioPension;
    }

    function setPorcentajePension($porcentajePension)
    {
        $this->porcentajePension = $porcentajePension;
    }

    function setFondoPension($fondoPension)
    {
        $this->fondoPension = $fondoPension;
    }

    function setFechaInicioSalud($fechaInicioSalud)
    {
        $this->fechaInicioSalud = $fechaInicioSalud;
    }

    function setPorcentajeSalud($porcentajeSalud)
    {
        $this->porcentajeSalud = $porcentajeSalud;
    }

    function setFondoSalud($fondoSalud)
    {
        $this->fondoSalud = $fondoSalud;
    }

    function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;
    }

    function setFechaFinVacaciones($fechaFinVacaciones)
    {
        $this->fechaFinVacaciones = $fechaFinVacaciones;
    }

    function setFechaInicioVacaciones($fechaInicioVacaciones)
    {
        $this->fechaInicioVacaciones = $fechaInicioVacaciones;
    }

    function setCentroCosto($centroCosto)
    {
        $this->centroCosto = $centroCosto;
    }

    function setFondoCesantias($fondoCesantias)
    {
        $this->fondoCesantias = $fondoCesantias;
    }

    function setCajaCompensacion($cajaCompensacion)
    {
        $this->cajaCompensacion = $cajaCompensacion;
    }

    function setPorcentajeArl($porcentajeArl)
    {
        $this->porcentajeArl = $porcentajeArl;
    }

    function setArl($arl)
    {
        $this->arl = $arl;
    }

    function setTipoCotizante($tipoCotizante)
    {
        $this->tipoCotizante = $tipoCotizante;
    }

    function setFormaPago($formaPago)
    {
        $this->formaPago = $formaPago;
    }

    function setSalarioDia($salarioDia)
    {
        $this->salarioDia = $salarioDia;
    }

    function setSalarioTotal($salarioTotal)
    {
        $this->salarioTotal = $salarioTotal;
    }

    function setMotivoRetiro($motivoRetiro)
    {
        $this->motivoRetiro = $motivoRetiro;
    }

    function setFechaCulminacionContrato($fechaCulminacionContrato)
    {
        $this->fechaCulminacionContrato = $fechaCulminacionContrato;
    }

    function setFechaInicioContrato($fechaInicioContrato)
    {
        $this->fechaInicioContrato = $fechaInicioContrato;
    }

    function setCargos($cargos)
    {
        $this->cargos = $cargos;
    }

    function setTipoContrato($tipoContrato)
    {
        $this->tipoContrato = $tipoContrato;
    }

    function setNumContrato($numContrato)
    {
        $this->numContrato = $numContrato;
    }

    function setIdEmpleado($idEmpleado)
    {
        $this->idEmpleado = $idEmpleado;
    }

    /////////////////////////////////////////////////////////////////////////////////

    function getParentesco()
    {
        return $this->parentesco;
    }

    function getFijo()
    {
        return $this->fijoAcomp;
    }

    function getCelular()
    {
        return $this->celularAcomp;
    }

    function getSegundoApellido()
    {
        return $this->segApellido;
    }

    function getPrimerApellido()
    {
        return $this->primApellido;
    }

    function getSegundoNombre()
    {
        return $this->segNombre;
    }

    function getPrimerNombre()
    {
        return $this->primNombre;
    }

    function getAreaTrabajo()
    {
        return $this->areaTrabajo;
    }

    function getIdContrato()
    {
        return $this->idContrato;
    }

    function getNumeroCuentaBanco()
    {
        return $this->numeroCuentaBanco;
    }

    function getTipoCuentaBanco()
    {
        return $this->tipoCuentaBanco;
    }

    function getBancos()
    {
        return $this->bancos;
    }

    function getFechaInicioPension()
    {
        return $this->fechaInicioPension;
    }

    function getPorcentajePension()
    {
        return $this->porcentajePension;
    }

    function getFondoPension()
    {
        return $this->fondoPension;
    }

    function getFechaInicioSalud()
    {
        return $this->fechaInicioSalud;
    }

    function getPorcentajeSalud()
    {
        return $this->porcentajeSalud;
    }

    function getFondoSalud()
    {
        return $this->fondoSalud;
    }

    function getCiudad()
    {
        return $this->ciudad;
    }

    function getFechaFinVacaciones()
    {
        return $this->fechaFinVacaciones;
    }

    function getFechaInicioVacaciones()
    {
        return $this->fechaInicioVacaciones;
    }

    function getCentroDeCosto()
    {
        return $this->centroCosto;
    }

    function getFondoCesantias()
    {
        return $this->fondoCesantias;
    }

    function getCajaCompensacion()
    {
        return $this->cajaCompensacion;
    }

    function getPorcentajeArl()
    {
        return $this->porcentajeArl;
    }

    function getArl()
    {
        return $this->arl;
    }

    function getTipoCotizante()
    {
        return $this->tipoCotizante;
    }

    function getFormaPago()
    {
        return $this->formaPago;
    }

    function getSalarioDia()
    {
        return $this->salarioDia;
    }

    function getSalarioTotal()
    {
        return $this->salarioTotal;
    }

    function getMotivoRetiro()
    {
        return $this->motivoRetiro;
    }

    function getFechaCulminacionContrato()
    {
        return $this->fechaCulminacionContrato;
    }

    function getFechaInicioContrato()
    {
        return $this->fechaInicioContrato;
    }

    function getCargos()
    {
        return $this->cargos;
    }
    function getTipoContrato()
    {
        return $this->tipoContrato;
    }
    function getNumContrato()
    {
        return $this->numContrato;
    }
    function getIdEmpleado()
    {
        return $this->idEmpleado;
    }
}
