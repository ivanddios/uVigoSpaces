<?php

require_once(__DIR__."..\..\core\ConnectionBD.php");

class BUILDING_Model {

	private $idBuilding;
	private $nameBuilding;
	private $addressBuilding;
	private $phoneBuilding;
	private $mysqli;


function __construct($idBuilding=NULL, $nameBuilding=NULL, $addressBuilding=NULL, $phoneBuilding=NULL)
{
    $this->idBuilding =  $idBuilding; 
	$this->nameBuilding = $nameBuilding;
	$this->addressBuilding = $addressBuilding;
    $this->phoneBuilding = $phoneBuilding;
    $this->mysqli = Connection::connectionBD();
}

public function getIdBuilding(){
    return $this->idBuilding;
}

public function getNameBuilding(){
    return $this->nameBuilding;
}


function showAllBuilding() {
    $sql = "SELECT * FROM `SM_BUILDING`";
    if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
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

function findBuilding() {
	$sql = "SELECT * FROM `SM_BUILDING` WHERE sm_idBuilding = '$this->idBuilding'";
	$result = $this->mysqli->query($sql);
	if ($result->num_rows == 1) {
		return true;
	} else {
		throw new Exception('Error in the query on the database');
	}
}

function addBuilding() {
    $errors = $this->checkIsValidForAdd_Update();
    if($errors === false){
        if(!$this->existsBuilding()){
            $sql = "INSERT INTO `SM_BUILDING` (sm_idBuilding, sm_nameBuilding, sm_addressBuilding, sm_phoneBuilding) VALUES ('$this->idBuilding', '$this->nameBuilding', '$this->addressBuilding', '$this->phoneBuilding')";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                return true;
            }
        } else {
            return 'There is already a building with that id';
        }
    } else {
        return $errors;
    }
}


function deleteBuilding() {
    $sql = "DELETE FROM `SM_BUILDING` WHERE sm_idBuilding ='$this->idBuilding'";
    if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
    } else {
        return true;
    }
}

function fillInBuilding() {
    $sql = "SELECT * FROM `SM_BUILDING` WHERE sm_idBuilding = '$this->idBuilding'";
    if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
    } else {
        $result = $resultado->fetch_array();
        return $result;
    }
}

function updateBuilding() {
    $errors = $this->checkIsValidForAdd_Update();
    if($errors === false){
        if($this->existsBuilding()){
            $sql = "UPDATE `SM_BUILDING` SET sm_idBuilding = '$this->idBuilding', sm_nameBuilding = '$this->nameBuilding', sm_addressBuilding = '$this->addressBuilding', sm_phoneBuilding = '$this->phoneBuilding' WHERE sm_idBuilding = '$this->idBuilding'";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                return true;
            }
        }else{
            return 'There is not a building with that id';
        }
    } else {
        return $errors;
    }
}


function findBuildingName() {
    $sql = "SELECT sm_nameBuilding FROM `SM_BUILDING` WHERE sm_idBuilding='$this->idBuilding'";
    $result = $this->mysqli->query($sql)->fetch_array();
    return $result['sm_nameBuilding'];
}


public function existsBuilding() {
	$sql = "SELECT * FROM `SM_BUILDING` WHERE sm_idBuilding = '$this->idBuilding'";
	$result = $this->mysqli->query($sql);
	if ($result->num_rows == 1) {
		return true;
	} else {
		return false;
	}
}


public function checkIsValidForAdd_Update() {

    $errors = false;

    if (strlen(trim($this->idBuilding)) == 0 ) {
        $errors= "Building id is mandatory";
    }else if (strlen(trim($this->idBuilding)) > 6 ) {
        $errors = "Building id can not be that long";
    }else if(!preg_match('/[A-Z0-9]/', $this->idBuilding)){
        $errors = "Building id is invalid. Example: OSBI0";
    }else if (strlen(trim($this->nameBuilding)) == 0 ) {
        $errors= "Building name is mandatory";
    }else if (strlen(trim($this->nameBuilding)) > 225 ) {
        $errors = "Building name can not be that long";
    }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameBuilding)){
        $errors = "Building name is invalid";
    }else if (strlen(trim($this->addressBuilding)) == 0 ) {
        $errors= "Building address is mandatory";
    }else if (strlen(trim($this->addressBuilding)) > 225 ) {
        $errors = "Building address can not be that long";
    }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->addressBuilding)){
        $errors = "Building address is invalid";
    }else if (strlen(trim($this->phoneBuilding)) != 9 ) {
        $errors= "Building phone is incorrect. Example: 666777888";
    }else if(!preg_match('/^[9|6|7][0-9]{8}$/', $this->phoneBuilding)){
        $errors = "Building phone format is invalid. Example: 666777888";
    }

    return $errors;
}




}