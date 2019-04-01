<?php

require_once(__DIR__."..\..\core\ViewManager.php");
require_once(__DIR__.'..\..\core\ACL.php');
require_once(__DIR__.'..\..\model\USER_Model.php');
require_once(__DIR__.'..\..\view\USER_LOGIN_View.php');
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
    $photo = $_FILES['photo'];

    $user = new USER_Model($username, $password, $name, $surname, $dni, $birthdate, $email, $phone, $photo);
    return $user;
}


if (!isset($_GET['action'])){
	$_GET['action'] = '';
}
Switch ($_GET['action']){

	case $strings['Login']:

		if(!isset($_POST['submit'])){
			new Login();
		}else{
			if(isset($_POST['username']) && isset($_POST['passwd'])){
                $user = new USER_Model($_POST['username'], $_POST['passwd']);
                try {
				    $user->login();
					$_SESSION['LOGIN'] = $user->getUsername();
					$_SESSION['PERMISSIONS'] = $user->getPermissions();
					$_SESSION['LANGUAGE'] = $_POST['language'];
					header('Location:../index.php');
				}catch(Exception $errors){
                    $view->setFlashDanger($errors->getMessage());
                    $view->redirect("USER_Controller.php", $strings['Login']);
				}
			}
		}

	break;

	case $strings['Add']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add users requires login."]);
            $view->redirect("BUILDING_Controller.php", "index");
        }

        if(!checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("USER_Controller.php", "index");
        }

        if (isset($_POST["submit"])) { 
            $userAdd = get_data_form();

            try{
                $userAdd->checkIsValidForAdd();
                $userAdd->addUser();
                $flashMessageSuccess = sprintf($strings["User \"%s\" successfully added."], $userAdd->getUsername());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("USER_Controller.php", "index");
            }catch(Exception $errors) {
                $view->setFlashDanger($strings[$errors->getMessage()]);
                $valuesForm = json_encode($userAdd);
                $view->setVariable("userForm", $valuesForm);
                $view->redirect("USER_Controller.php", $strings['Add']);
            }
                
        } else {
            new USER_ADD();
        }
           	       
    break;

    case $strings['Edit']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit user requires login."]);
            $view->redirect("BUILDING_Controller.php", "index");
        }

		if(!checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("USER_Controller.php", "index");
        }

        $username = $_GET['user'];

        if (isset($_POST["submit"])) { 
            $userEdit = get_data_form();
    
            try{
                $userEdit->checkIsValidForEdit(); 
                $userEdit->updateUser($_FILES['photo']['tmp_name']);
                $flashMessageSuccess = sprintf($strings["User \"%s\" successfully updated."], $userEdit->getUsername());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("USER_Controller.php", "index");
            }catch(Exception $errors) {
                $view->setFlashDanger($strings[$errors->getMessage()]);
                $view->redirect("USER_Controller.php", $strings['Edit'],"user=$username");
            }
        } else {
            $user = new USER_Model($username);
            $values = $user->findUser();
            new USER_EDIT($values);
        }
    break;

    case  $strings['Delete']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete users requires login."]);
            $view->redirect("BUILDING_Controller.php", "index");
        }

        if(!checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("USER_Controller.php", "index");
        }

        if (!isset($_POST['username'])){
            $view->setFlashDanger($strings["Username is mandatory"]);
            $view->redirect("USER_Controller.php", "index");
        }
        $username = $_POST['username'];
        $userDelete = new USER_Model($username);

        if (!$userDelete->findUser()) {
            $view->setFlashDanger($strings["No such user with this id"]);
            $view->redirect("USER_Controller.php", "index");
        }

        try{
            rmdir('../document/Users/'.$username);
            $userDelete->deleteUser();
            $flashMessageSuccess = sprintf($strings["User \"%s\" successfully deleted."], $username);
            $view->setFlashSuccess($flashMessageSuccess);
            $view->redirect("USER_Controller.php", "index");     
        }catch(Exception $errors) {
            $view->setFlashDanger($strings[$errors->getMessage()]);
            $view->redirect("USER_Controller.php", "index");
        }
            	
    break;


    case  $strings['Show']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Show floors requires login."]);
            $view->redirect("BUILDING_Controller.php", "index");
        }

        if(!checkRol('SHOW', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("USER_Controller.php", "index");
        }

        if (!isset($_GET['user'])){
            $view->setFlashDanger($strings["Username is mandatory"]);
            $view->redirect("USER_Controller.php", "index");
        }
        $username = $_GET['user'];

        $user = new USER_Model($username);
        $values = $user->findUser();
        new USER_SHOW($values);

    break;


    case $strings['Logout']:

        session_destroy();
        $view->redirect("../index.php", "index");

    break;	

    default:
    
        if(!checkRol('SHOW ALL', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php", "index");
		} else {
			$user = new USER_Model();
			$users = $user->showAllUsers();
			new USER_SHOWALL($users);
        }
        
    break;
						
}



?>
