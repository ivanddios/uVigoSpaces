<?php

require_once(__DIR__."../../core/ViewManager.php");
require_once(__DIR__."../../core/ACL.php");
require_once(__DIR__."../../model/BUILDING_Model.php");
require_once(__DIR__."../../view/BUILDING_SHOWALL_View.php");
require_once(__DIR__."../../view/BUILDING_ADD_View.php");
require_once(__DIR__."../../view/BUILDING_EDIT_View.php");
require_once(__DIR__."../../view/BUILDING_SHOW_View.php");


$function = "BUILDING";
$view = new ViewManager();

include '../locate/Strings_'.$_SESSION['LANGUAGE'].'.php';

function get_data_form() {

    $idBuilding = $_POST['idBuilding'];
    $nameBuilding = $_POST['nameBuilding'];
    $addressBuilding = $_POST['addressBuilding'];
    $phoneBuilding = $_POST['phoneBuilding'];
   
    $building = new BUILDING_Model($idBuilding, $nameBuilding, $addressBuilding, $phoneBuilding);
    return $building;
}


if (!isset($_GET['action'])){
	$_GET['action'] = '';
}

Switch ($_GET['action']){

    case  $strings['Add']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add buildings requires login."]);
            $view->redirect("USER_Controller.php", "index");
        }

        if(!checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php", "index");
        }

        if (isset($_POST["submit"])) { 
            $buildingAdd = get_data_form();

            try{
                $buildingAdd->checkIsValidForAdd_Update(); 
                $buildingAdd->addBuilding();
                $flashMessageSuccess = sprintf($strings["Building \"%s\" successfully added."], $buildingAdd->getNameBuilding());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("BUILDING_Controller.php", "index");

            }catch(Exception $errors) {
                $view->setFlashDanger($strings[$errors->getMessage()]);
                $view->redirect("BUILDING_Controller.php", $strings['Add']);

            }
                
        } else {
            new BUILDING_ADD();
        }
           	       
    break;


    case  $strings['Edit']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit buildings requires login."]);
            $view->redirect("USER_Controller.php", "index");
        }

        if(!checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php", "index");
        }

        if (!isset($_GET['building'])){
            $view->setFlashDanger($strings["Building id is mandatory"]);
            $view->redirect("BUILDING_Controller.php", "index");
        }
        $buildingid = $_GET['building'];

        if (isset($_POST["submit"])) { 
            $buildingEdit = get_data_form();

            try{
                $buildingEdit->checkIsValidForAdd_Update(); 
                $buildingEdit->updateBuilding($buildingid);
                $flashMessageSuccess = sprintf($strings["Building \"%s\" successfully updated."], $buildingEdit->getNameBuilding());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("BUILDING_Controller.php", "index");   

            }catch(Exception $errors) {
                $view->setFlashDanger($strings[$errors->getMessage()]);
                $view->redirect("BUILDING_Controller.php", $strings['Edit'], 'building='.$buildingid);
            }
        } else {
            $building = new BUILDING_Model($buildingid);
            $values = $building->fillInBuilding();
            new BUILDING_EDIT($values);
        }
            
    break;



    case  $strings['Show']:

        // if (!isset($_SESSION['LOGIN'])){
        //     $view->setFlashDanger($strings["Not in session. Show floors requires login."]);
        //     $view->redirect("USER_Controller.php", "");
        // }

        // if(!checkRol('SHOW', $function)){
        //     $view->setFlashDanger($strings["You do not have the necessary permits"]);
        //     $view->redirect("BUILDING_Controller.php", "");
        // }

        if (!isset($_GET['building'])){
            $view->setFlashDanger($strings["Building id is mandatory"]);
            $view->redirect("BUILDING_Controller.php", "index");
        }
        $buildingid = $_GET['building'];

        $building = new BUILDING_Model($buildingid);
        $values = $building->fillInBuilding();
        new BUILDING_SHOW($values);

    break;


    case  $strings['Delete']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete buildings requires login."]);
            $view->redirect("USER_Controller.php", "index");
        }

        if(!checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php", "index");
        }

        if (!isset($_POST['building'])){
            $view->setFlashDanger($strings["Building id is mandatory"]);
            $view->redirect("BUILDING_Controller.php", "index");
        }
        $buildingid = $_POST['building'];
        $buildingDelete = new BUILDING_Model($buildingid);

        if (!$buildingDelete->findBuilding()) {
            $view->setFlashDanger($strings["No such building with this id"]);
            $view->redirect("BUILDING_Controller.php", "index");
        }

        try{
            $buildingDelete->deleteBuilding();
            $flashMessageSuccess = sprintf($strings["Building \"%s\" successfully deleted."], $buildingid);
            $view->setFlashSuccess($flashMessageSuccess);
            $view->redirect("BUILDING_Controller.php", "index");     
        }catch(Exception $errors) {
            $view->setFlashDanger($strings[$errors->getMessage()]);
            $view->redirect("BUILDING_Controller.php", "index");
        }
            	
    break;
    

    default:

        // if(!checkRol('SHOW ALL', $function)){
        //     $view->setFlashDanger($strings["You do not have the necessary permits"]);
        //     $view->redirect("BUILDING_Controller.php", "");
        // }
        $building = new BUILDING_Model();
        $buildings = $building->showAllBuilding();
        new BUILDING_SHOWALL($buildings);
            
    break;
}

?>
