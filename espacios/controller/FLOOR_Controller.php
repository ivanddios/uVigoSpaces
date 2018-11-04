<?php

require_once(__DIR__."..\..\core\ViewManager.php");
include '../model/BUILDING_Model.php';
include '../model/FLOOR_Model.php';
include '../view/FLOOR_SHOWALL_View.php';
include '../view/FLOOR_EDIT_View.php';
include '../view/FLOOR_ADD_View.php';
include '../view/FLOOR_SHOW_View.php';
include '../core/ACL.php';

$function = "FLOOR";
$view = new ViewManager();

include '../locate/Strings_'.$_SESSION['LANGUAGE'].'.php';


function get_data_form() {

    $idBuilding = $_POST['idBuilding'];
    $idFloor = $_POST['idFloor'];
    $nameFloor = $_POST['nameFloor'];
    

    if (isset($_FILES['planeFloor']['name']) && ($_FILES['planeFloor']['name'] !== '')) {
        $planeFloor = '../document/'.$idBuilding.'/'.$idBuilding.$idFloor.'/'.$_FILES['planeFloor']['name'];
    } else {
        $planeFloor = $_POST['planeFloorOriginal'];
    }

    $surfaceBuildingFloor = $_POST['surfaceBuildingFloor'];
    $surfaceUsefulFloor = $_POST['surfaceUsefulFloor'];
   
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

            ////////////////////////////////////////METER EN UNA FUNCIÓN////////////////////////////////////////////////////////////
            $dirPlane = '../document/'.$floorAdd->getIdBuilding().'/'.$floorAdd->getIdBuilding().$floorAdd->getIdFloor().'/';
            if ($_FILES['planeFloor']['name'] !== '') {
                if (!file_exists($dirPlane)) {
                    mkdir($dirPlane, 0777, true);
                }
                move_uploaded_file($_FILES['planeFloor']['tmp_name'],$floorAdd->getPlaneFloor());
            }
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $consult = $floorAdd->addFloor(); 
            if($consult){
                $flashMessageSuccess = sprintf($strings["Floor \"%s\" successfully added."], $floorAdd->getNameFloor());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("FLOOR_Controller.php", "index&building=", $floorAdd->getIdFloor());
            } else {
                $view->setFlashDanger($strings[$consult]);
                $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
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
                    
            ////////////////////////////////////////METER EN UNA FUNCIÓN////////////////////////////////////////////////////////////
            $dirPlane = '../document/'.$floorEdit->getIdBuilding().'/'.$floorEdit->getIdBuilding().$floorEdit->getIdFloor().'/';
            if ($_FILES['planeFloor']['name'] !== '') {
                if (!file_exists($dirPlane)) {
                    mkdir($dirPlane, 0777, true);
                }
                move_uploaded_file($_FILES['planeFloor']['tmp_name'],$floorEdit->getPlaneFloor());
                $link = $floorEdit->findLinkPlane($buildingid, $floorid);
                unlink($link);
            }
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $consult = $floorEdit->updateFloor($buildingid, $floorid);
            if($consult){
                $flashMessageSuccess = sprintf($strings["Floor \"%s\" successfully updated."], $floorEdit->getNameFloor());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("FLOOR_Controller.php", "index&building=", $floorEdit->getIdFloor());
            } else {
                $view->setFlashDanger($strings[$consult]);
                $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
            }
        } else {
            $floor = new FLOOR_Model($buildingid, $floorid);
            $values = $floor->fillInFloor();
            new FLOOR_EDIT($values);
        }

    break;


    case  $strings['Show']:

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
        
        $floor = new FLOOR_Model($buildingid, $floorid);
        $values = $floor->fillInFloor();
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

        //////////////////////////////////////////////////////////////////////////////////////
        $link = $floor->findLinkPlane($floor->getIdBuilding(), $floor->getIdFloor());
        unlink($link); 
        rmdir('../document/'.$floor->getIdBuilding().'/'.$floor->getIdBuilding().$floor->getIdFloor());
        /////////////////////////////////////////////////////////////////////////////////////

        $floorName = $floor->findNameFloor();
        $consult = $floor->deleteFloor();
        if($consult){
            $flashMessageSuccess = sprintf($strings["Floor \"%s\" successfully deleted."], $floorName);
            $view->setFlashSuccess($flashMessageSuccess);
            $view->redirect("FLOOR_Controller.php", "index&building=", $floor->getIdFloor());
        } else {
            $view->setFlashDanger($strings[$consult]);
            $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
        }

    break;
    

    default:
                    
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Show the floors requires login"]);
            $view->redirect("USER_Controller.php", "");
        }

        if(!checkRol('SHOWALL', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php", "");
        }

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
