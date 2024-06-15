<?php

Class Viaje{
    

    private $idviaje;
    private $destino;
    private $maxCantP;
    private $colPasajeros;
    private $responsable;
    private $costoViaje;
    private $montoTotalAbonado;
    private $idEmpresa;
    private $mensajeoperacion;

    public function __construct( )
    {
        $this->idviaje = ""; 
        $this->destino="";
        $this->maxCantP= "";
        $this->responsable ="";  
        $this->colPasajeros ="";
        $this->costoViaje = "";
        $this->montoTotalAbonado = "";
        $this->idEmpresa = "";
    }

    public function cargar($idviaje , $destino, $capacidadMax,$idEmpresa,$responsable ,$costoViaje  ){
        $this->setViajeCod($idviaje); 
        $this->setDestino($destino);
        $this->setMaxCantP($capacidadMax);
        $this->setIdEmpresa($idEmpresa);
        $this->setResponsable($responsable);  
        // $this->setPasajeros($colPasajeros);

        $this->setCostoViaje($costoViaje);
        // $this->setMontoTotalAbonado($montoTotalAbonado);
    }

    public function getViajeCod(){
        return $this->idviaje;
    }
    public function setViajeCod($idviaje){
        $this->idviaje = $idviaje;
    }

    public function getDestino(){
        return $this->destino;
    }
    public function setDestino($destino){
        $this->destino = $destino;
    }

    public function getMaxCantP(){
        return $this->maxCantP;
    }
    public function setMaxCantP($capacidadMax){
        $this->maxCantP=$capacidadMax;
    }

    public function getPasajeros(){
        return $this->colPasajeros;
    }
    public function setPasajeros($aPasajeros){
        $this->colPasajeros=$aPasajeros;
    }

    public function getResponsable(){
        return $this->responsable;
    }
    public function setResponsable($responsable){
        $this->responsable=$responsable;
    }

    public function getCostoViaje(){
        return $this->costoViaje;
    }
    public function setCostoViaje($costoViaje){
        $this->costoViaje = $costoViaje;
    }

    public function getMontoTotalAbonado(){
        return $this->montoTotalAbonado;
    }
    public function setMontoTotalAbonado($montoTotalAbonado){
        $this->montoTotalAbonado = $montoTotalAbonado;
    }

    public function getIdEmpresa(){
        return $this->idEmpresa;
    }
    public function setIdEmpresa($idEmpresa){
        $this->idEmpresa = $idEmpresa;
    }

    public function getMensajeoperacion()
    {
      return $this->mensajeoperacion;
    }
    public function setMensajeoperacion($mensajeoperacion)
    {
      $this->mensajeoperacion = $mensajeoperacion;
    }

    public function Buscar($idViaje)
  {
    $base = new BaseDatos();
    $consultaViaje = "SELECT * FROM viaje WHERE idviaje=" . $idViaje;

    $resp = false;
    if ($base->Iniciar()) {
      if ($base->Ejecutar($consultaViaje)) {
        if ($row2 = $base->Registro()) {
          $this->cargar($row2["idviaje"], $row2["vdestino"], $row2["vcantmaxpasajeros"], $row2["idempresa"], $row2["rnumeroempleado"], $row2["vimporte"]);
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


    // public function agregarResponsable(Responsable $responsableV){
    //     $error = false;
    //     $responsables = $this->getResponsable();
        
    //     $i = 0;
    //     $n = count($responsables);
    //     while (!$error && $i < $n) {
    //         $p = $responsables[$i];
    //         if ($p->getDniResp() == $responsableV->getDniResp()) {
    //             $error = true;
    //             // echo "error";
    //         }
    //         $i++;
    //     }

    //     if ($error == false) {
    //         // Solo agregar el nuevo responsable si no hay error
    //         $responsables[] = $responsableV;
    //         $this->setResponsable($responsables);
    //         // echo "error if";
    //     }
        
    //     return $error;
    // }


    


    // public function agregarPasajeros(Personas $pasajero){
        
    //     $error = false;
    //     $pasajeros = $this->getPasajeros();
        
    //     $i = 0;
    //     $n = count($pasajeros);
    //     while (!$error && $i < $n) {
    //         $p = $pasajeros[$i];
    //         if ($p->getDni() == $pasajero->getDni()) {
    //             $error = true;
    //         }
    //         $i++;
    //     }
    
    //     if (!$error) {
    //         $pasajeros[] = $pasajero;
    //         $this->setPasajeros($pasajeros);
            
    //     }
    //     return $error;
    
    // // }
    // public function agregarPasajero($objPasajero){
    //     $this->setPasajeros(count($this->getPasajeros()), $objPasajero);
    // }



    // public function eliminarPasajero($dni) {
    //     $pasajeros = $this->getPasajeros();
    //     $eliminado = false;
    //     foreach ($pasajeros as $index => $pasajero) {
    //         if ($pasajero->getDni() == $dni) {
    //             unset($this->getPasajeros()[$index]);
    //             $eliminado = true;
    //         }
    //     }
    //     return $eliminado; 
    // }

    // public function hayPasajesDisponibles(){

    //     $maxCantP = $this->getMaxCantP();
    //     $colPasajeros = $this->getPasajeros();
    //     $cantP = count($colPasajeros);
    //     $pasajeDisponible = false;

    //     if($cantP < $maxCantP){
    //         $pasajeDisponible = true;
    //     }

    //     return $pasajeDisponible;
    // }

    // public function venderPasaje($objPasajero){
    //     $costo = -1;
    //     if($this->hayPasajesDisponibles()){
    //         //se reescribe el numero de ticket que tiene objPasajero ya que la venta se realiza aqui
    //         $numeroTicket = count($this->getPasajeros()) + 1;
    //         $objPasajero->setNumTicket($numeroTicket);
    //         $this->agregarPasajero($objPasajero);
    //         $costo += $costo * $objPasajero->darPorcentajeIncremento();
    //         $this->setMontoTotalAbonado($this->getMontoTotalAbonado() + $costo);
    //     }
    //     return $costo;
    // }




    // public function listaPasajeros(){
    //     $lista = $this->getPasajeros();
    //     $cadena = $this->devolverArreglos($lista);

    //     return $cadena;
    // }




    // public function devolverArreglos($arreglo){
    //     $cadena= "\n";
    //     foreach ($arreglo as $elemento){
    //         $cadena =  $cadena . " " .$elemento . "\n";
    //     }
    //     return $cadena;
    // }

    



    public function __toString()
    {
        // $cadenaPasajeros= $this->devolverArreglos($this->getPasajeros());
        return "Codigo del viaje N° " .  $this->getViajeCod(). "\n". " Con destino a ".$this->getDestino(). "\n" . 
        " La capacidad maxima de pasajeros es de ". $this->getMaxCantP() . " personas \n". 
        "Empresa de viaje: ". $this->getIdEmpresa() . " \n" . 
        "numero de empleado responsable: " . $this->getResponsable(). " \n" . 
        "Costo del viaje: " . $this->getCostoViaje(). "\n\n";
    }
}