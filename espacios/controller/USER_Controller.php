<?php

include '../model/USER_Model.php';
include '../view/MESSAGE_View.php';

if(!isset($_SESSION['LANGUAGE'])){
	include '../locate/Strings_Castellano.php';
}else {
	include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';
}

if(!isset($_SESSION)){
    session_start();
}


if (!isset($POST['action'])){
	$POST['action'] = '';
}
	Switch ($POST['action']){

		case "logout":
			session_destroy();
			header('Location:../index.php');
		break;	

		default:
		if(!isset($_POST['submit'])){
			require_once '../view/USER_LOGIN_View.php';
			$login = new Login();
		}else{
				if(isset($_POST['username']) && isset($_POST['passwd'])){
				$user = new USER_Model($_POST['username'], $_POST['passwd'],'','','','','','','');
				$answer = $user->login();
				if ($answer == 'true'){
					$_SESSION['LOGIN'] = $_POST['username'];
					$_SESSION['PERMISSIONS'] = $user->getPermisos();
					$_SESSION['LANGUAGE'] = $_POST['language'];
					header('Location:../index.php');
				}else{
					//MODIFICAR POR POP
					new MESSAGE($answer, '../controller/USER_Controller.php');
					}
				}
			}
		break;
						
}



?>
