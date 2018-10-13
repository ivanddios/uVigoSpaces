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



// //Insertar usuario
// function Insertar()
// {
//     $this->ConectarBD();
//     if ($this->USUARIO_USER <> '' ){
		
//         $sql = "select * from USUARIO where USUARIO_USER = '".$this->USUARIO_USER."'";

// 		if (!$result = $this->mysqli->query($sql)){
// 			return 'No se ha podido conectar con la base de datos';
// 		}
// 		else {
// 			if ($result->num_rows == 0){

// 				//Insertamos en la tabla USUARIO
// 				$sql = "INSERT INTO USUARIO (USUARIO_USER, USUARIO_PASSWORD, USUARIO_FECH_NAC, USUARIO_EMAIL, USUARIO_NOMBRE, USUARIO_APELLIDO, USUARIO_DNI, USUARIO_TELEFONO, USUARIO_CUENTA, USUARIO_DIRECCION, USUARIO_COMENTARIOS, USUARIO_TIPO, USUARIO_ESTADO, USUARIO_FOTO) VALUES ('";

// 				$sql = $sql . "$this->USUARIO_USER', '".md5($this->USUARIO_PASSWORD)."', '$this->USUARIO_FECH_NAC', '$this->USUARIO_EMAIL', '$this->USUARIO_NOMBRE', '$this->USUARIO_APELLIDO', '$this->USUARIO_DNI', '$this->USUARIO_TELEFONO','$this->USUARIO_CUENTA', '$this->USUARIO_DIRECCION', '$this->USUARIO_COMENTARIOS',  '$this->USUARIO_TIPO', '$this->USUARIO_ESTADO', '$this->USUARIO_FOTO')";

// 				$this->mysqli->query($sql);
// 				//Cogemos las páginas que le corresponden por pertenecer a un determinado rol
// 				$sql = "SELECT DISTINCT PAGINA.PAGINA_ID FROM USUARIO, ROL_FUNCIONALIDAD, FUNCIONALIDAD_PAGINA, PAGINA  WHERE USUARIO.USUARIO_TIPO=ROL_FUNCIONALIDAD.ROL_ID AND ROL_FUNCIONALIDAD.FUNCIONALIDAD_ID=FUNCIONALIDAD_PAGINA.FUNCIONALIDAD_ID AND PAGINA.PAGINA_ID=FUNCIONALIDAD_PAGINA.PAGINA_ID AND USUARIO_USER='" . $this->USUARIO_USER."'";

// 				if (!($resultado = $this->mysqli->query($sql))) {
// 					echo 'Error en la consulta sobre la base de datos';
// 				} else {
// 					while ($tupla=$resultado->fetch_array()){
// 						//Insertamos esas páginas en la tabla USUARIO_PÁGINA de la que se van a recoger las acciones permitidas
// 						$sql="INSERT INTO USUARIO_PAGINA (USUARIO_USER, PAGINA_ID) VALUES('".$this->USUARIO_USER."',".$tupla['PAGINA_ID'].")";

// 						$this->mysqli->query($sql);
// 					}

// 				}

// 				return 'Inserción realizada con éxito';
// 			}
// 			else
// 				return 'El usuario ya existe en la base de datos';
// 		}
//     }
//     else{

// 	return 'Introduzca un valor para usuario del usuario';
// }
// }

// //destrucción del objeto
// function __destruct()
// {

// }

// //Consulta por todos los campos
// function Consultar()
// {
//     $this->ConectarBD();
//     $sql = "select USUARIO_USER, USUARIO_PASSWORD, USUARIO_NOMBRE, USUARIO_APELLIDO, USUARIO_DNI, USUARIO_FECH_NAC, USUARIO_EMAIL, USUARIO_TELEFONO, USUARIO_CUENTA, USUARIO_DIRECCION, USUARIO_COMENTARIOS, USUARIO_TIPO, USUARIO_FOTO, USUARIO_ESTADO from USUARIO where (USUARIO_USER LIKE '".$this->USUARIO_USER."' )OR (USUARIO_NOMBRE LIKE '".$this->USUARIO_NOMBRE."' )OR (USUARIO_APELLIDO LIKE '".$this->USUARIO_APELLIDO."')OR (USUARIO_FECH_NAC LIKE '".$this->USUARIO_FECH_NAC."')OR(USUARIO_DNI LIKE '".$this->USUARIO_DNI."')OR (USUARIO_EMAIL LIKE '".$this->USUARIO_EMAIL."') OR (USUARIO_TELEFONO LIKE '".$this->USUARIO_TELEFONO."' ) OR (USUARIO_DIRECCION LIKE '".$this->USUARIO_DIRECCION."') OR (USUARIO_CUENTA LIKE '".$this->USUARIO_CUENTA."' )" ;

// 	if (!($resultado = $this->mysqli->query($sql))){
// 	return 'Error en la consulta sobre la base de datos';
// 	}
//     else{
// 		$toret=array();
// 		$i=0;

// 		while ($fila= $resultado->fetch_array()) {


// 			$toret[$i]=$fila;
// 			$i++;

// 		}

// 		return $toret;
// 	}
// }
// //Devuelve la información de todos los usuarios
// 	function ConsultarTodo()
// 	{
// 		$this->ConectarBD();
// 		$sql = "select * from USUARIO";
// 		if (!($resultado = $this->mysqli->query($sql))){
// 			return 'Error en la consulta sobre la base de datos';
// 		}
// 		else{

// 			$toret=array();
// 			$i=0;

// 			while ($fila= $resultado->fetch_array()) {


// 				$toret[$i]=$fila;
// 				$i++;

// 			}

// 			return $toret;

// 		}
// 	}
// //Realiza el borrado lógico de un usuario cambiando su estado a Inactivo
// function Borrar()
// {
//     $this->ConectarBD();
//     $sql = "select * from USUARIO where USUARIO_USER = '".$this->USUARIO_USER."'";
//     $result = $this->mysqli->query($sql);
//     if ($result->num_rows == 1)
//     {
//     	if ($this->USUARIO_ESTADO='Activo') {
// 			$sql = "UPDATE  USUARIO SET USUARIO_ESTADO='Inactivo' where USUARIO_USER = '" . $this->USUARIO_USER . "'";
// 			$this->mysqli->query($sql);
// 			return "El usuario ha sido borrado correctamente";
// 		}
// 		else {
// 			return "El usuario ya no se encuentra contratado";
// 		}
//     }
//     else
//         return "El usuario no existe";
// }
// //Devuelve los valores almacenados para un determinado usuario para posteriormente rellenar un formulario
// function RellenaDatos()
// {
//     $this->ConectarBD();
//     $sql = "select * from USUARIO where USUARIO_USER = '".$this->USUARIO_USER."'";

//     if (!($resultado = $this->mysqli->query($sql))){
// 	return 'Error en la consulta sobre la base de datos';
// 	}
//     else{
// 	$result = $resultado->fetch_array();
// 	return $result;
// 	}
// }
// //Actualiza en la base de datos la información de un determinado usuario
// function Modificar()
// {
//     $this->ConectarBD();
//     $sql = "select * from USUARIO where USUARIO_USER = '".$this->USUARIO_USER."'";
//     $result = $this->mysqli->query($sql);
//     if ($result->num_rows == 1)
//     {if ($this->USUARIO_USER==='ADMIN') {
//     	$this->USUARIO_TIPO=1;
// 	}
// 	$sql = "UPDATE USUARIO SET USUARIO_PASSWORD = '".md5($this->USUARIO_PASSWORD)."',USUARIO_FECH_NAC ='".$this->USUARIO_FECH_NAC."',USUARIO_EMAIL= '".$this->USUARIO_EMAIL."',USUARIO_NOMBRE= '".$this->USUARIO_NOMBRE."',USUARIO_APELLIDO = '".$this->USUARIO_APELLIDO."',USUARIO_DNI= '".$this->USUARIO_DNI."',USUARIO_TELEFONO= '".$this->USUARIO_TELEFONO."',USUARIO_CUENTA= '".$this->USUARIO_CUENTA."',USUARIO_DIRECCION= '".$this->USUARIO_DIRECCION."',USUARIO_COMENTARIOS= '".$this->USUARIO_COMENTARIOS."',USUARIO_ESTADO= '".$this->USUARIO_ESTADO."'";
// 	 if($this->USUARIO_FOTO!=''){
// 	 	$sql.=", USUARIO_FOTO='".$this->USUARIO_FOTO."'";
// 	 }
// 		if($this->USUARIO_TIPO!=''){
// 			$sql1="DELETE FROM USUARIO_PAGINA WHERE USUARIO_USER='".$this->USUARIO_USER."'";
// 			$this->mysqli->query($sql1);
// 			//Cogemos las páginas que le corresponden por pertenecer a un determinado rol
// 			$sql2 = "SELECT DISTINCT PAGINA.PAGINA_ID FROM  ROL_FUNCIONALIDAD, FUNCIONALIDAD_PAGINA, PAGINA  WHERE ROL_FUNCIONALIDAD.ROL_ID='".consultarRol($this->USUARIO_TIPO)."' AND ROL_FUNCIONALIDAD.FUNCIONALIDAD_ID=FUNCIONALIDAD_PAGINA.FUNCIONALIDAD_ID AND PAGINA.PAGINA_ID=FUNCIONALIDAD_PAGINA.PAGINA_ID";

// 			if (!($resultado = $this->mysqli->query($sql2))) {
// 				echo 'Error en la consulta sobre la base de datos';
// 			} else {
// 				while ($tupla=$resultado->fetch_array()){
// 					//Insertamos esas páginas en la tabla USUARIO_PÁGINA de la que se van a recoger las acciones permitidas
// 					$sql3="INSERT INTO USUARIO_PAGINA (USUARIO_USER, PAGINA_ID) VALUES('".$this->USUARIO_USER."',".$tupla['PAGINA_ID'].")";

// 					$this->mysqli->query($sql3);
// 				}

// 			}

// 			$sql.=", USUARIO_TIPO='".$this->USUARIO_TIPO."'";
// 		}

// 		$sql.=" WHERE USUARIO_USER='".$this->USUARIO_USER."'";





// 		if (!($resultado = $this->mysqli->query($sql))){
// 		return "Se ha producido un error en la modificación del usuario"; // sustituir por un try
// 	}
// 	else{
// 		$sql= "DELETE FROM USUARIO_PAGINA WHERE USUARIO_USER='".$this->USUARIO_USER."'";

// 		$this->mysqli->query($sql);

// 		$sql = "SELECT DISTINCT PAGINA.PAGINA_ID FROM USUARIO, ROL_FUNCIONALIDAD, FUNCIONALIDAD_PAGINA, PAGINA  WHERE USUARIO.USUARIO_TIPO=ROL_FUNCIONALIDAD.ROL_ID AND ROL_FUNCIONALIDAD.FUNCIONALIDAD_ID=FUNCIONALIDAD_PAGINA.FUNCIONALIDAD_ID AND PAGINA.PAGINA_ID=FUNCIONALIDAD_PAGINA.PAGINA_ID AND USUARIO_USER='" . $this->USUARIO_USER."'";

// 		if (!($resultado = $this->mysqli->query($sql))) {
// 			echo 'Error en la consulta sobre la base de datos';
// 		} else {
// 			while ($tupla=$resultado->fetch_array()){

// 				$sql="INSERT INTO USUARIO_PAGINA (USUARIO_USER, PAGINA_ID) VALUES('".$this->USUARIO_USER."',".$tupla['PAGINA_ID'].")";

// 				$this->mysqli->query($sql);
// 			}

// 		}

// 		return "El usuario se ha modificado con éxito";
// 	}
//     }
//     else
//     return "El usuario no existe";
// }
// //Nos permite modificar las acciones que puede realizar un determinado usuario
// 	function ModificarPaginas($pags){
// 		$this->ConectarBD();
// 		$sql="DELETE FROM USUARIO_PAGINA WHERE USUARIO_USER='".$this->USUARIO_USER."'";
// 		$this->mysqli->query($sql);
// 		for ($i=0;$i<count($pags);$i++){
// 			$sql="INSERT INTO  USUARIO_PAGINA(USUARIO_USER,PAGINA_ID) VALUES ('".$this->USUARIO_USER."', ".ConsultarIDPagina($pags[$i]).")";

// 			$this->mysqli->query($sql);
// 		}
// 	}
// 	//Comprueba que el usuario pueda loguearse
// 	function Login(){

// 		$this->ConectarBD();
// 		$sql = "select * from USUARIO where USUARIO_USER = '".$this->USUARIO_USER."'";
// 		$result = $this->mysqli->query($sql);
// 		if ($result->num_rows == 1 ){
// 			$tupla = $result->fetch_array();
// 			if ($tupla['USUARIO_PASSWORD'] == md5($this->USUARIO_PASSWORD)){
// 				return true;
// 			}
// 			else{
// 				return 'La contraseña para este usuario es errónea';
// 			}
// 		}
// 		else{
// 			return "El usuario no existe";
// 		}

// 	}
// //Nos devuelve las páginas a las que tiene acceso el usuario
// 	function ConsultarPaginas()
// 	{
// 		$this->ConectarBD();

// 		$sql = "select PAGINA_ID from USUARIO_PAGINA WHERE USUARIO_USER='".$this->USUARIO_USER."'";

// 		if (!($resultado = $this->mysqli->query($sql))){
// 			return 'Error en la consulta sobre la base de datos';
// 		}
// 		else{


// 			$toret=array();
// 			$i=0;

// 			while ($fila= $resultado->fetch_array()) {


// 				$toret[$i]=ConsultarNOMPagina($fila['PAGINA_ID']);
// 				$i++;

// 			}


// 			return $toret;

// 		}
// 	}




 }













?>
