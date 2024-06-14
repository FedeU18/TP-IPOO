<?php

class BaseDatos
{
  private $HOSTNAME;
  private $BASEDATOS;
  private $USUARIO;
  private $CLAVE;
  private $CONEXION;
  private $QUERY;
  private $RESULT;
  private $ERROR;

  public function __construct()
  {
    $this->HOSTNAME = "127.0.0.1";
    $this->BASEDATOS = "bdviajes";
    $this->USUARIO = "root";
    $this->CLAVE = "";
    $this->RESULT = 0;
    $this->QUERY = "";
    $this->ERROR = "";
  }


  public function Iniciar()
  {
    $resp = false;
    $conexion = mysqli_connect($this->HOSTNAME, $this->USUARIO, $this->CLAVE, $this->BASEDATOS);

    if ($conexion) {
      if (mysqli_select_db($conexion, $this->BASEDATOS)) {
        $this->CONEXION = $conexion;
        unset($this->QUERY);
        unset($this->ERROR);
        $resp = true;
      } else {
        $this->ERROR = mysqli_errno($conexion) . ": " . mysqli_error($conexion);
      }
    } else {
      $this->ERROR = mysqli_connect_errno($conexion) . ": " . mysqli_connect_error($conexion);
    }
    return $resp;
  }
}

$bd = new BaseDatos();

echo $bd->Iniciar() ? "inició" : "no inició";
// phpinfo();
