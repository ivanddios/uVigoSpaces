<?php

/**
* File: FLOOR_Controller
*
* Script that controller to add new floor, edit floor, delete floor, show floor
* and show all floor, show floor's plane
*
* @author ivanddios <ivanddios1994@gmail.com>
*/

require_once("../core/ViewManager.php");
require_once("../model/BUILDING_Model.php");
require_once("../model/FLOOR_Model.php");
require_once("../model/SPACE_Model.php");
require_once("../view/FLOOR_SHOWALL_View.php");
require_once("../view/FLOOR_ADD_View.php");
require_once("../view/FLOOR_EDIT_View.php");
require_once("../view/FLOOR_SHOW_View.php");
require_once("../view/FLOOR_SHOWPLAN_View.php");

$function = "FLOOR";
$view = new ViewManager();
include '../view/locate/Strings_'.$_SESSION['LANGUAGE'].'.php';


/**
* Gets values from the forms
*
* @return FLOOR with the form values
*/
function get_data_form() {

    $idBuilding = $_POST['idBuilding'];
    $idFloor = $_POST['idFloor'];
    $nameFloor = $_POST['nameFloor'];
    $builtSurfaceFloor =  $_POST['builtSurfaceFloor'];
    $surfaceUsefulFloor =  $_POST['surfaceUsefulFloor'];
    $planFloor = $_FILES['planFloor'];

    $floor = new FLOOR_Model($idBuilding, $idFloor, $nameFloor, $planFloor, $builtSurfaceFloor, $surfaceUsefulFloor);
    return $floor;
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
 * The controller gets the forms' data of the views and call the Floor model to make the actions against the database.
 */
Switch ($_REQUEST['action']){

    case  'Add':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add floors requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if exists the building parameter passed by GET
        if (!isset($_GET['building'])){
            $view->setFlashDanger($strings["Building id is mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }
        $buildingid = $_GET['building'];

        //@if Checks if the user can add a new building's floor
        if(!$view->checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
        }

        /**
        * @if Checks if exists $_POST gets the form's data, instances a new object Floor, 
        * checks if the data are valids and adds the building's floor to database
        */
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

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit floors requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if exists the building and floor parameters passed by GET
        if (!isset($_GET['building']) && !isset($_GET['floor'])){
            $view->setFlashDanger($strings["Building and floor id are mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }
        $buildingid = $_GET["building"];
        $floorid = $_GET['floor'];

        //@if Checks if the user can modify a building's floor
		if(!$view->checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("FLOOR_Controller.php", "index&building=".$buildingid);
        }

        /**
        * @if Checks if exists $_POST gets the form's data, instances a new object Floor, 
        * checks if the data are valids and modifies the building's floor in database.
        *
        * @else Otherwise, checks if exists anything floor with the identifier passed by GET
        * gets the floors values and shows it in FLOOR_EDIT_View.
        */
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
            if($floor->existsFloor()){
                $values = $floor->getFloor();
                new FLOOR_EDIT($values);
            }else{
                $view->setFlashDanger($strings["There isn't a floor with that identifier in the building"]);
                $view->redirect("FLOOR_Controller.php", "index&building=".$buildingid);
            }
        }
    break;


    case  'Show':

        //@if Checks if exists the building and floor parameters passed by GET
        if (!isset($_GET['building']) && !isset($_GET['floor'])){
            $view->setFlashDanger($strings["Building and floor id are mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $buildingid = $_GET["building"];
        $floorid = $_GET['floor'];
 
        /**
        * @if Checks if exists anything building's floor with the identifier passed by GET
        * gets the building's floor values and shows it in FLOOR_SHOW_View.
        */
        $floor = new FLOOR_Model($buildingid, $floorid);
        if($floor->existsFloor()){
            $values = $floor->getFloor();
            new FLOOR_SHOW($values);
        } else{
            $view->setFlashDanger($strings["There isn't a floor with that identifier in the building"]);
            $view->redirect("FLOOR_Controller.php", "index&building=".$buildingid);
        }
         
    break;


    case  'Delete':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete floors requires login"]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if exists the building and floor parameters passed by GET
        if (!isset($_GET['building']) && !isset($_GET['floor'])){
            $view->setFlashDanger($strings["Building id is mandatory"]);
            $view->redirect("BUILDING_Controller.php", "");
        }
        $buildingid = $_GET['building'];
        $floorid = $_GET['floor'];

        //@if Checks if the user can delete a building's floor
        if(!$view->checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("FLOOR_Controller.php", "building=".$buildingid);
        }

        //Try to delete a building's floor from the database
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

        /**
        * Shows the floor's plan with the location of its spaces
        */

        //@if Checks if exists the building and floor parameters passed by GET
        if (!isset($_GET['building']) && !isset($_GET['floor'])){
            $view->setFlashDanger($strings["Building and floor id are mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $buildingid = $_GET["building"];
        $floorid = $_GET['floor'];
        /**
         * @if Checks if the floor exists and gets the information of all spaces that the floor contains and the floor
         * 
         * @else Error message. Redirects the user
         */
        $floor = new FLOOR_Model($buildingid, $floorid);
        if($floor->existsFloor()){
            $space = new SPACE_Model($buildingid, $floorid);
            $spacesValues = $space->showAllSpaces();
            $planFloor = $floor->getLinkplan();
            $infoFloor = $floor->getInfoFloor();
            new FLOOR_SHOWPLAN($spacesValues, $planFloor, $infoFloor);
        } else{
            $view->setFlashDanger($strings["There isn't a floor with that identifier in the building"]);
            $view->redirect("FLOOR_Controller.php", "index&building=".$buildingid);
        }

    break;
    

    default:    

        /**
         * @if Checks if exists the building parameters passed by GET and gets the floor's building information.
         * 
         * @else Error message. Redirects the user.
         */
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
