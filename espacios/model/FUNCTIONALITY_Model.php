<?php

require_once(__DIR__."..\..\core\ConnectionBD.php");
require_once(__DIR__."..\..\model\ACTION_Model.php");
require_once(__DIR__."..\..\model\GROUP_Model.php");

class FUNCTIONALITY_Model {

    private $idFunction;
	private $nameFunction;
	private $descripFunction;
	private $mysqli;


    public function __construct($idFunction=null,$nameFunction=null, $descripFunction=null)
    {
        $this->idFunction = $idFunction;
        $this->nameFunction =  $nameFunction; 
        $this->descripFunction = $descripFunction;
        $this->mysqli = Connection::connectionBD();
    }

    public function getNameFunction(){
        return $this->nameFunction;
    }

    /* MAIN FUNCTIONS */

    public function getAllFunctions() {
        $sql = "SELECT * FROM `SM_FUNCTIONALITY`";
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


    public function getFunction() {
        $sql = "SELECT * FROM `SM_FUNCTIONALITY` WHERE sm_idFunction =  '$this->idFunction'";
        if (!($resultado = $this->mysqli->query($sql))) {
            throw new Exception('Error in the query on the database');
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }


    public function getAllActionsForFunctionality() {
        $sql = "SELECT sm_idAction FROM `SM_FUNCTIONALITY_ACTION` WHERE sm_idFunction = '$this->idFunction'";
        if (!($resultado = $this->mysqli->query($sql))) {
            throw new Exception('Error in the query on the database');
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



    public function addFunction($actions) {

        $errors = $this->checkIsValidForAdd($actions);
        if($errors === false){
            $sqlFunction = "INSERT INTO `SM_FUNCTIONALITY` (sm_nameFunction, sm_descripFunction) VALUES ('$this->nameFunction', '$this->descripFunction')";
            if (!($resultado = $this->mysqli->query($sqlFunction))) {
                return 'Error in the query on the database';
            } else {
                $lastId = $this->mysqli->insert_id;
                foreach($actions as $action){
                    $sqlFunctionAction = "INSERT INTO `SM_FUNCTIONALITY_ACTION` (sm_idFunction, sm_idAction) VALUES ($lastId, $action->id)";
                    if (!($resultado = $this->mysqli->query($sqlFunctionAction))) {
                        return 'Error in the query on the database';
                    }
                }
                return true;
            }
            return 'Error in the query on the database';
        }else{
            return $errors;
        }
    }


    public function updateFunction($actions) {

        $errors = $this->checkIsValidForUpdate($actions);
        if($errors === false){
            $sqlUpdate = "UPDATE `SM_FUNCTIONALITY` SET sm_nameFunction = '$this->nameFunction', sm_descripFunction = '$this->descripFunction' WHERE sm_idFunction = '$this->idFunction'";
            if (!($resultado = $this->mysqli->query($sqlUpdate))) {
                return 'Error in the query on the database';
            } else {
                $group = new GROUP_Model();
                $groups = $group->getGroupsForPermission($this->idFunction, $actions);
                $sqlDelete = "DELETE FROM `SM_FUNCTIONALITY_ACTION` WHERE sm_idFunction = '$this->idFunction'";
                if (!($resultado = $this->mysqli->query($sqlDelete))) {
                    return 'Error in the query on the database';
                }else {
                    foreach($actions as $action){
                        $sqlFunctionAction = "INSERT INTO `SM_FUNCTIONALITY_ACTION` (sm_idFunction, sm_idAction) VALUES ($this->idFunction, $action->id)";
                        if (!($resultado = $this->mysqli->query($sqlFunctionAction))) {
                            return 'Error in the query on the databasea';
                        }
                        foreach($groups as $group){
                            $sqlPermission = "INSERT INTO `SM_PERMISSION` (sm_idGroup, sm_idFunction, sm_idAction) VALUES ($group, $this->idFunction, $action->id)";
                            if (!($resultado = $this->mysqli->query($sqlPermission))) {
                                return 'Error in the query on the database';
                            }
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


    /* AUXILIARY FUNCTIONS */

    /*
        This public function is only used in unit tests over FUNCTION_EDIT and FUNCTION_DELETE to get the last id action inserted (through the unit test FUNCTION_ADD_TEST), 
        because of this the connection with DB is realized in the public function to be able to access it through an anonymous class.
    */
    public function findLastFunctionID() {
        $mysqli = Connection::connectionBD();
        $sql = "SELECT sm_idFunction FROM `SM_FUNCTIONALITY` ORDER BY sm_idFunction DESC LIMIT 1";
        if (!($resultado = $mysqli->query($sql))) {
            throw new Exception('Error in the query on the database');
        } else {
            $result = $resultado->fetch_array();
            return $result['sm_idFunction'];
        }
    }

    public function existsFunction() {
        $sql = "SELECT * FROM `SM_FUNCTIONALITY` WHERE sm_idFunction = '$this->idFunction'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function existsFunctionAction($idFunction, $idAction) {
        $sql = "SELECT * FROM `SM_FUNCTIONALITY_ACTION` WHERE sm_idFunction = '$idFunction' AND sm_idAction = '$idAction'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows >= 1) {
            return true;
        } else {
            return false;
        }
    }




    /* SERVER VALIDATION FUNCTIONS*/

    public function checkIsValidForAdd($actions) {

        $errors = false;

        if (strlen(trim($this->nameFunction)) == 0  && (strlen(trim($this->descripFunction)) == 0 )){
            $errors = "Function name and description are mandatory";
        }else if (strlen(trim($this->nameFunction)) == 0) {
            $errors = "Function name is mandatory";
        }else if (strlen(trim($this->nameFunction)) > 225) {
            $errors = "Function name can't be larger than 255 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameFunction)){
            $errors = "Function name format is invalid";
        }else if (strlen(trim($this->descripFunction)) == 0) {
            $errors= "Function description is mandatory";
        }else if (strlen(trim($this->descripFunction)) > 225) {
            $errors = "Function description can't be larger than 255 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->descripFunction)){
            $errors = "Function description format is invalid";
        }else if(!isset($actions)) {
            $errors = "Access to some functionality is mandatory";
        }else{
            foreach($actions as $action){
                $newAction = new ACTION_Model($action->id);
                if(!$newAction->existsAction()){
                    $errors = "Some action for functionality doesn't exist";
                }
            }
        }

        return $errors;
    }

    public function checkIsValidForUpdate($actions) {

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
        }else if (strlen(trim($this->nameFunction)) > 225) {
            $errors = "Function name can't be larger than 255 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->nameFunction)){
            $errors = "Function name format is invalid";
        }else if (strlen(trim($this->descripFunction)) == 0) {
            $errors= "Function description is mandatory";
        }else if (strlen(trim($this->descripFunction)) > 225) {
            $errors = "Function description can't be larger than 255 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->descripFunction)){
            $errors = "Function description format is invalid";
        }else if(!isset($actions)) {
            $errors = "Some action for functionality is mandatory";
        }else{
            foreach($actions as $action){
                $newAction = new ACTION_Model($action->id);
                if(!$newAction->existsAction()){
                    $errors = "Some action for functionality doesn't exist";
                }
            }
        }

        return $errors;
    }


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