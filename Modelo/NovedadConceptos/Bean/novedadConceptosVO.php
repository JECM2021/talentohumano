<?php
class novedadConceptosVO
{
    public $tipoConcepto;
    public $listadoNovedades = array();
    public $tipoconcepId;
    public $mesConcepto;

    function getMesConcepto()
    {
        return $this->mesConcepto;
    }

    function setMesConcepto($mesConcepto)
    {
        $this->mesConcepto = $mesConcepto;
    }

    function getTipoConceptoId()
    {
        return $this->tipoconcepId;
    }

    function setTipoConceptoId($tipoconcepId)
    {
        $this->tipoconcepId = $tipoconcepId;
    }

    function getListadoNovedades()
    {
        return $this->listadoNovedades;
    }

    function setListadoNovedades($listadoNovedades)
    {
        $this->listadoNovedades = $listadoNovedades;
    }
    /////////////////////////////////////////////////

    function getTipoConcepto()
    {
        return $this->tipoConcepto;
    }

    function setTipoConcepto($tipoConcepto)
    {
        $this->tipoConcepto = $tipoConcepto;
    }
}
