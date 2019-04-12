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

    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $dni = $_POST['dni'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $group = $_POST['group'];
    $photo = $_FILES['photo'];

    $user = new USER_Model($username, $password, $name, $surname, $dni, $birthdate, $email, $phone, $photo, $group);
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
                $flashMessageSuccess = sprintf($strings["User \"%s\" successfully added."], $userAdd->getUsername());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("USER_Controller.php");
            }else {
                $view->setFlashDanger($strings[$answerAdd]);
                $view->redirect("USER_Controller.php", $strings['Add']);
            }
        }else {
            $group = new GROUP_Model();
            $groupsValues = $group->showAllGroups();
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

        $username = $_GET['user'];

        if (isset($_POST["submit"])) { 
            $userEdit = get_data_form();
            $answerEdit = $userEdit->updateUser($_FILES['photo']['tmp_name']);
            if($answerEdit === true){
                $flashMessageSuccess = sprintf($strings["User \"%s\" successfully updated."], $userEdit->getUsername());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("USER_Controller.php");
            }else{
                $view->setFlashDanger($strings[$answerEdit]);
                $view->redirect("USER_Controller.php", $strings['Edit'],"user=$username");
            }
        } else {
            $user = new USER_Model($username);
            $userValues = $user->findUserWithGroup();
            $group = new GROUP_Model();
            $groupsValues = $group->showAllGroups();
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

        if (!isset($_POST['username'])){
            $view->setFlashDanger($strings["Username is mandatory"]);
            $view->redirect("USER_Controller.php");
        }
        $userDelete = new USER_Model($_POST['username']);
        $answerDelete =  $userDelete->deleteUser();
        if($answerDelete === true){
            $flashMessageSuccess = sprintf($strings["User \"%s\" successfully deleted."], $userDelete->getUsername());
            $view->setFlashSuccess($flashMessageSuccess);
            $view->redirect("USER_Controller.php");     
        }else {
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
            $view->setFlashDanger($strings["Username is mandatory"]);
            $view->redirect("USER_Controller.php");
        }
        $username = $_GET['user'];

        $user = new USER_Model($username);
        $values = $user->findUser();
        new USER_SHOW($values);

    break;
	

    default:
    
        if(!checkRol('SHOW ALL', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php");
		} else {
			$user = new USER_Model();
			$users = $user->showAllUsers();
			new USER_SHOWALL($users);
        }
        
    break;
						
}



?>
