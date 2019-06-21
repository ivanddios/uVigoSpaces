<?php

require_once("../core/ConnectionBD.php");
require_once("../model/ACTION_Model.php");
require_once("../model/GROUP_Model.php");

class FUNCTIONALITY_Model {

    private $idFunction;
	private $nameFunction;
    private $descripFunction;
    private $actions;
	private $mysqli;


    public function __construct($idFunction=null,$nameFunction=null, $descripFunction=null, $actions=null)
    {
        $this->idFunction = $idFunction;
        $this->nameFunction =  $nameFunction; 
        $this->descripFunction = $descripFunction;
        $this->actions = $actions;
        $this->mysqli = Connection::connectionBD();
    }

    public function setIdFunction($idFunction){
        $this->idFunction = $idFunction;
    }

    public function getNameFunction(){
        return $this->nameFunction;
    }

    /* MAIN FUNCTIONS */

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


    public function getFunction() {
        $sql = "SELECT * FROM `SM_FUNCTIONALITY` WHERE sm_idFunction =  '$this->idFunction'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }


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


    public function updateFunction() {

        $errors = $this->checkIsValidForUpdate();
        if($errors === false){
            $sqlUpdate = "UPDATE `SM_FUNCTIONALITY` SET sm_nameFunction = '$this->nameFunction', sm_descripFunction = '$this->descripFunction' WHERE sm_idFunction = '$this->idFunction'";
            if (!($resultado = $this->mysqli->query($sqlUpdate))) {
                return 'Error in the query on the database';
            } else {
                $group = new GROUP_Model();
                $groupsActions = $group->getGroupsActionsForPermission($this->idFunction, $this->actions);

                $sqlDelete = "DELETE FROM `SM_FUNCTIONALITY_ACTION` WHERE sm_idFunction = '$this->idFunction'";
                if (!($resultado = $this->mysqli->query($sqlDelete))) {
                    return 'Error in the query on the database';
                }else {
                    foreach($this->actions as $action){
                        $sqlFunctionAction = "INSERT INTO `SM_FUNCTIONALITY_ACTION` (sm_idFunction, sm_idAction) VALUES ($this->idFunction, $action)";
                        if (!($resultado = $this->mysqli->query($sqlFunctionAction))) {
                            return 'Error in the query on the databasea';
                        }
                    }
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