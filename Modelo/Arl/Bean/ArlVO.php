<?php
class ArlVO
{
    public $codigoArl;
    public $nombreArl;
    public $tipoDocumento;
    public $numDocumentoArl;
    public $codAdministradorArl;
    public $riesgoCero;
    public $riesgoUno;
    public $riesgoDos;
    public $riesgoTres;
    public $riesgoCuatro;
    public $riesgoCinco;
    public $riesgoSeis;
    public $RiesgoSiete;
    public $auxContableArl;
    public $auxFiscalArl;
    public $auxNormasArl;
    public $fuenteContable;
    public $tipoFondo;
    public $estadoFondo;
    public $idArl;

    function setIdArl($idArl)
    {
        $this->idArl = $idArl;
    }
    function setCodigoArl($codigoArl)
    {
        $this->codigoArl = $codigoArl;
    }
    function setNombreArl($nombreArl)
    {
        $this->nombreArl = $nombreArl;
    }
    function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;
    }
    function setNumDocumentoArl($numDocumentoArl)
    {
        $this->numDocumentoArl = $numDocumentoArl;
    }
    function setCodAdministradorArl($codAdministradorArl)
    {
        $this->codAdministradorArl = $codAdministradorArl;
    }
    function setRiesgoCero($riesgoCero)
    {
        $this->riesgoCero = $riesgoCero;
    }
    function setRiesgoUno($riesgoUno)
    {
        $this->riesgoUno = $riesgoUno;
    }
    function setRiesgoDos($riesgoDos)
    {
        $this->riesgoDos = $riesgoDos;
    }
    function setRiesgoTres($riesgoTres)
    {
        $this->riesgoTres = $riesgoTres;
    }
    function setRiesgoCuatro($riesgoCuatro)
    {
        $this->riesgoCuatro = $riesgoCuatro;
    }
    function setRiesgoCinco($riesgoCinco)
    {
        $this->riesgoCinco = $riesgoCinco;
    }
    function setRiesgoSeis($riesgoSeis)
    {
        $this->riesgoSeis = $riesgoSeis;
    }
    function setRiesgoSiete($RiesgoSiete)
    {
        $this->RiesgoSiete = $RiesgoSiete;
    }
    function setAuxContableArl($auxContableArl)
    {
        $this->auxContableArl = $auxContableArl;
    }
    function setAuxFiscalArl($auxFiscalArl)
    {
        $this->auxFiscalArl = $auxFiscalArl;
    }
    function setAuxNormasArl($auxNormasArl)
    {
        $this->auxNormasArl = $auxNormasArl;
    }
    function setFuenteContable($fuenteContable)
    {
        $this->fuenteContable = $fuenteContable;
    }
    function setTipoFondo($tipoFondo)
    {
        $this->tipoFondo = $tipoFondo;
    }
    function setEstadoFondo($estadoFondo)
    {
        $this->estadoFondo = $estadoFondo;
    }
    /////////////////////////////////////////////////////

    function getIdArl()
    {
        return $this->idArl;
    }
    function getCodigoArl()
    {
        return $this->codigoArl;
    }
    function getNombreArl()
    {
        return $this->nombreArl;
    }
    function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }
    function getNumDocumento()
    {
        return $this->numDocumentoArl;
    }
    function getCodAministradorArl()
    {
        return $this->codAdministradorArl;
    }
    function getRiesgoCero()
    {
        return $this->riesgoCero;
    }
    function getRiesgoUno()
    {
        return $this->riesgoUno;
    }
    function getRiesgoDos()
    {
        return $this->riesgoDos;
    }
    function getRiesgoTres()
    {
        return $this->riesgoTres;
    }
    function getRiesgoCuatro()
    {
        return $this->riesgoCuatro;
    }
    function getRiesgoCinco()
    {
        return $this->riesgoCinco;
    }
    function getRiesgoSeis()
    {
        return $this->riesgoSeis;
    }
    function getRiesgoSiete()
    {
        return $this->RiesgoSiete;
    }
    function getAuxContableArl()
    {
        return $this->auxContableArl;
    }
    function getAuxFiscalArl()
    {
        return $this->auxFiscalArl;
    }
    function getAuxNormasArl()
    {
        return $this->auxNormasArl;
    }
    function getFuenteContable()
    {
        return $this->fuenteContable;
    }
    function getTipoFondo()
    {
        return $this->tipoFondo;
    }
    function getEstadoFondo()
    {
        return $this->estadoFondo;
    }
}
