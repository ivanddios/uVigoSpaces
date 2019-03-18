<?php

require_once(__DIR__."..\..\core\ConnectionBD.php");

class SPACE_Model {

    private $idBuilding;
    private $idFloor;
    private $idSpace;
	private $nameSpace;
	private $surfaceSpace;
    private $numberInventorySpace;
    private $coordsPlane;
	private $mysqli;

function __construct($idBuilding=NULL, $idFloor=NULL, $idSpace=NULL, $nameSpace=NULL, $surfaceSpace=NULL, $numberInventorySpace=NULL, $coordsPlane=NULL)
{
    $this->idBuilding =  $idBuilding; 
    $this->idFloor = $idFloor;
    $this->idSpace = $idSpace;
	$this->nameSpace = $nameSpace;
    $this->surfaceSpace = $surfaceSpace;
    $this->coordsPlane = $coordsPlane;
    $this->mysqli = Connection::connectionBD();

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

public function setSurfaceSpace($surfaceSpace) {
    $this->surfaceSpace = $surfaceSpace;
}

public function setNumberInventorySpace($numberInventorySpace) {
    $this->numberInventorySpace = $numberInventorySpace;
}


function showAllSpaces() {
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

function findSpace() {
    $sql = "SELECT * FROM space WHERE idBuilding = '$this->idBuilding' AND idFloor = '$this->idFloor' AND idSpace = '$this->idSpace'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
    } else {
        $result = $resultado->fetch_array();
        return $result;
    }
}


function findInfoSpace() {
    $sql = "SELECT building.nameBuilding, floor.nameFloor, space.nameSpace, space.coordsPlane FROM building, floor, space WHERE building.idBuilding = floor.idBuilding AND floor.idFloor = space.idFloor AND building.idBuilding = '$this->idBuilding' AND floor.idFloor = '$this->idFloor' AND idSpace = '$this->idSpace'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
    } else {
        $result = $resultado->fetch_array();
        return $result;
    }
}

function findNameSpace() {
    $sql = "SELECT nameSpace FROM space WHERE idBuilding='$this->idBuilding' AND idFloor = '$this->idFloor' AND idSpace = '$this->idSpace'";
    $result = $this->mysqli->query($sql)->fetch_array();
    return $result['nameSpace'];
}

function findCoordsSpace() {
    $sql = "SELECT coordsPlane FROM space WHERE idBuilding='$this->idBuilding' AND idFloor = '$this->idFloor' AND idSpace = '$this->idSpace'";
    $result = $this->mysqli->query($sql)->fetch_array();
    return $result['coordsPlane'];
}






function addSpace() {
    $sql = "INSERT INTO space (idBuilding, idFloor, idSpace, nameSpace, surfaceSpace, numberInventorySpace) VALUES ('$this->idBuilding', '$this->idFloor', '$this->idSpace', '$this->nameSpace', $this->surfaceSpace, '$this->numberInventorySpace')";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
    } else {
        return true;
    }
}


function addCoords() {
    $sql = "UPDATE space SET coordsPlane = '$this->coordsPlane' WHERE idBuilding = '$this->idBuilding' AND idFloor = '$this->idFloor' AND idSpace = '$this->idSpace'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
    } else {
        var_dump($resultado);
        return true;
    }
}


function updateSpace($idBuilding, $idFloor, $idSpace) {
    $sql = "UPDATE space SET idSpace = '$this->idSpace', nameSpace = '$this->nameSpace', surfaceSpace = $this->surfaceSpace, numberInventorySpace = '$this->numberInventorySpace' WHERE idBuilding = '$idBuilding' AND idFloor = '$idFloor' AND idSpace = '$idSpace'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
    } else {
        return true;
    }
}

function deleteSpace() {
    $sql = "DELETE FROM space WHERE idBuilding ='$this->idBuilding' AND idFloor = '$this->idFloor' AND idSpace = '$this->idSpace'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
    } else {
        return true;
    }
}


public function existsSpace() {
	$sql = "SELECT * FROM space WHERE idBuilding = '$this->idBuilding' AND idFloor = '$this->idFloor' AND idSPace = '$this->idSpace'";
	$result = $this->mysqli->query($sql);
	if ($result->num_rows == 1) {
		return true;
	} else {
		return false;
	}
}

public function existsSpaceToEdit($idSpace) {
	$sql = "SELECT * FROM space WHERE (idBuilding, idFloor, idSpace) 
            NOT IN (SELECT idBuilding, idFloor, idSpace FROM space WHERE idBuilding='$this->idBuilding' AND idFloor='$this->idFloor' AND idSpace='$idSpace') 
            AND idBuilding='$this->idBuilding' AND idFloor='$this->idFloor' AND idSpace='$this->idSpace'";
	$result = $this->mysqli->query($sql);
	if ($result->num_rows >= 1) {
		return true;
	} else {
		return false;
	}
}


public function findPlane() {
	$sql = "SELECT planeFloor FROM floor WHERE idBuilding = '$this->idBuilding' AND idFloor = '$this->idFloor'";
	$result = $this->mysqli->query($sql)->fetch_array();
    return $result['planeFloor'];
}




//SERVER VALIDATION

public function checkIsValidForAdd() {

    $errors = array();

    if (!preg_match('/^[0-9]{1,8}([.][0-9]{1,2}){0,1}?$/', $this->surfaceSpace)) {
        $this->setSurfaceSpace(0.0);
    }

    if (!preg_match('/^([0-9]{6}|[#]{6})$/', $this->numberInventorySpace)) {
        $this->setNumberInventorySpace("######");
    }

    if (strlen(trim($this->idBuilding)) == 0 ) {
        $errors= "Building id is mandatory";
    }else if (strlen(trim($this->idBuilding)) > 6 ) {
        $errors = "Building id can not be that long";
    }else if(!preg_match('/[A-Z0-9]/', $this->idBuilding)){
        $errors = "Building id is invalid. Example: OSBI0";
    }elseif (strlen(trim($this->idFloor)) == 0 ) {
        $errors= "Floor id is mandatory";
    }else if (strlen(trim($this->idFloor)) > 2 ) {
        $errors = "Floor id can not be that long";
    }else if(!preg_match('/[A-Z0-9]/', $this->idFloor)){
        $errors = "Floor id is invalid. Example: 00,S1";
    }elseif (strlen(trim($this->idSpace)) == 0 ) {
        $errors= "Space id is mandatory";
    }else if (strlen(trim($this->idSpace)) > 6 ) {
        $errors = "Space id can not be that long";
    }else if(!preg_match('/^[0-9]{5}$/', $this->idSpace)){
        $errors = "Space id is invalid. Example: 000011";
    }elseif($this->existsSpace()){
        $errors = "There is already a space with that id in this floor";
    }else if (strlen(trim($this->nameSpace)) == 0 ) {
        $errors= "Space name is mandatory";
    }else if (strlen(trim($this->nameSpace)) > 225 ) {
        $errors = "Space name can not be that long";
    }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameSpace)){
        $errors = "Space name is invalid. Try again!";
    }else if (strlen(trim($this->surfaceSpace)) > 99999999.99) {
        $errors = "Space surface can not be that long";
    }
    if (sizeof($errors) > 0){
        throw new Exception($errors);
    }
}

public function checkIsValidForEdit($idSpace) {

    $errors = array();

    if (!preg_match('/^[0-9]{1,8}([.][0-9]{1,2}){0,1}?$/', $this->surfaceSpace)) {
        $this->setSurfaceSpace(0.0);
    }

    if (!preg_match('/^([0-9]{6}|[#]{6})$/', $this->numberInventorySpace)) {
        $this->setNumberInventorySpace("######");
    }

    if (strlen(trim($this->idBuilding)) == 0 ) {
        $errors= "Building id is mandatory";
    }else if (strlen(trim($this->idBuilding)) > 6 ) {
        $errors = "Building id can not be that long";
    }else if(!preg_match('/[A-Z0-9]/', $this->idBuilding)){
        $errors = "Building id is invalid. Example: OSBI0";
    }elseif (strlen(trim($this->idFloor)) == 0 ) {
        $errors= "Floor id is mandatory";
    }else if (strlen(trim($this->idFloor)) > 2 ) {
        $errors = "Floor id can not be that long";
    }else if(!preg_match('/[A-Z0-9]/', $this->idFloor)){
        $errors = "Floor id is invalid. Example: 00,S1";
    }elseif (strlen(trim($this->idSpace)) == 0 ) {
        $errors= "Space id is mandatory";
    }else if (strlen(trim($this->idSpace)) > 6 ) {
        $errors = "Space id can not be that long";
    }else if(!preg_match('/^[0-9]{5}$/', $this->idSpace)){
        $errors = "Space id is invalid. Example: 000011";
    }elseif($this->existsSpaceToEdit($idSpace)){
        $errors = "There is already a space with that id in this floor";
    }else if (strlen(trim($this->nameSpace)) == 0 ) {
        $errors= "Space name is mandatory";
    }else if (strlen(trim($this->nameSpace)) > 225 ) {
        $errors = "Space name can not be that long";
    }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameSpace)){
        $errors = "Space name is invalid. Try again!";
    }else if (strlen(trim($this->surfaceSpace)) > 99999999.99) {
        $errors = "Space surface can not be that long";
    }
    if (sizeof($errors) > 0){
        throw new Exception($errors);
    }
}



}