<?php


include 'BaseDatos.php';
include 'Empresa.php';
include 'Responsable.php';
include 'Viaje.php';
include 'Pasajero.php';


$persona = new Pasajero();
$persona->Buscar('12345678');
echo $persona;



