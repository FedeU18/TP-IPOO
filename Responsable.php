<?php

Class Responsable{

    private $numEmp;
    private $numLic;
    private $nomb;
    private $apellido;
    private $dniRespV;
    private $mensajeoperacion;


    public function __construct() 
    {
        $this->numEmp = "";
        $this->numLic = "";
        $this->nomb = "";
        $this->apellido = "";
        $this->dniRespV = "";
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
    public function getMensajeoperacion()
    {
      return $this->mensajeoperacion;
    }
    public function setMensajeoperacion($mensajeoperacion)
    {
      $this->mensajeoperacion = $mensajeoperacion;
    }

    public function cargar ($numEmpleado, $nombre, $apellido, $numLicencia){
        $this->setNumEmp($numEmpleado);
        $this->setNumLic($numLicencia,);
        $this->setNomb ($nombre);
        $this->setApellido($apellido);
        
    }

    public function Buscar($numEmpleado)
  {
    $base = new BaseDatos();
    $consultaEmpleado = "SELECT * FROM responsable WHERE rnumeroempleado=" . $numEmpleado;

    $resp = false;
    if ($base->Iniciar()) {
      if ($base->Ejecutar($consultaEmpleado)) {
        if ($row2 = $base->Registro()) {
          $this->cargar($row2["rnumeroempleado"], $row2["rnombre"], $row2["rapellido"], $row2["rnumerolicencia"]);
          $resp = true;
        }
      } else {
        $this->setMensajeoperacion($base->getERROR());
      }
    } else {
      $this->setMensajeoperacion($base->getERROR());
    }
    return $resp;
  }


    public function __toString()
    {
        return  "Responsable: " . $this->getNumEmp() . " \n " .
        $this->getNomb(). " " . $this->getApellido() . " \n numero de liciencia: " .  $this->getNumLic() . "\n" ;
    }
}