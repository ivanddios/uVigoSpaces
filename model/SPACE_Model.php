<?php

require_once("../core/ConnectionBD.php");
require_once("../model/BUILDING_Model.php");
require_once("../model/FLOOR_Model.php");

class SPACE_Model {

    private $idBuilding;
    private $idFloor;
    private $idSpace;
	private $nameSpace;
	private $surfaceSpace;
    private $numberInventorySpace;
    private $coordsplan;
	private $mysqli;

    public function __construct($idBuilding=null, $idFloor=null, $idSpace=null, $nameSpace=null, $surfaceSpace=null, $numberInventorySpace=null, $coordsplan=null)
    {
        $this->idBuilding =  $idBuilding; 
        $this->idFloor = $idFloor;
        $this->idSpace = $idSpace;
        $this->nameSpace = $nameSpace;
        $this->surfaceSpace = $surfaceSpace;
        $this->coordsplan = $coordsplan;
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
        $sql = "SELECT * FROM `SM_SPACE` 
                WHERE sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor' 
                    AND sm_idSpace = '$this->idSpace'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }


    public function findInfoSpace() {
        $sql = "SELECT DISTINCT `SM_SPACE`.*, `SM_FLOOR`.`sm_nameFloor`, `SM_BUILDING`.`sm_nameBuilding` 
                FROM `SM_SPACE`, `SM_FLOOR`, `SM_BUILDING` 
                WHERE `SM_BUILDING`.`sm_idBuilding` = `SM_SPACE`.`sm_idBuilding` 
                    AND `SM_FLOOR`.`sm_idFloor` = `SM_SPACE`.`sm_idFloor` 
                    AND `SM_SPACE`.sm_idBuilding = '$this->idBuilding' 
                    AND `SM_SPACE`.sm_idFloor = '$this->idFloor' 
                    AND `SM_SPACE`.sm_idSpace = '$this->idSpace'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }

    public function findNameSpace() {
        $sql = "SELECT sm_nameSpace FROM `SM_SPACE` 
                WHERE sm_idBuilding='$this->idBuilding' AND sm_idFloor = '$this->idFloor' 
                    AND sm_idSpace = '$this->idSpace'";
        $result = $this->mysqli->query($sql)->fetch_array();
        return $result['sm_nameSpace'];
    }

    public function findCoordsSpace() {
        $sql = "SELECT sm_coordsplan FROM `SM_SPACE` 
                WHERE sm_idBuilding='$this->idBuilding' AND sm_idFloor = '$this->idFloor' 
                    AND sm_idSpace = '$this->idSpace'";
        $result = $this->mysqli->query($sql)->fetch_array();
        return $result['sm_coordsplan'];
    }



    public function addSpace() {
        $errors = $this->checkIsValidForAdd_Update();
        if($errors === false){
            if(!$this->existsSpace()){
                $sql = "INSERT INTO `SM_SPACE` (sm_idBuilding, sm_idFloor, sm_idSpace, sm_nameSpace, sm_surfaceSpace, sm_numberInventorySpace) 
                        VALUES ('$this->idBuilding', '$this->idFloor', '$this->idSpace', '$this->nameSpace', $this->surfaceSpace, '$this->numberInventorySpace')";
                if (!($resultado = $this->mysqli->query($sql))) {
                    return 'Error in the query on the database';
                } else {
                    return true;
                } 
            }else{
                return "There is already a space with that identifier in this floor";
            }
        } else{
            return $errors;
        }
    
    }


    public function addCoords() {
        $errors = $this->checkCoords();
        if($errors === false){
            $sql = "UPDATE `SM_SPACE` SET sm_coordsplan = '$this->coordsplan' 
                    WHERE sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor' 
                        AND sm_idSpace = '$this->idSpace'";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                return true;
            }
        } else{
            return $errors;
        }
    }


    public function updateSpace($idSpaceOriginal) {

        $errors = $this->checkIsValidForAdd_Update();
        if($errors === false){
            $exists = $this->existsSpaceForEdit($idSpaceOriginal);
            if($exists === false){
                $sql = "UPDATE `SM_SPACE` SET sm_idSpace = '$this->idSpace', sm_nameSpace = '$this->nameSpace', sm_surfaceSpace = $this->surfaceSpace, sm_numberInventorySpace = '$this->numberInventorySpace' 
                        WHERE sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor' 
                            AND sm_idSpace = '$idSpaceOriginal'";
                if (!($resultado = $this->mysqli->query($sql))) {
                    return $this->mysqli->error;
                } else {
                    return true;
                }
            }else{
                return $exists;
            }
        }else{
            return $errors;
        }
    }

    public function deleteSpace() {
        $errors = $this->checkIsValidForDelete();
        if($errors === false){
            $sql = "DELETE FROM `SM_SPACE` WHERE sm_idBuilding ='$this->idBuilding' 
                        AND sm_idFloor = '$this->idFloor' AND sm_idSpace = '$this->idSpace'";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                return true;
            }
        }else{
            return $errors;
        }
    }


    public function existsSpace() {
        $sql = "SELECT * FROM `SM_SPACE` 
                WHERE sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor' 
                    AND sm_idSPace = '$this->idSpace'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function existsSpaceForEdit($idSpaceOriginal) {
        $sql = "SELECT sm_idSpace 
                FROM `SM_SPACE` 
                WHERE sm_idSpace NOT IN (
                                        SELECT sm_idSpace 
                                        FROM `SM_SPACE` 
                                        WHERE sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor' AND sm_idSpace='$idSpaceOriginal'
                                        )
                AND sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor'";

        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $toret = array();
            $i = 0;
            while ($fila = $resultado->fetch_array()) {
                $toret[$i] = $fila;
                $i++;
            }

            $errors = false;
            foreach($toret as $space){
                if($space['sm_idSpace'] == $this->idSpace){
                    $errors = "There is already a space with that identifier in this floor";
                }
            }
            return $errors;
        }
    }


    public function findplan() {
        $sql = "SELECT sm_planFloor FROM `SM_FLOOR` 
                WHERE sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor'";
        $result = $this->mysqli->query($sql)->fetch_array();
        return $result['sm_planFloor'];
    }




    /*SERVER VALIDATIONS FUNCTIONS */

    public function checkIsValidForAdd_Update() {

        $errors = false;

        $building = new BUILDING_Model($this->idBuilding);
        $floor = new FLOOR_Model($this->idBuilding, $this->idFloor);

        if (strlen(trim($this->idBuilding)) == 0) {
            $errors = "Building identifier is mandatory";
        }else if (strlen(trim($this->idBuilding)) < 5) {
            $errors = "Building identifier can't be less than 5 characters";
        }else if (strlen(trim($this->idBuilding)) > 5) {
            $errors = "Building identifier can't be larger than 5 characters";
        }else if(!preg_match('/[A-Z0-9]/', $this->idBuilding)){
            $errors = "Building identifier format is invalid";
        }else if(!$building->existsBuilding()){
            $errors = "There isn't a building with that identifier";
        }else if (strlen(trim($this->idFloor)) == 0) {
            $errors = "Floor identifier is mandatory";
        }else if (strlen(trim($this->idFloor)) < 2) {
            $errors = "Floor identifier can't be less than 2 characters";
        }else if (strlen(trim($this->idFloor)) > 2) {
            $errors = "Floor identifier can't be larger than 2 characters";
        }else if(!preg_match('/[A-Z0-9]/', $this->idFloor)){
            $errors = "Floor identifier format is invalid";
        }else if(!$floor->existsFloor()){
            $errors = "There isn't a floor with that identifier in the building";
        }else if (strlen(trim($this->idSpace)) == 0 ) {
            $errors = "Space identifier is mandatory";
        }else if (strlen(trim($this->idSpace)) < 5) {
            $errors = "Space identifier can't be less than 5 characters";
        }else if (strlen(trim($this->idSpace)) > 5 ) {
            $errors = "Space identifier can't be larger than 5 characters";
        }else if(!preg_match('/^[0-9]{5}$/', $this->idSpace)){
            $errors = "Space identifier is invalid";
        }else if (strlen(trim($this->nameSpace)) == 0 ) {
            $errors= "Space name is mandatory";
        }else if (strlen(trim($this->nameSpace)) > 225 ) {
            $errors = "Space name can't be larger than 225 characters";
        }else if(!preg_match('/^[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameSpace)){
            $errors = "Space name format is invalid";
        }else if ($this->surfaceSpace > 99999999.99) {
            $errors = "Space surface can't be larger than 99999999.99";
        }else if (!preg_match('/^[0-9]{1,8}([.][0-9]{1,2}){0,1}?$/', $this->surfaceSpace)) {
            $this->setSurfaceSpace(0.0);
        }else if (strlen(trim($this->numberInventorySpace)) > 6) {
            $errors = "Number inventory can't be larger than 6 characters";
        }else if (!preg_match('/^([0-9]{6}|[#]{6})$/', $this->numberInventorySpace)) {
            $this->setNumberInventorySpace("######");
        }

        return $errors;
    }


    public function checkCoords(){

        $errors = false;

        if(strlen(trim($this->coordsplan)) > 65535) {
            $errors = "Coords can't be larger than 500 characters";
        }else if($this->coordsplan !== null){
            if(!preg_match('/^[0-9]+ [0-9]+(, [0-9]+ [0-9]+)*$/', $this->coordsplan)){
                $errors = "Coords format is invalid";
            }
        }
       
        return $errors;
    }


    public function checkIsValidForDelete() {

        $errors = false;

        $building = new BUILDING_Model($this->idBuilding);
        $floor = new FLOOR_Model($this->idBuilding, $this->idFloor);

        if (strlen(trim($this->idBuilding)) == 0) {
            $errors= "Building identifier is mandatory";
        }else if (strlen(trim($this->idBuilding)) < 5) {
            $errors = "Building identifier can't be less than 5 characters";
        }else if (strlen(trim($this->idBuilding)) > 5) {
            $errors = "Building identifier can't be larger than 5 characters";
        }else if(!preg_match('/[A-Z0-9]/', $this->idBuilding)){
            $errors = "Building identifier format is invalid";
        }else if(!$building->existsBuilding()){
            $errors = "There isn't a building with that identifier";
        }else if (strlen(trim($this->idFloor)) == 0) {
            $errors= "Floor identifier is mandatory";
        }else if (strlen(trim($this->idFloor)) < 2) {
            $errors = "Floor identifier can't be less than 2 characters";
        }else if (strlen(trim($this->idFloor)) > 2) {
            $errors = "Floor identifier can't be larger than 2 characters";
        }else if(!preg_match('/[A-Z0-9]/', $this->idFloor)){
            $errors = "Floor identifier format is invalid";
        }else if (!$floor->existsFloor()) {
            $errors= "There isn't a floor with that identifier in the building";
        }else if (strlen(trim($this->idSpace)) == 0 ) {
            $errors= "Space identifier is mandatory";
        }else if (strlen(trim($this->idSpace)) < 5) {
            $errors = "Space identifier can't be less than 5 characters";
        }else if (strlen(trim($this->idSpace)) > 5 ) {
            $errors = "Space identifier can't be larger than 5 characters";
        }else if(!preg_match('/^[0-9]{5}$/', $this->idSpace)){
            $errors = "Space identifier is invalid";
        }else if (!$this->existsSpace()) {
            $errors= "There isn't a space with that identifier in the floor";
        }

        return $errors;
    }

}

?>