<?php


include 'BaseDatos.php';
include 'Empresa.php';
include 'Responsable.php';
include 'Viaje.php';
include 'Pasajero.php';


function menuResponsable()
{
  echo "Seccion Responsable \n";
  echo "Que accion desea tomar? \n";
  echo "1. Agregar \n";
  echo "2. Modificar \n";
  echo "3. Eliminar \n";
  echo "4. Buscar \n";
  echo "5. volver al menu principal \n";

  $opcionRespo = trim(fgets(STDIN));

  switch ($opcionRespo) {
    case 1:
      // Acción para agregar responsable
      break;
    case 2:
      // Acción para modificar responsable
      break;
    case 3:
      // Acción para eliminar responsable
      break;
    case 4:
      echo "Ingrese el numero de empleado que desea buscar: \n";
      $numEmpleado = trim(fgets(STDIN));
      $objResp = new Responsable();
      $objResp->Buscar($numEmpleado);
      if ($objResp !== null) {
        echo $objResp;
      } else {
        echo "No se encontro a la persona indicada.\n";
      }
      break;
    case 5:
      // Volver al menú principal
      break;
    default:
      echo "Opción no válida \n";
      break;
  }
}

// $persona = new Pasajero();
// $persona->Buscar('12345678');
// echo $persona;


// Menu para modificar datos con switch

$salir = false;

do {
  echo "Bienvenido \n";
  echo "A que seccion desea acceder? \n";
  echo "1. Empresa \n";
  echo "2. Responsable \n";
  echo "3. Viaje \n";
  echo "4. Pasajero \n";
  echo "5. Salir \n";

  $opcion = trim(fgets(STDIN));

  switch ($opcion) {
    case 1:
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
          // Acción para agregar empresa
          break;
        case 2:
          // Acción para modificar empresa
          break;
        case 3:
          // Acción para eliminar empresa
          break;
        case 4:
          echo "Ingrese el numero de empresa que desea buscar: \n";
          $numEmpresa = trim(fgets(STDIN));
          $objEmpresa = new Empresa();
          $objEmpresa->Buscar($numEmpresa);
          if ($objEmpresa !== null) {
            echo $objEmpresa;
          } else {
            echo "No se encontro la empresa con esta identificacion.\n";
          }
          break;
        case 5:
          // Volver al menú principal
          break;
        default:
          echo "Opción no válida \n";
          break;
      }
      break;

    case 2:
      menuResponsable();
      break;

    case 3:
      echo "Seccion Viaje \n";
      echo "Que accion desea tomar? \n";
      echo "1. Agregar \n";
      echo "2. Modificar \n";
      echo "3. Eliminar \n";
      echo "4. Buscar \n";
      echo "5. volver al menu principal \n";

      $opcionViaje = trim(fgets(STDIN));

      switch ($opcionViaje) {
        case 1:
          // Acción para agregar viaje
          break;
        case 2:
          // Acción para modificar viaje
          break;
        case 3:
          // Acción para eliminar viaje
          break;
        case 4:
          echo "Ingrese el numero del viaje que desea buscar: \n";
          $idViaje = trim(fgets(STDIN));
          $objViaje = new Viaje();
          $objViaje->Buscar($idViaje);
          if ($objViaje !== null) {
            echo $objViaje;
          } else {
            echo "No se encontro el viaje indicado.\n";
          }
          break;
        case 5:
          // Volver al menú principal
          break;
        default:
          echo "Opción no válida \n";
          break;
      }
      break;

    case 4:
      echo "Seccion Pasajero \n";
      echo "Que accion desea tomar? \n";
      echo "1. Agregar \n";
      echo "2. Modificar \n";
      echo "3. Eliminar \n";
      echo "4. Buscar \n";
      echo "5. Listar todos los pasajeros \n";
      echo "6. volver al menu principal \n";

      $opcionPasajero = trim(fgets(STDIN));

      switch ($opcionPasajero) {
        case 1:
          // Acción para agregar pasajero
          break;
        case 2:
          // Acción para modificar pasajero
          break;
        case 3:
          // Acción para eliminar pasajero
          break;
        case 4:
          echo "Ingrese el numero de DNI del pasajero que desea buscar: \n";
          $dni = trim(fgets(STDIN));
          $persona = new Pasajero();
          $persona->Buscar($dni);
          if ($persona !== null) {
            echo $persona;
          } else {
            echo "No se encontro a la persona indicada.\n";
          }
          break;

        case 5:
          echo "Mostrando Lista completa de pasajeros: ";
          $objPasajero = new Pasajero();

          $listaPasajeros = $objPasajero->Listar();
          $cadena = "";
          foreach ($listaPasajeros as $pasajero) {
            $cadena .= $pasajero . "\n";
          }
          echo $cadena;
        case 6:
          // Volver al menú principal
          break;
        default:
          echo "Opción no válida \n";
          break;
      }
      break;

    case 5:
      $salir = true;
      break;

    default:
      echo "Opción no válida \n";
      break;
  }
} while (!$salir);

echo "Gracias por usar el sistema. ¡Hasta luego!\n";
