<?php

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
}

public function getIdBuilding(){
    return $this->idBuilding;
}

public function getNameBuilding(){
    return $this->nameBuilding;
}


function ConectarBD() {
    $this->mysqli = new mysqli("localhost", "root", "", "espacios");
    $acentos = $this->mysqli->query("set names 'utf8'");
    if ($this->mysqli->connect_errno) {
        echo  "Error to conect with MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
    }
}


function showAllBuilding() {
    $this->ConectarBD();
    $sql = "SELECT * FROM building";
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
	$this->ConectarBD();
	$sql = "SELECT * FROM building WHERE idBuilding = '$this->idBuilding'";
	$result = $this->mysqli->query($sql);
	if ($result->num_rows == 1) {
		return true;
	} else {
		throw new Exception('Error in the query on the database');
	}
}

function addBuilding() {
    $this->ConectarBD();
    $sql = "INSERT INTO building (idBuilding, nameBuilding, addressBuilding, phoneBuilding) VALUES ('$this->idBuilding', '$this->nameBuilding', '$this->addressBuilding', '$this->phoneBuilding')";
    if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
    } else {
        return true;
    }
}


function deleteBuilding() {
    $this->ConectarBD();
    $sql = "DELETE FROM building WHERE idBuilding ='$this->idBuilding'";
    if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
    } else {
        return true;
    }
}

function fillInBuilding() {
    $this->ConectarBD();
    $sql = "SELECT * FROM building WHERE idBuilding = '$this->idBuilding'";
    if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
    } else {
        $result = $resultado->fetch_array();
        return $result;
    }
}

function updateBuilding($idBuilding) {
    $this->ConectarBD();
    $sql = "UPDATE building SET idBuilding = '$this->idBuilding', nameBuilding = '$this->nameBuilding', addressBuilding = '$this->addressBuilding', phoneBuilding = '$this->phoneBuilding' WHERE idBuilding = '$idBuilding'";
    if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
    } else {
        return true;
    }
}


function findBuildingName() {
    $this->ConectarBD();
    $sql = "SELECT nameBuilding FROM building WHERE idBuilding='$this->idBuilding'";
    $result = $this->mysqli->query($sql)->fetch_array();
    return $result['nameBuilding'];
}


public function existsBuilding($idBuilding) {
	$this->ConectarBD();
	$sql = "SELECT * FROM building WHERE idBuilding = '$idBuilding'";
	$result = $this->mysqli->query($sql);
	if ($result->num_rows == 1) {
		return true;
	} else {
		return false;
	}
}


public function checkIsValidForAdd_Update() {

    $errors = array();

    if (strlen(trim($this->idBuilding)) == 0 ) {
        $errors= "Building id is mandatory";
    }else if (strlen(trim($this->idBuilding)) > 6 ) {
        $errors = "Building id can not be that long";
    }else if(!preg_match('/[A-Z0-9]/', $this->idBuilding)){
        $errors = "Building id is invalid. Example: OSBI0";
    }elseif($this->existsBuilding($this->idbuilding)){
        $errors = "There is already a building with that id";
    }else if (strlen(trim($this->nameBuilding)) == 0 ) {
        $errors= "Building name is mandatory";
    }else if (strlen(trim($this->idBuilding)) > 225 ) {
        $errors = "Building name can not be that long";
    }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameBuilding)){
        $errors = "Building name is invalid. Try again!";
    }else if (strlen(trim($this->addressBuilding)) == 0 ) {
        $errors= "Building address is mandatory";
    }else if (strlen(trim($this->addressBuilding)) > 225 ) {
        $errors = "Building address can not be that long";
    }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->addressBuilding)){
        $errors = "Building address is invalid. Try again!";
    }else if (strlen(trim($this->phoneBuilding)) != 9 ) {
        $errors= "Building phone is incorrect. Example: 666777888";
    }else if(!preg_match('/^[9|6|7][0-9]{8}$/', $this->phoneBuilding)){
        $errors = "Building phone format is invalid. Example: 666777888";
    }

    if (sizeof($errors) > 0){
        throw new Exception($errors);
    }
}




}