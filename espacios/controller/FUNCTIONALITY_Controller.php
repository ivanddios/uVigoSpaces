<?php

require_once(__DIR__."../../core/ViewManager.php");
require_once(__DIR__."../../core/ACL.php");
require_once(__DIR__."../../model/FUNCTIONALITY_Model.php");
require_once(__DIR__."../../view/FUNCTIONALITY_SHOWALL_View.php");
require_once(__DIR__."../../view/FUNCTIONALITY_ADD_View.php");
// require_once(__DIR__."../../view/BUILDING_EDIT_View.php");
// require_once(__DIR__."../../view/BUILDING_SHOW_View.php");


$function = "FUNCTIONALITY";
$view = new ViewManager();

include '../locate/Strings_'.$_SESSION['LANGUAGE'].'.php';

function get_data_form() {

    $nameFunction = $_POST['nameFunction'];
    $descripFunction = $_POST['descripFunction'];
   
    $function = new FUNCTIONALITY_Model($nameFunction, $descripFunction);
    return $function;
}


if (!isset($_GET['action'])){
	$_GET['action'] = '';
}

Switch ($_GET['action']){

    case  $strings['Add']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add functionalities requires login."]);
            $view->redirect("USER_Controller.php", "");
        }

        if(!checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php", "");
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


    // case  $strings['Edit']:

    //     if (!isset($_SESSION['LOGIN'])){
    //         $view->setFlashDanger($strings["Not in session. Edit floors requires login."]);
    //         $view->redirect("USER_Controller.php", "");
    //     }

    //     if(!checkRol('EDIT', $function)){
    //         $view->setFlashDanger($strings["You do not have the necessary permits"]);
    //         $view->redirect("BUILDING_Controller.php", "");
    //     }

    //     if (!isset($_GET['building'])){
    //         $view->setFlashDanger($strings["Building id is mandatory"]);
    //         $view->redirect("BUILDING_Controller.php", "");
    //     }
    //     $buildingid = $_GET['building'];

    //     if (isset($_POST["submit"])) { 
    //         $buildingEdit = get_data_form();

    //         try{
    //             $buildingEdit->checkIsValidForAdd_Update(); 
    //             $buildingEdit->updateBuilding($buildingid);
    //             $flashMessageSuccess = sprintf($strings["Building \"%s\" successfully updated."], $buildingEdit->getNameBuilding());
    //             $view->setFlashSuccess($flashMessageSuccess);
    //             $view->redirect("BUILDING_Controller.php", "");   

    //         }catch(Exception $errors) {
    //             $view->setFlashDanger($strings[$errors->getMessage()]);
    //             $view->redirect("BUILDING_Controller.php", "edit");
    //         }
    //     } else {
    //         $building = new BUILDING_Model($buildingid);
    //         $values = $building->fillInBuilding();
    //         new BUILDING_EDIT($values);
    //     }
            
    // break;



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


    // case  $strings['Delete']:

    //     if (!isset($_SESSION['LOGIN'])){
    //         $view->setFlashDanger($strings["Not in session. Delete floors requires login."]);
    //         $view->redirect("USER_Controller.php", "");
    //     }

    //     if(!checkRol('DELETE', $function)){
    //         $view->setFlashDanger($strings["You do not have the necessary permits"]);
    //         $view->redirect("BUILDING_Controller.php", "");
    //     }

    //     if (!isset($_POST['building'])){
    //         $view->setFlashDanger($strings["Building id is mandatory"]);
    //         $view->redirect("BUILDING_Controller.php", "");
    //     }
    //     $buildingid = $_POST['building'];
    //     $buildingDelete = new BUILDING_Model($buildingid);

    //     if (!$buildingDelete->findBuilding()) {
    //         $view->setFlashDanger($strings["No such building with this id"]);
    //         $view->redirect("BUILDING_Controller.php", "");
    //     }

    //     try{
    //         $buildingDelete->deleteBuilding();
    //         $flashMessageSuccess = sprintf($strings["Building \"%s\" successfully deleted."], $buildingid);
    //         $view->setFlashSuccess($flashMessageSuccess);
    //         $view->redirect("BUILDING_Controller.php", "");     
    //     }catch(Exception $errors) {
    //         $view->setFlashDanger($strings[$errors->getMessage()]);
    //         $view->redirect("BUILDING_Controller.php", "");
    //     }
            	
    // break;
    

    default:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add functionalities requires login."]);
            $view->redirect("USER_Controller.php", "");
        }

        if(!checkRol('SHOWALL', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php", "");
        }

        $function = new FUNCTIONALITY_Model();
        $functions = $function->showAllFunctions();
        new FUNCTIONALITY_SHOWALL($functions);
            
    break;
}

?>
