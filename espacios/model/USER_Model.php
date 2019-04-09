<?php

require_once(__DIR__."..\..\core\ConnectionBD.php");

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
	private $mysqli;


    function __construct($username=null, $password=null, $name=null, $surname=null, $dni=null, $birthdate=null, $email=null, $phone=null, $photo=null)
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
        $this->dirPhoto = '../document/Users/'.$this->getUsername().'/';
        $this->mysqli = Connection::connectionBD();
    }


    public function getUsername(){
        return $this->username;
    }

    public function getPhoto($option=null){
        if($option !== null && isset($this->photo[$option])){
            return $this->photo[$option];
        } else {
            return $this->photo;
        }   
    }


    function login() {
        $sql = "SELECT * FROM `SM_USER` WHERE sm_username = '$this->username'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            $tuple = $result->fetch_array();
            if ($tuple['sm_passwd'] == md5($this->password)) {
                return true;
            } else {
                throw new Exception('Username or password is incorrect');
            }
        } else {
            throw new Exception('Username or password is incorrect');
        }
    }


    function getPermissions(){
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

    function findUser() {
        $sql = "SELECT * FROM `SM_USER` WHERE sm_username = '$this->username'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }

    function findLinkProfilePhoto() {
        $sql = "SELECT sm_photo FROM `SM_USER` WHERE sm_username='$this->username'";
        $result = $this->mysqli->query($sql)->fetch_array();
        return $result['photo'];
    }


    function showAllUsers() {
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

    function addUser() {
        $passwordBD = md5($this->password);
        $dateBD = $this->formatDate($this->birthdate);
        $photoBD =$this->dirPhoto.$this->getPhoto('name');
        $sql = "INSERT INTO `SM_USER` VALUES ('$photoBD', '$this->username', '$passwordBD', '$this->name', '$this->surname', '$this->dni', '$dateBD', '$this->email', '$this->phone')";
        if (!($resultado = $this->mysqli->query($sql))) {
            throw new Exception('Error in the query on the database');
        } else {
            $this->updateDirPhoto();
            return true;
        }
    }


    function updateUser() {

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
            throw new Exception('Error in the query on the database');
        } else {
            return true;
        }
    }

    function deleteUser() {
        $sql = "DELETE FROM `SM_USER` WHERE sm_username ='$this->username'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            return true;
        }
    }


    function formatDate($date){
        $dateFormat = str_replace('/', '-', $date);
        $dateFormat = date('Y-m-d', strtotime($dateFormat));
        return $dateFormat;
    }


    function updateDirPhoto() {

        if ($this->getPhoto('name') !== '') {
            if (!file_exists($this->dirPhoto)) {
                mkdir($this->dirPhoto, 0777, true);
            }
        move_uploaded_file($this->getPhoto('tmp_name'), $this->dirPhoto.$this->getPhoto('name'));
        }
    }


    function existsUser($username) {
        $sql = "SELECT * FROM `SM_USER` WHERE sm_username = '$username'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    function existsDNI($dni) {
        $sql = "SELECT * FROM `SM_USER` WHERE sm_dni = '$dni'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    function existsEmail($email) {
        $sql = "SELECT * FROM `SM_USER` WHERE sm_email = '$email'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }


    function validateletterDNI($dni) {

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


    function validateDate($date)
    {
        $day = (int) substr($date, 0, 2);
        $month = (int) substr($date, 3, 2);
        $year = (int) substr($date, 6, 12);
        $currentDate = date("d/m/Y");
        $currentYear = (int) substr($currentDate, 6, 12);

        if(checkdate($month, $day, $year) && ($currentDate > $date) && ($currentYear - $year) >= 18){
            return true;
        } else {
            return false;
        }
    }
    


    public function checkIsValidForAdd() {

        $errors = array();

        if (strlen(trim($this->username)) == 0 ) {
            $errors= "Username is mandatory";
        }else if (strlen(trim($this->username)) > 25 ) {
            $errors = "Username can not be that long";
        }else if(!preg_match('/^[a-zA-Z0-9, ]*$/', $this->username)){
            $errors = "Username is invalid";
        }elseif($this->existsUser($this->username)){
            $errors = "There is already a user with that username";
        }else if (strlen(trim($this->password)) == 0 ) {
            $errors= "Password is mandatory";
        }else if (strlen(trim(md5($this->password))) > 128 ) {
            $errors = "Password can not be that long";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->password)){
            $errors = "Password is invalid. Try again!";
        }else if (strlen(trim($this->name)) == 0 ) {
            $errors= "User name is mandatory";
        }else if (strlen(trim($this->name)) > 40 ) {
            $errors = "User name can not be that long";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->name)){
            $errors = "User name is invalid. Try again!";
        }else if (strlen(trim($this->surname)) == 0 ) {
            $errors= "User surnames are mandatory";
        }else if (strlen(trim($this->surname)) > 100 ) {
            $errors = "User surnames can not be that long";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->surname)){
            $errors = "User surnames are invalid. Try again!";
        }else if (strlen(trim($this->dni)) != 9 ) {
            $errors= "DNI can not be that long";
        }elseif($this->existsDNI($this->dni)){
            $errors = "There is already a user with that dni";
        }else if (!preg_match('/^\d{8}[a-zA-Z]$/', $this->dni)) {
            $errors = "User id is invalid. Try again!";
        }elseif(!$this->validateletterDNI($this->dni)){
            $errors = "User id letter is invalid. Try again!";
        }else if(!$this->validateDate($this->birthdate)){
            $errors = "Birthdate is incorrect";
        }else if (strlen(trim($this->email)) > 50 ) {
            $errors= "Email can not be that long";
        }elseif(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors = "Email is invalid";
        }elseif($this->existsEmail($this->email)){
            $errors = "There is already a user with that email";
        }else if (strlen(trim($this->phone)) != 9 ) {
            $errors= "User phone is incorrect. Example: 666777888";
        }else if(!preg_match('/^[9|6|7][0-9]{8}$/', $this->phone)){
            $errors = "User phone format is invalid. Example: 666777888";
        }

        if (sizeof($errors) > 0){
            throw new Exception($errors);
        }   
    }




    public function checkIsValidForEdit() {

        $errors = array();

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
                $errors = "Password is invalid. Try again!";
            }
        }else if (strlen(trim($this->name)) == 0 ) {
            $errors= "User name is mandatory";
        }else if (strlen(trim($this->name)) > 40 ) {
            $errors = "User name can not be that long";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->name)){
            $errors = "User name is invalid. Try again!";
        }else if (strlen(trim($this->surname)) == 0 ) {
            $errors= "User surnames are mandatory";
        }else if (strlen(trim($this->surname)) > 100 ) {
            $errors = "User surnames can not be that long";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->surname)){
            $errors = "User surnames are invalid. Try again!";
        }else if (strlen(trim($this->dni)) != 9 ) {
            $errors= "DNI can not be that long";
        }else if (!preg_match('/^\d{8}[a-zA-Z]$/', $this->dni)) {
            $errors = "User id is invalid. Try again!";
        }elseif(!$this->validateletterDNI($this->dni)){
            $errors = "User id letter is invalid. Try again!";
        }else if(!$this->validateDate($this->birthdate)){
            $errors = "Birthdate is incorrect";
        }else if (strlen(trim($this->email)) > 50 ) {
            $errors= "Email can not be that long";
        }elseif(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors = "Email is invalid";
        }else if (strlen(trim($this->phone)) != 9 ) {
            $errors= "User phone is incorrect. Example: 666777888";
        }else if(!preg_match('/^[9|6|7][0-9]{8}$/', $this->phone)){
            $errors = "User phone format is invalid. Example: 666777888";
        }

        if (sizeof($errors) > 0){
            throw new Exception($errors);
        }       
    }

}
    ?>
