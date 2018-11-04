<?php

class FLOOR_Model {

    private $idBuilding;
	private $idFloor;
	private $nameFLoor;
	private $planeFloor;
	private $surfaceFloor;
    private $usefulFloor;
	private $mysqli;


function __construct($idBuilding=NULL, $idFloor=NULL, $nameFloor=NULL, $planeFloor=NULL, $surfaceFloor=NULL, $usefulFloor=NULL)
{
    $this->idBuilding =  $idBuilding; 
    $this->idFloor = $idFloor;
	$this->nameFloor = $nameFloor;
	$this->planeFloor = $planeFloor;
	$this->surfaceFloor = $surfaceFloor;
	$this->usefulFloor =  $usefulFloor;
}



public function getIdBuilding(){
    return $this->idBuilding;
}

public function getIdFloor(){
    return $this->idFloor;
}

public function getNameFloor(){
    return $this->nameFloor;
}

public function getPlaneFloor(){
    return $this->planeFloor;
}


function ConectarBD() {
    $this->mysqli = new mysqli("localhost", "root", "", "espacios");
    $acentos = $this->mysqli->query("SET NAMES 'utf8'");
    if ($this->mysqli->connect_errno) {
        echo "Error to conect with MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
    }
}


function existsFloor() {
	$this->ConectarBD();
	$sql = "SELECT * FROM FLOOR WHERE idBuilding = '$this->idBuilding' AND idFloor = '$this->idFloor'";
	$result = $this->mysqli->query($sql);
	if ($result->num_rows == 1) {
		return true;
	} else {
		return 'Error in the query on the database';
	}
}


function findFloorName() {
    $this->ConectarBD();
    $sql = "SELECT nameFloor FROM floor WHERE idBuilding='$this->idBuilding' AND idFloor = '$this->idFloor'";
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
    $sql = "SELECT * FROM FLOOR WHERE idBuilding = '$this->idBuilding' AND idFloor = '$this->idFloor'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
    } else {
        $result = $resultado->fetch_array();
        return $result;
    }
}

function addFloor() {
    $this->ConectarBD();
    $sql = "INSERT INTO FLOOR (idBuilding, idFloor, nameFloor, planeFloor, surfaceBuildingFloor, surfaceUsefulFloor) VALUES ('$this->idBuilding', '$this->idFloor', '$this->nameFloor', '$this->planeFloor', $this->surfaceFloor, $this->usefulFloor)";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
    } else {
        return true;
    }
}

function updateFloor($idBuilding, $idFloor) {
    $this->ConectarBD();
    $sql = "UPDATE FLOOR SET idFloor = '$this->idFloor', nameFloor = '$this->nameFloor', planeFloor = '$this->planeFloor', surfaceBuildingFloor = '$this->surfaceFloor', surfaceUsefulFloor = '$this->usefulFloor' WHERE idBuilding = '$idBuilding' AND idFloor = '$idFloor'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
    } else {
        return true;
    }
}

function deleteFloor() {
    $this->ConectarBD();
    $sql = "DELETE FROM FLOOR WHERE idBuilding ='$this->idBuilding' AND idFloor = '$this->idFloor'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
    } else {
        return true;
    }
}


function showAllFloors() {
    $this->ConectarBD();
    $sql = "SELECT * FROM FLOOR WHERE idBuilding = '$this->idBuilding'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
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






}