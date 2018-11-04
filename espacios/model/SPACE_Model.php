<?php

class SPACE_Model {

    private $idBuilding;
    private $idFloor;
    private $idSpace;
	private $nameSpace;
	private $surfaceSpace;
	private $numberInventorySpace;
	private $mysqli;

function __construct($idBuilding=NULL, $idFloor=NULL, $idSpace=NULL, $nameSpace=NULL, $surfaceSpace=NULL, $numberInventorySpace=NULL)
{
    $this->idBuilding =  $idBuilding; 
    $this->idFloor = $idFloor;
    $this->idSpace = $idSpace;
	$this->nameSpace = $nameSpace;
    $this->surfaceSpace = $surfaceSpace;

    if(empty($numberInventorySpace)){
        $this->numberInventorySpace = "######";
    } else {
    $this->numberInventorySpace = $numberInventorySpace;
    }
}



public function getIdBuilding(){
    return $this->idBuilding;
}

public function getIdFloor(){
    return $this->idFloor;
}

public function getIdSpace(){
    return $this->idSpace;
}

public function getNameSpace(){
    return $this->nameSpace;
}



function ConectarBD() {
    $this->mysqli = new mysqli("localhost", "root", "", "espacios");
    $acentos = $this->mysqli->query("set names 'utf8'");
    if ($this->mysqli->connect_errno) {
        echo "Error to conect with MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
    }
}

function showAllSpaces() {
    $this->ConectarBD();
    $sql = "SELECT * FROM space WHERE idBuilding = '$this->idBuilding' AND idFloor = '$this->idFloor'" ;
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


function existsSpace() {
	$this->ConectarBD();
	$sql = "SELECT * FROM FLOOR WHERE idBuilding = '$this->idBuilding' AND idFloor = '$this->idFloor' AND idSpace = '$this->idSpace'";
	$result = $this->mysqli->query($sql);
	if ($result->num_rows == 1) {
		return true;
	} else {
		return 'Error in the query on the database';
	}
}


function findNameSpace() {
    $this->ConectarBD();
    $sql = "SELECT nameSpace FROM space WHERE idBuilding='$this->idBuilding' AND idFloor = '$this->idFloor' AND idSpace = '$this->idSpace'";
    $result = $this->mysqli->query($sql)->fetch_array();
    return $result['nameSpace'];
}


function fillInSpace() {
    $this->ConectarBD();
    $sql = "SELECT * FROM space WHERE idBuilding = '$this->idBuilding' AND idFloor = '$this->idFloor' AND idSpace = '$this->idSpace'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
    } else {
        $result = $resultado->fetch_array();
        return $result;
    }
}

function addSpace() {
    $this->ConectarBD();
    $sql = "INSERT INTO space (idBuilding, idFloor, idSpace, nameSpace, surfaceSpace, numberInventorySpace) VALUES ('$this->idBuilding', '$this->idFloor', '$this->idSpace', '$this->nameSpace', $this->surfaceSpace, '$this->numberInventorySpace')";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
    } else {
        return true;
    }
}

function updateSpace($idBuilding, $idFloor, $idSpace) {
    $this->ConectarBD();
    var_dump($this->idBuilding);
    var_dump($this->idFloor);
    var_dump($this->idSpace);
    var_dump($this->nameSpace);
    var_dump($this->surfaceSpace);
    var_dump($this->numberInventorySpace);
    $sql = "UPDATE space SET idSpace = '$this->idSpace', nameSpace = '$this->nameSpace', surfaceSpace = $this->surfaceSpace, numberInventorySpace = '$this->numberInventorySpace' WHERE idBuilding = '$idBuilding' AND idFloor = '$idFloor' AND idSpace = '$idSpace'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
    } else {
        return true;
    }
}

function deleteSpace() {
    $this->ConectarBD();
    $sql = "DELETE FROM space WHERE idBuilding ='$this->idBuilding' AND idFloor = '$this->idFloor' AND idSpace = '$this->idSpace'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
    } else {
        return true;
    }
}




}