<?php
class ConceptosNominaVO
{
    public $codigo;
    public $tipoConceptos;
    public $porcentaje;
    public $descripcion;
    public $estado;
    public $concepto_id;


    function getCodigo()
    {
        return $this->codigo;
    }

    function getTipoConceptos()
    {
        return $this->tipoConceptos;
    }

    function getPorcentaje()
    {
        return $this->porcentaje;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function getEstado()
    {
        return $this->estado;
    }

    function getConceptoId()
    {
        return $this->concepto_id;
    }

    //////////////////////////////////////

    function setConceptoId($concepto_id)
    {
        $this->concepto_id = $concepto_id;
    }


    function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    function setTipoConceptos($tipoConceptos)
    {
        $this->tipoConceptos = $tipoConceptos;
    }

    function setPorcentaje($porcentaje)
    {
        $this->porcentaje = $porcentaje;
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    function setEstado($estado)
    {
        $this->estado = $estado;
    }
}
