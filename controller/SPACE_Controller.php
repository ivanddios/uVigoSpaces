<?php

/**
* File: SPACE_Controller
*
* Script that controller to add new space, edit space, delete space, show space
* show all spaces, show the space' location, modify the space location and show the space location 
*
* @author ivanddios <ivanddios1994@gmail.com>
*/


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


/**
* Gets values from the forms
*
* @return Space with the form values
*/
function get_data_form() {
    $idBuilding = $_POST['idBuilding'];
    $idFloor = $_POST['idFloor'];
    $idSpace = $_POST['idSpace'];
    $categorySpace = $_POST['categorySpace'];
    $nameSpace = $_POST['nameSpace'];
    $surfaceSpace = $_POST['surfaceSpace'];
    $numInventorySpace = $_POST['numberInventorySpace'];
    $space = new SPACE_Model($idBuilding, $idFloor, $idSpace, $categorySpace, $nameSpace, $surfaceSpace, $numInventorySpace);
    return $space;
}


if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}


/**
 * Evaluates the 'action' parameter passed for URL
 * For each action, the controller checks if the user is logged and if the user has the permissions necessary.
 * 
 * The controller calls a view (with floor data or no, depending the action).
 * 
 * The controller gets the forms' data of the views and call the Space model to make the actions against the database.
 */
Switch ($_REQUEST['action']){

    case 'Add':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add space requires login."]);
            $view->redirect("USER_Controller.php");
        } 

        //@if Checks if exists the building and floor parameters passed by GET
        if(!isset($_GET['building']) && !isset($_GET['floor'])){
            $view->setFlashDanger($strings["Building and floor id are mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $buildingid = $_GET['building'];
        $floorid = $_GET['floor'];

        //@if Checks if the user can add a new space
        if(!$view->checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("SPACE_Controller.php", 'Add'."&building=".$buildingid, "&floor=".$floorid);
        }

        /**
        * @if Checks if exists $_POST gets the form's data, instances a new object Space, 
        * checks if the data are valids and adds the space to database
        */
        if (isset($_POST["submit"])) { 
            $space = get_data_form();
            $addAnswer = $space->addSpace();
            /**
            * @if The controller notices the user if the operation was successfully
            * 
            * @else Returns the error message
            */
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



    case 'Edit':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit spaces requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if the user can edit a space
		if(!$view->checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
        }
                
        //@if Checks if exists the building, floor and space parameters passed by GET
        if (!isset($_GET['building']) && !isset($_GET['floor']) && !isset($_GET['space'])){
            $view->setFlashDanger($strings["Building, floor and space id are mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $buildingid = $_GET['building'];
        $floorid = $_GET['floor'];
        $spaceid = $_GET['space'];

        /**
        * @if Checks if exists $_POST gets the form's data, instances a new object Space, 
        * checks if the data are valids and modifies the space in database.
        *
        * @else Otherwise, checks if exists anything space with the identifier passed by GET
        * gets the spaces values and shows it in SPACE_EDIT_View.
        */
        if (isset($_POST["submit"])) { 
            $spaceEdit = get_data_form();
            $updateAnswer = $spaceEdit->updateSpace($spaceid);
            /**
            * @if The controller notices the user if the operation was successfully
            * 
            * @else Returns the error message
            */
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
            if($space->existsSpace()){
                $values = $space->findSpace();
                $floorplan = $space->findplan();
                new SPACE_EDIT($values, $floorplan);
            }else{
                $view->setFlashDanger($strings["There isn't a space with that identifier in the floor"]);
                $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
            }
        }

    break;


    case  'Show':

        //@if Checks if exists the building, floor and space parameters passed by GET
        if (!isset($_GET['building']) && !isset($_GET['floor']) && !isset($_GET['space'])){
            $view->setFlashDanger($strings["Building, floor and space id are mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $buildingid = $_GET["building"];
        $floorid = $_GET['floor'];
        $spaceid = $_GET['space'];
        $space = new SPACE_Model($buildingid, $floorid, $spaceid);
        /**
        * @if Checks if exists anything space with the identifier passed by GET
        * gets the space values and shows it in SPACE_SHOW_View.
        */
        if($space->existsSpace()){
            $values = $space->findSpace();
            $floorplan = $space->findplan();
            new SPACE_SHOW($values, $floorplan);
        }else{
            $view->setFlashDanger($strings["There isn't a space with that identifier in the floor"]);
            $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
        }
         
    break;


    case 'Delete':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete spaces requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if the user can delete a space
        if(!$view->checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
        }

        //@if Checks if exists the building, floor and space parameters passed by GET
        if (!isset($_GET['building']) && !isset($_GET['floor']) && !isset($_GET['space'])){
            $view->setFlashDanger($strings["Building, floor and space id are mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $buildingid = $_GET["building"];
        $floorid = $_GET['floor'];
        $spaceid = $_GET['space'];
        //Gets building, floor and space identifier and try delete the space with this ids from the database
        $space = new SPACE_Model($buildingid, $floorid, $spaceid);
        $deleteAnswer = $space->deleteSpace();
        //Redirects the user and informs the user with a message
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

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add space requires login."]);
            $view->redirect("USER_Controller.php");
        } 
        //@if Checks if the user select a space's ubication
        if(!$view->checkRol('SELECT', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
        }

        //@if Checks if exists the building, floor and space parameters passed by GET
        if(!isset($_GET['building']) && !isset($_GET['floor']) && !isset($_GET['space'])){
            $view->setFlashDanger($strings["Building and floor id are mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $buildingid = $_GET['building'];
        $floorid = $_GET['floor'];
        $spaceid = $_GET['space'];

        /**
        * @if Checks if exists $_POST gets the form's data, instances a new object Array, 
        * checks if the data are valids and adds the space's coords to database
        */
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
        } else{
            $space = new SPACE_Model($buildingid, $floorid, $spaceid);
            if($space->existsSpace()){
                $spaceValues = $space->findSpace();
                $floorplan = $space->findplan();
                new SPACE_SELECTUBICATION($spaceValues, $floorplan);
            } else{
                $view->setFlashDanger($strings["There isn't a space with that identifier in the floor"]);
                $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
            }
        }

    break;

    case  'ShowSpacePlan':

        //@if Checks if exists the building and floor parameters passed by GET
        if(!isset($_GET['building']) && !isset($_GET['floor'])){
            $view->setFlashDanger($strings["Building and floor id are mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $buildingid = $_GET['building'];
        $floorid = $_GET['floor'];
        $spaceid = $_GET['space'];

        $space = new SPACE_Model($buildingid, $floorid, $spaceid);
        /**
         * @if Checks if the space exists and gets its information and the floor's plane where the space is
         * 
         * @else Error message. Redirects the user
         */
        if($space->existsSpace()){
            $spaceValues = $space->findInfoSpace();
            $floorplan = $space->findplan();
            new SPACE_SHOWUBICATION($spaceValues, $floorplan);
        } else{
            $view->setFlashDanger($strings["There isn't a space with that identifier in the floor"]);
            $view->redirect("SPACE_Controller.php", "index&building=".$buildingid, "&floor=".$floorid);
        }

    break;
    

    default:
        
        //@if Checks if exists the building and floor parameters passed by GET
        if(isset($_GET['building']) && isset($_GET['floor'])){
            $spaces = new SPACE_Model($_GET['building'],$_GET['floor']);
            $spaces = $spaces->showAllSpaces();

            //Gets information of all spaces of a plant
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
