<?php

class Pasajero
{
  private $nombre;
  private $apellido;
  private $nrodoc;
  private $telefono;

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
}
