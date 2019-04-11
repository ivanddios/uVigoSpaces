<?php

require_once(__DIR__."..\..\core\ConnectionBD.php");

class ACTION_Model {

    private $idAction;
	private $nameAction;
	private $descripAction;
	private $mysqli;


function __construct($idAction=null, $nameAction=null, $descripAction=null)
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

    $errors = $this->checkIsValidForAdd();
    if($errors === false){
        $sql = "INSERT INTO `SM_ACTION` (sm_nameAction, sm_descripAction) VALUES ('$this->nameAction', '$this->descripAction')";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
            //throw new Exception('Error in the query on the database');
        } else {
            return true;
        }
        return 'Error in the query on the database';
        //throw new Exception('Error in the query on the database');

    } else {
        return $errors;
    }
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
    $errors = $this->checkIsValidForUpdate();
    if($errors == false){
        $sql = "UPDATE `SM_ACTION` SET sm_nameAction = '$this->nameAction', sm_descripAction = '$this->descripAction' WHERE sm_idAction = '$this->idAction'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
            //throw new Exception('Error in the query on the database');
        } else {
            return true;
        }
    } else {
        return $errors;
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


public function checkIsValidForAdd() {

    $errors = false;

    if (strlen(trim($this->nameAction)) == 0  && (strlen(trim($this->descripAction)) == 0 )){
        $errors = "Action name and description are mandatory";
    }else if (strlen(trim($this->nameAction)) == 0 ) {
        $errors = "Action name is mandatory";
    }else if (strlen(trim($this->nameAction)) > 225 ) {
        $errors = "Action name can not be that long";
    }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameAction)){
        $errors = "Action name is invalid";
    }else if (strlen(trim($this->descripAction)) == 0 ) {
        $errors= "Action description is mandatory";
    }else if (strlen(trim($this->descripAction)) > 225 ) {
        $errors = "Action description can not be that long";
    }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->descripAction)){
        $errors = "Action description is invalid";
    }

    return $errors;
}


public function checkIsValidForUpdate() {

    $errors = false;

    if(strlen(trim($this->idAction)) == 0){
        $errors = "Action id are mandatory";
    }else if($this->existsAction() !== true) {
        $errors = "Action does not exists";
    } else if (strlen(trim($this->nameAction)) == 0  && (strlen(trim($this->descripAction)) == 0 )){
        $errors = "Action name and description are mandatory";
    }else if (strlen(trim($this->nameAction)) == 0 ) {
        $errors = "Action name is mandatory";
    }else if (strlen(trim($this->nameAction)) > 225 ) {
        $errors = "Action name can not be that long";
    }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameAction)){
        $errors = "Action name is invalid";
    }else if (strlen(trim($this->descripAction)) == 0 ) {
        $errors= "Action description is mandatory";
    }else if (strlen(trim($this->descripAction)) > 225 ) {
        $errors = "Action description can not be that long";
    }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->descripAction)){
        $errors = "Action description is invalid";
    }

    return $errors;
}




}