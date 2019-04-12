<?php

require_once(__DIR__."..\..\core\ConnectionBD.php");

class GROUP_Model {

    private $idGroup;
	private $nameGroup;
	private $descripGroup;
	private $mysqli;


function __construct($idGroup=null, $nameGroup=null, $descripGroup=null)
{
    $this->idGroup = $idGroup;
    $this->nameGroup =  $nameGroup; 
	$this->descripGroup = $descripGroup;
    $this->mysqli = Connection::connectionBD();
}

public function getNameGroup(){
    return $this->nameGroup;
}


function showAllGroups() {
    $sql = "SELECT * FROM `SM_GROUP`";
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



function findGroup() {
	$sql = "SELECT * FROM `SM_GROUP` WHERE sm_idGroup = '$this->idGroup'";
    if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
    } else {
        $result = $resultado->fetch_array();
        return $result;
    }
}


function addGroup($permissions) {

    $sql = "INSERT INTO `SM_GROUP` (sm_nameGroup, sm_descripGroup) VALUES ('$this->nameGroup', '$this->descripGroup')";
    if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
    } else {
        $idGroup = $this->mysqli->insert_id;
        $this->addPermission($idGroup, $permissions);
        return true;
    }
    throw new Exception('Error in the query on the database');
}


function addPermission($idGroup, $permissions) {

    foreach($permissions as $permission){
        $sql = "INSERT INTO `SM_PERMISSION` (sm_idGroup, sm_idFunction, sm_idAction) VALUES ('$idGroup', '$permission->idFunction', '$permission->idAction')";
        if (!($resultado = $this->mysqli->query($sql))) {
            throw new Exception('Error in the query on the database');
        }
    }
    return true;
}


function deleteGroup() {
    $sql = "DELETE FROM `SM_GROUP` WHERE sm_idGroup ='$this->idGroup'";
    if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
    } else {
        return true;
    }
}


function updateGroup() {
    $sql = "UPDATE `SM_GROUP` SET sm_nameGroup = '$this->nameGroup', sm_descripGroup = '$this->descripGroup' WHERE sm_idGroup = '$this->idGroup'";
    if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
    } else {
        return true;
    }
}


public function existsGroup() {
	$sql = "SELECT * FROM `SM_GROUP` WHERE sm_idGroup = '$this->idGroup'";
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