<?php

Class Responsable{

    private $numEmp;
    private $numLic;
    private $nomb;
    private $apellido;
    private $dniRespV;


    public function __construct($numEmpleado, $numLicencia,  $nombre, $apellido, $dniResp) 
    {
        $this->numEmp = $numEmpleado;
        $this->numLic = $numLicencia;
        $this->nomb = $nombre;
        $this->apellido = $apellido;
        $this->dniRespV = $dniResp;
    }


    public function getNumEmp(){
        return $this->numEmp;
    }
    public function setNumEmp($numEmpleado){
        $this->numEmp = $numEmpleado;
    }

    public function getNumLic(){
        return $this->numLic;
    }
    public function setNumLic($numLicencia){
        $this->numLic =$numLicencia;
    }

    public function getNomb(){
        return $this->nomb;
    }
    public function setNomb($nombre){
       $this->nomb = $nombre;    
    }

    public function getApellido()
    {
        return $this->apellido;
    }
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getDniResp()
    {
        return $this->dniRespV;
    }
    public function setDniResp($dniResp)
    {
        $this->dniRespV = $dniResp;
    }


    public function __toString()
    {
        return  "El responsable de viaje es el empleado: " . $this->getNumEmp() . " , " .
        $this->getNomb(). " " . $this->getApellido() . " , numero de liciencia: " .  $this->getNumLic() . "\n" . "Numero de Dni: " . $this->getDniResp();
    }
}