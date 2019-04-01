<?php

require_once(__DIR__."..\..\core\ConnectionBD.php");

class FLOOR_Model {

    private $idBuilding;
	private $idFloor;
	private $nameFLoor;
	private $planeFloor;
	private $surfaceBuildingFloor;
    private $surfaceUsefulFloor;
    private $dirPhoto;
	private $mysqli;


function __construct($idBuilding=NULL, $idFloor=NULL, $nameFloor=NULL, $planeFloor=NULL, $surfaceBuildingFloor=NULL, $surfaceUsefulFloor=NULL)
{
    $this->idBuilding =  $idBuilding; 
    $this->idFloor = $idFloor;
	$this->nameFloor = $nameFloor;
	$this->planeFloor = $planeFloor;
	$this->surfaceBuildingFloor = $surfaceBuildingFloor;
    $this->surfaceUsefulFloor =  $surfaceUsefulFloor;
    $this->dirPhoto = '../document/Users/'.$this->getIdBuilding().'/'.$this->getIdBuilding().$this->getIdFloor().'/';
    $this->mysqli = Connection::connectionBD();
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

public function getPlaneFloor($option=null){
    if($option !== null && isset($this->planeFloor[$option])){
        return $this->planeFloor[$option];
    } else {
        return $this->planeFloor;
    }   
}


public function getSurfaceBuildingFloor(){
    return $this->surfaceBuildingFloor;
}


public function getSurfaceUsefulFloor(){
    return $this->surfaceUsefulFloor;
}

public function setSurfaceBuildingFloor($surfaceBuildingFloor) {
    $this->surfaceBuildingFloor = $surfaceBuildingFloor;
}

public function setSurfaceUsefulFloor($surfaceUsefulFloor) {
    $this->surfaceUsefulFloor = $surfaceUsefulFloor;
}


function findFloor() {
    $sql = "SELECT * FROM floor WHERE idBuilding = '$this->idBuilding' AND idFloor = '$this->idFloor'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
    } else {
        $result = $resultado->fetch_array();
        return $result;
    }
}

function findInfoFloor() {
    $sql = "SELECT building.nameBuilding, floor.nameFloor, space.nameSpace, space.coordsPlane FROM building, floor, space WHERE  building.idBuilding = floor.idBuilding AND floor.idFloor = space.idFloor AND building.idBuilding = '$this->idBuilding' AND floor.idFloor = '$this->idFloor'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
    } else {
        $result = $resultado->fetch_array();
        return $result;
    }
}

function findFloorName() {
    $sql = "SELECT nameFloor FROM floor WHERE idBuilding='$this->idBuilding' AND idFloor = '$this->idFloor'";
    $result = $this->mysqli->query($sql)->fetch_array();
    return $result['nameFloor'];
}

function findLinkPlane($idBuilding, $idFloor) {
    $sql = "SELECT planeFloor FROM floor WHERE idBuilding='$idBuilding' AND idFloor = '$idFloor'";
    $result = $this->mysqli->query($sql)->fetch_array();
    return $result['planeFloor'];
}



function addFloor() {
    $planeFloorBD =$this->dirPhoto.$this->getPlaneFloor('name');
    $sql = "INSERT INTO floor (idBuilding, idFloor, nameFloor, planeFloor, surfaceBuildingFloor, surfaceUsefulFloor) VALUES ('$this->idBuilding', '$this->idFloor', '$this->nameFloor', '$planeFloorBD', $this->surfaceBuildingFloor, $this->surfaceUsefulFloor)";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
    } else {
        $this->updateDirPhoto();
        return true;
    }
}

function updateFloor($idBuilding, $idFloor) {
    if($this->getPlaneFloor('name') == ''){
        $sql = "UPDATE FLOOR SET idFloor = '$this->idFloor', nameFloor = '$this->nameFloor', surfaceBuildingFloor = '$this->surfaceBuildingFloor', surfaceUsefulFloor = '$this->surfaceUsefulFloor' WHERE idBuilding = '$idBuilding' AND idFloor = '$idFloor'";
    } else {
        $planeFloorBD =$this->dirPhoto.$this->getPlaneFloor('name');
        $sql = "UPDATE FLOOR SET idFloor = '$this->idFloor', nameFloor = '$this->nameFloor', planeFloor = '$planeFloorBD', surfaceBuildingFloor = '$this->surfaceBuildingFloor', surfaceUsefulFloor = '$this->surfaceUsefulFloor' WHERE idBuilding = '$idBuilding' AND idFloor = '$idFloor'";
        $this->updateDirPhoto();
        unlink($this->findLinkPlane());
    }
   
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
    } else {
        return true;
    }
}

function deleteFloor() {
    $sql = "DELETE FROM floor WHERE idBuilding ='$this->idBuilding' AND idFloor = '$this->idFloor'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error in the query on the database';
    } else {
        return true;
    }
}


function showAllFloors() {
    $sql = "SELECT * FROM floor WHERE idBuilding = '$this->idBuilding'";
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



public function existsFloor() {
	$sql = "SELECT * FROM floor WHERE idBuilding = '$this->idBuilding' AND idFloor = '$this->idFloor'";
	$result = $this->mysqli->query($sql);
	if ($result->num_rows == 1) {
		return true;
	} else {
		return false;
	}
}



function updateDirPhoto() {
    if ($this->getPlaneFloor('name') !== '') {
        if (!file_exists($this->dirPhoto)) {
            mkdir($this->dirPhoto, 0777, true);
        }
    move_uploaded_file($this->getPlaneFloor('tmp_name'), $this->dirPhoto.$this->getPlaneFloor('name'));
    }
}


public function checkIsValidForAdd() {

    $errors = array();

    if (!preg_match('/^[0-9]{1,8}([.][0-9]{1,2}){0,1}?$/', $this->surfaceUsefulFloor)) {
        $this->setSurfaceUsefulFloor(0.0);
    }

    if (!preg_match('/^[0-9]{1,8}([.][0-9]{1,2}){0,1}?$/', $this->surfaceBuildingFloor)) {
        $this->setSurfaceBuildingFloor(0.0);
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
    }elseif($this->existsFloor($this->idBuilding, $this->idFloor)){
        $errors = "There is already a floor with that id in this building";
    }else if (strlen(trim($this->nameFloor)) == 0 ) {
        $errors= "Floor name is mandatory";
    }else if (strlen(trim($this->nameFloor)) > 225 ) {
        $errors = "Floor name can not be that long";
    }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameFloor)){
        $errors = "Floor name is invalid. Try again!";
    }else if (strlen(trim($this->surfaceBuildingFloor)) > 99999999.99) {
        $errors = "Floor surface can not be that long";
    }else if (strlen(trim($this->surfaceUsefulFloor)) > 99999999.99) {
        $errors = "Floor useful surface can not be that long";
    }else if($this->getSurfaceUsefulFloor() > $this->getSurfaceBuildingFloor()){
        $errors = "The usable surface can not be greater than the building surface.";
    }

    if (sizeof($errors) > 0){
        throw new Exception($errors);
    }
}





public function existsFloorToEdit($idFloor) {
	$sql = "SELECT * FROM floor WHERE (idFloor, idBuilding) NOT IN (SELECT idFloor, idBuilding FROM floor WHERE idBuilding='$this->idBuilding' AND idFloor='$idFloor') AND idBuilding='$this->idBuilding' AND idFloor='$this->idFloor'";
	$result = $this->mysqli->query($sql);
	if ($result->num_rows >= 1) {
		return true;
	} else {
		return false;
	}
}

public function checkIsValidForEdit($idFloor) {

    $errors = array();

    if (!preg_match('/^[0-9]{1,8}([.][0-9]{1,2}){0,1}?$/', $this->surfaceUsefulFloor)) {
        $this->setSurfaceUsefulFloor(0.0);
    }

    if (!preg_match('/^[0-9]{1,8}([.][0-9]{1,2}){0,1}?$/', $this->surfaceBuildingFloor)) {
        $this->setSurfaceBuildingFloor(0.0);
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
    }elseif($this->existsFloorToEdit($idFloor)){
        $errors = "There is already a floor with that id in this building";
    }else if (strlen(trim($this->nameFloor)) == 0 ) {
        $errors= "Floor name is mandatory";
    }else if (strlen(trim($this->nameFloor)) > 225 ) {
        $errors = "Floor name can not be that long";
    }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameFloor)){
        $errors = "Floor name is invalid. Try again!";
    }else if (strlen(trim($this->surfaceBuildingFloor)) > 99999999.99) {
        $errors = "Floor surface can not be that long";
    }else if (strlen(trim($this->surfaceUsefulFloor)) > 99999999.99) {
        $errors = "Floor useful surface can not be that long";
    }else if($this->getSurfaceUsefulFloor() > $this->getSurfaceBuildingFloor()){
        $errors = "The usable surface can not be greater than the building surface.";
    }

    if (sizeof($errors) > 0){
        throw new Exception($errors);
    }
}





}