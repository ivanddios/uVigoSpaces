<?php

/**
* File: Action_Controller
*
* Script that controller to add new action, edit action, delete action, show action
* and show all actions
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
* Gets values from the forms
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


Switch ($_GET['action']){

    case 'Add':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add actions requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!$view->checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("ACTION_Controller.php");
        }

        if (isset($_POST["submit"])) { 
            $ActionAdd = get_data_form();
            $answerAdd = $ActionAdd->addAction();
            if($answerAdd === true){
                $flashMessageSuccess = sprintf($strings["Action \"%s\" successfully added."], $ActionAdd->getNameAction());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("ACTION_Controller.php");
            } else {
                $view->setFlashDanger($strings[$answerAdd]);
                $view->redirect("ACTION_Controller.php", 'Add');
            }

        } else {
            new ACTION_ADD();
        }
           	       
    break;


    case  'Edit':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit actions requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!$view->checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("ACTION_Controller.php");
        }

        if (!isset($_GET['action'])){
            $view->setFlashDanger($strings["Action id is mandatory"]);
            $view->redirect("ACTION_Controller.php");
        }
        $actionId = $_GET['accion'];

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
        } else {
            $action = new ACTION_Model($actionId);
            $actionValues = $action->getAction();
            new ACTION_EDIT($actionValues);
        }
            
    break;


    case  'Show':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Show action requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!$view->checkRol('SHOW', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("ACTION_Controller.php");
        }

        if (!isset($_GET['action'])){
            $view->setFlashDanger($strings["Action identifier is mandatory"]);
            $view->redirect("ACTION_Controller.php");
        }
        $actionId = $_GET['id'];
        $action = new ACTION_Model($actionId);
        $actionValues = $action->getAction();
        new ACTION_SHOW($actionValues);

    break;


    case  'Delete':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete actions requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!$view->checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("ACTION_Controller.php");
        }

        if (!isset($_POST['action'])){
            $view->setFlashDanger($strings["Action id is mandatory"]);
            $view->redirect("ACTION_Controller.php");
        }

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

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add actions requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!$view->checkRol('SHOW ALL', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $action = new ACTION_Model();
        $actions = $action->getAllActions();
        new ACTION_SHOWALL($actions);
            
    break;
}

?>
