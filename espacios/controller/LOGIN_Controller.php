<?php

require_once(__DIR__."..\..\core\ViewManager.php");
require_once(__DIR__.'..\..\core\ACL.php');
require_once(__DIR__.'..\..\model\USER_Model.php');
require_once(__DIR__.'..\..\view\LOGIN_View.php');

$view = new ViewManager();

include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';


if (!isset($_GET['action'])){
	$_GET['action'] = '';
}
Switch ($_GET['action']){

	case $strings['Login']:

		if(!isset($_POST['submit'])){
			new Login();
		}else{
			if(isset($_POST['email']) && isset($_POST['passwd'])){
                $user = new USER_Model($_POST['email'], $_POST['passwd']);
                $loginAnswer = $user->login();
				if($loginAnswer === true){
                    $_SESSION['LOGIN'] = $user->getEmail();
                    $_SESSION['PERMISSIONS'] = $user->getPermissions();
                    $_SESSION['LANGUAGE'] = $_POST['language'];
                    $view->redirect("BUILDING_Controller.php");
                } else {
                    $view->setFlashDanger($loginAnswer);
                    $view->redirect("LOGIN_Controller.php", $strings['Login']);
                }
			}
		}
	break;

    case $strings['Logout']:
        session_destroy();
        $view->redirect("../index.php");
    break;	

    default:
        
    break;
						
}



?>
