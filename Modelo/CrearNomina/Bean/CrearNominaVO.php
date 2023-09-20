<?php
class CrearNominaVO
{
    public $tipoLiquidacion;
    public $descripcion;
    public $mes;
    public $year;
    public $listadoNomina = array();

    function getTipoLiquidacion()
    {
        return $this->tipoLiquidacion;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function getMes()
    {
        return $this->mes;
    }

    function getYear()
    {
        return $this->year;
    }

    function getListadoNomina()
    {
        return $this->listadoNomina;
    }
    ///////////////////////////////////////////////////////////////////
    function setTipoLiquidacion($tipoLiquidacion)
    {
        $this->tipoLiquidacion = $tipoLiquidacion;
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    function setMes($mes)
    {
        $this->mes = $mes;
    }

    function setYear($year)
    {
        $this->year = $year;
    }

    function setListadoNomina($listadoNomina)
    {
        $this->listadoNomina = $listadoNomina;
    }
}
