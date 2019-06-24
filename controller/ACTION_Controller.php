<?php

/**
* File: ACTION_Controller
*
* Script that controller to add new action, edit action, 
* delete action, show action and show all actions
*
* @author ivanddios <ivanddios1994@gmail.com>
*/

require_once("../core/ViewManager.php");
require_once("../model/ACTION_Model.php");
require_once("../view/ACTION_SHOWALL_View.php");
require_once("../view/ACTION_ADD_View.php");
require_once("../view/ACTION_EDIT_View.php");
require_once("../view/ACTION_SHOW_View.php");

$function = "ACTION";
$view = new ViewManager();
include '../view/locate/Strings_'.$_SESSION['LANGUAGE'].'.php';


/**
* Gets values from the forms associated with actions
*
* @return Action with the form values
*/
function get_data_form() {
    $idAction = $_GET['accion'];
    $nameAction = $_POST['nameAction'];
    $descripAction = $_POST['descripAction'];
   
    $action = new ACTION_Model($idAction, $nameAction, $descripAction);
    return $action;
}


if (!isset($_GET['action'])){
	$_GET['action'] = '';
}

/**
 * Evaluates the 'action' parameter passed for URL
 * For each action, the controller checks if the user is logged and if the user has the permissions necessary.
 * 
 * The controller calls a view (with actions data or no, depending the action).
 * 
 * The controller gets the forms' data of the views and call the Action model to make the actions against the database.
 */
Switch ($_GET['action']){

    case 'Add':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add actions requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if the user can add a new action
        if(!$view->checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("ACTION_Controller.php");
        }

        /**
        * @if Checks if exists $_POST gets the form's data, instances a new object Action, 
        * checks if the data are valids and adds the action to database
        */
        if (isset($_POST["submit"])) { 
            $ActionAdd = get_data_form();
            $answerAdd = $ActionAdd->addAction();
            if($answerAdd === true){
                $flashMessageSuccess = sprintf($strings["Action \"%s\" successfully added."], $ActionAdd->getNameAction());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("ACTION_Controller.php");
            } else {
                /**
                * If the operation could not be completed, sets a flash danger variable with the error 
                * and redirects to show the ADD_View against
                */
                $view->setFlashDanger($strings[$answerAdd]);
                $view->redirect("ACTION_Controller.php", 'Add');
            }
        } else {
            new ACTION_ADD();
        }
           	       
    break;


    case 'Edit':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit actions requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if the user can modify an action
        if(!$view->checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("ACTION_Controller.php");
        }

        //@if Checks if exists the action parameter in URL
        if (!isset($_GET['action'])){
            $view->setFlashDanger($strings["Action id is mandatory"]);
            $view->redirect("ACTION_Controller.php");
        }

        $actionId = $_GET['accion'];

        /**
        * @if Checks if exists $_POST gets the form's data, instances a new object Action, 
        * checks if the data are valids and modifies the action in database.
        *
        * @else Otherwise, checks if exists anything action with the identifier passed by GET
        * gets the actions values and shows it in ACTION_EDIT_View.
        */
        if (isset($_POST["submit"])) { 
            $actionEdit = get_data_form();
            $answerEdit = $actionEdit->updateAction();
            if($answerEdit === true){
                $actionEdit->updateAction();
                $flashMessageSuccess = sprintf($strings["Action \"%s\" successfully updated."], $actionEdit->getNameAction());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("ACTION_Controller.php");   
            }else{
                $view->setFlashDanger($strings[$answerEdit]);
                $view->redirect("ACTION_Controller.php",'Edit', 'accion='.$actionId);
            }
        }else {
            $action = new ACTION_Model($actionId);
            if($action->existsAction()){
                $actionValues = $action->getAction();
                new ACTION_EDIT($actionValues);
            }else{
                $view->setFlashDanger($strings["Action doesn't exist"]);
                $view->redirect("ACTION_Controller.php");
            }
        }
            
    break;


    case 'Show':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Show action requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if the user can see an action
        if(!$view->checkRol('SHOW', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("ACTION_Controller.php");
        }

        //@if Checks if exists the action parameter in URL
        if (!isset($_GET['action'])){
            $view->setFlashDanger($strings["Action identifier is mandatory"]);
            $view->redirect("ACTION_Controller.php");
        }
        $actionId = $_GET['id'];
        $action = new ACTION_Model($actionId);

        /**
        * @if Checks if exists anything action with the identifier passed by GET
        * gets the actions values and shows it in ACTION_SHOW_View.
        */
        if($action->existsAction()){
            $actionValues = $action->getAction();
            new ACTION_SHOW($actionValues);
        } else{
            $view->setFlashDanger($strings["Action doesn't exist"]);
            $view->redirect("ACTION_Controller.php");
        }

    break;


    case  'Delete':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete actions requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if the user can modify a new action
        if(!$view->checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("ACTION_Controller.php");
        }

        //@if Checks if exists the action parameter in URL
        if (!isset($_POST['action'])){
            $view->setFlashDanger($strings["Action id is mandatory"]);
            $view->redirect("ACTION_Controller.php");
        }

        //Gets action identifier and try delete the action with this id from the database
        $actionDelete = new ACTION_Model($_POST['action']);
        $actionName = $actionDelete->findNameAction();
        $answerDelete = $actionDelete->deleteAction();
        if($answerDelete === true){
            $flashMessageSuccess = sprintf($strings["Action \"%s\" successfully deleted."], $actionName);
            $view->setFlashSuccess($flashMessageSuccess);
            $view->redirect("ACTION_Controller.php");     
        }else {
            $view->setFlashDanger($strings[$answerDelete]);
            $view->redirect("ACTION_Controller.php");
        }
            	
    break;
    

    default:

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add actions requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if the user can see all actions
        if(!$view->checkRol('SHOW ALL', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php");
        }

        //Gets all actions from the database and shows actions in ACTION_SHOWALL_View
        $action = new ACTION_Model();
        $actions = $action->getAllActions();
        new ACTION_SHOWALL($actions);
            
    break;
}

?>
