<?php

class USER_Model {

	var $USER_USERNAME;
	var $USER_PASSWD;
	var $USER_NAME;
	var $USER_SURNAME;
	var $USER_DNI;
	var $USER_BIRTHDATE;
	var $USER_EMAIL;
	var $USER_PHONE;
	var $USER_PHOTO;
	var $mysqli;


function __construct($USER_USERNAME, $USER_PASSWD, $USER_NAME, $USER_SURNAME, $USER_DNI, $USER_BIRTHDATE, $USER_EMAIL, $USER_PHONE, $USER_PHOTO)
{
    $this->USER_USERNAME =  $USER_USERNAME; 
	$this->USER_PASSWD = $USER_PASSWD;
	$this->USER_NAME = $USER_NAME;
	$this->USER_SURNAME = $USER_SURNAME;
	$this->USER_DNI =  $USER_DNI;
	$this->USER_BIRTHDATE = $USER_BIRTHDATE;
	$this->USER_EMAIL = $USER_EMAIL;
	$this->USER_PHONE =  $USER_PHONE;
	$this->USER_PHOTO =$USER_PHOTO;
}


function ConectarBD()
{
    $this->mysqli = new mysqli("localhost", "root", "", "espacios");
	if ($this->mysqli->connect_errno) {
		echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
	}
}

function Login() {
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


function getPermisos(){
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


 }













?>
