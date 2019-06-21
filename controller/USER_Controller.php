<?php

require_once("../core/ViewManager.php");
require_once("../core/ACL.php");
require_once("../model/USER_Model.php");
require_once("../view/USER_SHOWALL_View.php");
require_once("../view/USER_ADD_View.php");
require_once("../view/USER_EDIT_View.php");
require_once("../view/USER_EDIT_PROFILE_View.php");
require_once("../view/USER_SHOW_View.php");
require_once("../view/USER_SEARCH_View.php");

$view = new ViewManager();
$function = "USER";

include '../view/locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';

function get_data_form() {

    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $surname = $_POST['surname'];
    $dni = $_POST['dni'];
    $birthdate = $_POST['birthdate'];
    $phone = $_POST['phone'];
    $photo = $_FILES['photo'];
    $group = $_POST['group'];

    $user = new USER_Model($email, $password, $name, $surname, $dni, $birthdate, $phone, $photo, $group);
    return $user;
}

function get_data_form_search() {

    $email = $_POST['email'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $dni = $_POST['dni'];
    $birthdate = $_POST['birthdate'];
    $phone = $_POST['phone'];
    $group = $_POST['group'];

    $user = new USER_Model($email, '', $name, $surname, $dni, $birthdate, $phone, '', $group);
    return $user;
}


if (!isset($_GET['action'])){
	$_GET['action'] = '';
}

Switch ($_GET['action']){

	case 'Add':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add users requires login."]);
            $view->redirect("INDEX_Controller.php");
        }

        if(!checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
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
                $view->redirect("USER_Controller.php", 'Add');
            }
        }else {
            $group = new GROUP_Model();
            $groupsValues = $group->getAllGroups();
            new USER_ADD($groupsValues);
        }
           	       
    break;

    case 'Edit':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit user requires login."]);
            $view->redirect("BUILDING_Controller.php");
        }

		if(!checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("USER_Controller.php");
        }

        $email = $_GET['user'];

        if (isset($_POST["submit"])) { 
            $userEdit = get_data_form();
            $answerEdit = $userEdit->updateUser($_FILES['photo']['tmp_name']);
            if($answerEdit === true){
                $flashMessageSuccess = sprintf($strings["User \"%s\" successfully updated."], $userEdit->getEmail());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("USER_Controller.php");
            }else{
                $view->setFlashDanger($strings[$answerEdit]);
                $view->redirect("USER_Controller.php", 'Edit',"user=$email");
            }
        } else{
            $user = new USER_Model($email);
            $userValues = $user->getUser();
            $group = new GROUP_Model();
            $groupsValues = $group->getAllGroups();
            new USER_EDIT($userValues, $groupsValues);
        }
    break;



    case 'EditProfile':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit user requires login."]);
            $view->redirect("BUILDING_Controller.php");
        }

        if($_SESSION['LOGIN'] !== $_GET['user']){
            $view->setFlashDanger($strings["You can't modify the data of another user"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $email = $_GET['user'];

        if (isset($_POST["submit"])) { 
            $userEdit = get_data_form();
            $answerEdit = $userEdit->updateUserProfile($_FILES['photo']['tmp_name']);
            if($answerEdit === true){
                $flashMessageSuccess = sprintf($strings["User \"%s\" successfully updated."], $userEdit->getEmail());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("USER_Controller.php");
            }else{
                $view->setFlashDanger($strings[$answerEdit]);
                $view->redirect("USER_Controller.php", 'EditProfile',"user=$email");
            }
        } else{
            $user = new USER_Model($email);
            $userValues = $user->getUser();
            $group = new GROUP_Model();
            $groupsValues = $group->getAllGroups();
            new USER_EDIT_PROFILE($userValues, $groupsValues);
        }
    break;


    case  'Delete':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete users requires login."]);
            $view->redirect("BUILDING_Controller.php");
        }

        if(!checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("USER_Controller.php");
        }

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


    case  'Show':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Show floors requires login."]);
            $view->redirect("BUILDING_Controller.php");
        }

        if(!checkRol('SHOW', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
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


    case 'Search':


        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Search users requires login."]);
            $view->redirect("BUILDING_Controller.php");
        }

        if(!checkRol('SEARCH', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("USER_Controller.php");
        }

        if (isset($_POST["submit"])) { 
            $user = get_data_form_search();
            $answerSearch = $user->searchUser();
            new USER_SHOWALL($answerSearch);
        }else {
            $group = new GROUP_Model();
            $groupsValues = $group->getAllGroups();
            new USER_SEARCH($groupsValues);
        }
           	       
    break;
	

    default:
    
        if(!checkRol('SHOW ALL', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php");
		}else{
			$user = new USER_Model();
			$users = $user->getAllUsers();
			new USER_SHOWALL($users);
        }
        
    break;
						
}

?>
