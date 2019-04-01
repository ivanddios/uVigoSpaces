<?php

require_once(__DIR__."../../core/ViewManager.php");
require_once(__DIR__."../../core/ACL.php");
require_once(__DIR__."../../model/FUNCTIONALITY_Model.php");
require_once(__DIR__."../../view/FUNCTIONALITY_SHOWALL_View.php");
require_once(__DIR__."../../view/FUNCTIONALITY_ADD_View.php");
require_once(__DIR__."../../view/FUNCTIONALITY_EDIT_View.php");
// require_once(__DIR__."../../view/BUILDING_SHOW_View.php");


$function = "FUNCTIONALITY";
$view = new ViewManager();

include '../locate/Strings_'.$_SESSION['LANGUAGE'].'.php';

function get_data_form() {

    $idFunction = $_GET['function'];
    $nameFunction = $_POST['nameFunction'];
    $descripFunction = $_POST['descripFunction'];
   
    $function = new FUNCTIONALITY_Model($idFunction, $nameFunction, $descripFunction);
    return $function;
}


if (!isset($_GET['action'])){
	$_GET['action'] = '';
}

Switch ($_GET['action']){

    case  $strings['Add']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add functionalities requires login."]);
            $view->redirect("USER_Controller.php", "index");
        }

        if(!checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php", "index");
        }

        if (isset($_POST["submit"])) { 
            $functionAdd = get_data_form();
            $actions = json_decode($_POST["actions"]);
            try{
                // $functionAdd->checkIsValidForAdd_Update(); 
                $functionAdd->addFunction($actions);
                $flashMessageSuccess = sprintf($strings["Functionality \"%s\" successfully added."], $functionAdd->getNameFunction());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("FUNCTIONALITY_Controller.php", "index");

            }catch(Exception $errors) {
                $view->setFlashDanger($strings[$errors->getMessage()]);
                $view->redirect("BUILDING_Controller.php", "add");

            }
                
        } else {
            $function = new FUNCTIONALITY_Model();
            $actions = $function->showAllActions();
            new FUNCTIONALITY_ADD($actions);
        }
           	       
    break;


    case  $strings['Edit']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit functionalities requires login."]);
            $view->redirect("USER_Controller.php", "index");
        }

        if(!checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php", "index");
        }

        if (!isset($_GET['function'])){
            $view->setFlashDanger($strings["Function id is mandatory"]);
            $view->redirect("FUNCTIONALITY_Controller.php", "index");
        }
        $functionId = $_GET['function'];

        if (isset($_POST["submit"])) { 
            $functionEdit = get_data_form();
            $actions = json_decode($_POST["actions"]);
            try{
                //$functionEdit->checkIsValidForAdd_Update();
                var_dump("HO");
                $functionEdit->updateFunction($actions);
                $flashMessageSuccess = sprintf($strings["Function \"%s\" successfully updated."], $functionEdit->getNameFunction());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("FUNCTIONALITY_Controller.php", "index");   

            }catch(Exception $errors) {
                $view->setFlashDanger($strings[$errors->getMessage()]);
                $view->redirect("FUNCTIONALITY_Controller.php", $strings['Edit'], 'function='.$functionId);
            }
        } else {

            $function = new FUNCTIONALITY_Model($functionId);
            $functionValues = $function->findFunctionality();
            $actions = $function->showAllActions();
            $actionsForFunctionality = $function->showAllActionsForFunctionality();
            //var_dump($actionsForFunctionality);
            new FUNCTIONALITY_EDIT($functionValues, $actions, $actionsForFunctionality);
        }
            
    break;



    // case  $strings['Show']:

    //     // if (!isset($_SESSION['LOGIN'])){
    //     //     $view->setFlashDanger($strings["Not in session. Show floors requires login."]);
    //     //     $view->redirect("USER_Controller.php", "");
    //     // }

    //     // if(!checkRol('SHOW', $function)){
    //     //     $view->setFlashDanger($strings["You do not have the necessary permits"]);
    //     //     $view->redirect("BUILDING_Controller.php", "");
    //     // }

    //     if (!isset($_GET['building'])){
    //         $view->setFlashDanger($strings["Building id is mandatory"]);
    //         $view->redirect("BUILDING_Controller.php", "");
    //     }
    //     $buildingid = $_GET['building'];

    //     $building = new BUILDING_Model($buildingid);
    //     $values = $building->fillInBuilding();
    //     new BUILDING_SHOW($values);

    // break;


    case  $strings['Delete']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete functionalities requires login."]);
            $view->redirect("USER_Controller.php", "index");
        }

        if(!checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("FUNCTIONALITY_Controller.php", "index");
        }

        if (!isset($_POST['function'])){
            $view->setFlashDanger($strings["Function id is mandatory"]);
            $view->redirect("FUNCTIONALITY_Controller.php", "index");
        }
        $functionId = $_POST['function'];
        $functionDelete = new FUNCTIONALITY_Model($functionId);

        if (!$functionDelete->existsFunction()) {
            $view->setFlashDanger($strings["No such function with this id"]);
            $view->redirect("FUNCTIONALITY_Controller.php", "index");
        }

        try{
            $functionDelete->deleteFunction();
            $flashMessageSuccess = sprintf($strings["Function \"%s\" successfully deleted."], $buildingid);
            $view->setFlashSuccess($flashMessageSuccess);
            $view->redirect("FUNCTIONALITY_Controller.php", "index");     
        }catch(Exception $errors) {
            $view->setFlashDanger($strings[$errors->getMessage()]);
            $view->redirect("FUNCTIONALITY_Controller.php", "index");
        }
            	
    break;
    

    default:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add functionalities requires login."]);
            $view->redirect("USER_Controller.php", "index");
        }

        if(!checkRol('SHOW ALL', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php", "index");
        }

        $function = new FUNCTIONALITY_Model();
        $functions = $function->showAllFunctions();
        new FUNCTIONALITY_SHOWALL($functions);
            
    break;
}

?>
