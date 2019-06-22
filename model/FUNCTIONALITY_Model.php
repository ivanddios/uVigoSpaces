<?php

require_once("../core/ConnectionBD.php");
require_once("../model/ACTION_Model.php");
require_once("../model/GROUP_Model.php");

/**
* Class FUNCTIONALITY_Model
*
* Represents a Functionality
*
*/

class FUNCTIONALITY_Model {

    /**
    * Attributes:  
    *   @var int $idFunction The functionality identifier. 
    *   @var string $nameFunction The functionality name.  
    *   @var string $descripFunction The functionality description. 
    *   @var array $actions Array with actions identifiers. 
    *   @var mysqli $mysqli Connection with the database.  
    */

    private $idFunction;
	private $nameFunction;
    private $descripFunction;
    private $actions;
	private $mysqli;

    /**
	* The FUNCTIONALITY_Model constructor
	*
    * @param int $idFunction The identifier of the functionality.
    * @param string $nameFunction The name of the functionality.
    * @param string $descripFunction The description of the functionality.
    * @param array $actions Array with actions identifiers.
	*/
    public function __construct($idFunction=null,$nameFunction=null, $descripFunction=null, $actions=null)
    {
        $this->idFunction = $idFunction;
        $this->nameFunction =  $nameFunction; 
        $this->descripFunction = $descripFunction;
        $this->actions = $actions;
        $this->mysqli = Connection::connectionBD();
    }

    /**
	* Sets the identifier of this functionality
	*
	* @param string $idFunction The identifier of this functionality
	* @return void
	*/
    public function setIdFunction($idFunction){
        $this->idFunction = $idFunction;
    }

    /**
	* Gets the name of the functionality 
	*
	* @return string The name of the functionality
	*/
    public function getNameFunction(){
        return $this->nameFunction;
    }

    /**
	* Retrieves all functionalities.
	*
	* @return mixed Fetch array with functionalities values.
	*/
    public function getAllFunctions() {
        $sql = "SELECT * FROM `SM_FUNCTIONALITY`";
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
    * Gets a functionality values from the database given the functionality identifier 
	*
	* @return Fetch array with a functionality values or empty array
	* if the functionality isn't found
	*/
    public function getFunction() {
        $sql = "SELECT * FROM `SM_FUNCTIONALITY` WHERE sm_idFunction =  '$this->idFunction'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }

    /**
    * Gets the actions' identifier associated with a functionality given the functionality identifier.
	*
	* @return Array with a actions identifiers
	*/
    public function getAllActionsForFunctionality() {
        $sql = "SELECT sm_idAction FROM `SM_FUNCTIONALITY_ACTION` WHERE sm_idFunction = '$this->idFunction'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $toret = array();
            $i = 0;
            while ($fila = $resultado->fetch_array()) {
                $toret[$i] = $fila['sm_idAction'];
                $i++;
            }
            return  $toret;
        }
    }


    /**
	* Saves a functionality into the database and the actions associated with it too
	*
    * @return true when the operations is successfully or string with the error
    */
    public function addFunction() {

        $errors = $this->checkIsValidForAdd();
        if($errors === false){
            $sqlFunction = "INSERT INTO `SM_FUNCTIONALITY` (sm_nameFunction, sm_descripFunction) VALUES ('$this->nameFunction', '$this->descripFunction')";
            if (!($resultado = $this->mysqli->query($sqlFunction))) {
                return 'Error in the query on the database';
            }else {
                $lastId = $this->mysqli->insert_id;
                foreach($this->actions as $action){
                    $sqlFunctionAction = "INSERT INTO `SM_FUNCTIONALITY_ACTION` (sm_idFunction, sm_idAction) VALUES ($lastId, $action)";
                    if (!($resultado = $this->mysqli->query($sqlFunctionAction))) {
                        return 'Error in the query on the database';
                    }
                }
                return true;
            }
        }else{
            return $errors;
        }
    }

    /**
	* Updates a functionalities values in the database
    *
    * Note: First, updates a floor values (name and descript). -> (Step 1)
    * Then, gets the groups that have relation with the functionality and the actions -> (Step 2)
    * Clears the old associations between functionality and actions -> (Step 3)
    * Adds the new assciations -> (Step 4)
    * And adds again the permissions over the roles (step 2) -> (Step 5)
    *
	* @return true when the operations is successfully or
    * string with the error
	*/
    public function updateFunction() {

        $errors = $this->checkIsValidForUpdate();
        if($errors === false){
            //Step 1
            $sqlUpdate = "UPDATE `SM_FUNCTIONALITY` SET sm_nameFunction = '$this->nameFunction', sm_descripFunction = '$this->descripFunction' WHERE sm_idFunction = '$this->idFunction'";
            if (!($resultado = $this->mysqli->query($sqlUpdate))) {
                return 'Error in the query on the database';
            } else {
                $group = new GROUP_Model();
                //Step 2
                $groupsActions = $group->getGroupsActionsForPermission($this->idFunction, $this->actions); 

                //Step 3
                $sqlDelete = "DELETE FROM `SM_FUNCTIONALITY_ACTION` WHERE sm_idFunction = '$this->idFunction'";
                if (!($resultado = $this->mysqli->query($sqlDelete))) {
                    return 'Error in the query on the database';
                }else {
                    //Step 4
                    foreach($this->actions as $action){
                        $sqlFunctionAction = "INSERT INTO `SM_FUNCTIONALITY_ACTION` (sm_idFunction, sm_idAction) VALUES ($this->idFunction, $action)";
                        if (!($resultado = $this->mysqli->query($sqlFunctionAction))) {
                            return 'Error in the query on the databasea';
                        }
                    }
                    //Step 5
                    foreach($groupsActions as $groupAction){    
                        $idGroup = $groupAction['idGroup'];
                        $idAction = $groupAction['idAction'];
                        $sqlPermission = "INSERT INTO `SM_PERMISSION` (sm_idGroup, sm_idFunction, sm_idAction) VALUES ($idGroup, $this->idFunction, $idAction)";
                        if (!($resultado = $this->mysqli->query($sqlPermission))) {
                            return 'Error in the query on the database';
                        }
                    }
                    return true;
                }
            }
            return 'Error in the query on the database';
        }else{
            return $errors;
        }
    }

    /**
	* Deletes a functionality to the database given a functionality identifier
    *
	* @return true when the operations is successfully or string with the error
	*/
    public function deleteFunction() {
        $errors = $this->checkIsValidForDelete();
        if($errors === false){
            $sql = "DELETE FROM `SM_FUNCTIONALITY` WHERE sm_idFunction = '$this->idFunction'";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                return true;
            }
        } else{
            return $errors;
        }
    }


    /**
	* Retrieves the last functionality identifier that added to database
    *
    * This function is used in unit_test
    *
    * @return int with the function's identifier or NULL if 
    * the functionality isn't found
	*/
    public static function findLastFunctionID() {
        $mysqli = Connection::connectionBD();
        $sql = "SELECT sm_idFunction FROM `SM_FUNCTIONALITY` ORDER BY sm_idFunction DESC LIMIT 1";
        if (!($resultado = $mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result['sm_idFunction'];
        }
    }

    /**
	* Checks if a function exists is in database
    *
    * @return boolean true when the function is in database and false
    * when it isn't in database
	*/
    public function existsFunction() {
        $sql = "SELECT * FROM `SM_FUNCTIONALITY` WHERE sm_idFunction = '$this->idFunction'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
	* Checks if for a function exists the action 
    *
    * @return boolean true when the action exists for functionality and false
    * when it not exists
	*/
    public function existsFunctionAction($idFunction, $idAction) {
        $sql = "SELECT * FROM `SM_FUNCTIONALITY_ACTION` WHERE sm_idFunction = '$idFunction' AND sm_idAction = '$idAction'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows >= 1) {
            return true;
        } else {
            return false;
        }
    }


    /**
	* Checks if the current function's instance is valid 
	* and if the actions exists for being added in the database
	*
    * @return false when the function's values are valids or
    * string with the error when some value is wrong
	*/
    public function checkIsValidForAdd() {
        $errors = false;
        if (strlen(trim($this->nameFunction)) == 0  && (strlen(trim($this->descripFunction)) == 0 )){
            $errors = "Function name and description are mandatory";
        }else if (strlen(trim($this->nameFunction)) == 0) {
            $errors = "Function name is mandatory";
        }else if (strlen(trim($this->nameFunction)) > 50) {
            $errors = "Function name can't be larger than 50 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameFunction)){
            $errors = "Function name format is invalid";
        }else if (strlen(trim($this->descripFunction)) == 0) {
            $errors= "Function description is mandatory";
        }else if (strlen(trim($this->descripFunction)) > 225) {
            $errors = "Function description can't be larger than 255 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->descripFunction)){
            $errors = "Function description format is invalid";
        }else if(!isset($this->actions)) {
            $errors = "Access to some functionality is mandatory";
        }else{
            foreach($this->actions as $action){
                $newAction = new ACTION_Model($action);
                if(!$newAction->existsAction()){
                    $errors = "Some action for functionality doesn't exist";
                }
            }
        }
        return $errors;
    }

    /**
	* Checks if the current functionality instance is valid 
	* and if the actions exists for being modified in the database
	*
    * @return false when the functionalitiy values are valids or
    * string with the error when some value is wrong
	*/
    public function checkIsValidForUpdate() {
        $errors = false;
        if(strlen(trim($this->idFunction)) == 0){
            $errors = "Function identifier is mandatory";
        }else if(!preg_match('/^\d+$/', $this->idFunction)){
            $errors = "Function identifier format is invalid";
        }else if($this->existsFunction() !== true) {
            $errors = "Function doesn't exist";
        }else if (strlen(trim($this->nameFunction)) == 0  && (strlen(trim($this->descripFunction)) == 0 )){
            $errors = "Function name and description are mandatory";
        }else if (strlen(trim($this->nameFunction)) == 0) {
            $errors = "Function name is mandatory";
        }else if (strlen(trim($this->nameFunction)) > 50) {
            $errors = "Function name can't be larger than 50 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameFunction)){
            $errors = "Function name format is invalid";
        }else if (strlen(trim($this->descripFunction)) == 0) {
            $errors= "Function description is mandatory";
        }else if (strlen(trim($this->descripFunction)) > 225) {
            $errors = "Function description can't be larger than 255 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->descripFunction)){
            $errors = "Function description format is invalid";
        }else if(!isset($this->actions)) {
            $errors = "Some action for functionality is mandatory";
        }else{
            foreach($this->actions as $action){
                $newAction = new ACTION_Model($action);
                if(!$newAction->existsAction()){
                    $errors = "Some action for functionality doesn't exist";
                }
            }
        }
        return $errors;
    }

    /**
	* Checks if the current functionality instance is valid 
	* for being deleted to the database
	*
    * @return false when the identifier of functionalitiy is valid or
    * string with the error when some value is wrong
	*/
    public function checkIsValidForDelete() {
        $errors = false;
        if(strlen(trim($this->idFunction)) == 0){
            $errors = "Function identifier is mandatory";
        }else if(!preg_match('/^\d+$/', $this->idFunction)){
            $errors = "Function identifier format is invalid";
        }else if($this->existsFunction() !== true) {
            $errors = "Function doesn't exist";
        }
        return $errors;
    }
}

?>