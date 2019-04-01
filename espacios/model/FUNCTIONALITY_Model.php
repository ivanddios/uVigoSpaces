<?php

require_once(__DIR__."..\..\core\ConnectionBD.php");

class FUNCTIONALITY_Model {

    private $idFunction;
	private $nameFunction;
	private $descripFunction;
	private $mysqli;


function __construct($idFunction=null,$nameFunction=NULL, $descripFunction=NULL)
{
    $this->idFunction = $idFunction;
    $this->nameFunction =  $nameFunction; 
	$this->descripFunction = $descripFunction;
    $this->mysqli = Connection::connectionBD();
}

public function getNameFunction(){
    return $this->nameFunction;
}


function showAllFunctions() {
    $sql = "SELECT * FROM functionality";
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

function showAllActions() {
    $sql = "SELECT * FROM action";
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


function showAllActionsForFunctionality() {
    $sql = "SELECT idAction FROM action_functionality WHERE idFunction = '$this->idFunction'";
    if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
    } else {
        $toret = array();
        $i = 0;
        while ($fila = $resultado->fetch_array()) {
            $toret[$i] = $fila['idAction'];
            $i++;
        }
        return  $toret;
    }
}

function findFunctionality() {
	$sql = "SELECT * FROM functionality WHERE idFunction = '$this->idFunction'";
    if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
    } else {
        $result = $resultado->fetch_array();
        return $result;
    }
}

function addFunction($actions) {
    $sqlFunction = "INSERT INTO functionality (nameFunction, descripFunction) VALUES ('$this->nameFunction', '$this->descripFunction')";
    if (!($resultado = $this->mysqli->query($sqlFunction))) {
        throw new Exception('Error in the query on the database');
    } else {
        $lastId = $this->mysqli->insert_id;
        foreach($actions as $action){
            $sqlFunctionAction = "INSERT INTO action_functionality (idAction, idFunction) VALUES ($action->id, $lastId)";
            if (!($resultado = $this->mysqli->query($sqlFunctionAction))) {
                throw new Exception('Error in the query on the database');
            }
        }
        return true;
    }
    throw new Exception('Error in the query on the database');
}


function deleteFunction() {
    $sql = "DELETE FROM functionality WHERE idFunction ='$this->idFunction'";
    if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
    } else {
        return true;
    }
}


function updateFunction($actions) {
    $sql = "DELETE FROM functionality WHERE idFunction ='$this->idFunction'";
    if (($resultado = $this->mysqli->query($sql))) {
        if(!$this->addFunction($actions)){
            throw new Exception('Error in the query on the database'); 
        }
    } else {
        throw new Exception('Error in the query on the database'); 
    }
    return true;
}


public function existsFunction() {
	$sql = "SELECT * FROM functionality WHERE idFunction = '$this->idFunction'";
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