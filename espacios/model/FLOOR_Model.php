<?php

require_once(__DIR__."..\..\core\ConnectionBD.php");
require_once(__DIR__."..\..\model\BUILDING_Model.php");

class FLOOR_Model {

    private $idBuilding;
	private $idFloor;
	private $nameFLoor;
	private $planeFloor;
	private $surfaceBuildingFloor;
    private $surfaceUsefulFloor;
    private $dirPhoto;
	private $mysqli;

    public function __construct($idBuilding=NULL, $idFloor=NULL, $nameFloor=NULL, $planeFloor=NULL, $surfaceBuildingFloor=NULL, $surfaceUsefulFloor=NULL)
    {
        $this->idBuilding =  $idBuilding; 
        $this->idFloor = $idFloor;
        $this->nameFloor = $nameFloor;
        $this->planeFloor = $planeFloor;
        $this->surfaceBuildingFloor =  $surfaceBuildingFloor;
        $this->surfaceUsefulFloor =  $surfaceUsefulFloor;
        $this->dirPhoto = '../document/Buildings/'.$this->getIdBuilding().'/'.$this->getIdBuilding().$this->getIdFloor().'/';
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


    /* MAIN FUNCTIONS*/

    public function getAllFloors() {
        $sql = "SELECT * FROM `SM_FLOOR` WHERE sm_idBuilding = '$this->idBuilding'";
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

    public function getFloor() {
        $sql = "SELECT * FROM `SM_FLOOR` WHERE sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }


    public function addFloor() {

        $errors = $this->checkIsValidForAdd_Update();
        if($errors === false){
            if(!$this->existsFloor()){
                $planeFloorBD = $this->dirPhoto.$this->getPlaneFloor('name');
                $sql = "INSERT INTO `SM_FLOOR` (sm_idBuilding, sm_idFloor, sm_nameFloor, sm_planeFloor, sm_surfaceBuildingFloor, sm_surfaceUsefulFloor) VALUES ('$this->idBuilding', '$this->idFloor', '$this->nameFloor', '$planeFloorBD', $this->surfaceBuildingFloor, $this->surfaceUsefulFloor)";
                if (!($resultado = $this->mysqli->query($sql))) {
                    return 'Error in the query on the database';
                } else {
                    $this->updateDirPhoto();
                    return true;
                }
            }else{
                return "There is already a floor with that id in this building";
            }
        }else {
            return $errors;
        }
    }

    public function updateFloor() {

        $errors = $this->checkIsValidForAdd_Update();
        if($errors === false){
            if($this->existsFloor()){
                if($this->getPlaneFloor('name') == ''){
                    $sql = "UPDATE `SM_FLOOR` SET sm_idFloor = '$this->idFloor', sm_nameFloor = '$this->nameFloor', sm_surfaceBuildingFloor = '$this->surfaceBuildingFloor', sm_surfaceUsefulFloor = '$this->surfaceUsefulFloor' WHERE sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor'";
                } else {
                    if(is_file($this->getLinkPlane())){
                        unlink($this->getLinkPlane());
                    }
                    rmdir($this->dirPhoto);
                    $planeFloorBD =$this->dirPhoto.$this->getPlaneFloor('name');
                    $sql = "UPDATE `SM_FLOOR` SET sm_idFloor = '$this->idFloor', sm_nameFloor = '$this->nameFloor', sm_planeFloor = '$planeFloorBD', sm_surfaceBuildingFloor = '$this->surfaceBuildingFloor', sm_surfaceUsefulFloor = '$this->surfaceUsefulFloor' WHERE sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor'";
                    $this->updateDirPhoto();
                }
                if (!($resultado = $this->mysqli->query($sql))) {
                    return 'Error in the query on the database';
                } else{
                    return true;
                }
            }else{
                return "There isn't a floor with that identifier in the building";
            }
        } else{
            return $errors;
        }
    }

    public function deleteFloor() {

        $errors = $this->checkIsValidForDelete();
        if($errors === false){
            $sql = "DELETE FROM `SM_FLOOR` WHERE sm_idBuilding ='$this->idBuilding' AND sm_idFloor = '$this->idFloor'";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                rmdir($this->dirPhoto);
                return true;
            }
        }else{
            return $errors;
        }
    }





    /* AUXILIARY FUNCTIONS */

    public function getFloorName() {
        $sql = "SELECT sm_nameFloor FROM `SM_FLOOR` WHERE sm_idBuilding='$this->idBuilding' AND sm_idFloor = '$this->idFloor'";
        $result = $this->mysqli->query($sql)->fetch_array();
        return $result['sm_nameFloor'];
    }

    public function getLinkPlane() {
        $sql = "SELECT sm_planeFloor FROM `SM_FLOOR` WHERE sm_idBuilding='$this->idBuilding' AND sm_idFloor = '$this->idFloor'";
        $result = $this->mysqli->query($sql)->fetch_array();
        return $result['sm_planeFloor'];
    }

    public function getInfoFloor() {
        $sql = "SELECT B.sm_nameBuilding, F.sm_nameFloor, S.sm_nameSpace, S.sm_coordsPlane 
        FROM `SM_BUILDING` AS B, `SM_FLOOR` AS F, `SM_SPACE`AS S
        WHERE  B.sm_idBuilding = F.sm_idBuilding AND F.sm_idFloor = S.sm_idFloor 
               AND B.sm_idBuilding = '$this->idBuilding' AND F.sm_idFloor = '$this->idFloor'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }

    public function updateDirPhoto() {

        if (!is_dir($this->dirPhoto)) {
            mkdir($this->dirPhoto, 0777);
        }

        if ($this->getPlaneFloor('name') !== '') {
            move_uploaded_file($this->getPlaneFloor('tmp_name'), $this->dirPhoto.$this->getPlaneFloor('name'));
        }
    }

    public function existsFloor() {
        $sql = "SELECT * FROM `SM_FLOOR` WHERE sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function validateExtensionPlane(){

        $allowed =  array('jpeg', 'jpg');
        $filename = $this->getPlaneFloor('name');
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!in_array($ext,$allowed)) {
            return false;
        } else {
            return true;
        }
    }



    /*SERVER VALIDATIONS FUNCTIONS */

    public function checkIsValidForAdd_Update() {

        $errors = false;

        $building = new BUILDING_Model($this->idBuilding);

        if (strlen(trim($this->idBuilding)) == 0) {
            $errors= "Building identifier is mandatory";
        }else if (strlen(trim($this->idBuilding)) > 5) {
            $errors = "Building identifier can't be larger than 5 characters";
        }else if(!preg_match('/[A-Z0-9]/', $this->idBuilding)){
            $errors = "Building identifier format is invalid";
        }else if(!$building->existsBuilding()){
            $errors = "There isn't a building with that identifier";
        }else if (strlen(trim($this->idFloor)) == 0) {
            $errors= "Floor identifier is mandatory";
        }else if (strlen(trim($this->idFloor)) > 2) {
            $errors = "Floor identifier can't be larger than 2 characters";
        }else if(!preg_match('/[A-Z0-9]/', $this->idFloor)){
            $errors = "Floor identifier format is invalid";
        }else if (strlen(trim($this->nameFloor)) == 0) {
            $errors= "Floor name is mandatory";
        }else if (strlen(trim($this->nameFloor)) > 225) {
            $errors = "Floor name can't be larger than 255 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameFloor)){
            $errors = "Floor name format is invalid";
        }else if (!preg_match('/^[0-9]{1,8}([.][0-9]{1,2}){0,1}?$/', $this->surfaceBuildingFloor)) {
            $errors = "Floor building surface can't be long than 99999999.99";
        }else if (!preg_match('/^[0-9]{1,8}([.][0-9]{1,2}){0,1}?$/', $this->surfaceUsefulFloor)) {
            $errors = "Floor useful surface can't be long than 99999999.99";
        }else if($this->surfaceUsefulFloor > $this->surfaceBuildingFloor){
            $errors = "The usable surface can't be greater than the building surface";
        }else if($this->getPlaneFloor("name") !== ''){
            if(!$this->validateExtensionPlane()){
                $errors = "Floor plane extension is invalid";
            }
        }
        return $errors;
    }


    public function checkIsValidForDelete() {

        $errors = false;

        $building = new BUILDING_Model($this->idBuilding);

        if (strlen(trim($this->idBuilding)) == 0) {
            $errors= "Building identifier is mandatory";
        }else if (strlen(trim($this->idBuilding)) > 5) {
            $errors = "Building identifier can't be larger than 5 characters";
        }else if(!preg_match('/[A-Z0-9]/', $this->idBuilding)){
            $errors = "Building identifier format is invalid";
        }else if(!$building->existsBuilding()){
            $errors = "There isn't a building with that identifier";
        }else if (strlen(trim($this->idFloor)) == 0) {
            $errors= "Floor identifier is mandatory";
        }else if (strlen(trim($this->idFloor)) > 2) {
            $errors = "Floor identifier can't be larger than 2 characters";
        }else if(!preg_match('/[A-Z0-9]/', $this->idFloor)){
            $errors = "Floor identifier format is invalid";
        }else if (!$this->existsFloor()) {
            $errors= "There isn't a floor with that identifier in the building";
        }
        return $errors;
    }


}