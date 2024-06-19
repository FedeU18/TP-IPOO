<?php

class Viaje
{


  private $idviaje;
  private $vdestino;
  private $vcantmaxpasajeros;
  private $objEmpresa;
  private $objResponsable;
  private $vimporte;
  private $montoTotalAbonado;
  private $colPasajeros;
  private $mensajeoperacion;

  public function __construct()
  {
    $this->idviaje = 0;
    $this->vdestino = "";
    $this->vcantmaxpasajeros = 0;
    $this->objEmpresa = new Empresa();
    $this->objResponsable = new Responsable();
    $this->vimporte = 0;
    $this->montoTotalAbonado = 0;
    $this->colPasajeros = [];
  }

  public function cargar($idviaje, $destino, $capacidadMax, $idEmpresa, $responsable, $costoViaje)
  {
    $this->setViajeCod($idviaje);
    $this->setDestino($destino);
    $this->setMaxCantP($capacidadMax);
    $this->setObjEmpresa($idEmpresa);
    $this->setObjResponsable($responsable);
    $this->setCostoViaje($costoViaje);
    // $this->setColPasajeros($colPasajeros);
    // $this->setMontoTotalAbonado($montoTotalAbonado);
  }

  public function getViajeCod()
  {
    return $this->idviaje;
  }
  public function setViajeCod($idviaje)
  {
    $this->idviaje = $idviaje;
  }

  public function getDestino()
  {
    return $this->vdestino;
  }
  public function setDestino($destino)
  {
    $this->vdestino = $destino;
  }

  public function getMaxCantP()
  {
    return $this->vcantmaxpasajeros;
  }
  public function setMaxCantP($capacidadMax)
  {
    $this->vcantmaxpasajeros = $capacidadMax;
  }

  // public function getColPasajeros()
  // {
  //   return $this->colPasajeros;
  // }
  // public function setColPasajeros($aPasajeros)
  // {
  //   $this->colPasajeros = $aPasajeros;
  // }

  public function getObjEmpresa()
  {
    return $this->objEmpresa;
  }

  public function setObjEmpresa($objEmpresa)
  {
    $this->objEmpresa = $objEmpresa;
  }

  public function getObjResponsable()
  {
    return $this->objResponsable;
  }

  public function setObjResponsable($objResponsable)
  {
    $this->objResponsable = $objResponsable;
  }

  public function getCostoViaje()
  {
    return $this->vimporte;
  }
  public function setCostoViaje($costoViaje)
  {
    $this->vimporte = $costoViaje;
  }

  public function getMontoTotalAbonado()
  {
    return $this->montoTotalAbonado;
  }
  public function setMontoTotalAbonado($montoTotalAbonado)
  {
    $this->montoTotalAbonado = $montoTotalAbonado;
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
          $objetoEmpresa = new Empresa();
          $objetoEmpresa->Buscar($row2["idempresa"]);
          $objetoResponsable = new Responsable();
          $objetoResponsable->Buscar($row2["rnumeroempleado"]);

          // $objPasajero = new Pasajero();
          // $condicion = "idviaje=" . $row2["idviaje"];
          // $colPasajeros = $objPasajero->listar($condicion);


          $this->cargar(
            $row2["idviaje"],
            $row2["vdestino"],
            $row2["vcantmaxpasajeros"],
            $objetoEmpresa,
            $objetoResponsable,
            $row2["vimporte"]
            // $colPasajeros
          );
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

  public function listar($condicion = "")
  {
    $arregloViajes = null;
    $base = new BaseDatos();
    $consultaViajes = "Select * from viaje ";
    if ($condicion != "") {
      $consultaViajes = $consultaViajes . ' where ' . $condicion;
    }
    $consultaViajes .= " order by vdestino";
    if ($base->Iniciar()) {
      if ($base->Ejecutar($consultaViajes)) {
        $arregloViajes = array();
        while ($row2 = $base->Registro()) {
          $objetoEmpresa = new Empresa();
          $objetoEmpresa->Buscar($row2["idempresa"]);
          $objetoResponsable = new Responsable();
          $objetoResponsable->Buscar($row2["rnumeroempleado"]);

          $VId = $row2['idviaje'];
          $viajeDest = $row2['vdestino'];
          $maxPasajeros = $row2['vcantmaxpasajeros'];
          $ValorVia = $row2['vimporte'];

          // $objPasajero = new Pasajero();
          // $condicion = "idviaje=" . $row2["idviaje"];
          // $colPasajeros = $objPasajero->listar($condicion);

          $viaje = new Viaje();
          $viaje->cargar($VId, $viajeDest, $maxPasajeros, $objetoEmpresa, $objetoResponsable, $ValorVia);
          array_push($arregloViajes, $viaje);
        }
      } else {
        $this->setmensajeoperacion($base->getError());
      }
    } else {
      $this->setmensajeoperacion($base->getError());
    }
    return $arregloViajes;
  }

  public function insertar()
  {
    $base = new BaseDatos();
    $resp = false;
    $consultaInsertar = "INSERT INTO viaje(vdestino,vcantmaxpasajeros,idempresa,rnumeroempleado,vimporte) 
VALUES ('" . $this->getDestino() . "','" . $this->getMaxCantP() . "', '" . $this->getObjEmpresa()->getIdEmpresa() . "', '" . $this->getObjResponsable()->getNumEmp() . "', " . $this->getCostoViaje() . ")";

    if ($base->Iniciar()) {
      if ($base->Ejecutar($consultaInsertar)) {
        $resp = true;
      } else {
        $this->setMensajeoperacion($base->getERROR());
      }
    } else {
      $this->setMensajeoperacion($base->getERROR());
    }
    return $resp;
  }

  public function modificar()
  {
    $resp = false;
    $base = new BaseDatos();
    $idEmpresa = $this->getObjEmpresa()->getIdEmpresa();
    $rnumeroempleado = $this->getObjResponsable()->getNumEmp();
    // $consultaModificar = "UPDATE viaje SET vdestino = '" .$this->getDestino(). "',". $this->getMaxCantP(). ", " . $this->getIdEmpresa() . ", " . $this->getResponsable(). ", " . $this->getCostoViaje(). "
    //     WHERE idviaje =".$this->getViajeCod();
    $consultaModificar = "UPDATE viaje SET vdestino = '{$this->getDestino()}' , vcantmaxpasajeros = {$this->getMaxCantP()}, idempresa = {$idEmpresa}, rnumeroempleado = {$rnumeroempleado}, vimporte = {$this->getCostoViaje()}
        WHERE idviaje = {$this->getViajeCod()} ";
    if ($base->Iniciar()) {
      if ($base->Ejecutar($consultaModificar)) {
        $resp = true;
      } else {
        $this->setMensajeoperacion($base->getERROR());
      }
    } else {
      $this->setMensajeoperacion($base->getERROR());
    }
    return $resp;
  }

  public function eliminar()
  {
    $base = new BaseDatos();
    $resp = false;
    if ($base->Iniciar()) {
      $consultaEliminar = "DELETE FROM viaje WHERE idviaje=" . $this->getViajeCod();
      if ($base->Ejecutar($consultaEliminar)) {
        $resp =  true;
      } else {
        $this->setmensajeoperacion($base->getError());
      }
    } else {
      $this->setmensajeoperacion($base->getError());
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
    $cadena = "Codigo del viaje N° " .  $this->getViajeCod() . "\n" . " Con destino a " . $this->getDestino() . "\n" .
      " La capacidad maxima de pasajeros es de " . $this->getMaxCantP() . " personas \n" .
      "Empresa de viaje: " . $this->getObjEmpresa() . " \n" .
      "numero de empleado responsable: " . $this->getObjResponsable() . " \n" .
      "Costo del viaje: " . $this->getCostoViaje() . "\n\n";
    // $colPasajeros = $this->getColPasajeros();

    // foreach ($colPasajeros as $pasajero) {
    //   $cadena .= "\n" . $pasajero . "\n";
    // }


    return $cadena;
  }
}
