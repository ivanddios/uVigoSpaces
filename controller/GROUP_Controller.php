<?php

/**
* File: GROUP_Controller
*
* Script that controller to add new group, edit group, delete group, show group
* and show all group
*
* @author ivanddios <ivanddios1994@gmail.com>
*/

require_once("../core/ViewManager.php");
require_once("../model/FUNCTIONALITY_Model.php");
require_once("../model/ACTION_Model.php");
require_once("../model/USER_Model.php");
require_once("../model/GROUP_Model.php");
require_once("../view/GROUP_SHOWALL_View.php");
require_once("../view/GROUP_ADD_View.php");
require_once("../view/GROUP_EDIT_View.php");
require_once("../view/GROUP_SHOW_View.php");
require_once("../view/USER_SHOWALL_View.php");

$function = "GROUP";
$view = new ViewManager();

include '../view/locate/Strings_'.$_SESSION['LANGUAGE'].'.php';


/**
* Gets values from the forms
*
* @return Group with the form values
*/
function get_data_form() {

    $idGroup = $_GET['group'];
    $nameGroup = $_POST['nameGroup'];
    $descripGroup = $_POST['descripGroup'];
   
    $group = new GROUP_Model($idGroup, $nameGroup, $descripGroup);
    return $group;
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
 * The controller gets the forms' data of the views and call the Group model to make the actions against the database.
 */
Switch ($_GET['action']){

    case 'Add':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add groups requires login."]);
            $view->redirect("USER_Controller.php");
        }

         //@if Checks if the user can add a new goup
        if(!$view->checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("GROUP_Controller.php");
        }

        /**
        * @if Checks if exists $_POST gets the form's data, instances a new object Group, 
        * checks if the data are valids and adds the group to database
        */
        if (isset($_POST["submit"])) {
            $groupAdd = get_data_form();
            $permissions = $groupAdd->convertArray($_POST["actions"]);
            $addAnswer = $groupAdd->addGroup($permissions);
            /**
            * @if The controller notices the user if the operation was successfully
            * 
            * @else Returns the error message
            */
            if($addAnswer === true){
                $flashMessageSuccess = sprintf($strings["Group \"%s\" successfully added."], $groupAdd->getNameGroup());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("GROUP_Controller.php");
            }else{
                $view->setFlashDanger($strings[$addAnswer]);
                $view->redirect("GROUP_Controller.php", 'Add');
            }
        }else{
            $function = new FUNCTIONALITY_Model();
            $functions = $function->getAllFunctions();
            $action = new ACTION_Model();
            $actions = $action->getAllActionsForFunction();
            new GROUP_ADD($functions, $actions);
        }
           	       
    break;


    case 'Edit':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit groups requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if the user can edit a group
        if(!$view->checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("GROUP_Controller.php");
        }

        //@if Checks if exists the group parameter passed by GET
        if (!isset($_GET['group'])){
            $view->setFlashDanger($strings["Group id is mandatory"]);
            $view->redirect("GROUP_Controller.php");
        }
        $groupId = $_GET['group'];

        /**
        * @if Checks if exists $_POST gets the form's data, instances a new object Group, 
        * checks if the data are valids and modifies the group in database.
        *
        * @else Otherwise, checks if exists anything group with the identifier passed by GET
        * gets the groups values and shows it in GROUP_EDIT_View.
        */
        if (isset($_POST["submit"])) { 
            $groupEdit = get_data_form();
            $permissions = $groupEdit->convertArray($_POST["actions"]);
            $updateAnswer = $groupEdit->updateGroup($permissions);
            /**
            * @if The controller notices the user if the operation was successfully
            * 
            * @else Returns the error message
            */
            if($updateAnswer === true){
                $flashMessageSuccess = sprintf($strings["Group \"%s\" successfully updated."], $groupEdit->getNameGroup());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("GROUP_Controller.php");   
            }else{
                $view->setFlashDanger($strings[$updateAnswer]);
                $view->redirect("GROUP_Controller.php", 'Edit', 'group='.$groupId);
            }
        } else {
            $group = new GROUP_Model($groupId);
            /**
            * @if Check if existis the group and shows its values
            * 
            * @else Returns the error message
            */
            if($group->existsGroup()){
                $groupValues = $group->getGroup();
                $permissions = $group->getPermissionForGroup();
                $function = new FUNCTIONALITY_Model();
                $functions = $function->getAllFunctions();
                $action = new ACTION_Model();
                $actions = $action->getAllActionsForFunction();
                new GROUP_EDIT($groupValues, $functions, $actions, $permissions);
            }else{
                $view->setFlashDanger($strings["Group doesn't exist"]);
                $view->redirect("GROUP_Controller.php"); 
            }
        }
            
    break;



    case 'Users':

        /**
        * Shows all users with a one permission's group 
        */

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Show floors requires login."]);
            $view->redirect("LOGIN_Controller.php");
        }

        //@if Checks if the user can see all users
        if(!$view->checkRol('SHOW ALL', 'USER')){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("GROUP_Controller.php");
        }

        //@if Checks if exists the group parameter passed by GET
        if (!isset($_GET['group'])){
            $view->setFlashDanger($strings["Group id is mandatory"]);
            $view->redirect("GROUP_Controller.php");
        }
        $groupid = $_GET['group'];

        $user = new USER_Model('','','','','','','','', $groupid);
        $users = $user->getUsersForGroup();
        new USER_SHOWALL($users);

    break;

    case 'Show':
        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit groups requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if the user can see a group
        if(!$view->checkRol('SHOW', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("GROUP_Controller.php");
        }

        //@if Checks if exists the group parameter passed by GET
        if (!isset($_GET['group'])){
            $view->setFlashDanger($strings["Group id is mandatory"]);
            $view->redirect("GROUP_Controller.php");
        }
        $groupId = $_GET['group'];

        /**
        * @if Checks if exists anything group with the identifier passed by GET
        * gets the group values and shows it in GROUP_SHOW_View.
        */
        $group = new GROUP_Model($groupId);
        if($group->existsGroup()){
            $groupValues = $group->getGroup();
            $permissions = $group->getPermissionForGroup();
            $function = new FUNCTIONALITY_Model();
            $functions = $function->getAllFunctions();
            $action = new ACTION_Model();
            $actions = $action->getAllActionsForFunction();
            new GROUP_SHOW($groupValues, $functions, $actions, $permissions);
        }else{
            $view->setFlashDanger($strings["Group doesn't exist"]);
            $view->redirect("GROUP_Controller.php");
        }
            
    break;


    case  'Delete':
        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete groups requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if the user can delete a group
        if(!$view->checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("GROUP_Controller.php");
        }

        //@if Checks if exists the group parameter passed by GET
        if (!isset($_POST['group'])){
            $view->setFlashDanger($strings["Group id is mandatory"]);
            $view->redirect("GROUP_Controller.php");
        }

        //Try to delete one group from the database
        $groupDelete = new GROUP_Model($_POST['group']);
        $groupName = $groupDelete->findNameGroup();
        $deleteAnswer = $groupDelete->deleteGroup();
        if($deleteAnswer === true){
            $flashMessageSuccess = sprintf($strings["Group \"%s\" successfully deleted."], $groupName);
            $view->setFlashSuccess($flashMessageSuccess);
            $view->redirect("GROUP_Controller.php");     
        }else{
            $view->setFlashDanger($strings[$deleteAnswer]);
            $view->redirect("GROUP_Controller.php");
        }
            	
    break;
    

    default:

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add groups requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if the user can see all groups.
        if(!$view->checkRol('SHOW ALL', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php");
        }

        //Gets all permission's groups
        $group = new GROUP_Model();
        $groups = $group->getAllGroups();
        new GROUP_SHOWALL($groups);
            
    break;
}

?>
