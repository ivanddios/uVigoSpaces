<?php

require_once(__DIR__."..\..\core\ViewManager.php");
require_once(__DIR__.'..\..\core\ACL.php');
require_once(__DIR__.'..\..\model\USER_Model.php');
require_once(__DIR__.'..\..\view\USER_SHOWALL_View.php');
require_once(__DIR__.'..\..\view\USER_ADD_View.php');
require_once(__DIR__.'..\..\view\USER_EDIT_View.php');
require_once(__DIR__.'..\..\view\USER_SHOW_View.php');

$view = new ViewManager();
$function = "USER";

include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';

function get_data_form() {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $dni = $_POST['dni'];
    $birthdate = $_POST['birthdate'];
    $phone = $_POST['phone'];
    $photo = $_FILES['photo'];
    $group = $_POST['group'];

    $user = new USER_Model($email, $password, $name, $surname, $dni, $birthdate, $phone, $photo, $group);
    return $user;
}


if (!isset($_GET['action'])){
	$_GET['action'] = '';
}
Switch ($_GET['action']){

	case $strings['Add']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add users requires login."]);
            $view->redirect("BUILDING_Controller.php");
        }

        if(!checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("USER_Controller.php");
        }

        if (isset($_POST["submit"])) { 
            $userAdd = get_data_form();
            $answerAdd = $userAdd->addUser();
            if($answerAdd === true){
                $flashMessageSuccess = sprintf($strings["User \"%s\" successfully added."], $userAdd->getEmail());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("USER_Controller.php");
            }else{
                $view->setFlashDanger($strings[$answerAdd]);
                $view->redirect("USER_Controller.php", $strings['Add']);
            }
        }else {
            $group = new GROUP_Model();
            $groupsValues = $group->getAllGroups();
            new USER_ADD($groupsValues);
        }
           	       
    break;

    case $strings['Edit']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit user requires login."]);
            $view->redirect("BUILDING_Controller.php");
        }

		if(!checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("USER_Controller.php");
        }

        $email = $_GET['user'];

        if (isset($_POST["submit"])) { 
            $userEdit = get_data_form();
            $answerEdit = $userEdit->updateUser($_FILES['photo']['tmp_name']);
            var_dump($answerEdit);
            exit();
            if($answerEdit === true){
                $flashMessageSuccess = sprintf($strings["User \"%s\" successfully updated."], $userEdit->getEmail());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("USER_Controller.php");
            }else{
                $view->setFlashDanger($strings[$answerEdit]);
                $view->redirect("USER_Controller.php", $strings['Edit'],"user=$email");
            }
        } else{
            $user = new USER_Model($email);
            $userValues = $user->getUser();
            $group = new GROUP_Model();
            $groupsValues = $group->getAllGroups();
            new USER_EDIT($userValues, $groupsValues);
        }
    break;

    case  $strings['Delete']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete users requires login."]);
            $view->redirect("BUILDING_Controller.php");
        }

        if(!checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("USER_Controller.php");
        }

        // if (!isset($_POST['email'])){
        //     $view->setFlashDanger($strings["Email is mandatory"]);
        //     $view->redirect("USER_Controller.php");
        // }
        $userDelete = new USER_Model($_POST['email']);
        $answerDelete =  $userDelete->deleteUser();
        if($answerDelete === true){
            $flashMessageSuccess = sprintf($strings["User \"%s\" successfully deleted."], $userDelete->getEmail());
            $view->setFlashSuccess($flashMessageSuccess);
            $view->redirect("USER_Controller.php");     
        }else{
            $view->setFlashDanger($strings[$answerDelete]);
            $view->redirect("USER_Controller.php");
        }
            	
    break;


    case  $strings['Show']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Show floors requires login."]);
            $view->redirect("BUILDING_Controller.php");
        }

        if(!checkRol('SHOW', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("USER_Controller.php");
        }

        if (!isset($_GET['user'])){
            $view->setFlashDanger($strings["Email is mandatory"]);
            $view->redirect("USER_Controller.php");
        }
        $email = $_GET['user'];

        $user = new USER_Model($email);
        $values = $user->getUser();
        new USER_SHOW($values);

    break;
	

    default:
    
        if(!checkRol('SHOW ALL', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php");
		}else{
			$user = new USER_Model();
			$users = $user->getAllUsers();
			new USER_SHOWALL($users);
        }
        
    break;
						
}



?>
