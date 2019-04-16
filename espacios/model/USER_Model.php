<?php

require_once(__DIR__."..\..\core\ConnectionBD.php");
require_once(__DIR__.'..\..\model\GROUP_Model.php');

class USER_Model {

	private $email;
	private $password;
	private $name;
	private $surname;
	private $dni;
	private $birthdate;
	private $phone;
    private $photo = array();
    private $dirPhoto;
    private $group;
	private $mysqli;


    public function __construct($email=null, $password=null, $name=null, $surname=null, $dni=null, $birthdate=null, $phone=null, $photo=null, $group=null)
    {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->dni = $dni;
        $this->birthdate = $birthdate;
        $this->phone = $phone;
        $this->photo = $photo;
        $this->group = $group;
        $this->dirPhoto = '../document/Users/'.$this->getEmail().'/';
        $this->mysqli = Connection::connectionBD();
    }


    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getGroup(){
        return $this->group;
    }

    public function getPhoto($option=null){
        if($option !== null && isset($this->photo[$option])){
            return $this->photo[$option];
        } else {
            return $this->photo;
        }   
    }


    /* MAIN FUNCTIONS */

    public function login() {
        $errors = $this->checkLogin();
        if($errors === false){
            $sql = "SELECT * FROM `USER` WHERE email = '$this->email'";
            $result = $this->mysqli->query($sql);
            if ($result->num_rows == 1) {
                $tuple = $result->fetch_array();
                if ($tuple['passwd'] == md5($this->password)) {
                    return true;
                } else{
                    return "Password is incorrect";
                }
            }
        } else{
            return $errors;
        }

    }


    public function getPermissions(){
        $sql ="SELECT DISTINCT A.sm_nameAction, F.sm_nameFunction 
                FROM `SM_GROUP` AS G, `SM_USER_GROUP` AS UG, `SM_PERMISSION` AS P, `SM_FUNCTIONALITY` AS F, `SM_ACTION` AS A 
                WHERE UG.sm_email = '$this->email' AND UG.sm_idGroup = G.sm_idGroup 
                    AND P.sm_idFunction = F.sm_idFunction AND P.sm_idAction = A.sm_idAction";
        $result = $this->mysqli->query($sql);  
        $j = 0;
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


    public function getAllUsers() {
        $sql = "SELECT * FROM `SM_USER`";
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

    public function getUser() {
        $sql = "SELECT U.*, G.sm_nameGroup, G.sm_descripGroup 
                FROM sm_user AS U, sm_user_group AS UG, sm_group AS G 
                WHERE U.sm_email = '$this->email' AND U.sm_email = UG.sm_email AND UG.sm_idGroup = G.sm_idGroup";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }


    public function addUser() {
        $errors = $this->checkIsValidForAdd();
        if($errors === false){
            $passwordBD = md5($this->password);
            $dateBD = $this->formatDate($this->birthdate);
            $photoBD =$this->dirPhoto.$this->getPhoto('name');
            $sql = "INSERT INTO `USER` VALUES ('$photoBD', '$this->email', '$passwordBD', '$this->name', '$this->surname', '$this->dni', '$dateBD', '$this->phone')";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                $sql = "INSERT INTO `SM_USER` VALUES ('$this->email')";
                if (!($resultado = $this->mysqli->query($sql))) {
                    return 'Error in the query on the database';
                } else {
                    if($this->addRoleUser() === true){
                        $this->updateDirPhoto();
                    }else {
                        return false;
                    }
                    return true;
                } 
            }
        }else {
            return $errors;
        }
    }


    public function updateUser() {
        $errors = $this->checkIsValidForEdit();
        if($errors === false){
            $dateBD = $this->formatDate($this->birthdate);
            if($this->getPhoto('name') == '' && empty($this->password)){
                $sql = "UPDATE `USER` SET name = '$this->name', surname = '$this->surname', dni = '$this->dni', birthdate = '$dateBD', email = '$this->email', phone = '$this->phone' WHERE email = '$this->email'";  
            }else if($this->getPhoto('name') == '' && !empty($this->password)){
                $passwordBD = md5($this->password);
                $sql = "UPDATE `USER` SET passwd = '$passwordBD', name = '$this->name', surname = '$this->surname', dni = '$this->dni', birthdate = '$dateBD', email = '$this->email', phone = '$this->phone' WHERE email = '$this->email'";  
            }else if($this->getPhoto('name') !== '' && empty($this->password)){
                $photoBD =$this->dirPhoto.$this->getPhoto('name');
                $sql = "UPDATE `USER` SET photo = '$photoBD', name = '$this->name', surname = '$this->surname', dni = '$this->dni', birthdate = '$dateBD', email = '$this->email', phone = '$this->phone' WHERE email = '$this->email'";
                unlink($this->getLinkProfilePhoto());
                $this->updateDirPhoto();
            } else {
                $passwordBD = md5($this->password);
                $photoBD =$this->dirPhoto.$this->getPhoto('name'); 
                $sql = "UPDATE `USER` SET photo = '$photoBD', passwd = '$passwordBD', name = '$this->name', surname = '$this->surname', dni = '$this->dni', birthdate = '$dateBD', email = '$this->email', phone = '$this->phone' WHERE email = '$this->email'";
                unlink($this->getLinkProfilePhoto());
                $this->updateDirPhoto(); 
            }
            if (!($resultado = $this->mysqli->query($sql))) {
                // return 'Error in the query on the database';
                return $this->mysqli->error;
            } else {
                return true;
            }
        } else {
            return $errors;
        }
    }

    public function deleteUser() {

        $errors = $this->checkIsValidForDelete();
        if($errors === false){
            $this->deleteDirPhoto();
            $sql = "DELETE FROM `SM_USER_GROUP` WHERE sm_email ='$this->email'";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                return true;
            }
        } else {
            return $errors;;
        }
    }



    /*AUXLIARY FUNCTIONS*/

    public function addRoleUser() {
        $sql = "INSERT INTO `SM_USER_GROUP` VALUES ('$this->email','$this->group')";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            return true;
        }
    }


    public function getLinkProfilePhoto() {
        $sql = "SELECT photo FROM `USER` WHERE email='$this->email'";
        $result = $this->mysqli->query($sql)->fetch_array();
        return $result['photo'];
    }

    public function formatDate($date){
        $dateFormat = str_replace('/', '-', $date);
        $dateFormat = date('Y-m-d', strtotime($dateFormat));
        return $dateFormat;
    }


    public function updateDirPhoto() {
        if (!is_dir($this->dirPhoto)) {
            mkdir($this->dirPhoto, 0777, true);
        }
        if ($this->getLinkProfilePhoto('name') !== '') {
            move_uploaded_file($this->getLinkProfilePhoto('tmp_name'), $this->dirPhoto.$this->getLinkProfilePhoto('name'));
        }
    }

    public function deleteDirPhoto() {
        if(is_file($this->getLinkProfilePhoto())){
            unlink($this->getLinkProfilePhoto());
        }
        return (rmdir($this->dirPhoto));
    }


    public function getUsersForGroup() {
        $sql = "SELECT U.* FROM `SM_USER` AS U, `SM_USER_GROUP`AS UG, `SM_GROUP` AS G 
        WHERE U.sm_email = UG.sm_email AND UG.sm_idGroup = G.sm_idGroup AND G.sm_idGroup = 1";
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

    public function existsUser() {
        $sql = "SELECT * FROM `SM_USER` WHERE sm_email = '$this->email'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }


    public function existsDNI() {
        $sql = "SELECT * FROM `USER` WHERE dni = '$this->dni'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }



    public function validateletterDNI($dni) {
        $letterDNI = substr($dni, -1, 1);
        $numberDNI = substr($dni, 0, 8);
    
        $mod = $numberDNI % 23;
        $validLetters = "TRWAGMYFPDXBNJZSQVHLCKE";
        $letterCorrect = substr($validLetters, $mod, 1);

        if (strtoupper($letterDNI) != strtoupper($letterCorrect)) {
            return false;
        } else {
            return true;
        }
    }


    public function validateDate($date){
        $day = (int) substr($date, 0, 2);
        $month = (int) substr($date, 3, 2);
        $year = (int) substr($date, 6, 12);
        $currentDate = date("d/m/Y");
        $currentYear = (int) substr($currentDate, 6, 12);

        if(checkdate($month, $day, $year) && ($currentYear > $date) && ($currentYear - $year) >= 18){
            return true;
        } else {
            return false;
        }
    }
    


    /* SERVER VALIDATION FUNCTIONS*/


    public function checkLogin(){
        $errors = false;

        if (strlen(trim($this->email)) == 0) {
            $errors= "Email is mandatory";
        }else if (strlen(trim($this->email)) > 50 ) {
            $errors= "Email can't be larger than 50 characters";
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors = "Email format is invalid";
        }else if(!$this->existsUser()){
            $errors = "There isn't a user with that email";
        }else if (strlen(trim($this->password)) == 0 ) {
            $errors= "Password is mandatory";
        }else if (strlen(trim(md5($this->password))) > 128 ) {
            $errors = "Password can't be larger than 128 characters";
        }else if(!preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,15}$/', $this->password)){
            $errors = "Password format is invalid";
        }

        return $errors;

    }

    public function checkIsValidForAdd() {

        $errors = false;
        $group = new GROUP_Model($this->group);

        if (strlen(trim($this->email)) == 0) {
            $errors= "Email is mandatory";
        }else if (strlen(trim($this->email)) > 50 ) {
            $errors= "Email can't be larger than 50 characters";
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors = "Email format is invalid";
        }else if($this->existsUser()){
            $errors = "There is already a user with that email";
        }else if (strlen(trim($this->password)) == 0 ) {
            $errors= "Password is mandatory";
        }else if (strlen(trim(md5($this->password))) > 128 ) {
            $errors = "Password can't be larger than 128 characters";
        }else if(!preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,15}$/', $this->password)){
            $errors = "Password format is invalid";
        }else if (strlen(trim($this->name)) == 0 ) {
            $errors= "User name is mandatory";
        }else if (strlen(trim($this->name)) > 40 ) {
            $errors = "User name can't be larger than 40 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->name)){
            $errors = "User name format is invalid";
        }else if (strlen(trim($this->surname)) == 0 ) {
            $errors= "User surnames are mandatory";
        }else if (strlen(trim($this->surname)) > 100 ) {
            $errors = "User surnames can't be larger than 100 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->surname)){
            $errors = "User surnames format is invalid";
        }else if (strlen(trim($this->dni)) != 9 ) {
            $errors= "NID can't be different from 9 characters";;
        }else if (!preg_match('/^\d{8}[a-zA-Z]$/', $this->dni)) {
            $errors = "User id format is invalid";
        }else if(!$this->validateletterDNI($this->dni)){
            $errors = "User id letter is incorrect";
        }else if($this->existsDNI()){
            $errors = "There is already a user with that dni";
        }else if(strlen(trim($this->birthdate)) == 0){
            $errors = "Birthdate is mandatory";
        }else if(strlen(trim($this->birthdate)) > 10){
            $errors = "Birthdate can't be larger than 10 characters";
        }else if(!$this->validateDate($this->birthdate)){
            $errors = "Birthdate format is invalid";
        }else if (strlen(trim($this->phone)) != 9 ) {
            $errors= "User phone size is incorrect";
        }else if(!preg_match('/^[9|6|7][0-9]{8}$/', $this->phone)){
            $errors = "User phone format is invalid";
        }else if(!preg_match('/^\d+$/', $this->group)){
            $errors = "The role format is invalid";
        }else if(!$group->existsGroup()){
            $errors = "The role doesn't exist";
        }

       return $errors;
    }


    public function checkIsValidForEdit() {

        $errors = false;
        $group = new GROUP_Model($this->group);

        if (strlen(trim($this->email)) == 0) {
            $errors= "Email is mandatory";
        }else if (strlen(trim($this->email)) > 50 ) {
            $errors= "Email can't be larger than 50 characters";
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors = "Email format is invalid";
        }else if(!$this->existsUser()){
            $errors = "There isn't a user with that email";
        }else if(strlen(trim($this->password)) > 0 && strlen(trim(md5($this->password))) > 128) {
                $errors = "Password can't be larger than 128 characters";
        }else if(strlen(trim($this->password)) > 0 && !preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,15}$/', $this->password)){
                $errors = 'Password format is invalid';
        }else if (strlen(trim($this->name)) == 0 ) {
            $errors= "User name is mandatory";
        }else if (strlen(trim($this->name)) > 40 ) {
            $errors = "User name can't be larger than 40 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->name)){
            $errors = "User name format is invalid";
        }else if (strlen(trim($this->surname)) == 0 ) {
            $errors= "User surnames are mandatory";
        }else if (strlen(trim($this->surname)) > 100 ) {
            $errors = "User surnames can't be larger than 100 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->surname)){
            $errors = "User surnames format is invalid";
        }else if (strlen(trim($this->dni)) != 9 ) {
            $errors= "NID can't be different from 9 characters";
        }else if (!preg_match('/^\d{8}[a-zA-Z]$/', $this->dni)) {
            $errors = "User id format is invalid";
        }elseif(!$this->validateletterDNI($this->dni)){
            $errors = "User id letter is incorrect";
        }else if(strlen(trim($this->birthdate)) == 0){
            $errors = "Birthdate is mandatory";
        }else if(strlen(trim($this->birthdate)) > 10){
            $errors = "Birthdate can't be larger than 10 characters";
        }else if(!$this->validateDate($this->birthdate)){
            $errors = "Birthdate format is invalid";
        }else if (strlen(trim($this->phone)) != 9 ) {
            $errors= "User phone size is incorrect";
        }else if(!preg_match('/^[9|6|7][0-9]{8}$/', $this->phone)){
            $errors = "User phone format is invalid";
        }else if(!preg_match('/^\d+$/', $this->group)){
            $errors = "The role format is invalid";
        }else if(!$group->existsGroup()){
            $errors = "The role doesn't exist";
        }

       return $errors;      
    }

    public function checkIsValidForDelete() {

        $errors = false;

        if (strlen(trim($this->email)) == 0) {
            $errors= "Email is mandatory";
        }else if (strlen(trim($this->email)) > 50 ) {
            $errors= "Email can't be larger than 50 characters";
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors = "Email format is invalid";
        }else if(!$this->existsUser()){
            $errors = "There isn't a user with that email";
        }

       return $errors;      
    }

}
    ?>
