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
    $coordsPlane = $_POST['coordsSpace'];
   
    $space = new SPACE_Model($idBuilding, $idFloor, $idSpace, $nameSpace, $surfaceSpace, $numInventorySpace, $coordsPlane);
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
            $spaceAdd = get_data_form();
            
            try{
                $spaceAdd->checkIsValidForAdd();
                $spaceAdd->addSpace(); 
                $flashMessageSuccess = sprintf($strings["Space \"%s\" successfully added."], $spaceAdd->getNameSpace());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("SPACE_Controller.php", "SelectSpacePlane&building=".$buildingid, "&floor=".$floorid."&space=".$spaceAdd->getIdSpace());
            }catch(Exception $errors) {
                $view->setFlashDanger($strings[$errors->getMessage()]);
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

        $buildingid = $_GET["building"];
        $floorid = $_GET['floor'];
        $spaceid = $_GET['space'];

        if (isset($_POST["submit"])) { 
            $spaceEdit = get_data_form();
            try{
                $spaceEdit->checkIsValidForEdit($spaceid);
                $spaceEdit->updateSpace($buildingid, $floorid, $spaceid);
                $flashMessageSuccess = sprintf($strings["Space \"%s\" successfully updated."], $spaceEdit->getNameSpace());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
            }catch(Exception $errors) {
                $view->setFlashDanger($strings[$errors->getMessage()]);
                $view->redirect("SPACE_Controller.php", $strings['Edit']."&building=".$buildingid."&floor=".$floorid, "&space=".$spaceid);
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
                
        if (!$space->existsSpace()) {
            $view->setFlashDanger($strings["No exist space to delete"]);
            $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
        }

        try{
            $space->deleteSpace();
            $flashMessageSuccess = sprintf($strings["Space \"%s\" successfully deleted."], $buildingid.$floorid.$spaceid);
            $view->setFlashSuccess($flashMessageSuccess);
            $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
        }catch(Exception $errors) {
            $view->setFlashDanger($strings[$errors->getMessage()]);
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
          
            $spacePlane = get_data_form();
            
            try{
                $spacePlane->addCoords(); 
                $view->setFlashSuccess($strings["Plane successfully updated"]);
                $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
            }catch(Exception $errors) {
                $view->setFlashDanger($strings[$errors->getMessage()]);
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
        $spacePlane = get_data_form();
        
        try{
            $spacePlane->addCoords(); 
            $view->setFlashSuccess($strings["Plane successfully updated"]);
            $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
        }catch(Exception $errors) {
            $view->setFlashDanger($strings[$errors->getMessage()]);
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
            $buildingName = $building->findBuildingName();

            $floor = new FLOOR_Model($_GET['building'], $_GET['floor']);
            $floorName = $floor->findFloorName();

            new SPACE_SHOWALL($spaces, $buildingName, $floorName);
        } else {
            $view->setFlashDanger($strings["Building and floor is mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }
               
    break;
}

?>
