<?php

require_once(__DIR__."..\..\core\ConnectionBD.php");

class ACTION_Model {

    private $idAction;
	private $nameAction;
	private $descripAction;
	private $mysqli;


    public function __construct($idAction=null, $nameAction=null, $descripAction=null)
    {
        $this->idAction = $idAction;
        $this->nameAction =  $nameAction; 
        $this->descripAction = $descripAction;
        $this->mysqli = Connection::connectionBD();
    }

    public function getNameAction(){
        return $this->nameAction;
    }


    /* Principal functions*/

    public function showAllActions() {
        $sql = "SELECT * FROM `SM_ACTION`";
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



    public function findAction() {
        $sql = "SELECT * FROM `SM_ACTION` WHERE sm_idAction = '$this->idAction'";
        if (!($resultado = $this->mysqli->query($sql))) {
            throw new Exception('Error in the query on the database');
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }


    public function updateAction() {

        $errors = $this->checkIsValidForUpdate();
        if($errors === false){
            $sql = "UPDATE `SM_ACTION` SET sm_nameAction = '$this->nameAction', sm_descripAction = '$this->descripAction' WHERE sm_idAction = '$this->idAction'";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                return true;
            }
        } else {
            return $errors;
        }
    }


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


    /* Auxilary functions*/

    public function findNameAction() {
        $sql = "SELECT sm_nameAction FROM `SM_ACTION` WHERE sm_idAction = '$this->idAction'";
        if (!($resultado = $this->mysqli->query($sql))) {
            throw new Exception('Error in the query on the database');
        } else {
            $result = $resultado->fetch_array();
            return $result['nameAction'];
        }
    }

    /*
        This public function is only used in unit tests over ACTION_EDIT and ACTION_DELETE to get the last id action inserted (through the unit test ACTION_ADD_TEST), 
        because of this the connection with DB is realized in the public function to be able to access it through an anonymous class.
    */
    public function findLastActionID() {
        $mysqli = Connection::connectionBD();
        $sql = "SELECT sm_idAction FROM `SM_ACTION` ORDER BY sm_idAction DESC LIMIT 1";
        if (!($resultado = $mysqli->query($sql))) {
            throw new Exception('Error in the query on the database');
        } else {
            $result = $resultado->fetch_array();
            return $result['sm_idAction'];
        }
    }



    public function existsAction() {
        $sql = "SELECT * FROM `SM_ACTION` WHERE sm_idAction = '$this->idAction'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }



    /* Server validations functions*/

    public function checkIsValidForAdd() {

        $errors = false;

        if (strlen(trim($this->nameAction)) == 0  && (strlen(trim($this->descripAction)) == 0 )){
            $errors = "Action name and description are mandatory";
        }else if (strlen(trim($this->nameAction)) == 0) {
            $errors = "Action name is mandatory";
        }else if (strlen(trim($this->nameAction)) > 225) {
            $errors = "Action name can't be larger than 255 characters";
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
        }else if (strlen(trim($this->nameAction)) > 225) {
            $errors = "Action name can't be larger than 255 characters";
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