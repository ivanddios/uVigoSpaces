<?php

require_once(__DIR__."../../core/ViewManager.php");
require_once(__DIR__."../../core/ACL.php");
require_once(__DIR__."../../model/BUILDING_Model.php");
require_once(__DIR__."../../model/FLOOR_Model.php");
require_once(__DIR__."../../model/SPACE_Model.php");
require_once(__DIR__."../../view/SPACE_SHOWALL_View.php");
require_once(__DIR__."../../view/SPACE_ADD_View.php");
require_once(__DIR__."../../view/SPACE_EDIT_View.php");
require_once(__DIR__."../../view/SPACE_SHOW_View.php");
require_once(__DIR__."../../view/SPACE_SELECT_PLANE_View.php");
require_once(__DIR__."../../view/SPACE_EDIT_PLANE_View.php");
require_once(__DIR__."../../view/SPACE_SHOW_PLANE_View.php");

$function = "SPACE";
$view = new ViewManager();

include '../locate/Strings_'.$_SESSION['LANGUAGE'].'.php';


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

    case  $strings['Add']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add space requires login."]);
            $view->redirect("USER_Controller.php");
        } 

        if(!isset($_GET['building']) && !isset($_GET['floor'])){
            $view->setFlashDanger($strings["Building and floor id is mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $buildingid = $_GET['building'];
        $floorid = $_GET['floor'];

        if(!checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("SPACE_Controller.php", $strings['Add']."&building=".$buildingid, "&floor=".$floorid);
        }

        if (isset($_POST["submit"])) { 
            $space = get_data_form();
            $addAnswer = $space->addSpace();
            if($addAnswer === true){
                $flashMessageSuccess = sprintf($strings["Space \"%s\" successfully added."], $space->getNameSpace());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("SPACE_Controller.php", "SelectSpacePlane&building=".$buildingid, "&floor=".$floorid."&space=".$space->getIdSpace());
            }else{
                $view->setFlashDanger($strings[$addAnswer]);
                $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
            }   

        } else {
            new SPACE_ADD($buildingid, $floorid);
        }
 
    break;



    case  $strings['Edit']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit spaces requires login."]);
            $view->redirect("USER_Controller.php");
        }

		if(!checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
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
                $view->redirect("SPACE_Controller.php", $strings['Edit']."&building=".$spaceEdit->getIdBuilding()."&floor=".$spaceEdit->getIdFloor(), "&space=".$spaceid);
            }

        } else {
            $space = new SPACE_Model($buildingid, $floorid, $spaceid);
            $values = $space->findSpace();
            $floorPlane = $space->findPlane();
            new SPACE_EDIT($values, $floorPlane);
        }

    break;


    case  $strings['Show']:

        if (!isset($_GET['building']) && !isset($_GET['floor']) && !isset($_GET['space'])){
            $view->setFlashDanger($strings["Building, floor and space id are mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $buildingid = $_GET["building"];
        $floorid = $_GET['floor'];
        $spaceid = $_GET['space'];
        $space = new SPACE_Model($buildingid, $floorid, $spaceid);
        $values = $space->findSpace();
        $floorPlane = $space->findPlane();
        new SPACE_SHOW($values, $floorPlane);
         
    break;


    case  $strings['Delete']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete spaces requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
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


    case  $strings['SelectSpacePlane']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add space requires login."]);
            $view->redirect("USER_Controller.php");
        } 

        if(!isset($_GET['building']) && !isset($_GET['floor'])){
            $view->setFlashDanger($strings["Building and floor id is mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $buildingid = $_GET['building'];
        $floorid = $_GET['floor'];
        $spaceid = $_GET['space'];

        if (isset($_POST["submit"])) { 
            $spacePlane = new SPACE_Model($buildingid, $floorid, $spaceid,'','','', $_POST['coordsSpace']);
            $answerCords = $spacePlane->addCoords();
            if($answerCords === true){
                $view->setFlashSuccess($strings["Plane successfully updated"]);
                $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
            }else {
                $view->setFlashDanger($strings[$answerCords]);
                $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
            }   
        } else {
                $space = new SPACE_Model($buildingid, $floorid, $spaceid);
                $spaceValues = $space->findSpace();
                $floorPlane = $space->findPlane();
                new SPACE_SELECT_PLANE($spaceValues, $floorPlane);
        }

    break;

    case  $strings['ShowSpacePlane']:

        if(!isset($_GET['building']) && !isset($_GET['floor'])){
            $view->setFlashDanger($strings["Building and floor id is mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $buildingid = $_GET['building'];
        $floorid = $_GET['floor'];
        $spaceid = $_GET['space'];

        $space = new SPACE_Model($buildingid, $floorid, $spaceid);
        $spaceValues = $space->findInfoSpace();
        $floorPlane = $space->findPlane();
        new SPACE_SHOW_PLANE($spaceValues, $floorPlane);

    break;


    case  $strings['EditSpacePlane']:

    if (!isset($_SESSION['LOGIN'])){
        $view->setFlashDanger($strings["Not in session. Add space requires login."]);
        $view->redirect("USER_Controller.php", "");
    } 

    if(!isset($_GET['building']) && !isset($_GET['floor'])){
        $view->setFlashDanger($strings["Building and floor id is mandatory"]);
        $view->redirect("BUILDING_Controller.php", "");
    }

    $buildingid = $_GET['building'];
    $floorid = $_GET['floor'];
    $spaceid = $_GET['space'];

     if (isset($_POST["submit"])) { 
            $spacePlane = new SPACE_Model($buildingid, $floorid, $spaceid,'','','', $_POST['coordsSpace']);
            $answerCoords = $spacePlane->addCoords();
            if($answerCoords === true){
                $view->setFlashSuccess($strings["Plane successfully updated"]);
                $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
            }else {
                $view->setFlashDanger($strings[$answerCoords]);
                $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
            }   
    } else {
        $space = new SPACE_Model($buildingid, $floorid, $spaceid);
        $spaceValues = $space->findSpace();
        $floorPlane = $space->findPlane();
        new SPACE_EDIT_PLANE($spaceValues, $floorPlane);
    }

    break;
    

    default:
                    
        if(isset($_GET['building']) && isset($_GET['floor'])){
            $spaces = new SPACE_Model($_GET['building'],$_GET['floor']);
            $spaces = $spaces->showAllSpaces();

            $building = new BUILDING_Model($_GET['building']);
            $buildingName = $building->getBuildingName();

            $floor = new FLOOR_Model($_GET['building'], $_GET['floor']);
            $floorName = $floor->getFloorName();

            new SPACE_SHOWALL($spaces, $buildingName, $floorName);
        } else {
            $view->setFlashDanger($strings["Building and floor is mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }
               
    break;
}

?>
