<?php

class SPACE_Model {

    private $idBuilding;
	private $idFloor;
	private $nameSpace;
	private $surfaceSpace;
	private $numberInventorySpace;
	private $mysqli;

function __construct($idBuilding=NULL, $idFloor=NULL, $nameSpace=NULL, $surfaceSpace=NULL, $numberInventorySpace=NULL, $FLOOR_surfaceUsefulFloor=NULL)
{
    $this->idBuilding =  $idBuilding; 
    $this->idFloor = $idFloor;
	$this->nameSpace = $nameSpace;
	$this->surfaceSpace = $surfaceSpace;
	$this->numberInventorySpace = $numberInventorySpace;
}



public function getIdBuilding(){
    return $this->idBuilding;
}

public function getIdFloor(){
    return $this->idFloor;
}

public function getNameFloor(){
    return $this->nameSpace;
}



function ConectarBD() {
    $this->mysqli = new mysqli("localhost", "root", "", "espacios");
    $acentos = $this->mysqli->query("SET NAMES 'utf8'");
    if ($this->mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
    }
}

function showAllSpaces() {
    $this->ConectarBD();
    $sql = "SELECT * FROM SPACE WHERE idBuilding = '$this->idBuilding' AND idFloor = '$this->idFloor'" ;
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


// function existsFloor() {
// 	$this->ConectarBD();
// 	$sql = "SELECT * FROM FLOOR WHERE idBuilding = '$this->idBuilding' AND idFloor = '$this->idFloor'";
// 	$result = $this->mysqli->query($sql);
// 	if ($result->num_rows == 1) {
// 		return true;
// 	} else {
// 		return "No exist any floor with this id";
// 	}
// }


// function findNameFloor() {
//     $this->ConectarBD();
//     $sql = "SELECT nameFloor FROM floor WHERE idBuilding='$this->idBuilding' AND idFloor = '$this->idFloor'";
//     $result = $this->mysqli->query($sql)->fetch_array();
//     return $result['nameFloor'];
// }

// function findLinkPlane($idBuilding, $idFloor) {
//     $this->ConectarBD();
//     $sql = "SELECT planeFloor FROM floor WHERE idBuilding='$idBuilding' AND idFloor = '$idFloor'";
//     $result = $this->mysqli->query($sql)->fetch_array();
//     return $result['planeFloor'];
// }

// function fillInFloor() {
//     $this->ConectarBD();
//     $sql = "SELECT * FROM FLOOR WHERE idBuilding = '$this->idBuilding' AND idFloor = '$this->idFloor'";
//     if (!($resultado = $this->mysqli->query($sql))) {
//         return 'Error en la consulta sobre la base de datos';
//     } else {
//         $result = $resultado->fetch_array();
//         return $result;
//     }
// }

// function addFloor() {
//     $this->ConectarBD();
//     $sql = "INSERT INTO FLOOR (idBuilding, idFloor, nameFloor, planeFloor, surfaceBuildingFloor, surfaceUsefulFloor) VALUES ('$this->idBuilding', '$this->idFloor', '$this->nameSpace', '$this->surfaceSpace', $this->numberInventorySpace, $this->FLOOR_surfaceUsefulFloor)";
//     if (!($resultado = $this->mysqli->query($sql))) {
//         return 'Error en la consulta sobre la base de datos.';
//     } else {
//         return true;
//     }
// }

// function updateFloor($idBuilding, $idFloor) {
//     $this->ConectarBD();
//     $sql = "UPDATE FLOOR SET idFloor = '$this->idFloor', nameFloor = '$this->nameSpace', planeFloor = '$this->surfaceSpace', surfaceBuildingFloor = '$this->numberInventorySpace', surfaceUsefulFloor = '$this->FLOOR_surfaceUsefulFloor' WHERE idBuilding = '$idBuilding' AND idFloor = '$idFloor'";
//     if (!($resultado = $this->mysqli->query($sql))) {
//         return 'Error en la consulta sobre la base de datos.';
//     } else {
//         return true;
//     }
// }

// function deleteFloor() {
//     $this->ConectarBD();
//     $sql = "DELETE FROM FLOOR WHERE idBuilding ='$this->idBuilding' AND idFloor = '$this->idFloor'";
//     if (!($resultado = $this->mysqli->query($sql))) {
//         return 'Error en la consulta sobre la base de datos.';
//     } else {
//         return true;
//     }
// }




}