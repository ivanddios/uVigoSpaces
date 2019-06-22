<?php

require_once("../core/ConnectionBD.php");
require_once("../model/BUILDING_Model.php");

/**
* Class FLOOR_Model
*
* Represents a building's floor
*/

class FLOOR_Model {

    /**
    * Attributes:  
    *   @var int  $idBuilding The building's identifier. 
    *   @var int $idFloor The building's floor identifier.  
    *   @var string $nameFloor The building's floor name. 
    *   @var array $planFloor The building's floor plane. 
    *   @var float $builtSurfaceFloor The built surface of the floor. 
    *   @var float $surfaceUsefulFloor The useful surface of the building's floor. 
    *   @var string $dirPhoto The floor's plan route on the server. 
    *   @var mysqli $mysqli Connection with the database. 
    */
    private $idBuilding;
	private $idFloor;
	private $nameFloor;
	private $planFloor;
	private $builtSurfaceFloor;
    private $surfaceUsefulFloor;
    private $dirPhoto;
	private $mysqli;

    /**
	* The FLOOR_Model constructor
	*
    * @param int $idBuilding The identifier of the building.
    * @param int $idFloor The identifier of the building's floor.
    * @param string $nameFloor The name of the floor.
    * @param array $planFloor Image file of the building's floor plan.
    * @param float $builtSurfaceFloor The built surface of the building's floor.
    * @param float $surfaceUsefulFloor The useful surface of the floor.
	*/
    public function __construct($idBuilding=NULL, $idFloor=NULL, $nameFloor=NULL, $planFloor=NULL, $builtSurfaceFloor=NULL, $surfaceUsefulFloor=NULL)
    {   
        $this->idBuilding =  $idBuilding; 
        $this->idFloor = $idFloor;
        $this->nameFloor = $nameFloor;
        $this->planFloor = $planFloor;
        $this->builtSurfaceFloor =  $builtSurfaceFloor;
        $this->surfaceUsefulFloor =  $surfaceUsefulFloor;
        $this->dirPhoto = '../document/Buildings/'.$this->getIdBuilding().'/'.$this->getIdBuilding().$this->getIdFloor().'/';
        $this->mysqli = Connection::connectionBD();
    }

    /**
	* Gets the identifier of the building where is the floor
	*
	* @return int The identifier of the building
	*/
    public function getIdBuilding(){
        return $this->idBuilding;
    }

    /**
	* Gets the identifier of the floor
	*
	* @return int The identifier of the building's floor
	*/
    public function getIdFloor(){
        return $this->idFloor;
    }

    /**
	* Gets the name of the building's floor
	*
	* @return string The name of the floor
	*/
    public function getNameFloor(){
        return $this->nameFloor;
    }

    /**
    * Gets name of the image of building's floor plan
    * or the file temporal of the image.
    *
    * @param $option @var string. Key to the associative array. 
    *
    * @return string When $option is 'name', return the name of image file,
    * when it's 'tmp_name' return the temporal image file.
	*/
    public function getplanFloor($option){
        if($option !== null && isset($this->planFloor[$option])){
            return $this->planFloor[$option];
        } else {
            return $this->planFloor;
        }   
    }


    /**
	* Retrieves all building's floors given the building's identifier.
	*
	* @return mixed Fetch array with building's floors and its values.
	*/
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

    /**
    * Gets a building's floor values from the database given the building's floor identifier 
    * and the building's identifier where the floor is located
	*
	* @return Fetch array with a floor values or empty array
	* if the floor isn't found in the building
	*/
    public function getFloor() {
        $sql = "SELECT * FROM `SM_FLOOR` WHERE sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }

    /**
	* Saves a floor into the database
	*
    * @return true when the operations is successfully or
    * string with the error
    */
    public function addFloor() {

        $errors = $this->checkIsValidForAdd_Update();
        if($errors === false){
            if(!$this->existsFloor()){
                $planFloorBD = $this->dirPhoto.$this->getplanFloor('name');
                $sql = "INSERT INTO `SM_FLOOR` (sm_idBuilding, sm_idFloor, sm_nameFloor, sm_planFloor, sm_builtSurfaceFloor, sm_surfaceUsefulFloor) VALUES ('$this->idBuilding', '$this->idFloor', '$this->nameFloor', '$planFloorBD', $this->builtSurfaceFloor, $this->surfaceUsefulFloor)";
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

    /**
	* Updates a building's floor values in the database
    *
    * Note: If not exists a plan, not modified this field in database
    * Otherwise, the old plan directory is deleted and added with the new plan image.
    *
	* @return true when the operations is successfully or
    * string with the error
	*/
    public function updateFloor() {
        $errors = $this->checkIsValidForAdd_Update();
        if($errors === false){
            if($this->existsFloor()){
                if($this->getplanFloor('name') == ''){
                    $sql = "UPDATE `SM_FLOOR` SET sm_idFloor = '$this->idFloor', sm_nameFloor = '$this->nameFloor', sm_builtSurfaceFloor = '$this->builtSurfaceFloor', sm_surfaceUsefulFloor = '$this->surfaceUsefulFloor' WHERE sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor'";
                } else {
                    $this->deleteDirPhoto();
                    $planFloorBD =$this->dirPhoto.$this->getplanFloor('name');
                    $sql = "UPDATE `SM_FLOOR` SET sm_idFloor = '$this->idFloor', sm_nameFloor = '$this->nameFloor', sm_planFloor = '$planFloorBD', sm_builtSurfaceFloor = '$this->builtSurfaceFloor', sm_surfaceUsefulFloor = '$this->surfaceUsefulFloor' WHERE sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor'";
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

    /**
    * Deletes a building's floor to the database given building's floor identifier
    * and a building's identifier where the floor is located
    *
    *Note: The directory that contain the plan is deleted too.
    *
	* @return true when the operations is successfully or
    * string with the error
	*/
    public function deleteFloor() {
        $errors = $this->checkIsValidForDelete();
        if($errors === false){
            $this->deleteDirPhoto();
            $sql = "DELETE FROM `SM_FLOOR` WHERE sm_idBuilding ='$this->idBuilding' AND sm_idFloor = '$this->idFloor'";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                return true;
            }
        }else{
            return $errors;
        }
    }


    /**
	* Gets a floor's name given its identifier and the building where it is located.
	*
    * @return string with the building's name or NULL if 
    * the building isn't found
	*/
    public function getFloorName() {
        $sql = "SELECT sm_nameFloor FROM `SM_FLOOR` WHERE sm_idBuilding='$this->idBuilding' AND sm_idFloor = '$this->idFloor'";
        $result = $this->mysqli->query($sql)->fetch_array();
        return $result['sm_nameFloor'];
    }

    /**
	* Gets the building's floor plane route on the server
	*
    * @return string with the plane route or NULL if 
    * the building's floor plane route isn't found
	*/
    public function getLinkplan() {
        $sql = "SELECT sm_planFloor FROM `SM_FLOOR` WHERE sm_idBuilding='$this->idBuilding' AND sm_idFloor = '$this->idFloor'";
        $result = $this->mysqli->query($sql)->fetch_array();
        return $result['sm_planFloor'];
    }

    /**
	* Gets information about the building and the building's floor
    *
    * Note: This information contains the coordinates of spaces that are in the floor.
    *
    * @return array fetch with the floor,building and spaces coordinates values
	*/
    public function getInfoFloor() {
        $sql = "SELECT B.sm_nameBuilding, F.sm_nameFloor, S.sm_nameSpace, S.sm_coordsplan 
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

    /**
	* Updates the plan file in server
    *
    * @return void
	*/
    public function updateDirPhoto() {
        if (!is_dir($this->dirPhoto)) {
            mkdir($this->dirPhoto, 0777, true);
        }
        if ($this->getplanFloor('name') !== '') {
            move_uploaded_file($this->getplanFloor('tmp_name'), $this->dirPhoto.$this->getplanFloor('name'));
        }
    }

    /**
	* Deletes the plane directory in server
    *
    * @return void
	*/
    public function deleteDirPhoto() {
        if(is_file($this->getLinkplan())){
            unlink($this->getLinkplan());
        }
        return (rmdir($this->dirPhoto));
    }

    /**
	* Checks if a buiding's floor exists in database
    *
    * @return boolean true when the floor is in database and false
    * when it isn't in database or it isn't associated with the building's id
	*/
    public function existsFloor() {
        $sql = "SELECT * FROM `SM_FLOOR` WHERE sm_idBuilding = '$this->idBuilding' AND sm_idFloor = '$this->idFloor'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
	* Checks if a the plane extension is correct
    *
    * Note: Only is allowed .jpg, .jpeg, .png
    *
    * @return boolean true when extension is valid or false when it isn't valid.
	*/
    public function validateExtensionplan(){
        $allowed =  array('jpeg', 'jpg', 'png');
        $filename = $this->getplanFloor('name');
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!in_array($ext,$allowed)) {
            return false;
        } else {
            return true;
        }
    }

    /**
	* Checks if the current building's floor's instance is valid
	* for being added or modified in the database
	*
    * @return false when the floor's values are valids or
    * string with the error when some value is wrong
	*/
    public function checkIsValidForAdd_Update() {
        $errors = false;
        $building = new BUILDING_Model($this->idBuilding);
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
        }else if (strlen(trim($this->nameFloor)) == 0) {
            $errors= "Floor name is mandatory";
        }else if (strlen(trim($this->nameFloor)) > 225) {
            $errors = "Floor name can't be larger than 255 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameFloor)){
            $errors = "Floor name format is invalid";
        }else if (!preg_match('/^[0-9]{1,8}([.][0-9]{1,2}){0,1}?$/', $this->builtSurfaceFloor)) {
            $errors = "Floor building surface can't be long than 99999999.99";
        }else if (!preg_match('/^[0-9]{1,8}([.][0-9]{1,2}){0,1}?$/', $this->surfaceUsefulFloor)) {
            $errors = "Floor useful surface can't be long than 99999999.99";
        }else if($this->surfaceUsefulFloor > $this->builtSurfaceFloor){
            $errors = "The usable surface can't be greater than the building surface";
        }else if($this->getplanFloor("name") !== ''){
            if(!$this->validateExtensionplan()){
                $errors = "Floor plan extension is invalid";
            }
        }
        return $errors;
    }
    

    /**
	* Checks if the current building's floor's instance is valid
	* for being deleted for the database
	*
    * @return false when the floor's values are valids and 
    * the building's identifier is correct. Otherwise, 
    * the function return a string with the error.
	*/
    public function checkIsValidForDelete() {
        $errors = false;
        $building = new BUILDING_Model($this->idBuilding);
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
        }else if (!$this->existsFloor()) {
            $errors= "There isn't a floor with that identifier in the building";
        }
        return $errors;
    }

}

?>