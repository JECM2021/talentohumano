<?php
class FondosVO
{
    public $fondoId;
    public $codigo;
    public $nombreFondo;
    public $tipoDocumento;
    public $numDocumento;
    public $codAdministrador;
    public $porcPension;
    public $auxContablePension;
    public $auxFiscalPension;
    public $auxNormasPension;
    public $porcFsp;
    public $auxContableFsp;
    public $auxFiscalFsp;
    public $auxNormasFsp;
    public $porcEdu;
    public $auxContableEdu;
    public $auxFiscalEdu;
    public $auxNormasEdu;
    public $tipoFondo;
    public $estadoFondo;
    public $fondeDe;
    ////////////////////////////////////////////////////
    public $porcSalud;
    public $auxContableEps;
    public $auxFiscalEps;
    public $auxNormasEps;
    public $idFondo;


    function getPorcSalud()
    {
        return $this->porcSalud;
    }

    function setPorcSalud($porcSalud)
    {
        $this->porcSalud = $porcSalud;
    }

    function getAuxContableEps()
    {
        return $this->auxContableEps;
    }

    function setAuxContableEps($auxContableEps)
    {
        $this->auxContableEps = $auxContableEps;
    }

    function getAuxFiscalEps()
    {
        return $this->auxFiscalEps;
    }

    function setAuxFiscalEps($auxFiscalEps)
    {
        $this->auxFiscalEps = $auxFiscalEps;
    }

    function getAuxNormasEps()
    {
        return $this->auxNormasEps;
    }

    function setAuxNormasEps($auxNormasEps)
    {
        $this->auxNormasEps = $auxNormasEps;
    }

    function getFondoId()
    {
        return $this->fondoId;
    }

    function setFondoId($fondoId)
    {
        $this->fondoId = $fondoId;
    }

    function getIdFondo()
    {
        return $this->idFondo;
    }

    function setIdFondo($idFondo)
    {
        $this->idFondo = $idFondo;
    }

    function getCodigo()
    {
        return $this->codigo;
    }
    function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }
    function getNombreFondo()
    {
        return $this->nombreFondo;
    }
    function setNombreFondo($nombreFondo)
    {
        $this->nombreFondo = $nombreFondo;
    }
    function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }
    function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;
    }
    function getNumDocumento()
    {

        return $this->numDocumento;
    }

    function setNumDocumento($numDocumento)
    {
        $this->numDocumento = $numDocumento;
    }
    function getCodAdministrador()
    {
        return $this->codAdministrador;
    }
    function setCodAdministrador($codAdministrador)
    {
        $this->codAdministrador = $codAdministrador;
    }
    function getPorcPension()
    {
        return $this->porcPension;
    }
    function setPorcPension($porcPension)
    {
        $this->porcPension = $porcPension;
    }
    function getAuxContablePension()
    {
        return $this->auxContablePension;
    }
    function setAuxContablePension($auxContablePension)
    {
        $this->auxContablePension = $auxContablePension;
    }
    function getAuxFiscalPension()
    {
        return $this->auxFiscalPension;
    }
    function setAuxFiscalPension($auxFiscalPension)
    {
        $this->auxFiscalPension = $auxFiscalPension;
    }
    function getAuxNormasPension()
    {
        return $this->auxNormasPension;
    }
    function setAuxNormasPension($auxNormasPension)
    {
        $this->auxNormasPension = $auxNormasPension;
    }
    function getPorcFsp()
    {
        return $this->porcFsp;
    }
    function setPorcFsp($porcFsp)
    {
        $this->porcFsp = $porcFsp;
    }
    function getAuxContableFsp()
    {
        return $this->auxContableFsp;
    }
    function setAuxContableFsp($auxContableFsp)
    {
        $this->auxContableFsp = $auxContableFsp;
    }
    function getAuxFiscalFsp()
    {
        return $this->auxFiscalFsp;
    }
    function setAuxFiscalFsp($auxFiscalFsp)
    {
        $this->auxFiscalFsp = $auxFiscalFsp;
    }
    function getAuxNormasFsp()
    {
        return $this->auxNormasFsp;
    }
    function setAuxNormasFsp($auxNormasFsp)
    {
        $this->auxNormasFsp = $auxNormasFsp;
    }
    function getPorcEdu()
    {
        return $this->porcEdu;
    }
    function setPorcEdu($porcEdu)
    {
        $this->porcEdu = $porcEdu;
    }
    function getAuxContableEdu()
    {
        return $this->auxContableEdu;
    }
    function setAuxContableEdu($auxContableEdu)
    {
        $this->auxContableEdu = $auxContableEdu;
    }
    function getAuxFiscalEdu()
    {
        return $this->auxFiscalEdu;
    }
    function setAuxFiscalEdu($auxFiscalEdu)
    {
        $this->auxFiscalEdu = $auxFiscalEdu;
    }
    function getAuxNormasEdu()
    {
        return $this->auxNormasEdu;
    }
    function setAuxNormasEdu($auxNormasEdu)
    {
        $this->auxNormasEdu = $auxNormasEdu;
    }
    function getTipoFondo()
    {
        return $this->tipoFondo;
    }
    function setTipoFondo($tipoFondo)
    {
        $this->tipoFondo = $tipoFondo;
    }
    function getEstadoFondo()
    {
        return $this->estadoFondo;
    }
    function setEstadoFondo($estadoFondo)
    {
        $this->estadoFondo = $estadoFondo;
    }
    function getFondeDe()
    {
        return $this->fondeDe;
    }
    function setFondeDe($fondeDe)
    {
        $this->fondeDe = $fondeDe;
    }
}
