<?php


include 'BaseDatos.php';
include 'Empresa.php';
include 'Responsable.php';
include 'Viaje.php';
include 'Pasajero.php';


// $persona = new Pasajero();
// $persona->Buscar('12345678');
// echo $persona;


// Menu para modificar datos con switch

$salir = false;
$opcion = null;

do {

  echo "Bienvenido \n";
  echo "A que seccion desea acceder? \n";
  echo "1. Empresa \n";
  echo "2. Responsable \n";
  echo "3. Viaje \n";
  echo "4. Pasajero \n";
  echo "5. Salir \n";

  $opcion = trim(fgets(STDIN));

  if ($opcion == 1) {
    $opcionEmpresa = null;
    echo "Seccion Empresa \n";
    echo "Que accion desea tomar? \n";
    echo "1. Agregar \n";
    echo "2. Modificar \n";
    echo "3. Eliminar \n";
    echo "4. Buscar \n";
    echo "5. volver al menu principal \n";

    $opcionEmpresa = trim(fgets(STDIN));

    switch ($opcionEmpresa) {
      case 1:

        break;
      case 2:
    }
  } else if ($opcion == 2) {
    $opcionRespo = null;
    echo "Seccion Responsable \n";
    echo "Que accion desea tomar? \n";
    echo "1. Agregar \n";
    echo "2. Modificar \n";
    echo "3. Eliminar \n";
    echo "4. Buscar \n";
    echo "5. volver al menu principal \n";

    switch ($opcionRespo) {
      case 1:
    }
  } else if ($opcion == 3) {
    $opcionViaje = null;
    echo "Seccion Viaje \n";
    echo "Que accion desea tomar? \n";
    echo "1. Agregar \n";
    echo "2. Modificar \n";
    echo "3. Eliminar \n";
    echo "4. Buscar \n";
    echo "5. volver al menu principal \n";

    switch ($opcionViaje) {
      case 1:
    }
  } else if ($opcion == 4) {
    $opcionPasajero = null;
    echo "Seccion Pasajero \n";
    echo "Que accion desea tomar? \n";
    echo "1. Agregar \n";
    echo "2. Modificar \n";
    echo "3. Eliminar \n";
    echo "4. Buscar \n";
    echo "5. volver al menu principal \n";

    switch ($opcionPasajero) {
      case 1:
    }
  }
} while (!$salir);
