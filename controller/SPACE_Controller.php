<?php

require_once("../core/ViewManager.php");
require_once("../model/BUILDING_Model.php");
require_once("../model/FLOOR_Model.php");
require_once("../model/SPACE_Model.php");
require_once("../view/SPACE_SHOWALL_View.php");
require_once("../view/SPACE_ADD_View.php");
require_once("../view/SPACE_EDIT_View.php");
require_once("../view/SPACE_SHOW_View.php");
require_once("../view/SPACE_SELECTUBICATION_View.php");
require_once("../view/SPACE_SHOWUBICATION_View.php");

$function = "SPACE";
$view = new ViewManager();

include '../view/locate/Strings_'.$_SESSION['LANGUAGE'].'.php';


function get_data_form() {

    $idBuilding = $_POST['idBuilding'];
    $idFloor = $_POST['idFloor'];
    $idSpace = $_POST['idSpace'];
    $nameSpace = $_POST['nameSpace'];
    $surfaceSpace = $_POST['surfaceSpace'];
    $numInventorySpace = $_POST['numberInventorySpace'];
   
    $space = new SPACE_Model($idBuilding, $idFloor, $idSpace, $nameSpace, $surfaceSpace, $numInventorySpace);
    return $space;
}


if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}

Switch ($_REQUEST['action']){

    case 'Add':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add space requires login."]);
            $view->redirect("USER_Controller.php");
        } 

        if(!isset($_GET['building']) && !isset($_GET['floor'])){
            $view->setFlashDanger($strings["Building and floor id are mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $buildingid = $_GET['building'];
        $floorid = $_GET['floor'];

        if(!$view->checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("SPACE_Controller.php", 'Add'."&building=".$buildingid, "&floor=".$floorid);
        }

        if (isset($_POST["submit"])) { 
            $space = get_data_form();
            $addAnswer = $space->addSpace();
            if($addAnswer === true){
                $flashMessageSuccess = sprintf($strings["Space \"%s\" successfully added."], $space->getNameSpace());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("SPACE_Controller.php", "SelectSpacePlan&building=".$buildingid, "&floor=".$floorid."&space=".$space->getIdSpace());
            }else{
                $view->setFlashDanger($strings[$addAnswer]);
                $view->redirect("SPACE_Controller.php","Add&building=".$buildingid, "&floor=".$floorid."&space=".$space->getIdSpace());
            }   

        } else {
            new SPACE_ADD($buildingid, $floorid);
        }
 
    break;



    case  'Edit':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit spaces requires login."]);
            $view->redirect("USER_Controller.php");
        }

		if(!$view->checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
        }
                
        if (!isset($_GET['building']) && !isset($_GET['floor']) && !isset($_GET['space'])){
            $view->setFlashDanger($strings["Building, floor and space id are mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $buildingid = $_GET['building'];
        $floorid = $_GET['floor'];
        $spaceid = $_GET['space'];

        if (isset($_POST["submit"])) { 
            $spaceEdit = get_data_form();
            $updateAnswer = $spaceEdit->updateSpace($spaceid);
            if($updateAnswer === true){
                $flashMessageSuccess = sprintf($strings["Space \"%s\" successfully updated."], $spaceEdit->getNameSpace());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("SPACE_Controller.php", "index&building=".$spaceEdit->getIdBuilding(), "&floor=".$spaceEdit->getIdFloor());
            }else{
                $view->setFlashDanger($strings[$updateAnswer]);
                $view->redirect("SPACE_Controller.php", "Edit&building=".$spaceEdit->getIdBuilding()."&floor=".$spaceEdit->getIdFloor(), "&space=".$spaceid);
            }

        } else {
            $space = new SPACE_Model($buildingid, $floorid, $spaceid);
            $values = $space->findSpace();
            $floorplan = $space->findplan();
            new SPACE_EDIT($values, $floorplan);
        }

    break;


    case  'Show':

        if (!isset($_GET['building']) && !isset($_GET['floor']) && !isset($_GET['space'])){
            $view->setFlashDanger($strings["Building, floor and space id are mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $buildingid = $_GET["building"];
        $floorid = $_GET['floor'];
        $spaceid = $_GET['space'];
        $space = new SPACE_Model($buildingid, $floorid, $spaceid);
        $values = $space->findSpace();
        $floorplan = $space->findplan();
        new SPACE_SHOW($values, $floorplan);
         
    break;


    case  'Delete':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete spaces requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!$view->checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
        }

        if (!isset($_GET['building']) && !isset($_GET['floor']) && !isset($_GET['space'])){
            $view->setFlashDanger($strings["Building, floor and space id are mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $buildingid = $_GET["building"];
        $floorid = $_GET['floor'];
        $spaceid = $_GET['space'];
        $space = new SPACE_Model($buildingid, $floorid, $spaceid);
        $deleteAnswer = $space->deleteSpace();
        if($deleteAnswer === true){
            $flashMessageSuccess = sprintf($strings["Space \"%s\" successfully deleted."], $buildingid.$floorid.$spaceid);
            $view->setFlashSuccess($flashMessageSuccess);
            $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
        }else{
            $view->setFlashDanger($strings[$deleteAnswer]);
            $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
        }

    break;


    case  'SelectSpacePlan':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add space requires login."]);
            $view->redirect("USER_Controller.php");
        } 

        if(!$view->checkRol('SELECT', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
        }

        if(!isset($_GET['building']) && !isset($_GET['floor']) && !isset($_GET['space'])){
            $view->setFlashDanger($strings["Building and floor id are mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $buildingid = $_GET['building'];
        $floorid = $_GET['floor'];
        $spaceid = $_GET['space'];

        if (isset($_POST["submit"])) { 
            $spaceplan = new SPACE_Model($buildingid, $floorid, $spaceid,'','','', $_POST['coordsSpace']);
            $answerCords = $spaceplan->addCoords();
            if($answerCords === true){
                $view->setFlashSuccess($strings["Space successfully updated in plan"]);
                $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
            }else {
                $view->setFlashDanger($strings[$answerCords]);
                $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
            }   
        } else {
                $space = new SPACE_Model($buildingid, $floorid, $spaceid);
                $spaceValues = $space->findSpace();
                $floorplan = $space->findplan();
                new SPACE_SELECTUBICATION($spaceValues, $floorplan);
        }

    break;

    case  'ShowSpacePlan':

        if(!isset($_GET['building']) && !isset($_GET['floor'])){
            $view->setFlashDanger($strings["Building and floor id are mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $buildingid = $_GET['building'];
        $floorid = $_GET['floor'];
        $spaceid = $_GET['space'];

        $space = new SPACE_Model($buildingid, $floorid, $spaceid);
        $spaceValues = $space->findInfoSpace();
        $floorplan = $space->findplan();
        new SPACE_SHOWUBICATION($spaceValues, $floorplan);

    break;
    

    default:
                    
        if(isset($_GET['building']) && isset($_GET['floor'])){
            $spaces = new SPACE_Model($_GET['building'],$_GET['floor']);
            $spaces = $spaces->showAllSpaces();

            $building = new BUILDING_Model($_GET['building']);
            $building_values = $building->getBuilding();

            $floor = new FLOOR_Model($_GET['building'], $_GET['floor']);
            $floor_values = $floor->getFloor();

            new SPACE_SHOWALL($spaces, $building_values, $floor_values);
        } else {
            $view->setFlashDanger($strings["Building and floor is mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }
               
    break;
}

?>
