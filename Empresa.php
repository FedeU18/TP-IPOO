<?php
class Empresa {
    private $idempresa;
    private $enombre;
    private $edireccion;

    public function __construct() {
        $this->idempresa = null;
        $this->enombre = "";
        $this->edireccion = "";
    }

    public function getIdEmpresa(){
        return $this->idempresa;
    }
    public function setIdEmpresa($idempresa){
        $this->idempresa = $idempresa;
    }

    public function getENombre(){
        return $this->enombre;
    }
    public function setENombre($enombre){
        $this->enombre = $enombre;
    }

    public function getEDireccion(){
        return $this->edireccion;
    }
    public function setEDireccion($edireccion){
        $this->edireccion = $edireccion;
        }


    public function __toString()
    {
        return "Id Empresa: " . $this->idempresa . " - Nombre: " .  
        $this->enombre . " - Dirección: " . $this->edireccion;
    }
}