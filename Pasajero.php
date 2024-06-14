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
    $this->telefono = "";
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
    $consultaPersona = "SELECT * FROM pasajero WHERE pdocumento=" . $dni;

    $resp = false;
    if ($base->Iniciar()) {
      if ($base->Ejecutar($consultaPersona)) {
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

  public function __toString()
  {
    return "Nombre: " . $this->getNombre() . "\nApellido: " . $this->getApellido() . "\nNro Documento: " . $this->getNrodoc() . "\n";
  }
}
