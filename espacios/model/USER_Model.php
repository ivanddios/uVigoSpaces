<?php

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
	$this->password = $password;
	$this->name = $name;
	$this->surname = $surname;
	$this->dni =  $dni;
	$this->birthdate = $birthdate;
	$this->email = $email;
	$this->phone =  $phone;
	$this->photo =$photo;
}


function ConectarBD()
{
	$this->mysqli = new mysqli("localhost", "root", "", "espacios");
	$this->mysqli->query("set names 'utf8'");
	if ($this->mysqli->connect_errno) {
		echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
	}
}

function login() {
	$this->ConectarBD();
	$sql = "SELECT * FROM USER WHERE username = '" . $this->USER_USERNAME . "'";
	$result = $this->mysqli->query($sql);
	if ($result->num_rows == 1) {
		$tuple = $result->fetch_array();
		if ($tuple['passwd'] == md5($this->USER_PASSWD)) {
			return true;
		} else {
			return 'Username or password is incorrect';
		}
	} else {
		return "Username or password is incorrect";
	}
}

function getPermissions(){
	$sql ="SELECT DISTINCT A.nameAction, F.nameFunction FROM USER_GROUP UG, PERMISSION P, FUNCTIONALITY F, ACTION A  WHERE UG.username='$this->USER_USERNAME' && UG.idGroup = P.idGroup && P.idFunction=F.idFunction && P.idAction = A.idAction";
	$result = $this->mysqli->query($sql);  
	$j = 0;
	while($tuple = mysqli_fetch_row($result)){
			$tuples[$j] = $tuple;
			$j++;
	}
	if($tuples == null){
		return false;
	}
	else{
		return $tuples;
	}
}

function showAllUsers() {
    $this->ConectarBD();
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




public function existsUser($username) {
	$this->ConectarBD();
	$sql = "SELECT * FROM user WHERE username = '$username'";
	$result = $this->mysqli->query($sql);
	if ($result->num_rows == 1) {
		return true;
	} else {
		return false;
	}
}


/* INCOMPLETAS */
public function checkIsValidForAdd_Update() {

    $errors = array();

    if (strlen(trim($this->username)) == 0 ) {
        $errors= "Username is mandatory";
    }else if (strlen(trim($this->username)) > 25 ) {
        $errors = "Username can not be that long";
    }else if(!preg_match('/[A-Z0-9]/', $this->username)){
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
        $errors= "User surname is mandatory";
    }else if (strlen(trim($this->surname)) > 225 ) {
        $errors = "User surname can not be that long";
    }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->surname)){
        $errors = "User surname is invalid. Try again!";
    }else if (strlen(trim($this->phoneBuilding)) != 9 ) {
        $errors= "Building phone is incorrect. Example: 666777888";
    }else if(!preg_match('/^[9|6|7][0-9]{8}$/', $this->phoneBuilding)){
        $errors = "Building phone format is invalid. Example: 666777888";
    }

    if (sizeof($errors) > 0){
        throw new Exception($errors);
    }
}

 }


?>
