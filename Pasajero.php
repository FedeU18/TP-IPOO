<?php

class Pasajero
{
  private $nombre;
  private $apellido;
  private $nrodoc;
  private $telefono;
  private $mensajeoperacion;

  public function __construct()
  {
    $this->nombre = "";
    $this->apellido = "";
    $this->nrodoc = 0;
    $this->telefono = 0;
  }

  public function cargar($nrodoc, $nombre, $apellido, $telefono)
  {
    $this->setNombre($nombre);
    $this->setApellido($apellido);
    $this->setNrodoc($nrodoc);
    $this->setTelefono($telefono);
  }

  public function getNombre()
  {
    return $this->nombre;
  }
  public function setNombre($nombre)
  {
    $this->nombre = $nombre;
  }

  public function getApellido()
  {
    return $this->apellido;
  }
  public function setApellido($apellido)
  {
    $this->apellido = $apellido;
  }

  public function getNrodoc()
  {
    return $this->nrodoc;
  }
  public function setNrodoc($nrodoc)
  {
    $this->nrodoc = $nrodoc;
  }

  public function getTelefono()
  {
    return $this->telefono;
  }
  public function setTelefono($telefono)
  {
    $this->telefono = $telefono;
  }


  public function getMensajeoperacion()
  {
    return $this->mensajeoperacion;
  }
  public function setMensajeoperacion($mensajeoperacion)
  {
    $this->mensajeoperacion = $mensajeoperacion;
  }

  public function Buscar($dni)
  {
    $base = new BaseDatos();
    $consultaPasajero = "SELECT * FROM pasajero WHERE pdocumento=" . $dni;

    $resp = false;
    if ($base->Iniciar()) {
      if ($base->Ejecutar($consultaPasajero)) {
        if ($row2 = $base->Registro()) {
          $this->cargar($dni, $row2["pnombre"], $row2["papellido"], $row2["ptelefono"]);
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
    $arregloPasajero = null;
    $base = new BaseDatos();
    $consultaPasajeros = "SELECT * FROM pasajero";
    if ($condicion != "") {
      $consultaPasajeros = $consultaPasajeros . " WHERE " . $condicion;
    }
    $consultaPasajeros .= " ORDER BY papellido";
    if ($base->Iniciar()) {
      if ($base->Ejecutar($consultaPasajeros)) {
        $arregloPasajero = array();
        while ($row2 = $base->Registro()) {
          $pasajero = new Pasajero();
          $pasajero->cargar($row2["pdocumento"], $row2["pnombre"], $row2["papellido"], $row2["ptelefono"]);
          array_push($arregloPasajero, $pasajero);
        }
      } else {
        $this->setMensajeoperacion($base->getERROR());
      }
    } else {
      $this->setMensajeoperacion($base->getERROR());
    }
    return $arregloPasajero;
  }

  public function insertar()
  {
    $base = new BaseDatos();
    $resp = false;
    $consultaInsertar = "INSERT INTO pasajero(pdocumento,pnombre,papellido,ptelefono) 
      VALUES (" . $this->getNrodoc()  . ",'" . $this->getNombre() . "' , '" . $this->getApellido() . "'," . $this->getTelefono() . ")";

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
    $consultaModificar =
      "UPDATE pasajero SET pnombre ='" . $this->getNombre()
      . "', papellido = '" . $this->getApellido()
      . "', ptelefono=" . $this->getTelefono()
      . " WHERE pdocumento=" . $this->getNrodoc();
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
      $consultaEliminar = "DELETE FROM pasajero WHERE pdocumento=" . $this->getNrodoc();
      if ($base->Ejecutar($consultaEliminar)) {
        $resp = true;
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
    return "Nombre: " . $this->getNombre() . "\nApellido: " . $this->getApellido() . "\nNro Documento: " . $this->getNrodoc() . "\n";
  }
}
