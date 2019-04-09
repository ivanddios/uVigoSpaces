<?php

require_once(__DIR__."..\..\core\ConnectionBD.php");

class ACTION_Model {

    private $idAction;
	private $nameAction;
	private $descripAction;
	private $mysqli;


function __construct($idAction=NULL, $nameAction=NULL, $descripAction=NULL)
{
    $this->idAction = $idAction;
    $this->nameAction =  $nameAction; 
	$this->descripAction = $descripAction;
    $this->mysqli = Connection::connectionBD();
}

public function getNameAction(){
    return $this->nameAction;
}


function showAllActions() {
    $sql = "SELECT * FROM `SM_ACTION`";
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



function findAction() {
	$sql = "SELECT * FROM `SM_ACTION` WHERE sm_idAction = '$this->idAction'";
    if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
    } else {
        $result = $resultado->fetch_array();
        return $result;
    }
}

function findNameAction() {
	$sql = "SELECT sm_nameAction FROM `SM_ACTION` WHERE sm_idAction = '$this->idAction'";
    if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
    } else {
        $result = $resultado->fetch_array();
        return $result['nameAction'];
    }
}

function addAction() {
    $sql = "INSERT INTO `SM_ACTION` (sm_nameAction, sm_descripAction) VALUES ('$this->nameAction', '$this->descripAction')";
    if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
    } else {
        return true;
    }
    throw new Exception('Error in the query on the database');
}


function deleteAction() {
    $sql = "DELETE FROM `SM_ACTION` WHERE sm_idAction ='$this->idAction'";
    if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
    } else {
        return true;
    }
}


function updateAction() {
    $sql = "UPDATE `SM_ACTION` SET sm_nameAction = '$this->nameAction', sm_descripAction = '$this->descripAction' WHERE sm_idAction = '$this->idAction'";
    if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
    } else {
        return true;
    }
}


public function existsAction() {
	$sql = "SELECT * FROM `SM_ACTION` WHERE sm_idAction = '$this->idAction'";
	$result = $this->mysqli->query($sql);
	if ($result->num_rows == 1) {
		return true;
	} else {
		return false;
	}
}


// public function checkIsValidForAdd_Update() {

//     $errors = array();

//     if (strlen(trim($this->idBuilding)) == 0 ) {
//         $errors= "Building id is mandatory";
//     }else if (strlen(trim($this->idBuilding)) > 6 ) {
//         $errors = "Building id can not be that long";
//     }else if(!preg_match('/[A-Z0-9]/', $this->idBuilding)){
//         $errors = "Building id is invalid. Example: OSBI0";
//     }elseif($this->existsBuilding($this->idbuilding)){
//         $errors = "There is already a building with that id";
//     }else if (strlen(trim($this->nameBuilding)) == 0 ) {
//         $errors= "Building name is mandatory";
//     }else if (strlen(trim($this->nameBuilding)) > 225 ) {
//         $errors = "Building name can not be that long";
//     }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameBuilding)){
//         $errors = "Building name is invalid. Try again!";
//     }else if (strlen(trim($this->addressBuilding)) == 0 ) {
//         $errors= "Building address is mandatory";
//     }else if (strlen(trim($this->addressBuilding)) > 225 ) {
//         $errors = "Building address can not be that long";
//     }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->addressBuilding)){
//         $errors = "Building address is invalid. Try again!";
//     }else if (strlen(trim($this->phoneBuilding)) != 9 ) {
//         $errors= "Building phone is incorrect. Example: 666777888";
//     }else if(!preg_match('/^[9|6|7][0-9]{8}$/', $this->phoneBuilding)){
//         $errors = "Building phone format is invalid. Example: 666777888";
//     }

//     if (sizeof($errors) > 0){
//         throw new Exception($errors);
//     }
// }




}