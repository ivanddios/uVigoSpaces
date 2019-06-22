<?php

require_once("../core/ConnectionBD.php");

/**
* Class BUILDING_Model
*
* Represents a Building in the system
*
*/

class BUILDING_Model {

    /**
    * Attributes:  
	*   @var int $idBuilding The building identifier. 
    *   @var string $nameBuilding. The building name. 
    *   @var string $addressBuilding. The building postal address. 
    *   @var int $phoneBuilding. The building contact phone. 
    *   @var mysqli $mysqli. Connection with the database. 
    */
	private $idBuilding;
	private $nameBuilding;
	private $addressBuilding;
	private $phoneBuilding;
	private $mysqli;

    /**
	* The BUILDING_CLASS constructor
	*
	* @param int $idBuilding The identifier of the building in the database.
    * @param string $nameBuilding The name of the building.
    * @param string $addressBuilding The address of the building.
    * @param string $phoneBuilding The building contact phone.
	*/
    public function __construct($idBuilding=NULL, $nameBuilding=NULL, $addressBuilding=NULL, $phoneBuilding=NULL)
    {
        $this->idBuilding =  $idBuilding; 
        $this->nameBuilding = $nameBuilding;
        $this->addressBuilding = $addressBuilding;
        $this->phoneBuilding = $phoneBuilding;
        $this->mysqli = Connection::connectionBD();
    }

    /**
	* Gets the identifier of the building instance
	*
	* @return int The identifier of the building
	*/
    public function getIdBuilding(){
        return $this->idBuilding;
    }

    /**
	* Gets the building's name 
	*
	* @return string The name of the building
	*/
    public function getNameBuilding(){
        return $this->nameBuilding;
    }

	/**
	* Retrieves all buildings
	*
	* @return mixed Fetch array with buildings and its values
	*/
    public function getAllBuilding() {
        $sql = "SELECT * FROM `SM_BUILDING`";
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
	* Loads a building values from the database given its identifier
	*
	* @return Fetch array with a building values or empty array
	* if the building isn't found
	*/
    public function getBuilding() {
        $sql = "SELECT * FROM `SM_BUILDING` WHERE sm_idBuilding = '$this->idBuilding'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }

    /**
	* Saves a building into the database
	*
    * @return true when the operations is successfully or
    * string with the error
    */
    public function addBuilding() {
        $errors = $this->checkIsValidForAdd_Update();
        if($errors === false){
            if(!$this->existsBuilding()){
                $sql = "INSERT INTO `SM_BUILDING` (sm_idBuilding, sm_nameBuilding, sm_addressBuilding, sm_phoneBuilding) VALUES ('$this->idBuilding', '$this->nameBuilding', '$this->addressBuilding', '$this->phoneBuilding')";
                if (!($resultado = $this->mysqli->query($sql))) {
                    return 'Error in the query on the database';
                } else {
                    return true;
                }
            } else {
                return "There is already a building with that identifier";
            }
        } else {
            return $errors;
        }
    }

    /**
	* Updates a building in the database
	*
	* @return true when the operations is successfully or
    * string with the error
	*/
    public function updateBuilding() {
        $errors = $this->checkIsValidForAdd_Update();
        if($errors === false){
            if($this->existsBuilding()){
                $sql = "UPDATE `SM_BUILDING` SET sm_nameBuilding = '$this->nameBuilding', sm_addressBuilding = '$this->addressBuilding', sm_phoneBuilding = '$this->phoneBuilding' WHERE sm_idBuilding = '$this->idBuilding'";
                if (!($resultado = $this->mysqli->query($sql))) {
                    return 'Error in the query on the database';
                } else {
                    return true;
                }
            }else{
                return "There isn't a building with that identifier";
            }
        } else {
            return $errors;
        }
    }

    /**
	* Deletes a building to the database
	*
	* @return true when the operations is successfully or
    * string with the error
	*/
    public function deleteBuilding() {
        $errors = $this->checkIsValidForDelete();
        if($errors === false){
            $sql = "DELETE FROM `SM_BUILDING` WHERE sm_idBuilding ='$this->idBuilding'";
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
	* Gets a building's name given its identifier
	*
    * @return string with the building's name or NULL if 
    * the building isn't found
	*/
    public function getBuildingName() {
        $sql = "SELECT sm_nameBuilding FROM `SM_BUILDING` WHERE sm_idBuilding='$this->idBuilding'";
        $result = $this->mysqli->query($sql)->fetch_array();
        return $result['sm_nameBuilding'];
    }


    /**
	* Checks if a building's identifier exists in database
    *
    * @return boolean true when the building exists in database and false
    * when its isn't in database
	*/
    public function existsBuilding() {
        $sql = "SELECT * FROM `SM_BUILDING` WHERE sm_idBuilding = '$this->idBuilding'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }


    /**
	* Checks if the current building's instance is valid
	* for being added or modified in the database
	*
    * @return false when the building's values are valids or
    * string with the error when some value is wrong
	*/
    public function checkIsValidForAdd_Update() {
        $errors = false;
        if (strlen(trim($this->idBuilding)) == 0) {
            $errors= "Building identifier is mandatory";
        }else if (strlen(trim($this->idBuilding)) < 5) {
            $errors = "Building identifier can't be less than 5 characters";
        }else if (strlen(trim($this->idBuilding)) > 5) {
            $errors = "Building identifier can't be larger than 5 characters";
        }else if(!preg_match('/[A-Z0-9]/', $this->idBuilding)){
            $errors = "Building identifier format is invalid";
        }else if (strlen(trim($this->nameBuilding)) == 0) {
            $errors= "Building name is mandatory";
        }else if (strlen(trim($this->nameBuilding)) > 225) {
            $errors = "Building name can't be larger than 255 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameBuilding)){
            $errors = "Building name format is invalid";
        }else if (strlen(trim($this->addressBuilding)) == 0) {
            $errors= "Building address is mandatory";
        }else if (strlen(trim($this->addressBuilding)) > 225) {
            $errors = "Building address can't be larger than 255 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->addressBuilding)){
            $errors = "Building address format is invalid";
        }else if (strlen(trim($this->phoneBuilding)) != 9) {
            $errors= "Building phone is incorrect";
        }else if(!preg_match('/^[9|6|7][0-9]{8}$/', $this->phoneBuilding)){
            $errors = "Building phone format is invalid";
        }
        return $errors;
    }

    /**
	* Checks if the current building's instance is valid
	* for being deleted to the database
	*
    * @return false when the building identifier is valid and 
    * the building exists in database. In case of that the building identifier
    * is invalid or the building doesn't exist in database, return a message with 
    * the error
    */
    public function checkIsValidForDelete() {
        $errors = false;
        if(strlen(trim($this->idBuilding)) == 0){
            $errors = "Building identifier is mandatory";
        }else if (strlen(trim($this->idBuilding)) < 5) {
            $errors = "Building identifier can't be less than 5 characters";
        }else if (strlen(trim($this->idBuilding)) > 5) {
            $errors = "Building identifier can't be larger than 5 characters";
        }else if(!preg_match('/[A-Z0-9]/', $this->idBuilding)){
            $errors = "Building identifier format is invalid";
        }else if($this->existsBuilding() !== true) {
            $errors = "There isn't a building with that identifier";
        }
        return $errors;
    }
}

?>