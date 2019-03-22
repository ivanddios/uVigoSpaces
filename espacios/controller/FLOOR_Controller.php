<?php

require_once(__DIR__."../../core/ViewManager.php");
require_once(__DIR__."../../core/ACL.php");
require_once(__DIR__."../../model/BUILDING_Model.php");
require_once(__DIR__."../../model/FLOOR_Model.php");
require_once(__DIR__."../../model/SPACE_Model.php");
require_once(__DIR__."../../view/FLOOR_SHOWALL_View.php");
require_once(__DIR__."../../view/FLOOR_ADD_View.php");
require_once(__DIR__."../../view/FLOOR_EDIT_View.php");
require_once(__DIR__."../../view/FLOOR_SHOW_View.php");
require_once(__DIR__."../../view/FLOOR_SHOW_PLANE_View.php");

$function = "FLOOR";
$view = new ViewManager();

include '../locate/Strings_'.$_SESSION['LANGUAGE'].'.php';


function get_data_form() {

    $idBuilding = $_POST['idBuilding'];
    $idFloor = $_POST['idFloor'];
    $nameFloor = $_POST['nameFloor'];
    $surfaceBuildingFloor =  $_POST['surfaceBuildingFloor'];
    $surfaceUsefulFloor =  $_POST['surfaceUsefulFloor'];
    
    if (isset($_FILES['planeFloor']['name']) && ($_FILES['planeFloor']['name'] !== '')) {
        $planeFloor = '../document/Buildings/'.$idBuilding.'/'.$idBuilding.$idFloor.'/'.$_FILES['planeFloor']['name'];
    } else {
        $planeFloor = $_POST['planeFloorOriginal'];
    }

    $floor = new FLOOR_Model($idBuilding, $idFloor, $nameFloor, $planeFloor, $surfaceBuildingFloor, $surfaceUsefulFloor);
    return $floor;
}


if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}

Switch ($_REQUEST['action']){

    case  $strings['Add']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add floors requires login."]);
            $view->redirect("USER_Controller.php", "index");
        }

        if (!isset($_GET['building'])){
            $view->setFlashDanger($strings["Building is mandatory"]);
            $view->redirect("BUILDING_Controller.php", "");
        }
        $buildingid = $_GET['building'];

        if(!checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
        }

        if (isset($_POST["submit"])) { 
            $floorAdd = get_data_form();
            try{
                $floorAdd->checkIsValidForAdd(); 

                ////////////////////////////////////////METER EN UNA FUNCIÓN////////////////////////////////////////////////////////////
                $dirPlane = '../document/Buildings/'.$floorAdd->getIdBuilding().'/'.$floorAdd->getIdBuilding().$floorAdd->getIdFloor().'/';
                if ($_FILES['planeFloor']['name'] !== '') {
                    if (!file_exists($dirPlane)) {
                        mkdir($dirPlane, 0777, true);
                    }
                    move_uploaded_file($_FILES['planeFloor']['tmp_name'], $floorAdd->getPlaneFloor());
                }
                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $floorAdd->addFloor(); 
                $flashMessageSuccess = sprintf($strings["Floor \"%s\" successfully added."], $floorAdd->getNameFloor());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("FLOOR_Controller.php", "index&building=", $floorAdd->getIdBuilding());

            }catch(Exception $errors) {
                $view->setFlashDanger($strings[$errors->getMessage()]);
                $view->redirect("FLOOR_Controller.php", "add&building=", $buildingid);
            }

        } else {
            new FLOOR_ADD($buildingid);
        }
        
    break;



    case  $strings['Edit']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Show the floors requires login"]);
            $view->redirect("USER_Controller.php", "index");
        }

        if (!isset($_GET['building']) && !isset($_GET['floor'])){
            $view->setFlashDanger($strings["Building and floor id is mandatory"]);
            $view->redirect("BUILDING_Controller.php", "");
        }
        $buildingid = $_GET["building"];
        $floorid = $_GET['floor'];

		if(!checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
        }

        
        if (isset($_POST["submit"])) { 
            $floorEdit = get_data_form();
            
            try{
                $floorEdit->checkIsValidForEdit($floorid); 
                ////////////////////////////////////////METER EN UNA FUNCIÓN////////////////////////////////////////////////////////////
                $dirPlane = '../document/Buildings/'.$floorEdit->getIdBuilding().'/'.$floorEdit->getIdBuilding().$floorEdit->getIdFloor().'/';
                if ($_FILES['planeFloor']['name'] !== '') {
                    if (!file_exists($dirPlane)) {
                        mkdir($dirPlane, 0777, true);
                    }
                   
                    move_uploaded_file($_FILES['planeFloor']['tmp_name'],$floorEdit->getPlaneFloor());
                    $link = $floorEdit->findLinkPlane($buildingid, $floorid);
                    unlink($link);
                }
                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $floorEdit->updateFloor($buildingid, $floorid);
                $flashMessageSuccess = sprintf($strings["Floor \"%s\" successfully updated."], $floorEdit->getNameFloor());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("FLOOR_Controller.php", "index&building=", $floorEdit->getIdBuilding());
            }catch(Exception $errors) {
                    $view->setFlashDanger($strings[$errors->getMessage()]);
                    $view->redirect("FLOOR_Controller.php", "edit&building=$buildingid&floor=", $floorid);
            }
        } else {
            $floor = new FLOOR_Model($buildingid, $floorid);
            $values = $floor->findFloor();
            new FLOOR_EDIT($values);
        }

    break;


    case  $strings['Show']:

        // if (!isset($_SESSION['LOGIN'])){
        //     $view->setFlashDanger($strings["Not in session. Show the floors requires login"]);
        //      $view->redirect("USER_Controller.php", "index");
        // }

        if (!isset($_GET['building']) && !isset($_GET['floor'])){
            $view->setFlashDanger($strings["Building and floor id is mandatory"]);
            $view->redirect("BUILDING_Controller.php", "");
        }
        $buildingid = $_GET["building"];
        $floorid = $_GET['floor'];

        // if(!checkRol('SHOW', $function)){
        //     $view->setFlashDanger($strings["You do not have the necessary permits"]);
        //     $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
        // }
        
        $floor = new FLOOR_Model($buildingid, $floorid);
        $values = $floor->findFloor();
        new FLOOR_SHOW($values);
         
    break;


    case  $strings['Delete']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Show the floors requires login"]);
            $view->redirect("USER_Controller.php", "index");
        }

        if (!isset($_GET['building']) && !isset($_GET['floor'])){
            $view->setFlashDanger($strings["Building is mandatory"]);
            $view->redirect("BUILDING_Controller.php", "");
        }
        $buildingid = $_GET['building'];
        $floorid = $_GET['floor'];

        if(!checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
        }
        $floor = new FLOOR_Model($buildingid, $floorid);
                
        if (!$floor->existsFloor()) {
            $view->setFlashDanger($strings["No exist floor to delete"]);
            $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
        }

        try{
            rmdir('../document/Buildings/'.$floor->getIdBuilding().'/'.$floor->getIdBuilding().$floor->getIdFloor());
            $floor->deleteFloor();
            $flashMessageSuccess = sprintf($strings["Floor \"%s\" successfully deleted."], $buildingid.$floorid);
            $view->setFlashSuccess($flashMessageSuccess);
            $view->redirect("FLOOR_Controller.php", "index&building=", $floor->getIdBuilding());
        }catch(Exception $errors) {
            $view->setFlashDanger($strings[$errors->getMessage()]);
            $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
    }

    break;

    case  $strings['Show Plane']:

        // if (!isset($_SESSION['LOGIN'])){
        //     $view->setFlashDanger($strings["Not in session. Show the floors requires login"]);
        //     $view->redirect("USER_Controller.php", "index");
        // }

        if (!isset($_GET['building']) && !isset($_GET['floor'])){
            $view->setFlashDanger($strings["Building and floor id is mandatory"]);
            $view->redirect("BUILDING_Controller.php", "");
        }
        $buildingid = $_GET["building"];
        $floorid = $_GET['floor'];

        // if(!checkRol('SHOW', $function)){
        //     $view->setFlashDanger($strings["You do not have the necessary permits"]);
        //     $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
        // }
        
        $space = new SPACE_Model($buildingid, $floorid);
        $spacesValues = $space->showAllSpaces();
        
        $floor = new FLOOR_Model($buildingid, $floorid);
        $planeFloor = $floor->findLinkPlane($buildingid, $floorid);
        $infoFloor = $floor->findInfoFloor();

        new FLOOR_SHOW_PLANE($spacesValues, $planeFloor, $infoFloor);
        
    break;
    

    default:
                    
        // if (!isset($_SESSION['LOGIN'])){
        //     $view->setFlashDanger($strings["Not in session. Show the floors requires login"]);
        //     $view->redirect("USER_Controller.php", "");
        // }

        // if(!checkRol('SHOWALL', $function)){
        //     $view->setFlashDanger($strings["You do not have the necessary permits"]);
        //     $view->redirect("BUILDING_Controller.php", "");
        // }

        if(isset($_GET['building'])){
            $floor = new FLOOR_Model($_GET['building']);
            $building = new BUILDING_Model($_GET['building']);
            $buildingName = $building->findBuildingName();
            $floors = $floor->showAllFloors();
            new FLOOR_SHOWALL($floors, $buildingName);
        } else {
            $view->setFlashDanger($strings["Building is mandatory"]);
            $view->redirect("BUILDING_Controller.php", "");
        }
               
    break;
}

?>
