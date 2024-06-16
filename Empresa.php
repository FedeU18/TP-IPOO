<?php
class Empresa {
    private $idempresa;
    private $enombre;
    private $edireccion;
    private $mensajeoperacion;

    public function __construct() {
        $this->idempresa = "";
        $this->enombre = "";
        $this->edireccion = "";
    }

    public function cargar($idempresa, $enombre,$edireccion){
        $this->setIdEmpresa($idempresa);
        $this->setENombre($enombre);
        $this->setEDireccion($edireccion);
    }

    public function getIdEmpresa(){
        return $this->idempresa;
    }
    public function setIdEmpresa($idempresa){
        $this->idempresa = $idempresa;
    }

    public function getENombre(){
        return $this->enombre;
    }
    public function setENombre($enombre){
        $this->enombre = $enombre;
    }

    public function getEDireccion(){
        return $this->edireccion;
    }
    public function setEDireccion($edireccion){
        $this->edireccion = $edireccion;
    }

    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }
    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }


    /**
     * Recupera los datos de una empresa por su id
     * @param int $idEmp
     * @return true en caso de encontrar los datos, false en caso contrario
     */
    public function Buscar($idEmp){
        $base=new BaseDatos();
        $consultaEmpresa="Select * from empresa where idempresa=".$idEmp;
        $resp= false;
        if($base->Iniciar()){
            if($base->Ejecutar($consultaEmpresa)){
                if($row2=$base->Registro()){
                    $this->cargar($idEmp, $row2['enombre'], $row2['edireccion'] );
                    $resp= true;
                }

            }	else {
                $this->setmensajeoperacion($base->getError());

            }
        }	else {
            $this->setmensajeoperacion($base->getError());

        }
        return $resp;
    }


    public function listar($condicion=""){
        $arregloEmpresa = null;
        $base=new BaseDatos();
        $consultaEmpresas="Select * from empresa ";
        if ($condicion!=""){
            $consultaEmpresas=$consultaEmpresas.' where '.$condicion;
        }
        $consultaEmpresas.=" order by enombre ";
        //echo $consultaEmpresas;
        if($base->Iniciar()){
            if($base->Ejecutar($consultaEmpresas)){
                $arregloEmpresa= array();
                while($row2=$base->Registro()){

                    $EId = $row2['idempresa'];
                    $Enombre = $row2['enombre'];
                    $Edireccion = $row2['edireccion'];

                    $emp=new Empresa();
                    $emp->cargar($EId, $Enombre, $Edireccion);
                    array_push($arregloEmpresa,$emp);

                }


            }else {
                $this->setmensajeoperacion($base->getError());
            }
        }else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arregloEmpresa;
    }



    public function insertar(){
        $base=new BaseDatos();
        $resp= false;
        $consultaInsertar="INSERT INTO empresa(enombre, edireccion) 
				VALUES (".$this->getENombre()."','".$this->getEDireccion()."')";

        if($base->Iniciar()){

            if($base->Ejecutar($consultaInsertar)){

                $resp=  true;

            }	else {
                $this->setmensajeoperacion($base->getError());

            }

        } else {
            $this->setmensajeoperacion($base->getError());

        }
        return $resp;
    }

    public function modificar(){
        $resp =false;
        $base=new BaseDatos();
        $consultaModificar="UPDATE empresa SET enombre='".$this->getENombre()."',edireccion='".$this->getEDireccion()." WHERE idempresa=". $this->getIdEmpresa();
        if($base->Iniciar()){
            if($base->Ejecutar($consultaModificar)){
                $resp=  true;
            }else{
                $this->setmensajeoperacion($base->getError());

            }
        }else{
            $this->setmensajeoperacion($base->getError());

        }
        return $resp;
    }

    public function eliminar(){
        $base=new BaseDatos();
        $resp=false;
        if($base->Iniciar()){
            $consultaEliminar="DELETE FROM empresa WHERE idempresa=".$this->getIdEmpresa();
            if($base->Ejecutar($consultaEliminar)){
                $resp=  true;
            }else{
                $this->setmensajeoperacion($base->getError());

            }
        }else{
            $this->setmensajeoperacion($base->getError());

        }
        return $resp;
    }

    public function __toString()
    {
        return "Id Empresa: " . $this->idempresa . " - Nombre: " .  
        $this->enombre . " - Dirección: " . $this->edireccion;
    }
}


