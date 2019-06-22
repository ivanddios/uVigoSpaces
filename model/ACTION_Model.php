<?php

require_once("../core/ConnectionBD.php");

/**
* Class ACTION_Model
*
* Represents a Action 
*
*/

class ACTION_Model {

    /**
    * Attributes:  
	*   @var int $idAction The action identifier.  
    *   @var string $nameAction The action name. 
    *   @var string $descripAction The action description 
    *   @var mysqli $mysqli Connection with the database. 
    */
    private $idAction;
	private $nameAction;
	private $descripAction;
	private $mysqli;

    /**
	* The ACTION constructor
	*
	* @param int $idAction The identifier of the action in database.
    * @param string $nameAction The name of the action.
    * @param string $descripAction The description of the action.
	*/
    public function __construct($idAction=null, $nameAction=null, $descripAction=null)
    {
        $this->idAction = $idAction;
        $this->nameAction =  $nameAction; 
        $this->descripAction = $descripAction;
        $this->mysqli = Connection::connectionBD();
    }

    /**
	* Gets the name of current action
	*
	* @return string The name of the action
	*/
    public function getNameAction(){
        return $this->nameAction;
    }

	/**
	* Retrieves all actions
	*
	* @return mixed Fetch array with actions and its values
	*/
    public function getAllActions() {
        $sql = "SELECT * FROM `SM_ACTION`";
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
	* Loads a action's values from the database given its identifier
	*
	* @return Fetch array with a action values or empty array
	* if the action isn't found
	*/
    public function getAction() {
        $sql = "SELECT * FROM `SM_ACTION` WHERE sm_idAction = '$this->idAction'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }

    /**
	* Saves a action into the database
	*
    * @return true when the operations is successfully or
    * string with the error
    */
    public function addAction() {
        $errors = $this->checkIsValidForAdd();
        if($errors === false){
            $sql = "INSERT INTO `SM_ACTION` (sm_nameAction, sm_descripAction) VALUES ('$this->nameAction', '$this->descripAction')";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                return true;
            }
        } else {
            return $errors;
        }
    }

    /**
	* Updates a action in the database
	*
	* @return true when the operations is successfully or
    * string with the error
	*/
    public function updateAction() {
        $errors = $this->checkIsValidForUpdate();
        if($errors === false){
            $sql = "UPDATE `SM_ACTION` SET sm_nameAction = '$this->nameAction', sm_descripAction = '$this->descripAction' 
                    WHERE sm_idAction = '$this->idAction'";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                return true;
            }
        } else {
            return $errors;
        }
    }

    /**
	* Deletes a action to the database
	*
	* @return true when the operations is successfully or
    * string with the error
	*/
    public function deleteAction() {
        $errors = $this->checkIsValidForDelete();
        if($errors === false){
            $sql = "DELETE FROM `SM_ACTION` WHERE sm_idAction ='$this->idAction'";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                return true;
            }
        }else {
            return $errors;
        }
    }

    /**
	* Retrieves a action's name given its identifier
	*
    * @return string with the action's name or NULL if 
    * the action isn't found
	*/
    public function findNameAction() {
        $sql = "SELECT sm_nameAction FROM `SM_ACTION` WHERE sm_idAction = '$this->idAction'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result['nameAction'];
        }
    }

    /**
	* Retrieves the last action's identifier that added to database
    *
    * This function is used in unit_test
    *
    * @return int with the action's identifier or NULL if 
    * the action isn't found
	*/
    public static function getLastActionID() {
        $mysqli = Connection::connectionBD();
        $sql = "SELECT sm_idAction FROM `SM_ACTION` ORDER BY sm_idAction DESC LIMIT 1";
        if (!($resultado = $mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result['sm_idAction'];
        }
    }

    /**
	* Retrieves the actions with the functionality to which they are associated.
    *
    * @return Array fetch with functionality and its actions associated
	*/
    public function getAllActionsForFunction() {
        $sql = "SELECT F.sm_idFunction,F.sm_nameFunction, A.sm_idAction, A.sm_nameAction
                FROM `SM_FUNCTIONALITY` AS F, `SM_ACTION` AS A, `SM_FUNCTIONALITY_ACTION` AS FA
                WHERE F.sm_idFunction = FA.sm_idFunction AND FA.sm_idAction = A.sm_idAction
                ORDER BY A.sm_idAction";
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
	* Checks if a action's identifier exists in database
    *
    * @return boolean true when the action exists in database 
    * and false when its isn't in database
	*/
    public function existsAction() {
        $sql = "SELECT * FROM `SM_ACTION` WHERE sm_idAction = '$this->idAction'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }


    /**
	* Checks if the current action's instance is valid
	* for being added in the database
	*
    * @return false when the action's values are valids or
    * string with the error when some value is wrong
	*/
    public function checkIsValidForAdd() {
        $errors = false;
        if (strlen(trim($this->nameAction)) == 0  && (strlen(trim($this->descripAction)) == 0 )){
            $errors = "Action name and description are mandatory";
        }else if (strlen(trim($this->nameAction)) == 0) {
            $errors = "Action name is mandatory";
        }else if (strlen(trim($this->nameAction)) > 50) {
            $errors = "Action name can't be larger than 50 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameAction)){
            $errors = "Action name format is invalid";
        }else if (strlen(trim($this->descripAction)) == 0) {
            $errors= "Action description is mandatory";
        }else if (strlen(trim($this->descripAction)) > 225) {
            $errors = "Action description can't be larger than 255 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->descripAction)){
            $errors = "Action description format is invalid";
        }
        return $errors;
    }


    /**
	* Checks if the current action's instance is valid
	* for being modified in the database
	*
    * @return false when the action's values are valids or
    * string when some value is wrong
	*/
    public function checkIsValidForUpdate() {
        $errors = false;
        if(strlen(trim($this->idAction)) == 0){
            $errors = "Action identifier is mandatory";
        }else if(!preg_match('/^\d+$/', $this->idAction)){
            $errors = "Action identifier format is invalid";
        }else if($this->existsAction() !== true) {
                $errors = "Action doesn't exist";
        } else if (strlen(trim($this->nameAction)) == 0  && (strlen(trim($this->descripAction)) == 0 )){
            $errors = "Action name and description are mandatory";
        }else if (strlen(trim($this->nameAction)) == 0) {
            $errors = "Action name is mandatory";
        }else if (strlen(trim($this->nameAction)) > 50) {
            $errors = "Action name can't be larger than 50 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameAction)){
            $errors = "Action name format is invalid";
        }else if (strlen(trim($this->descripAction)) == 0) {
            $errors= "Action description is mandatory";
        }else if (strlen(trim($this->descripAction)) > 225) {
            $errors = "Action description can't be larger than 255 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->descripAction)){
            $errors = "Action description format is invalid";
        }
        return $errors;
    }

    /**
	* Checks if the current action's instance is valid
	* for being deleted to the database
	*
    * @return false when the action's values are valids or
    * string when some value is wrong
	*/
    public function checkIsValidForDelete() {
        $errors = false;
        if(strlen(trim($this->idAction)) == 0){
            $errors = "Action identifier is mandatory";
        }else if(!preg_match('/^\d+$/', $this->idAction)){
            $errors = "Action identifier format is invalid";
        }else if($this->existsAction() !== true) {
            $errors = "Action doesn't exist";
        }  
        return $errors;
    }
}

?>