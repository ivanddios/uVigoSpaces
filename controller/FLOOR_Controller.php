<?php

require_once("../core/ViewManager.php");
require_once("../core/ACL.php");
require_once("../model/BUILDING_Model.php");
require_once("../model/FLOOR_Model.php");
require_once("../model/SPACE_Model.php");
require_once("../view/FLOOR_SHOWALL_View.php");
require_once("../view/FLOOR_ADD_View.php");
require_once("../view/FLOOR_EDIT_View.php");
require_once("../view/FLOOR_SHOW_View.php");
require_once("../view/FLOOR_SHOW_PLAN_View.php");

$function = "FLOOR";
$view = new ViewManager();

include '../view/locate/Strings_'.$_SESSION['LANGUAGE'].'.php';


function get_data_form() {

    $idBuilding = $_POST['idBuilding'];
    $idFloor = $_POST['idFloor'];
    $nameFloor = $_POST['nameFloor'];
    $surfaceBuildingFloor =  $_POST['surfaceBuildingFloor'];
    $surfaceUsefulFloor =  $_POST['surfaceUsefulFloor'];
    $planFloor = $_FILES['planFloor'];

    $floor = new FLOOR_Model($idBuilding, $idFloor, $nameFloor, $planFloor, $surfaceBuildingFloor, $surfaceUsefulFloor);
    return $floor;
}


if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}

Switch ($_REQUEST['action']){

    case  'Add':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add floors requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if (!isset($_GET['building'])){
            $view->setFlashDanger($strings["Building id is mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }
        $buildingid = $_GET['building'];

        if(!checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
        }

        if (isset($_POST["submit"])) { 
            $floorAdd = get_data_form();
            $addAnswer =  $floorAdd->addFloor();
            if($addAnswer === true){
                $flashMessageSuccess = sprintf($strings["Floor \"%s\" successfully added."], $floorAdd->getNameFloor());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("FLOOR_Controller.php", "index&building=".$floorAdd->getIdBuilding());
            }else{
                $view->setFlashDanger($strings[$addAnswer]);
                $view->redirect("FLOOR_Controller.php", 'Add', "building=".$buildingid, "floor=Add");
            }
        } else {
            new FLOOR_ADD($buildingid);
        }
        
    break;



    case 'Edit':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit floors requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if (!isset($_GET['building']) && !isset($_GET['floor'])){
            $view->setFlashDanger($strings["Building and floor id are mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }
        $buildingid = $_GET["building"];
        $floorid = $_GET['floor'];

		if(!checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("FLOOR_Controller.php", "index&building=".$buildingid);
        }

        
        if (isset($_POST["submit"])) { 
            $floorEdit = get_data_form();
            $editAnswer =  $floorEdit->updateFloor();
            if($editAnswer === true){
                $flashMessageSuccess = sprintf($strings["Floor \"%s\" successfully updated."], $floorEdit->getNameFloor());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("FLOOR_Controller.php", "index&building=".$floorEdit->getIdBuilding());
            }else {
                $view->setFlashDanger($strings[$editAnswer]);
                $view->redirect("FLOOR_Controller.php", 'Edit', "building=$buildingid&floor=".$floorid);
            }
        } else {
            $floor = new FLOOR_Model($buildingid, $floorid);
            $values = $floor->getFloor();
            new FLOOR_EDIT($values);
        }

    break;


    case  'Show':

        if (!isset($_GET['building']) && !isset($_GET['floor'])){
            $view->setFlashDanger($strings["Building and floor id are mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $buildingid = $_GET["building"];
        $floorid = $_GET['floor'];

        $floor = new FLOOR_Model($buildingid, $floorid);
        $values = $floor->getFloor();
        new FLOOR_SHOW($values);
         
    break;


    case  'Delete':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete floors requires login"]);
            $view->redirect("USER_Controller.php");
        }

        if (!isset($_GET['building']) && !isset($_GET['floor'])){
            $view->setFlashDanger($strings["Building id is mandatory"]);
            $view->redirect("BUILDING_Controller.php", "");
        }
        $buildingid = $_GET['building'];
        $floorid = $_GET['floor'];

        if(!checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("FLOOR_Controller.php", "building=".$buildingid);
        }
        $floor = new FLOOR_Model($buildingid, $floorid);
        $deleteAnswer = $floor->deleteFloor();
        if($deleteAnswer === true){
            $flashMessageSuccess = sprintf($strings["Floor \"%s\" successfully deleted."], $buildingid.$floorid);
            $view->setFlashSuccess($flashMessageSuccess);
            $view->redirect("FLOOR_Controller.php", "index&building=".$floor->getIdBuilding());
        }else {
            $view->setFlashDanger($strings[$deleteAnswer]);
            $view->redirect("FLOOR_Controller.php", "index&building=".$buildingid);
    }

    break;

    case  'ShowPlan':

        if (!isset($_GET['building']) && !isset($_GET['floor'])){
            $view->setFlashDanger($strings["Building and floor id are mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }
        $buildingid = $_GET["building"];
        $floorid = $_GET['floor'];

        $space = new SPACE_Model($buildingid, $floorid);
        $spacesValues = $space->showAllSpaces();
        
        $floor = new FLOOR_Model($buildingid, $floorid);
        $planFloor = $floor->getLinkplan();
        $infoFloor = $floor->getInfoFloor();

        new FLOOR_SHOW_plan($spacesValues, $planFloor, $infoFloor);
        
    break;
    

    default:
                    
        if(isset($_GET['building'])){
            $floor = new FLOOR_Model($_GET['building']);
            $building = new BUILDING_Model($_GET['building']);
            $buildingName = $building->getBuildingName();
            $floors = $floor->getAllFloors();
            new FLOOR_SHOWALL($floors, $buildingName);
        } else {
            $view->setFlashDanger($strings["Building id is mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }
               
    break;
}

?>