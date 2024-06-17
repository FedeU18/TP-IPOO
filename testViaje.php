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
  echo "5. Listar\n";
  echo "6. volver al menu principal \n";

  $opcionRespo = trim(fgets(STDIN));
  $salirMenuResponsable = false;
  do {
    switch ($opcionRespo) {
      case 1:
        // Acción para agregar responsable
        echo "AGREGAR RESPONSABLE \n\n";
        echo "Ingrese número de licencia: \n";
        $nroLic = trim(fgets(STDIN));
        echo "Ingrese nombre: \n";
        $nombre = trim(fgets(STDIN));
        echo "Ingrese apellido: \n";
        $apellido = trim(fgets(STDIN));
        $objResponsable = new Responsable();
        $objResponsable->cargar(0, $nombre, $apellido, $nroLic);
        if ($nombre != "" && $apellido != "" && $nroLic != 0) {
          if ($objResponsable->insertar()) {
            echo "El responsable se agregó con éxito a la BD";
          } else {
            echo "El responsable no se pudo agregar a la BD";
          }
        } else {
          echo "Faltaron campos para agregar el responsable a la BD";
        }
        break;
      case 2:
        // Acción para modificar responsable
        echo "MODIFICAR RESPONSABLE \n\n";
        echo "Ingrese el número del responsable que desea modificar: \n";
        $nroResponsable = trim(fgets(STDIN));
        $objResponsable = new Responsable;
        if ($objResponsable->Buscar($nroResponsable)) {
          menuModificarResponsable($nroResponsable);
        } else {
          echo "No se encontró un responsable con ese número \n";
        }
        break;
      case 3:
        // Acción para eliminar responsable
        //CORREGIR, NO ELIMINAR RESPONSABLE SI YA ESTÁ REFERENCIADO EN VIAJES
        //ESPERAR A QUE ESTÉN LOS MÉTODOS EN LA CLASE VIAJE
        echo "ELIMINAR RESPONSABLE \n\n";
        echo "Ingrese el número del responsable que desea eliminar\n";
        $nroResponsable = trim(fgets(STDIN));
        $objResponsable = new Responsable();
        if ($objResponsable->Buscar($nroResponsable)) {
          echo $objResponsable . "\n";
          $objResponsable->eliminar();
          echo "Responsable eliminado de la BD\n";
        } else {
          echo "Responsable no encontrado\n";
        }
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
        // Listar todos los responsables
        $objResponsable = new Responsable();
        $colResponsables = $objResponsable->listar();
        if ($colResponsables != null) {
          foreach ($colResponsables as $responsable) {
            echo "\n" . $responsable . "\n";
          }
        } else {
          echo "aún no hay responsables cargados en la db";
        }
        break;
      case 6:
        // Volver al menú principal
        $salirMenuResponsable = true;

      default:
        echo "Opción no válida \n";
        break;
    }
  } while (!$salirMenuResponsable);
}

function menuModificarResponsable($nroResponsable)
{
  $objResponsable = new Responsable();
  $salirMenuModificarResponsable = false;
  if ($objResponsable->Buscar($nroResponsable)) {
    do {
      echo "\nElija una opción\n";
      echo "1-Modificar nombre\n";
      echo "2-Modificar apellido\n";
      echo "3-Modificar numero licencia\n";
      echo "4-Volver\n";
      $opcion = trim(fgets(STDIN));
      switch ($opcion) {
        case 1:
          echo "Ingrese el nuevo nombre: \n";
          $modificacion = trim(fgets(STDIN));
          $objResponsable->setNomb($modificacion);
          if ($objResponsable->modificar()) {
            echo "Responsable modificado con éxito\n";
          } else {
            echo "No se pudo modificar el responsable\n";
          }
          break;
        case 2:
          echo "Ingrese el nuevo apellido: \n";
          $modificacion = trim(fgets(STDIN));
          $objResponsable->setApellido($modificacion);
          $objResponsable->modificar();
          break;
        case 3:
          echo "Ingrese el nuevo numero de licencia: \n";
          $modificacion = trim(fgets(STDIN));
          $objResponsable->setNumLic($modificacion);
          $objResponsable->modificar();
          break;
        case 4:
          $salirMenuModificarResponsable = true;
          break;
        default:
          echo "Opción no valida, vuelva a intentar.";
          break;
      }
    } while (!$salirMenuModificarResponsable);
  } else {
    echo "Responsable no encontrado";
  }
}

// $persona = new Pasajero();
// $persona->Buscar('12345678');
// echo $persona;
function menuEmpresa(){
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
          echo "AGREGAR EMPRESA \n\n";
          echo "Ingrese nombre de la empresa: \n";
          $empresaNombre = trim(fgets(STDIN));
          echo "Ingrese la direccion\n";
          $empresaDir = trim(fgets(STDIN));
          $objEmpresa = new Empresa();
          if($objEmpresa -> listar("enombre =" . $empresaNombre)){
            echo "Ya existe una empresa con ese nombre";
          }else{
            $objEmpresa->cargar("", $empresaNombre, $empresaDir );
            $objEmpresa->insertar();
            echo "Empresa agregada con exito";
          }
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
}

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
        menuEmpresa();
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
