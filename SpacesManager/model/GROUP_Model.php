<?php

require_once(__DIR__."..\..\core\ConnectionBD.php");
require_once(__DIR__."..\..\model\FUNCTIONALITY_Model.php");

class GROUP_Model {

    private $idGroup;
	private $nameGroup;
	private $descripGroup;
	private $mysqli;


    public function __construct($idGroup=null, $nameGroup=null, $descripGroup=null)
    {
        $this->idGroup = $idGroup;
        $this->nameGroup =  $nameGroup; 
        $this->descripGroup = $descripGroup;
        $this->mysqli = Connection::connectionBD();
    }

    public function getNameGroup(){
        return $this->nameGroup;
    }


    /* MAIN FUNCTIONS */

    public function getAllGroups() {
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


    public function getGroup() {
        $sql = "SELECT * FROM `SM_GROUP` WHERE sm_idGroup = '$this->idGroup'";
        if (!($resultado = $this->mysqli->query($sql))) {
            throw new Exception('Error in the query on the database');
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }

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
                        $sqlPermissions = "INSERT INTO `SM_PERMISSION` (sm_idGroup, sm_idFunction, sm_idAction) VALUES ($this->idGroup, $permission->idFunction, $permission->idAction)";
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


    /*AUXILARY FUNCTIONS */

    public function findNameGroup() {
        $sql = "SELECT sm_nameGroup FROM `SM_GROUP` WHERE sm_idGroup = '$this->idGroup'";
        if (!($resultado = $this->mysqli->query($sql))) {
            throw new Exception('Error in the query on the database');
        } else {
            $result = $resultado->fetch_array();
            return $result['sm_nameGroup'];
        }
    }

    /*
        This public function is only used in unit tests over GROUP_EDIT and GROUP_DELETE to get the last id action inserted (through the unit test GROUP_ADD_TEST), 
        because of this the connection with DB is realized in the public function to be able to access it through an anonymous class.
    */
    public function findLastGroupID() {
        $mysqli = Connection::connectionBD();
        $sql = "SELECT sm_idGroup FROM `SM_GROUP` ORDER BY sm_idGroup DESC LIMIT 1";
        if (!($resultado = $mysqli->query($sql))) {
            throw new Exception('Error in the query on the database');
        } else {
            $result = $resultado->fetch_array();
            return $result['sm_idGroup'];
        }
    }

    
    public function addPermission($idGroup, $permissions) {
        foreach($permissions as $permission){
            $sql = "INSERT INTO `SM_PERMISSION` (sm_idGroup, sm_idFunction, sm_idAction) VALUES ('$idGroup', '$permission->idFunction', '$permission->idAction')";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            }
        }
        return true;
    }


    public function getPermissionForGroup() {
        $sql = "SELECT * FROM `SM_PERMISSION` WHERE sm_idGroup = '$this->idGroup'";
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

    public function getGroupsActionsForPermission($idFunction, $actions) {
        $toret = array();
        $i = 0;
        foreach($actions as $action){
            $sql = "SELECT sm_idGroup, sm_idAction FROM `SM_PERMISSION` WHERE sm_idFunction = '$idFunction' AND sm_idAction = '$action->id'";
            if (!($resultado = $this->mysqli->query($sql))) {
                throw new Exception('Error in the query on the database');
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


        public function existsGroup() {
        $sql = "SELECT * FROM `SM_GROUP` WHERE sm_idGroup = '$this->idGroup'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }


    /* SERVER VALIDATIONS*/

    /* Server validations functions*/

    public function checkIsValidForAdd($permissions) {

        $errors = false;

        if (strlen(trim($this->nameGroup)) == 0  && (strlen(trim($this->descripGroup)) == 0 )){
            $errors = "Group name and description are mandatory";
        }else if (strlen(trim($this->nameGroup)) == 0) {
            $errors = "Group name is mandatory";
        }else if (strlen(trim($this->nameGroup)) > 225) {
            $errors = "Group name can't be larger than 255 characters";
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
                if(!$function->existsFunctionAction($permission->idFunction, $permission->idAction)){
                    $errors = "Some action for functionality doesn't exist";
                }
            }
        }

        return $errors;
    }


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
        }else if (strlen(trim($this->nameGroup)) > 225) {
            $errors = "Group name can't be larger than 255 characters";
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
                if(!$function->existsFunctionAction($permission->idFunction, $permission->idAction)){
                    $errors = "Some action for functionality doesn't exist";
                }
            }
        }

        return $errors;
    }

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