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

    public function __construct($idBuilding=NULL, $idFloor=NULL, $idSpace=NULL, $nameSpace=NULL, $surfaceSpace=NULL, $numberInventorySpace=NULL, $coordsPlane=NULL)
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


    public function showAllSpaces() {
        $sql = "SELECT * FROM `SM_SPACE` WHERE sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor'" ;
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

    public function findSpace() {
        $sql = "SELECT * FROM `SM_SPACE` WHERE sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor' AND sm_idSpace = '$this->idSpace'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }


    public function findInfoSpace() {
        $sql = "SELECT SM_BUILDING.sm_nameBuilding, SM_FLOOR.sm_nameFloor, SM_SPACE.sm_nameSpace, SM_SPACE.sm_coordsPlane FROM `SM_BUILDING`, `SM_FLOOR`, `SM_SPACE` WHERE SM_BUILDING.sm_idBuilding = SM_FLOOR.sm_idBuilding AND SM_FLOOR.sm_idFloor = SM_SPACE.sm_idFloor AND SM_BUILDING.sm_idBuilding = '$this->idBuilding' AND SM_FLOOR.sm_idFloor = '$this->idFloor' AND SM_SPACE.sm_idSpace = '$this->idSpace'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }

    public function findNameSpace() {
        $sql = "SELECT sm_nameSpace FROM `SM_SPACE` WHERE sm_idBuilding='$this->idBuilding' AND sm_idFloor = '$this->idFloor' AND sm_idSpace = '$this->idSpace'";
        $result = $this->mysqli->query($sql)->fetch_array();
        return $result['sm_nameSpace'];
    }

    public function findCoordsSpace() {
        $sql = "SELECT sm_coordsPlane FROM `SM_SPACE` WHERE sm_idBuilding='$this->idBuilding' AND sm_idFloor = '$this->idFloor' AND sm_idSpace = '$this->idSpace'";
        $result = $this->mysqli->query($sql)->fetch_array();
        return $result['sm_coordsPlane'];
    }



    public function addSpace() {
        $sql = "INSERT INTO `SM_SPACE` (sm_idBuilding, sm_idFloor, sm_idSpace, sm_nameSpace, sm_surfaceSpace, sm_numberInventorySpace) VALUES ('$this->idBuilding', '$this->idFloor', '$this->idSpace', '$this->nameSpace', $this->surfaceSpace, '$this->numberInventorySpace')";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            return true;
        }
    }


    public function addCoords() {
        $sql = "UPDATE `SM_SPACE` SET sm_coordsPlane = '$this->coordsPlane' WHERE sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor' AND sm_idSpace = '$this->idSpace'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            return true;
        }
    }


    public function updateSpace($idBuilding, $idFloor, $idSpace) {
        $sql = "UPDATE `SM_SPACE` SET sm_idSpace = '$this->idSpace', nameSpace = '$this->nameSpace', sm_surfaceSpace = $this->surfaceSpace, sm_numberInventorySpace = '$this->numberInventorySpace' WHERE sm_idBuilding = '$idBuilding' AND sm_idFloor = '$idFloor' AND sm_idSpace = '$idSpace'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            return true;
        }
    }

    public function deleteSpace() {
        $sql = "DELETE FROM `SM_SPACE` WHERE sm_idBuilding ='$this->idBuilding' AND sm_idFloor = '$this->idFloor' AND sm_idSpace = '$this->idSpace'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            return true;
        }
    }


    public function existsSpace() {
        $sql = "SELECT * FROM `SM_SPACE` WHERE sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor' AND sm_idSPace = '$this->idSpace'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function existsSpaceToEdit($idSpace) {
        $sql = "SELECT * FROM `SM_SPACE` WHERE (sm_idBuilding, sm_idFloor, sm_idSpace) 
                    NOT IN (SELECT sm_idBuilding, sm_idFloor, sm_idSpace FROM `SM_SPACE` WHERE sm_idBuilding='$this->idBuilding' AND sm_idFloor='$this->idFloor' AND sm_idSpace='$idSpace') 
                AND sm_idBuilding='$this->idBuilding' AND sm_idFloor='$this->idFloor' AND sm_idSpace='$this->idSpace'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows >= 1) {
            return true;
        } else {
            return false;
        }
    }


    public function findPlane() {
        $sql = "SELECT sm_planeFloor FROM `SM_FLOOR` WHERE sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor'";
        $result = $this->mysqli->query($sql)->fetch_array();
        return $result['sm_planeFloor'];
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
        }else if (strlen(trim($this->idFloor)) == 0 ) {
            $errors= "Floor id is mandatory";
        }else if (strlen(trim($this->idFloor)) > 2 ) {
            $errors = "Floor id can not be that long";
        }else if(!preg_match('/[A-Z0-9]/', $this->idFloor)){
            $errors = "Floor id is invalid. Example: 00,S1";
        }else if (strlen(trim($this->idSpace)) == 0 ) {
            $errors= "Space id is mandatory";
        }else if (strlen(trim($this->idSpace)) > 6 ) {
            $errors = "Space id can not be that long";
        }else if(!preg_match('/^[0-9]{5}$/', $this->idSpace)){
            $errors = "Space id is invalid. Example: 000011";
        }else if($this->existsSpace()){
            $errors = "There is already a space with that id in this floor";
        }else if (strlen(trim($this->nameSpace)) == 0 ) {
            $errors= "Space name is mandatory";
        }else if (strlen(trim($this->nameSpace)) > 225 ) {
            $errors = "Space name can not be that long";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameSpace)){
            $errors = "Space name is invalid. Try again!";
        }else if (strlen(trim($this->surfaceSpace)) > 99999999.99) {
            $errors = "Space surface can not be that long";
        }else if (strlen(trim($this->numberInventorySpace)) > 10) {
            $errors = "Number inventory can not be that long";
        }else if (strlen(trim($this->coordsPlane)) > 225) {
            $errors = "Coords can not be that long";
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
        }else if (strlen(trim($this->idFloor)) == 0 ) {
            $errors= "Floor id is mandatory";
        }else if (strlen(trim($this->idFloor)) > 2 ) {
            $errors = "Floor id can not be that long";
        }else if(!preg_match('/[A-Z0-9]/', $this->idFloor)){
            $errors = "Floor id is invalid. Example: 00,S1";
        }else if (strlen(trim($this->idSpace)) == 0 ) {
            $errors= "Space id is mandatory";
        }else if (strlen(trim($this->idSpace)) > 6 ) {
            $errors = "Space id can not be that long";
        }else if(!preg_match('/^[0-9]{5}$/', $this->idSpace)){
            $errors = "Space id is invalid. Example: 000011";
        }else if($this->existsSpaceToEdit($idSpace)){
            $errors = "There is already a space with that id in this floor";
        }else if (strlen(trim($this->nameSpace)) == 0 ) {
            $errors= "Space name is mandatory";
        }else if (strlen(trim($this->nameSpace)) > 225 ) {
            $errors = "Space name can not be that long";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameSpace)){
            $errors = "Space name is invalid. Try again!";
        }else if (strlen(trim($this->surfaceSpace)) > 99999999.99) {
            $errors = "Space surface can not be that long";
        }else if (strlen(trim($this->numberInventorySpace)) > 10) {
            $errors = "Number inventory can not be that long";
        }else if (strlen(trim($this->coordsPlane)) > 225) {
            $errors = "Coords can not be that long";
        }
        if (sizeof($errors) > 0){
            throw new Exception($errors);
        }
    }


}