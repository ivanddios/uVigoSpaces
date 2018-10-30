<?php

class FLOOR_Model {

    private $FLOOR_idBuilding;
	private $FLOOR_idFloor;
	private $FLOOR_nameFloor;
	private $FLOOR_planeFloor;
	private $FLOOR_surfaceBuildingFloor;
    private $FLOOR_surfaceUsefulFloor;
	private $mysqli;


function __construct($FLOOR_idBuilding, $FLOOR_idFloor, $FLOOR_nameFloor, $FLOOR_planeFloor, $FLOOR_surfaceBuildingFloor, $FLOOR_surfaceUsefulFloor)
{
    $this->FLOOR_idBuilding =  $FLOOR_idBuilding; 
    $this->FLOOR_idFloor = $FLOOR_idFloor;
	$this->FLOOR_nameFloor = $FLOOR_nameFloor;
	$this->FLOOR_planeFloor = $FLOOR_planeFloor;
	$this->FLOOR_surfaceBuildingFloor = $FLOOR_surfaceBuildingFloor;
	$this->FLOOR_surfaceUsefulFloor =  $FLOOR_surfaceUsefulFloor;
}



public function getIdBuilding(){
    return $this->FLOOR_idBuilding;
}

public function getIdFloor(){
    return $this->FLOOR_idFloor;
}

public function getNameFloor(){
    return $this->FLOOR_nameFloor;
}

public function getPlaneFloor(){
    return $this->FLOOR_planeFloor;
}


function ConectarBD() {
    $this->mysqli = new mysqli("localhost", "root", "", "espacios");
    $acentos = $this->mysqli->query("SET NAMES 'utf8'");
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


function existsFloor() {
	$this->ConectarBD();
	$sql = "SELECT * FROM FLOOR WHERE idBuilding = '$this->FLOOR_idBuilding' AND idFloor = '$this->FLOOR_idFloor'";
	$result = $this->mysqli->query($sql);
	if ($result->num_rows == 1) {
		return true;
	} else {
		return "No exist any floor with this id";
	}
}


function findNameFloor() {
    $this->ConectarBD();
    $sql = "SELECT nameFloor FROM floor WHERE idBuilding='$this->FLOOR_idBuilding' AND idFloor = '$this->FLOOR_idFloor'";
    $result = $this->mysqli->query($sql)->fetch_array();
    return $result['nameFloor'];
}

function findLinkPlane($idBuilding, $idFloor) {
    $this->ConectarBD();
    $sql = "SELECT planeFloor FROM floor WHERE idBuilding='$idBuilding' AND idFloor = '$idFloor'";
    $result = $this->mysqli->query($sql)->fetch_array();
    return $result['planeFloor'];
}

function fillInFloor() {
    $this->ConectarBD();
    $sql = "SELECT * FROM FLOOR WHERE idBuilding = '$this->FLOOR_idBuilding' AND idFloor = '$this->FLOOR_idFloor'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos';
    } else {
        $result = $resultado->fetch_array();
        return $result;
    }
}

function addFloor() {
    $this->ConectarBD();
    $sql = "INSERT INTO FLOOR (idBuilding, idFloor, nameFloor, planeFloor, surfaceBuildingFloor, surfaceUsefulFloor) VALUES ('$this->FLOOR_idBuilding', '$this->FLOOR_idFloor', '$this->FLOOR_nameFloor', '$this->FLOOR_planeFloor', '$this->FLOOR_surfaceBuildingFloor', '$this->FLOOR_surfaceUsefulFloor')";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos.';
    } else {
        return true;
    }
}

function updateFloor($idBuilding, $idFloor) {
    $this->ConectarBD();
    $sql = "UPDATE FLOOR SET idFloor = '$this->FLOOR_idFloor', nameFloor = '$this->FLOOR_nameFloor', planeFloor = '$this->FLOOR_planeFloor', surfaceBuildingFloor = '$this->FLOOR_surfaceBuildingFloor', surfaceUsefulFloor = '$this->FLOOR_surfaceUsefulFloor' WHERE idBuilding = '$idBuilding' AND idFloor = '$idFloor'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos.';
    } else {
        return true;
    }
}

function deleteFloor() {
    $this->ConectarBD();
    $sql = "DELETE FROM FLOOR WHERE idBuilding ='$this->FLOOR_idBuilding' AND idFloor = '$this->FLOOR_idFloor'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos.';
    } else {
        return true;
    }
}




}