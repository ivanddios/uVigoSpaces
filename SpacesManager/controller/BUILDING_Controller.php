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

include '../view/locate/Strings_'.$_SESSION['LANGUAGE'].'.php';

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
            $view->redirect("USER_Controller.php");
        }

        if(!checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php");
        }

        if (isset($_POST["submit"])) { 
            $buildingAdd = get_data_form();
            $answerAdd = $buildingAdd->addBuilding();

            if($answerAdd === true){
                $buildingAdd->addBuilding();
                $flashMessageSuccess = sprintf($strings["Building \"%s\" successfully added."], $buildingAdd->getNameBuilding());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("BUILDING_Controller.php");

            }else{
                $view->setFlashDanger($strings[$answerAdd]);
                $view->redirect("BUILDING_Controller.php", $strings['Add']);
            }
                
        } else {
            new BUILDING_ADD();
        }
           	       
    break;


    case  $strings['Edit']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit buildings requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php");
        }

        if (!isset($_GET['building'])){
            $view->setFlashDanger($strings["Building id is mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }
        $buildingid = $_GET['building'];

        if (isset($_POST["submit"])) { 
            $buildingEdit = get_data_form();
            $answerEdit = $buildingEdit->updateBuilding();
            if($answerEdit === true){
                $flashMessageSuccess = sprintf($strings["Building \"%s\" successfully updated."], $buildingEdit->getNameBuilding());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("BUILDING_Controller.php");   
            }else{
                $view->setFlashDanger($strings[$answerEdit]);
                $view->redirect("BUILDING_Controller.php", $strings['Add']);
            }
        } else {
            $building = new BUILDING_Model($buildingid);
            $values = $building->getBuilding();
            new BUILDING_EDIT($values);
        }
            
    break;



    case  $strings['Show']:

        if (!isset($_GET['building'])){
            $view->setFlashDanger($strings["Building id is mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }
        $buildingid = $_GET['building'];

        $building = new BUILDING_Model($buildingid);
        $values = $building->getBuilding();
        new BUILDING_SHOW($values);

    break;


    case  $strings['Delete']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete buildings requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php");
        }

        if (!isset($_POST['building'])){
            $view->setFlashDanger($strings["Building id is mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }
        $buildingDelete = new BUILDING_Model($_POST['building']);
        $buildingID = $buildingDelete->getIdBuilding();
        $answerDelete = $buildingDelete->deleteBuilding();
        if($answerDelete === true){
            $flashMessageSuccess = sprintf($strings["Building \"%s\" successfully deleted."], $buildingID);
            $view->setFlashSuccess($flashMessageSuccess);
            $view->redirect("BUILDING_Controller.php");     
        }else{            
            $view->setFlashDanger($strings[$answerDelete]);
            $view->redirect("BUILDING_Controller.php");
        }
          	
    break;
    

    default:
        $building = new BUILDING_Model();
        $buildings = $building->getAllBuilding();
        new BUILDING_SHOWALL($buildings);  
    break;
}

?>
