<?php

require_once("../core/ViewManager.php");
require_once("../core/ACL.php");
require_once("../model/ACTION_Model.php");
require_once("../model/FUNCTIONALITY_Model.php");
require_once("../view/FUNCTIONALITY_SHOWALL_View.php");
require_once("../view/FUNCTIONALITY_ADD_View.php");
require_once("../view/FUNCTIONALITY_EDIT_View.php");
require_once("../view/FUNCTIONALITY_SHOW_View.php");


$function = "FUNCTIONALITY";
$view = new ViewManager();

include '../view/locate/Strings_'.$_SESSION['LANGUAGE'].'.php';

function get_data_form() {

    $nameFunction = $_POST['nameFunction'];
    $descripFunction = $_POST['descripFunction'];
    $actions = $_POST['actions'];
   
    $function = new FUNCTIONALITY_Model(null, $nameFunction, $descripFunction, $actions);
    return $function;
}


if (!isset($_GET['action'])){
	$_GET['action'] = '';
}

Switch ($_GET['action']){

    case  'Add':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add functionalities requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("FUNCTIONALITY_Controller.php");
        }

        if (isset($_POST["submit"])) { 
            $functionAdd = get_data_form();
            $addAnswer = $functionAdd->addFunction();
            if($addAnswer === true){
                $flashMessageSuccess = sprintf($strings["Functionality \"%s\" successfully added."], $functionAdd->getNameFunction());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("FUNCTIONALITY_Controller.php");
            }else{
                $view->setFlashDanger($strings[$addAsnwer]);
                $view->redirect("FUNCTIONALITY_Controller.php", 'Add');
            }
                
        } else {
            $function = new FUNCTIONALITY_Model();
            $action = new ACTION_Model();

            $actions = $action->getAllActions();
            new FUNCTIONALITY_ADD($actions);
        }
           	       
    break;


    case  'Edit':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit functionalities requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("FUNCTIONALITY_Controller.php");
        }

        if (!isset($_GET['function'])){
            $view->setFlashDanger($strings["Function id is mandatory"]);
            $view->redirect("FUNCTIONALITY_Controller.php");
        }
        $functionId = $_GET['function'];

        if (isset($_POST["submit"])) { 
            $functionEdit = get_data_form();
            $functionEdit->setIdFunction($functionId);
            $editAnswer = $functionEdit->updateFunction();
            if($editAnswer === true){
                $functionEdit->updateFunction($actions);
                $flashMessageSuccess = sprintf($strings["Function \"%s\" successfully updated."], $functionEdit->getNameFunction());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("FUNCTIONALITY_Controller.php");   

            }else{
                $view->setFlashDanger($strings[$editAnswer]);
                $view->redirect("FUNCTIONALITY_Controller.php", 'Edit', 'function='.$functionId);
            }
        } else {

            $function = new FUNCTIONALITY_Model($functionId);
            $functionValues = $function->getFunction();
            $action = new ACTION_Model();
            $actions = $action->getAllActions();
            $actionsForFunctionality = $function->getAllActionsForFunctionality();

            new FUNCTIONALITY_EDIT($functionValues, $actions, $actionsForFunctionality);
        }
            
    break;



    case  'Show':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Show function requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!checkRol('SHOW', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("FUNCTIONALITY_Controller.php");
        }

        if (!isset($_GET['function'])){
            $view->setFlashDanger($strings["Function identifier is mandatory"]);
            $view->redirect("FUNCTIONALITY_Controller.php");
        }
        $functionId = $_GET['function'];

        $function = new FUNCTIONALITY_Model($functionId);
        $functionValues = $function->getFunction();
        $action = new ACTION_Model();
        $actions = $action->getAllActions();
        $actionsForFunctionality = $function->getAllActionsForFunctionality();
        new FUNCTIONALITY_SHOW($functionValues, $actions, $actionsForFunctionality);

    break;


    case  'Delete':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete functionalities requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("FUNCTIONALITY_Controller.php");
        }

        if (!isset($_POST['function'])){
            $view->setFlashDanger($strings["Function id is mandatory"]);
            $view->redirect("FUNCTIONALITY_Controller.php");
        }
        $functionId = $_POST['function'];
        $functionDelete = new FUNCTIONALITY_Model($functionId);

        if (!$functionDelete->existsFunction()) {
            $view->setFlashDanger($strings["No such function with this id"]);
            $view->redirect("FUNCTIONALITY_Controller.php");
        }

        try{
            $functionDelete->deleteFunction();
            $flashMessageSuccess = sprintf($strings["Function \"%s\" successfully deleted."], $functionId);
            $view->setFlashSuccess($flashMessageSuccess);
            $view->redirect("FUNCTIONALITY_Controller.php");     
        }catch(Exception $errors) {
            $view->setFlashDanger($strings[$errors->getMessage()]);
            $view->redirect("FUNCTIONALITY_Controller.php");
        }
            	
    break;
    

    default:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add functionalities requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!checkRol('SHOW ALL', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $function = new FUNCTIONALITY_Model();
        $functions = $function->getAllFunctions();
        new FUNCTIONALITY_SHOWALL($functions);
            
    break;
}

?>
