<?php
class VacacionesVO
{
    public $idEmpleado;
    public $idNovVacaciones;
    public $perVenInicio;
    public $perVenFin;
    public $iniVac;
    public $finVac;
    public $observaciones;
    public $idVacacionesDetalle;
    public $estadoVacaciones;

    function setIdVacacionesDetalle($idVacacionesDetalle)
    {
        $this->idVacacionesDetalle = $idVacacionesDetalle;
    }

    function setIdEmpleado($idEmpleado)
    {
        $this->idEmpleado = $idEmpleado;
    }

    function setIdNovVacaciones($idNovVacaciones)
    {
        $this->idNovVacaciones = $idNovVacaciones;
    }

    function setPerVenInicio($perVenInicio)
    {
        $this->perVenInicio = $perVenInicio;
    }

    function setPerVenFin($perVenFin)
    {
        $this->perVenFin = $perVenFin;
    }

    function setIniVac($iniVac)
    {
        $this->iniVac = $iniVac;
    }

    function setFinVac($finVac)
    {
        $this->finVac = $finVac;
    }

    function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }

    function setEstadoVacaciones($estadoVacaciones)
    {
        $this->estadoVacaciones = $estadoVacaciones;
    }
    ///////////////////////////////////

    function getIdVacacionesDetalle()
    {
        return $this->idVacacionesDetalle;
    }

    function getIdEmpleado()
    {
        return $this->idEmpleado;
    }

    function getIdNovVacaciones()
    {
        return $this->idNovVacaciones;
    }

    function getPerVenInicio()
    {
        return $this->perVenInicio;
    }

    function getPerVenFin()
    {
        return $this->perVenFin;
    }

    function getIniVac()
    {
        return $this->iniVac;
    }

    function getFinVac()
    {
        return $this->finVac;
    }

    function getObservaciones()
    {
        return $this->observaciones;
    }

    function getEstadoVacaciones()
    {
        return $this->estadoVacaciones;
    }
}
