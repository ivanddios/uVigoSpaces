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


    /* MAIN FUNCTIONS */

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
        $sql ="SELECT DISTINCT A.sm_nameAction, F.sm_nameFunction 
                FROM `SM_GROUP` AS G, `SM_USER_GROUP` AS UG, `SM_PERMISSION` AS P, `SM_FUNCTIONALITY` AS F, `SM_ACTION` AS A 
                WHERE UG.sm_username = '$this->username' AND UG.sm_idGroup = G.sm_idGroup 
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
                WHERE U.sm_username = '$this->username' AND U.sm_username = UG.sm_username AND UG.sm_idGroup = G.sm_idGroup";
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
                $sql = "UPDATE `SM_USER` SET sm_passwd = '$this->password', sm_name = '$this->name', sm_surname = '$this->surname', sm_dni = '$this->dni', sm_birthdate = '$dateBD', sm_email = '$this->email', sm_phone = '$this->phone' WHERE sm_username = '$this->username'";  
            }else if($this->getPhoto('name') !== '' && empty($this->password)){
                $photoBD =$this->dirPhoto.$this->getPhoto('name');
                $sql = "UPDATE `SM_USER` SET sm_photo = '$photoBD', sm_name = '$this->name', sm_surname = '$this->surname', sm_dni = '$this->dni', sm_birthdate = '$dateBD', sm_email = '$this->email', sm_phone = '$this->phone' WHERE sm_username = '$this->username'";
                unlink($this->getLinkProfilePhoto());
                $this->updateDirPhoto();
            } else {
                $photoBD =$this->dirPhoto.$this->getPhoto('name'); 
                $sql = "UPDATE `SM_USER` SET sm_photo = '$photoBD', sm_passwd = '$this->password', sm_name = '$this->name', sm_surname = '$this->surname', sm_dni = '$this->dni', sm_birthdate = '$dateBD', sm_email = '$this->email', sm_phone = '$this->phone' WHERE sm_username = '$this->username'";
                unlink($this->getLinkProfilePhoto());
                $this->updateDirPhoto(); 
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

        $errors = $this->checkIsValidForDelete();
        if($errors === false){
            $this->deleteDirPhoto();
            $sql = "DELETE FROM `SM_USER` WHERE sm_username ='$this->username'";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                return true;
            }
        } else {
            return $errors;;
        }
    }



    /*AUXLIARY FUNCTIONS  */
    public function addRoleUser() {
        $sql = "INSERT INTO `SM_USER_GROUP` VALUES ('$this->username','$this->group')";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            return true;
        }
    }


    public function getLinkProfilePhoto() {
        $sql = "SELECT sm_photo FROM `SM_USER` WHERE sm_username='$this->username'";
        $result = $this->mysqli->query($sql)->fetch_array();
        return $result['sm_photo'];
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

    public function checkIsValidForAdd() {

        $errors = false;
        $group = new GROUP_Model($this->group);

        if (strlen(trim($this->username)) == 0 ) {
            $errors= "Username is mandatory";
        }else if (strlen(trim($this->username)) > 25 ) {
            $errors = "Username can't be larger than 25 characters";
        }else if(!preg_match('/^[a-zA-Z0-9, ]*$/', $this->username)){
            $errors = "Username format is invalid";
        }else if($this->existsUser()){
            $errors = "There is already a user with that username";
        }else if (strlen(trim($this->password)) == 0 ) {
            $errors= "Password is mandatory";
        }else if (strlen(trim(md5($this->password))) > 128 ) {
            $errors = "Password can't be larger than 128 characters";
        }else if(!preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{5,15}$/', $this->password)){
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
        }else if (strlen(trim($this->email)) == 0) {
            $errors= "Email is mandatory";
        }else if (strlen(trim($this->email)) > 50 ) {
            $errors= "Email can't be larger than 50 characters";
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors = "Email format is invalid";
        }else if($this->existsEmail()){
            $errors = "There is already a user with that email";
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

        if (strlen(trim($this->username)) == 0 ) {
            $errors= "Username is mandatory";
        }else if (strlen(trim($this->username)) > 25 ) {
            $errors = "Username can't be larger than 25 characters";
        }else if(!preg_match('/^[a-zA-Z0-9, ]*$/', $this->username)){
            $errors = "Username format is invalid";
        }else if(!$this->existsUser()){
                $errors = "There isn't a user with that username";
        }else if(strlen(trim($this->password)) > 0 && strlen(trim(md5($this->password))) > 128) {
                $errors = "Password can't be larger than 128 characters";
        }else if(strlen(trim($this->password)) > 0 && !preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{5,15}$/', $this->password)){
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
        }else if (strlen(trim($this->email)) == 0) {
            $errors= "Email is mandatory";
        }else if (strlen(trim($this->email)) > 50 ) {
            $errors= "Email can't be larger than 50 characters";
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors = "Email format is invalid";
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

        if (strlen(trim($this->username)) == 0 ) {
            $errors= "Username is mandatory";
        }else if (strlen(trim($this->username)) > 25 ) {
            $errors = "Username can't be larger than 25 characters";
        }else if(!preg_match('/^[a-zA-Z0-9, ]*$/', $this->username)){
            $errors = "Username format is invalid";
        }else if(!$this->existsUser()){
            $errors = "There isn't a user with that username";
        }

       return $errors;      
    }

}
    ?>
