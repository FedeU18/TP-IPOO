<?php

class Responsable
{

  private $numEmp;
  private $numLic;
  private $nomb;
  private $apellido;
  private $dniRespV;
  private $mensajeoperacion;


  public function __construct()
  {
    $this->numEmp = 0;
    $this->numLic = 0;
    $this->nomb = "";
    $this->apellido = "";
  }


  public function getNumEmp()
  {
    return $this->numEmp;
  }
  public function setNumEmp($numEmpleado)
  {
    $this->numEmp = $numEmpleado;
  }

  public function getNumLic()
  {
    return $this->numLic;
  }
  public function setNumLic($numLicencia)
  {
    $this->numLic = $numLicencia;
  }

  public function getNomb()
  {
    return $this->nomb;
  }
  public function setNomb($nombre)
  {
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

  public function getMensajeoperacion()
  {
    return $this->mensajeoperacion;
  }
  public function setMensajeoperacion($mensajeoperacion)
  {
    $this->mensajeoperacion = $mensajeoperacion;
  }

  public function cargar($numEmpleado, $nombre, $apellido, $numLicencia)
  {
    $this->setNumEmp($numEmpleado);
    $this->setNumLic($numLicencia,);
    $this->setNomb($nombre);
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

  public function listar($condicion = "")
  {
    $arregloResponsable = null;
    $base = new BaseDatos();
    $consultaResponsables = "SELECT * FROM responsable";
    if ($condicion != "") {
      $consultaResponsables = $consultaResponsables . " WHERE " . $condicion;
    }
    $consultaResponsables .= " ORDER BY rapellido";
    if ($base->Iniciar()) {
      if ($base->Ejecutar($consultaResponsables)) {
        $arregloResponsable = array();
        while ($row2 = $base->Registro()) {
          $responsable = new responsable();
          $responsable->cargar($row2["rnumeroempleado"], $row2["rnombre"], $row2["rapellido"], $row2["rnumerolicencia"]);
          array_push($arregloResponsable, $responsable);
        }
      } else {
        $this->setMensajeoperacion($base->getERROR());
      }
    } else {
      $this->setMensajeoperacion($base->getERROR());
    }
    return $arregloResponsable;
  }

  public function insertar()
  {
    $base = new BaseDatos();
    $resp = false;
    $consultaInsertar = "INSERT INTO responsable(rnumerolicencia,rnombre,rapellido) 
      VALUES (" . $this->getNumLic() . " , '" . $this->getNomb() . "','" . $this->getApellido() . "')";

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
    $consultaModificar = "UPDATE responsable SET rnumerolicencia = {$this->getNumLic()}, rnombre = '{$this->getNomb()}', rapellido = '{$this->getApellido()}' WHERE rnumeroempleado = {$this->getNumEmp()}";
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
      $consultaEliminar = "DELETE FROM responsable WHERE rnumeroempleado=" . $this->getNumEmp();
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
    return  "Responsable: " . $this->getNumEmp() . "\n" .
      $this->getNomb() . " " . $this->getApellido() . "\nnumero de liciencia: " .  $this->getNumLic() . "\n";
  }
}
