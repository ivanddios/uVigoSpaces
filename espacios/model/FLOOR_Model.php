<?php

class FLOOR_Model {

    private $FLOOR_idBuilding;
	private $FLOOR_idFloor;
	private $FLOOR_nameFloor;
	private $FLOOR_planFloor;
	private $FLOOR_surfaceBuildingFloor;
    private $FLOOR_surfaceUsefulFloor;
	private $mysqli;


function __construct($FLOOR_idBuilding, $FLOOR_idFloor, $FLOOR_nameFloor, $FLOOR_planFloor, $FLOOR_surfaceBuildingFloor, $FLOOR_surfaceUsefulFloor)
{
    $this->FLOOR_idBuilding =  $FLOOR_idBuilding; 
    $this->FLOOR_idFloor = $FLOOR_idFloor;
	$this->FLOOR_nameFloor = $FLOOR_nameFloor;
	$this->FLOOR_planFloor = $FLOOR_planFloor;
	$this->FLOOR_surfaceBuildingFloor = $FLOOR_surfaceBuildingFloor;
	$this->FLOOR_surfaceUsefulFloor =  $FLOOR_surfaceUsefulFloor;
}

function ConectarBD() {
    $this->mysqli = new mysqli("localhost", "root", "", "espacios");
    $this->mysqli->set_charset("utf8");
    if ($this->mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
    }
}

function showAllFloors() {
    $this->ConectarBD();
    $sql = "SELECT * FROM FLOOR WHERE idBuilding = '$this->FLOOR_idBuilding'" ;
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos.';
    } else {
        $toret = array();
        $i = 0;
        while ($fila = $resultado->fetch_array()) {
            $toret[$i] = $fila;
            $i++;
        }
        return $toret;
    }
}


function FillInFloor() {
    $this->ConectarBD();
    $sql = "SELECT * FROM FLOOR WHERE idBuilding = '$this->FLOOR_idBuilding' AND idFloor = '$this->FLOOR_idFloor'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos';
    } else {
        $result = $resultado->fetch_array();
        return $result;
    }
}

function updateFloor($idBuilding, $idFloor) {
    $this->ConectarBD();
    $sql = "UPDATE FLOOR SET idFloor = '$this->FLOOR_idFloor', nameFloor = '$this->FLOOR_nameFloor', planFloor = '$this->FLOOR_planFloor', surfaceBuildingFloor = '$this->FLOOR_surfaceBuildingFloor', surfaceUsefulFloor = '$this->FLOOR_surfaceUsefulFloor' WHERE idBuilding = '$idBuilding' AND idFloor = '$idFloor'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos.';
    } else {
        return true;
    }
}


}