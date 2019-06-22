<?php

require_once("../core/ViewManager.php");
require_once("../model/USER_Model.php");
require_once("../view/LOGIN_View.php");

$view = new ViewManager();

include '../view/locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';


if (!isset($_GET['action'])){
	$_GET['action'] = '';
}
Switch ($_GET['action']){

	case 'Login':
		if(!isset($_POST['submit'])){
			new Login();
		}else{
			if(isset($_POST['email']) && isset($_POST['passwd'])){
                $user = new USER_Model($_POST['email'], $_POST['passwd']);
                $loginAnswer = $user->login();
				if($loginAnswer === true){
                    //Set the variables of sessions 
                    $view->setVariableSession('LOGIN', $user->getEmail());
                    $view->setVariableSession('PERMISSIONS', $user->getPermissions());
                    $view->setVariableSession('PHOTO', $user->getLinkProfilePhoto($user->getEmail()));
                    $view->setVariableSession('LANGUAGE', $_POST['language']);
                    $view->redirect("BUILDING_Controller.php");
                } else {
                    $view->setFlashDanger($loginAnswer);
                    $view->redirect("LOGIN_Controller.php", $strings['Login']);
                }
			}
		}
	break;

    case 'Logout':
        session_destroy();
        $view->redirect("../index.php");
    break;	

    default:
    break;
						
}

?>
