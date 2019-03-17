<?php

require_once(__DIR__."..\..\core\ViewManager.php");
include '../core/ACL.php';
include '../view/USER_SHOWALL_View.php';
include '../view/USER_ADD_View.php';
include '../view/MESSAGE_View.php';

if(!isset($_SESSION['LANGUAGE'])){
	include '../locate/Strings_Castellano.php';
}else {
	include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';
}

$function = "USER";
$view = new ViewManager();

function get_data_form() {

    // $idBuilding = $_POST['idBuilding'];
    // $nameBuilding = $_POST['nameBuilding'];
    // $addressBuilding = $_POST['addressBuilding'];
    // $phoneBuilding = $_POST['phoneBuilding'];
   
    // $building = new BUILDING_Model($idBuilding, $nameBuilding, $addressBuilding, $phoneBuilding);
    // return $building;
}


if (!isset($_GET['action'])){
	$_GET['action'] = '';
}
Switch ($_GET['action']){

	case "logout":
		session_destroy();
		header('Location:../index.php');
	break;	

	case "login":

		if(!isset($_POST['submit'])){
			require_once '../view/USER_LOGIN_View.php';
			$login = new Login();
		}else{
			if(isset($_POST['username']) && isset($_POST['passwd'])){
				$user = new USER_Model($_POST['username'], $_POST['passwd'],'','','','','','','');
				$answer = $user->login();
				if ($answer == 'true'){
					$_SESSION['LOGIN'] = $_POST['username'];
					$_SESSION['PERMISSIONS'] = $user->getPermissions();
					$_SESSION['LANGUAGE'] = $_POST['language'];
					header('Location:../index.php');
				}else{
					//MODIFICAR POR POP
					new MESSAGE($answer, '../controller/USER_Controller.php');
				}
			}
		}

	break;

	case  $strings['Add']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add users requires login."]);
            $view->redirect("USER_Controller.php", "");
        }

        if(!checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("USER_Controller.php", "");
        }

        if (isset($_POST["submit"])) { 
            $userAdd = get_data_form();

            try{
                $userAdd->checkIsValidForAdd_Update(); 
                $userAdd->addUser();
                $flashMessageSuccess = sprintf($strings["User \"%s\" successfully added."], $userAdd->getNameUser());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("USER_Controller.php", "index");

            }catch(Exception $errors) {
                $view->setFlashDanger($strings[$errors->getMessage()]);
                $view->redirect("USER_Controller.php", "add");
            }
                
        } else {
            new USER_ADD();
        }
           	       
    break;

	default:

        if(!checkRol('SHOWALL', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php", "");
		} else {
			$user = new USER_Model();
			$users = $user->showAllUsers();
			new USER_SHOWALL($users);
		}
            
    break;
						
}



?>
