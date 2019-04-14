<?php

require_once(__DIR__."..\..\core\ConnectionBD.php");
require_once(__DIR__.'..\..\model\GROUP_Model.php');

class USER_Model {

	private $username;
	private $password;
	private $name;
	private $surname;
	private $dni;
	private $birthdate;
	private $email;
	private $phone;
    private $photo = array();
    private $dirPhoto;
    private $group;
	private $mysqli;


    public function __construct($username=null, $password=null, $name=null, $surname=null, $dni=null, $birthdate=null, $email=null, $phone=null, $photo=null, $group=null)
    {
        $this->username = $username; 
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->dni = $dni;
        $this->birthdate = $birthdate;
        $this->email = $email;
        $this->phone = $phone;
        $this->photo = $photo;
        $this->group = $group;
        $this->dirPhoto = '../document/Users/'.$this->getUsername().'/';
        $this->mysqli = Connection::connectionBD();
    }


    public function getUsername(){
        return $this->username;
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


    public function login() {
        if($this->getUsername() != null && $this->getPassword() != null){
            $sql = "SELECT * FROM `SM_USER` WHERE sm_username = '$this->username'";
            $result = $this->mysqli->query($sql);
            if ($result->num_rows == 1) {
                $tuple = $result->fetch_array();
                if ($tuple['sm_passwd'] == md5($this->password)) {
                    return true;
                } else {
                    return 'Password is incorrect';
                }
            } else {
                return "The user doesn't exist";
            }
        }else{
            return 'Username and password are mandatory';
        }
    }


    public function getPermissions(){
        $sql ="SELECT DISTINCT SM_ACTION.sm_nameAction, SM_FUNCTIONALITY.sm_nameFunction FROM `SM_GROUP`, `SM_USER_GROUP`, `SM_PERMISSION`, `SM_FUNCTIONALITY`, `SM_ACTION` WHERE SM_USER_GROUP.sm_username = '$this->username' AND SM_USER_GROUP.sm_idGroup = SM_GROUP.sm_idGroup AND SM_PERMISSION.sm_idFunction = SM_FUNCTIONALITY.sm_idFunction AND SM_PERMISSION.sm_idAction = SM_ACTION.sm_idAction";
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

    public function findUser() {
        $sql = "SELECT * FROM `SM_USER` WHERE sm_username = '$this->username'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }


    public function findUserWithGroup(){
        $sql = "SELECT * FROM`SM_USER` U, `SM_USER_GROUP` UG, `SM_GROUP` G
                WHERE U.sm_username = '$this->username' AND U.sm_username = UG.sm_username AND UG.sm_idGroup = G.sm_idGroup";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }

    public function findLinkProfilePhoto() {
        $sql = "SELECT sm_photo FROM `SM_USER` WHERE sm_username='$this->username'";
        $result = $this->mysqli->query($sql)->fetch_array();
        return $result['photo'];
    }


    public function showAllUsers() {
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

    public function addUser() {

        $errors = $this->checkIsValidForAdd();
        if($errors === false){
            $passwordBD = md5($this->password);
            $dateBD = $this->formatDate($this->birthdate);
            $photoBD =$this->dirPhoto.$this->getPhoto('name');
            $sql = "INSERT INTO `SM_USER` VALUES ('$photoBD', '$this->username', '$passwordBD', '$this->name', '$this->surname', '$this->dni', '$dateBD', '$this->email', '$this->phone')";
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
        }else {
            return $errors;
        }
    }


    public function updateUser() {

        $errors = $this->checkIsValidForEdit();
        if($errors === false){
            $dateBD = $this->formatDate($this->birthdate);
            if($this->getPhoto('name') == '' && empty($this->password)){
                $sql = "UPDATE `SM_USER` SET sm_name = '$this->name', sm_surname = '$this->surname', sm_dni = '$this->dni', sm_birthdate = '$dateBD', sm_email = '$this->email', sm_phone = '$this->phone' WHERE sm_username = '$this->username'";  
            }else if($this->getPhoto('name') == '' && !empty($this->password)){
                $sql = "UPDATE `SM_USER` SET sm_password = '$this->password', sm_name = '$this->name', sm_surname = '$this->surname', sm_dni = '$this->dni', sm_birthdate = '$dateBD', sm_email = '$this->email', sm_phone = '$this->phone' WHERE sm_username = '$this->username'";  
            }else if($this->getPhoto('name') !== '' && empty($this->password)){
                $photoBD =$this->dirPhoto.$this->getPhoto('name');
                $sql = "UPDATE `SM_USER` SET sm_photo = '$photoBD', sm_name = '$this->name', sm_surname = '$this->surname', sm_dni = '$this->dni', sm_birthdate = '$dateBD', sm_email = '$this->email', sm_phone = '$this->phone' WHERE sm_username = '$this->username'";
                $this->updateDirPhoto();
                unlink($this->findLinkProfilePhoto());
            } else {
                $photoBD =$this->dirPhoto.$this->getPhoto('name'); 
                $sql = "UPDATE `SM_USER` SET sm_photo = '$photoBD', sm_password = '$this->password', sm_name = '$this->name', sm_surname = '$this->surname', sm_dni = '$this->dni', sm_birthdate = '$dateBD', sm_email = '$this->email', sm_phone = '$this->phone' WHERE sm_username = '$this->username'";
                $this->updateDirPhoto();
                unlink($this->findLinkProfilePhoto());
            }

            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                return true;
            }
        } else {
            return $errors;
        }
    }

    public function deleteUser() {
        if($this->existsUser()){
            $sql = "DELETE FROM `SM_USER` WHERE sm_username ='$this->username'";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                rmdir('../document/Users/'.$this->username);
                return true;
            }
        } else {
            return 'No such user with this username';
        }
    }



    public function addRoleUser() {
        $sql = "INSERT INTO `SM_USER_GROUP` VALUES ('$this->username','$this->group')";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            return true;
        }
    }




    public function formatDate($date){
        $dateFormat = str_replace('/', '-', $date);
        $dateFormat = date('Y-m-d', strtotime($dateFormat));
        return $dateFormat;
    }


    public function updateDirPhoto() {
        if ($this->getPhoto('name') !== '') {
            if (!file_exists($this->dirPhoto)) {
                mkdir($this->dirPhoto, 0777, true);
            }
        move_uploaded_file($this->getPhoto('tmp_name'), $this->dirPhoto.$this->getPhoto('name'));
        }
    }


    public function existsUser() {
        $sql = "SELECT * FROM `SM_USER` WHERE sm_username = '$this->username'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function existsDNI() {
        $sql = "SELECT * FROM `SM_USER` WHERE sm_dni = '$this->dni'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function existsEmail() {
        $sql = "SELECT * FROM `SM_USER` WHERE sm_email = '$this->email'";
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


    public function validateDate($date)
    {
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
    


    public function checkIsValidForAdd() {

        $errors = false;
        $group = new GROUP_Model($this->group);

        if (strlen(trim($this->username)) == 0 ) {
            $errors= "Username is mandatory";
        }else if (strlen(trim($this->username)) > 25 ) {
            $errors = "Username can not be that long";
        }else if(!preg_match('/^[a-zA-Z0-9, ]*$/', $this->username)){
            $errors = "Username is invalid";
        }else if($this->existsUser()){
            $errors = "There is already a user with that username";
        }else if (strlen(trim($this->password)) == 0 ) {
            $errors= "Password is mandatory";
        }else if (strlen(trim(md5($this->password))) > 128 ) {
            $errors = "Password can not be that long";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->password)){
            $errors = "Password is invalid";
        }else if (strlen(trim($this->name)) == 0 ) {
            $errors= "User name is mandatory";
        }else if (strlen(trim($this->name)) > 40 ) {
            $errors = "User name can not be that long";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->name)){
            $errors = "User name is invalid";
        }else if (strlen(trim($this->surname)) == 0 ) {
            $errors= "User surnames are mandatory";
        }else if (strlen(trim($this->surname)) > 100 ) {
            $errors = "User surnames can not be that long";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->surname)){
            $errors = "User surnames are invalid";
        }else if (strlen(trim($this->dni)) != 9 ) {
            $errors= "DNI can not be that long";
        }else if($this->existsDNI()){
            $errors = "There is already a user with that dni";
        }else if (!preg_match('/^\d{8}[a-zA-Z]$/', $this->dni)) {
            $errors = "User id is invalid";
        }else if(!$this->validateletterDNI($this->dni)){
            $errors = "User id letter is invalid";
        }else if(!$this->validateDate($this->birthdate)){
            $errors = "Birthdate is incorrect";
        }else if (strlen(trim($this->email)) > 50 ) {
            $errors= "Email can not be that long";
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors = "Email is invalid";
        }else if($this->existsEmail()){
            $errors = "There is already a user with that email";
        }else if (strlen(trim($this->phone)) != 9 ) {
            $errors= "User phone is incorrect";
        }else if(!preg_match('/^[9|6|7][0-9]{8}$/', $this->phone)){
            $errors = "User phone format is invalid";
        }else if(!$group->existsGroup()){
            $errors = "The role doesn't exist";
        }else if(!preg_match('/^\d+$/', $this->group)){
            $errors = "The role format is invalid";
        }

       return $errors;
    }


    public function checkIsValidForEdit() {

        $errors = false;
        $group = new GROUP_Model($this->group);

        if (strlen(trim($this->username)) == 0 ) {
            $errors= "Username is mandatory";
        }else if (strlen(trim($this->username)) > 25 ) {
            $errors = "Username can not be that long";
        }else if(!preg_match('/^[a-zA-Z0-9, ]*$/', $this->username)){
            $errors = "Username is invalid";
        }else if(strlen(trim($this->password)) > 0 ) {
            if (strlen(trim(md5($this->password))) > 128 ) {
                $errors = "Password can not be that long";
            }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->password)){
                $errors = "Password is invalid";
            }
        }else if (strlen(trim($this->name)) == 0 ) {
            $errors= "User name is mandatory";
        }else if (strlen(trim($this->name)) > 40 ) {
            $errors = "User name can not be that long";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->name)){
            $errors = "User name is invalid";
        }else if (strlen(trim($this->surname)) == 0 ) {
            $errors= "User surnames are mandatory";
        }else if (strlen(trim($this->surname)) > 100 ) {
            $errors = "User surnames can not be that long";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->surname)){
            $errors = "User surnames are invalid";
        }else if (strlen(trim($this->dni)) != 9 ) {
            $errors= "DNI can not be that long";
        }else if (!preg_match('/^\d{8}[a-zA-Z]$/', $this->dni)) {
            $errors = "User id is invalid";
        }elseif(!$this->validateletterDNI($this->dni)){
            $errors = "User id letter is invalid";
        }else if(!$this->validateDate($this->birthdate)){
            $errors = "Birthdate is incorrect";
        }else if (strlen(trim($this->email)) > 50 ) {
            $errors= "Email can not be that long";
        }elseif(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors = "Email is invalid";
        }else if (strlen(trim($this->phone)) != 9 ) {
            $errors= "User phone is incorrect";
        }else if(!preg_match('/^[9|6|7][0-9]{8}$/', $this->phone)){
            $errors = "User phone format is invalid";
        }else if(!$group->existsGroup()){
            $errors = "The role doesn't exist";
        }else if(!preg_match('/^\d+$/', $this->group)){
            $errors = "The role format is invalid";
        }

       return $errors;      
    }

}
    ?>
