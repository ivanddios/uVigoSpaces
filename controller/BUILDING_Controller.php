<?php

/**
* File: BUILDING_Controller
*
* Script that controller to add new building, edit building, delete building, show building
* and show all building
*
* @author ivanddios <ivanddios1994@gmail.com>
*/

require_once("../core/ViewManager.php");
require_once("../model/BUILDING_Model.php");
require_once("../view/BUILDING_SHOWALL_View.php");
require_once("../view/BUILDING_ADD_View.php");
require_once("../view/BUILDING_EDIT_View.php");
require_once("../view/BUILDING_SHOW_View.php");

$function = "BUILDING";
$view = new ViewManager();
include '../view/locate/Strings_'.$_SESSION['LANGUAGE'].'.php';


/**
* Gets values from the building's forms
*
* @return Bulding with the form values
*/
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

/**
 * Evaluates the 'action' parameter passed for URL
 * For each action, the controller checks if the user is logged and if the user has the permissions necessary.
 * 
 * The controller calls a view (with building data or no, depending the action).
 * 
 * The controller gets the forms' data of the views and call the Building model to make the actions against the database.
 */
Switch ($_GET['action']){

    case  'Add':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add buildings requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if the user can add a new building
        if(!$view->checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php");
        }

        /**
        * @if Checks if exists $_POST gets the form's data, instances a new object Building, 
        * checks if the data are valids and adds the building to database
        */
        if (isset($_POST["submit"])) { 
            $buildingAdd = get_data_form();
            $answerAdd = $buildingAdd->addBuilding();
            /**
            * @if The controller notices the user if the operation was successfully
            * 
            * @else Returns the error message
            */
            if($answerAdd === true){
                $flashMessageSuccess = sprintf($strings["Building \"%s\" successfully added."], $buildingAdd->getNameBuilding());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("BUILDING_Controller.php");
            }else{
                $view->setFlashDanger($strings[$answerAdd]);
                $view->redirect("BUILDING_Controller.php", 'Add');
            }   
        } else {
            new BUILDING_ADD();
        }
           	       
    break;


    case  'Edit':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit buildings requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if the user can modify building
        if(!$view->checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php");
        }

        //@if Checks if exists the building parameter passed by GET
        if (!isset($_GET['building'])){
            $view->setFlashDanger($strings["Building id is mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }
        $buildingid = $_GET['building'];

        /**
        * @if Checks if exists $_POST gets the form's data, instances a new object Building, 
        * checks if the data are valids and modifies the building in database.
        *
        * @else Otherwise, checks if exists anything building with the identifier passed by GET
        * gets the buildings values and shows it in ACTION_EDIT_View.
        */
        if (isset($_POST["submit"])) { 
            $buildingEdit = get_data_form();
            $answerEdit = $buildingEdit->updateBuilding();
            if($answerEdit === true){
                $flashMessageSuccess = sprintf($strings["Building \"%s\" successfully updated."], $buildingEdit->getNameBuilding());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("BUILDING_Controller.php");   
            }else{
                $view->setFlashDanger($strings[$answerEdit]);
                $view->redirect("BUILDING_Controller.php", 'Edit');
            }
        } else {
            $building = new BUILDING_Model($buildingid);
            if($building->existsBuilding()){
                $buildingValues = $building->getBuilding();
                new BUILDING_EDIT($buildingValues);
            } else{
                $view->setFlashDanger($strings["There isn't a building with that identifier"]);
                $view->redirect("BUILDING_Controller.php");
            }
            
        }
            
    break;



    case  'Show':

        //@if Checks if exists the building parameter passed by GET
        if (!isset($_GET['building'])){
            $view->setFlashDanger($strings["Building id is mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }
        $buildingid = $_GET['building'];

        $building = new BUILDING_Model($buildingid);
        /**
        * @if Checks if exists anything building with the identifier passed by GET
        * gets the building values and shows it in BUILDING_SHOW_View.
        */
        if($building->existsBuilding()){
            $buildingValues = $building->getBuilding();
            new BUILDING_SHOW($buildingValues);
        }else{
            $view->setFlashDanger($strings["There isn't a building with that identifier"]);
            $view->redirect("BUILDING_Controller.php");
        }

    break;


    case  'Delete':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete buildings requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if the user can delete building
        if(!$view->checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php");
        }

        //@if Checks if exists the building parameter passed by GET
        if (!isset($_POST['building'])){
            $view->setFlashDanger($strings["Building id is mandatory"]);
            $view->redirect("BUILDING_Controller.php");
        }

        //Gets building identifier and try delete the building with this id from the database
        $buildingDelete = new BUILDING_Model($_POST['building']);
        $buildingID = $buildingDelete->getIdBuilding();
        $answerDelete = $buildingDelete->deleteBuilding();
        //Redirects the user and informs the user with a message
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
        //Gets all buildings from the database
        $building = new BUILDING_Model();
        $buildings = $building->getAllBuilding();
        new BUILDING_SHOWALL($buildings);  
    break;
}

?>
