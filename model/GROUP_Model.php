<?php

require_once("../core/ConnectionBD.php");
require_once("../model/FUNCTIONALITY_Model.php");

/**
* Class GROUP_Model
*
* Represents a Group 
*
*/

class GROUP_Model {

    /**
    * Attributes:  
	*   @var int $idGroup The group identifier. 
    *   @var string $nameGroup The group name.
    *   @var string $descripGroup The group description. 
    *   @var mysqli $mysqli Connection with the database. 
    */
    private $idGroup;
	private $nameGroup;
	private $descripGroup;
	private $mysqli;

    /**
	* The GROUP_Model constructor
	*
	* @param int $idGroup The identifier of the group in database.
    * @param string $nameGroup The name of the group.
    * @param string $descripGroup The description of the group.
	*/
    public function __construct($idGroup=null, $nameGroup=null, $descripGroup=null)
    {
        $this->idGroup = $idGroup;
        $this->nameGroup =  $nameGroup; 
        $this->descripGroup = $descripGroup;
        $this->mysqli = Connection::connectionBD();
    }

    /**
	* Gets the name of this group instance
	*
	* @return string The name of the group
	*/
    public function getNameGroup(){
        return $this->nameGroup;
    }


    /**
	* Retrieves all groups
	*
	* @return mixed Fetch array with groups and its values
	*/
    public function getAllGroups() {
        $sql = "SELECT * FROM `SM_GROUP`";
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
	* Loads a group values from the database given its identifier
	*
	* @return Fetch array with a group values or empty array
	* if the group isn't found
	*/
    public function getGroup() {
        $sql = "SELECT * FROM `SM_GROUP` WHERE sm_idGroup = '$this->idGroup'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }

    /**
	* Transforms the array of permissions in a key-value array
	*
	* @return Array with key (idFunction) and value (idAction)
	*/
    public function convertArray($permissions){
        $permissionsFormat = array();
        foreach($permissions as $permission) {
            $ids = explode(",", $permission);
            array_push($permissionsFormat, ["idFunction"=> $ids[0], "idAction" => $ids[1]]);
        }
        return $permissionsFormat;
    }


    /**
	* Saves a group into the database
	*
    * @return true when the operations is successfully or
    * string with the error
    */
    public function addGroup($permissions) {

        $errors = $this->checkIsValidForAdd($permissions);
        if($errors === false){
            $sql = "INSERT INTO `SM_GROUP` (sm_nameGroup, sm_descripGroup) VALUES ('$this->nameGroup', '$this->descripGroup')";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                $idGroup = $this->mysqli->insert_id;
                if($this->addPermission($idGroup, $permissions) === true){
                    return true;
                } else {
                    return 'Error in the query on the database';
                }
            }
            return 'Error in the query on the database';
        } else{
            return $errors;
        }
    }

    /**
	* Updates a group in the database
    *
    * First, update the group values
    * The, delete the group in permissions table to delete the old associations with functionalities and actions
    * Add the group with its functionalities and actions associated
    *
	* @return true when the operations is successfully or
    * string with the error
	*/
    public function updateGroup($permissions) {
        $errors = $this->checkIsValidForUpdate($permissions);
        if($errors === false){
            $sql = "UPDATE `SM_GROUP` SET sm_nameGroup = '$this->nameGroup', sm_descripGroup = '$this->descripGroup' WHERE sm_idGroup = '$this->idGroup'";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                $sqlDelete = "DELETE FROM `SM_PERMISSION` WHERE sm_idGroup = '$this->idGroup'";
                if (!($resultado = $this->mysqli->query($sqlDelete))) {
                    return 'Error in the query on the database';
                }else {
                    foreach($permissions as $permission){
                        $idFunction = $permission['idFunction'];
                        $idAction = $permission['idAction'];
                        $sqlPermissions = "INSERT INTO `SM_PERMISSION` (sm_idGroup, sm_idFunction, sm_idAction) VALUES ($this->idGroup, $idFunction, $idAction)";
                        if (!($resultado = $this->mysqli->query($sqlPermissions))) {
                            return 'Error in the query on the database';
                        }
                    }
                    return true;
                }
            }
        }
        return $errors;
    }


    /**
	* Deletes a group to the database
	*
	* @return true when the operations is successfully or
    * string with the error
	*/
    public function deleteGroup() {
        $errors = $this->checkIsValidForDelete();
        if($errors === false){
            $sql = "DELETE FROM `SM_GROUP` WHERE sm_idGroup ='$this->idGroup'";
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
	* Retrieves a group name given its identifier
	*
    * @return string with the group name or NULL if 
    * the group isn't found
	*/
    public function findNameGroup() {
        $sql = "SELECT sm_nameGroup FROM `SM_GROUP` WHERE sm_idGroup = '$this->idGroup'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result['sm_nameGroup'];
        }
    }

    /**
	* Retrieves the last group identifier that added to database
    *
    * This function is used in unit_test
    *
    * @return int with the group identifier or NULL if 
    * the action isn't found
	*/
    public static function findLastGroupID() {
        $mysqli = Connection::connectionBD();
        $sql = "SELECT sm_idGroup FROM `SM_GROUP` ORDER BY sm_idGroup DESC LIMIT 1";
        if (!($resultado = $mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result['sm_idGroup'];
        }
    }

    /**
	* Saves a group with its functionalities and actions associated
	*
    * @return true when the operations is successfully or
    * string with the error
    */
    public function addPermission($idGroup, $permissions) {
        foreach($permissions as $permission){
            $idFunction = $permission["idFunction"];
            $idAction = $permission["idAction"];
            $sql = "INSERT INTO `SM_PERMISSION` (sm_idGroup, sm_idFunction, sm_idAction) VALUES ('$idGroup', '$idFunction', '$idAction')";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            }
        }
        return true;
    }

    /**
	* Gets functionalities and actions associated with the group
	*
    * @return Fetch array with a group values with functionalities and actions
    * or empty array  if the group isn't found
	*/
    public function getPermissionForGroup() {
        $sql = "SELECT * FROM `SM_PERMISSION` WHERE sm_idGroup = '$this->idGroup'";
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
	* Gets groups with a functionality and action associated
	*
    * @return Fetch array with a group and actions values
	*/
    public function getGroupsActionsForPermission($idFunction, $actions) {
        $toret = array();
        $i = 0;
        foreach($actions as $action){
            $sql = "SELECT sm_idGroup, sm_idAction FROM `SM_PERMISSION` WHERE sm_idFunction = '$idFunction' AND sm_idAction = '$action'";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            }else {
                $fila = $resultado->fetch_array();
                if($fila['sm_idGroup'] !== null){
                    $toret[$i] =(['idGroup' => $fila['sm_idGroup'],
                                'idAction' => $fila['sm_idAction']]);
                    $i++;
                }
            }
        }
        return $toret;
    }

    /**
	* Checks if a group identifier is in database
    *
    * @return true when the group is in database and false
    * when its isn't in database
	*/
    public function existsGroup() {
        $sql = "SELECT * FROM `SM_GROUP` WHERE sm_idGroup = '$this->idGroup'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
	* Checks if the current group instance is valid
	* for being added in the database
	*
    * @return false when the group values are valids or
    * string with the error when some value is wrong
	*/
    public function checkIsValidForAdd($permissions) {

        $errors = false;

        if (strlen(trim($this->nameGroup)) == 0  && (strlen(trim($this->descripGroup)) == 0 )){
            $errors = "Group name and description are mandatory";
        }else if (strlen(trim($this->nameGroup)) == 0) {
            $errors = "Group name is mandatory";
        }else if (strlen(trim($this->nameGroup)) > 50) {
            $errors = "Group name can't be larger than 50 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameGroup)){
            $errors = "Group name format is invalid";
        }else if (strlen(trim($this->descripGroup)) == 0) {
            $errors= "Group description is mandatory";
        }else if (strlen(trim($this->descripGroup)) > 225) {
            $errors = "Group description can't be larger than 255 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->descripGroup)){
            $errors = "Group description format is invalid";
        }else if(!isset($permissions)) {
            $errors = "Access to some functionality is mandatory";
        }else{
            $function = new FUNCTIONALITY_Model();
            foreach($permissions as $permission){
                if(!$function->existsFunctionAction($permission["idFunction"], $permission["idAction"])){
                    $errors = "Some action for functionality doesn't exist";
                }
            }
        }
        return $errors;
    }


    /**
	* Checks if the current group instance is valid
	* for being modified in the database
	*
    * @return false when the group values are valids or
    * string when some value is wrong
	*/
    public function checkIsValidForUpdate($permissions) {
        $errors = false;
        if(strlen(trim($this->idGroup)) == 0){
            $errors = "Group identifier is mandatory";
        }else if(!preg_match('/^\d+$/', $this->idGroup)){
            $errors = "Group identifier format is invalid";
        }else if($this->existsGroup() !== true) {
                $errors = "Group doesn't exist";
        } else if (strlen(trim($this->nameGroup)) == 0  && (strlen(trim($this->descripGroup)) == 0 )){
            $errors = "Group name and description are mandatory";
        }else if (strlen(trim($this->nameGroup)) == 0) {
            $errors = "Group name is mandatory";
        }else if (strlen(trim($this->nameGroup)) > 50) {
            $errors = "Group name can't be larger than 50 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameGroup)){
            $errors = "Group name format is invalid";
        }else if (strlen(trim($this->descripGroup)) == 0) {
            $errors= "Group description is mandatory";
        }else if (strlen(trim($this->descripGroup)) > 225) {
            $errors = "Group description can't be larger than 255 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->descripGroup)){
            $errors = "Group description format is invalid";
        }else if(!isset($permissions)) {
            $errors = "Access to some functionality is mandatory";
        }else{
            $function = new FUNCTIONALITY_Model();
            foreach($permissions as $permission){
                if(!$function->existsFunctionAction($permission["idFunction"], $permission["idAction"])){
                    $errors = "Some action for functionality doesn't exist";
                }
            }
        }
        return $errors;
    }

    /**
	* Checks if the current group instance is valid
	* for being deleted to the database
	*
    * @return false when the group identifier is valid or
    * string when some value is wrong
	*/
    public function checkIsValidForDelete() {
        $errors = false;
        if(strlen(trim($this->idGroup)) == 0){
            $errors = "Group identifier is mandatory";
        }else if(!preg_match('/^\d+$/', $this->idGroup)){
            $errors = "Group identifier format is invalid";
        }else if($this->existsGroup() !== true) {
            $errors = "Group doesn't exist";
        }
        return $errors;
    }
}

?>