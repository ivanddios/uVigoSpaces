<?php

require_once(__DIR__."../../core/ViewManager.php");
require_once(__DIR__."../../core/ACL.php");
require_once(__DIR__."../../model/ACTION_Model.php");
require_once(__DIR__."../../view/ACTION_SHOWALL_View.php");
require_once(__DIR__."../../view/ACTION_ADD_View.php");
require_once(__DIR__."../../view/ACTION_EDIT_View.php");
require_once(__DIR__."../../view/ACTION_SHOW_View.php");


$function = "ACTION";
$view = new ViewManager();

include '../view/locate/Strings_'.$_SESSION['LANGUAGE'].'.php';

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

    case  $strings['Add']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add actions requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!checkRol('ADD', $function)){
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
                $view->redirect("ACTION_Controller.php", $strings['Add']);
            }

        } else {
            new ACTION_ADD();
        }
           	       
    break;


    case  $strings['Edit']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit actions requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!checkRol('EDIT', $function)){
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
                $view->redirect("ACTION_Controller.php", $strings['Edit'], 'accion='.$actionId);
            }
        } else {
            $action = new ACTION_Model($actionId);
            $actionValues = $action->getAction();
            new ACTION_EDIT($actionValues);
        }
            
    break;



    case  $strings['Show']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Show action requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!checkRol('SHOW', $function)){
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


    case  $strings['Delete']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete actions requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!checkRol('DELETE', $function)){
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

        if(!checkRol('SHOW ALL', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $action = new ACTION_Model();
        $actions = $action->getAllActions();
        new ACTION_SHOWALL($actions);
            
    break;
}

?>
