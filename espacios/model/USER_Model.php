<?php

require_once(__DIR__."..\..\core\ConnectionBD.php");

class USER_Model {

	var $username;
	var $password;
	var $name;
	var $surname;
	var $dni;
	var $birthdate;
	var $email;
	var $phone;
	var $photo;
	var $mysqli;


    function __construct($username=null, $password=null, $name=null, $surname=null, $dni=null, $birthdate=null, $email=null, $phone=null, $photo=null)
    {
        $this->username =  $username; 
        $this->password = md5($password);
        $this->name = $name;
        $this->surname = $surname;
        $this->dni = $dni;
        $this->birthdate = $birthdate;
        $this->email = $email;
        $this->phone = $phone;
        $this->photo =$photo;
        $this->mysqli = Connection::connectionBD();
    }


    public function getUsername(){
        return $this->username;
    }

    public function getDNI(){
        return $this->dni;
    }



    function login() {
        $sql = "SELECT * FROM user WHERE username = '$this->username'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            $tuple = $result->fetch_array();
            if ($tuple['passwd'] == md5($this->password)) {
                return true;
            } else {
                return 'Username or password is incorrect';
            }
        } else {
            return "Username or password is incorrect";
        }
    }


    function getPermissions(){
        $sql ="SELECT DISTINCT action.nameAction, functionality.nameFunction FROM user_group, permission, functionality, action WHERE user_group.username = '$this->username' AND user_group.idGroup = permission.idGroup AND permission.idFunction = functionality.idFunction AND permission.idAction = action.idAction";
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



    function showAllUsers() {
        $sql = "SELECT * FROM user";
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

       

        $sql = "INSERT INTO user VALUES ('$this->photo', '$this->username', '$this->password', '$this->name', '$this->surname', '$this->dni', '$this->birthdate', '$this->email', '$this->phone')";
        if (!($resultado = $this->mysqli->query($sql))) {
            throw new Exception('Error in the query on the database');
        } else {
            var_dump("DQA");
            return true;
        }
    }


    function existsUser($username) {
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }


    function letterDNI($dni) {

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

    /* INCOMPLETAS. PROBAR FECHA Y DNI */ 
    public function checkIsValidForAdd_Update() {

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
        }else if (strlen(trim($this->password)) > 225 ) {
            $errors = "Password can not be that long";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->password)){
            $errors = "Password is invalid. Try again!";
        }else if (strlen(trim($this->name)) == 0 ) {
            $errors= "User name is mandatory";
        }else if (strlen(trim($this->name)) > 225 ) {
            $errors = "User name can not be that long";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->name)){
            $errors = "User name is invalid. Try again!";
        }else if (strlen(trim($this->surname)) == 0 ) {
            $errors= "User surnames are mandatory";
        }else if (strlen(trim($this->surname)) > 225 ) {
            $errors = "User surnames can not be that long";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->surname)){
            $errors = "User surnames are invalid. Try again!";
        }else if (!preg_match('/^\d{8}[a-zA-Z]$/', $this->dni)) {
            $errors = "User id is invalid. Try again!";
        }elseif(!$this->letterDNI($this->dni)){
            $errors = "User id letter is invalid. Try again!";
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
