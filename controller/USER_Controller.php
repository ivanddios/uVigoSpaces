<?php


/**
* File: USER_Controller
*
* Script that controller to add new user, edit user, delete user, show user
* show all user and edit profile of a user in session
*
* @author ivanddios <ivanddios1994@gmail.com>
*/


require_once("../core/ViewManager.php");
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

/**
* Gets values from the forms
*
* @return User with the form values
*/
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

/**
* Gets values from the search's forms
*
* @return User with the form values
*/
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


/**
 * Evaluates the 'action' parameter passed for URL
 * For each action, the controller checks if the user is logged and if the user has the permissions necessary.
 * 
 * The controller calls a view (with floor data or no, depending the action).
 * 
 * The controller gets the forms' data of the views and call the User model to make the actions against the database.
 */
Switch ($_GET['action']){

	case 'Add':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add users requires login."]);
            $view->redirect("INDEX_Controller.php");
        }

        //@if Checks if the user can add a new users
        if(!$view->checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("USER_Controller.php");
        }


       /**
        * @if Checks if exists $_POST gets the form's data, instances a new object User, 
        * checks if the data are valids and adds the space to database
        */
        if (isset($_POST["submit"])) { 
            $userAdd = get_data_form();
            $answerAdd = $userAdd->addUser();
            /**
            * @if The controller notices the user if the operation was successfully
            * 
            * @else Returns the error message
            */
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

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit user requires login."]);
            $view->redirect("BUILDING_Controller.php");
        }

        //@if Checks if the user can edit a new users
		if(!$view->checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("USER_Controller.php");
        }

        $email = $_GET['user'];

        /**
        * @if Checks if exists $_POST gets the form's data, instances a new object User, 
        * checks if the data are valids and modifies the user in database.
        *
        * @else Otherwise, checks if exists anything user with the email passed by GET
        * gets the users values and shows it in USER_EDIT_View.
        */
        if (isset($_POST["submit"])) { 
            $userEdit = get_data_form();
            $answerEdit = $userEdit->updateUser($email);
            /**
            * @if The controller notices the user if the operation was successfully
            * 
            * @else Returns the error message
            */
            if($answerEdit === true){
                $_SESSION['LOGIN'] = $userEdit->getEmail();
                $_SESSION['PHOTO'] = $userEdit->getLinkProfilePhoto($userEdit->getEmail());
                $flashMessageSuccess = sprintf($strings["User \"%s\" successfully updated."], $userEdit->getEmail());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("USER_Controller.php");
            }else{
                $view->setFlashDanger($strings[$answerEdit]);
                $view->redirect("USER_Controller.php", 'Edit',"user=$email");
            }
        } else{
            $user = new USER_Model($email);
            if($user->existsUser()){
                $userValues = $user->getUser();
                $group = new GROUP_Model();
                $groupsValues = $group->getAllGroups();
                new USER_EDIT($userValues, $groupsValues);
            }else{
                $view->setFlashDanger($strings["There isn't a user with that email"]);
                $view->redirect("USER_Controller.php");
            }
        }
    break;



    case 'EditProfile':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit user requires login."]);
            $view->redirect("BUILDING_Controller.php");
        }

        //@if Checks if the user is authenticated is the same that requires modifies his profile
        if($_SESSION['LOGIN'] !== $_GET['user']){
            $view->setFlashDanger($strings["You can't modify the data of another user"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $email = $_GET['user'];

        /**
        * @if Checks if exists $_POST gets the form's data, instances a new object User, 
        * checks if the data are valids and modifies the user values in database.
        *
        * @else Otherwise, checks if exists anything user with the email passed by GET
        * gets the user values and shows it in USER_EDIT_View.
        */
        if (isset($_POST["submit"])) { 
            $userEdit = get_data_form();
            $answerEdit = $userEdit->updateUserProfile();
            if($answerEdit === true){
                $_SESSION['PHOTO'] = $userEdit->getLinkProfilePhoto($userEdit->getEmail());
                $flashMessageSuccess = sprintf($strings["User \"%s\" successfully updated."], $userEdit->getEmail());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("USER_Controller.php");
            }else{
                $view->setFlashDanger($strings[$answerEdit]);
                $view->redirect("USER_Controller.php", 'EditProfile',"user=$email");
            }
        } else{
            $user = new USER_Model($email);
            if($user->existsUser()){
                $userValues = $user->getUser();
                $group = new GROUP_Model();
                $groupsValues = $group->getAllGroups();
                new USER_EDIT_PROFILE($userValues, $groupsValues);
            }else{
                $view->setFlashDanger($strings["There isn't a user with that email"]);
                $view->redirect("USER_Controller.php");
            }
        }
    break;


    case  'Delete':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete users requires login."]);
            $view->redirect("BUILDING_Controller.php");
        }

         //@if Checks if the user can delete users
        if(!$view->checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("USER_Controller.php");
        }

        $userDelete = new USER_Model($_POST['email']);
        $answerDelete =  $userDelete->deleteUser();
        if($answerDelete === true){
            if($_SESSION['LOGIN'] == $userDelete->getEmail()){
                $flashMessageSuccess = sprintf($strings["Your user had been deleted."], $userDelete->getEmail());
                $view->setFlashSuccess($flashMessageSuccess);
                session_destroy();
                $view->redirect("INDEX_Controller.php");
            }else{
                $flashMessageSuccess = sprintf($strings["User \"%s\" successfully deleted."], $userDelete->getEmail());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("USER_Controller.php");
            }
        }else{
            $view->setFlashDanger($strings[$answerDelete]);
            $view->redirect("USER_Controller.php");
        }
            	
    break;


    case  'Show':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Show floors requires login."]);
            $view->redirect("BUILDING_Controller.php");
        }

         //@if Checks if the user can see a user
        if(!$view->checkRol('SHOW', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("USER_Controller.php");
        }

         //@if Checks if exists a parameter user
        if (!isset($_GET['user'])){
            $view->setFlashDanger($strings["Email is mandatory"]);
            $view->redirect("USER_Controller.php");
        }

        $email = $_GET['user'];
         /**
        * @if Checks if exists anything user with the email passed by GET
        * gets the user values and shows it in USER_SHOW_View.
        */
        $user = new USER_Model($email);
        if($user->existsUser()){
            $values = $user->getUser();
            new USER_SHOW($values);
        }else{
            $view->setFlashDanger($strings["There isn't a user with that email"]);
            $view->redirect("USER_Controller.php");
        }
    break;


    case 'Search':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Search users requires login."]);
            $view->redirect("BUILDING_Controller.php");
        }

        //@if Checks if the user can search users
        if(!$view->checkRol('SEARCH', $function)){
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
    
        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Search users requires login."]);
            $view->redirect("BUILDING_Controller.php");
        }

        //@if Checks if the user can see all system's users
        if(!$view->checkRol('SHOW ALL', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php");
        }

        //Gets all users and shows in USER_SHOWALL
		$user = new USER_Model();
		$users = $user->getAllUsers();
		new USER_SHOWALL($users);
        
    break;
						
}

?>
