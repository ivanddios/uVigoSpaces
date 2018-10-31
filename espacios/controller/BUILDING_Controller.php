<?php

require_once(__DIR__."..\..\core\ViewManager.php");
include '../model/BUILDING_Model.php';
include '../view/BUILDING_SHOWALL_View.php';
include '../view/BUILDING_EDIT_View.php';
include '../view/BUILDING_SHOW_View.php';
include '../view/BUILDING_ADD_View.php';
include '../core/ACL.php';

$function = "BUILDING";
$back = 'BUILDING_Controller.php';
$view = new ViewManager();

include '../locate/Strings_'.$_SESSION['LANGUAGE'].'.php';

function get_data_form() {

    $idBuilding = $_POST['idBuilding'];
    $nameBuilding = $_POST['nameBuilding'];
    $addressBuilding = $_POST['addressBuilding'];
    $phoneBuilding = $_POST['phoneBuilding'];
    $responsibleBuilding = $_POST['responsibleBuilding'];
   
    $building = new BUILDING_Model($idBuilding, $nameBuilding, $addressBuilding, $phoneBuilding, $responsibleBuilding);
    return $building;
}


if (!isset($_GET['action'])){
	$_GET['action'] = '';
}

Switch ($_GET['action']){

    case  $strings['Add']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add floors requires login."]);
            $view->redirect("USER_Controller.php", "");
        }

        if(!checkRol('ADD', $function)){
            $view->setFlashDanger($strings["No tienes los permisos necesarios"]);
            $view->redirect("BUILDING_Controller.php", "");
        }

        if (isset($_POST["submit"])) { 
            $buildingAdd = get_data_form();
            $consult = $buildingAdd->addBuilding();
            
            if($consult){
                // $buildings = $buildingAdd->showAllBuilding();
                // $message=(sprintf($strings["Building \"%s\" successfully added."], $buildingAdd->getIdBuilding()));
                // new BUILDING_SHOWALL($buildings, '', $message);
                $flashMessageSuccess = sprintf($strings["Building \"%s\" successfully added."], $buildingAdd->getNameBuilding());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("BUILDING_Controller.php", "");
            } else {
                $view->setFlashDanger($strings[$consult]);
                $view->redirect("BUILDING_Controller.php", "");
            }
        } else {
            new BUILDING_ADD();
        }
           	       
    break;


    case  $strings['Edit']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit floors requires login."]);
            $view->redirect("USER_Controller.php", "");
        }

        if(!checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["No tienes los permisos necesarios"]);
            $view->redirect("BUILDING_Controller.php", "");
        }

        if (!isset($_GET['building'])){
            $view->setFlashDanger($strings["Building id is mandatory"]);
            $view->redirect("BUILDING_Controller.php", "");
        }
        $buildingid = $_GET['building'];

        if (isset($_POST["submit"])) { 
            $buildingEdit = get_data_form();
            $consult = $buildingEdit->updateBuilding($buildingid);
            if($consult){
                $flashMessageSuccess = sprintf($strings["Building \"%s\" successfully updated."], $buildingEdit->getNameBuilding());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("BUILDING_Controller.php", "");     
            } else {
                $view->setFlashDanger($strings[$consult]);
                $view->redirect("BUILDING_Controller.php", "");
            }
        } else {
            $building = new BUILDING_Model($buildingid,'','','','');
            $values = $building->fillInBuilding();
            new BUILDING_EDIT($values);
        }
            
    break;



    case  $strings['Show']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Show floors requires login."]);
            $view->redirect("USER_Controller.php", "");
        }

        if(!checkRol('SHOW', $function)){
            $view->setFlashDanger($strings["No tienes los permisos necesarios"]);
            $view->redirect("BUILDING_Controller.php", "");
        }

        if (!isset($_GET['building'])){
            $view->setFlashDanger($strings["Building id is mandatory"]);
            $view->redirect("BUILDING_Controller.php", "");
        }
        $buildingid = $_GET['building'];

        $building = new BUILDING_Model($buildingid,'','','','');
        $values = $building->fillInBuilding();
        new BUILDING_SHOW($values);

    break;


    case  $strings['Delete']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete floors requires login."]);
            $view->redirect("USER_Controller.php", "");
        }

        if(!checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["No tienes los permisos necesarios"]);
            $view->redirect("BUILDING_Controller.php", "");
        }

        if (!isset($_GET['building'])){
            $view->setFlashDanger($strings["Building id is mandatory"]);
            $view->redirect("BUILDING_Controller.php", "");
        }
        $buildingid = $_GET['building'];

        $building = new BUILDING_Model($buildingid,"","","","");
        $buildingDelete = $building->findBuilding();

        if ($buildingDelete != 'true') {
            $view->setFlashDanger($strings["No such building with this id"]);
            $view->redirect("BUILDING_Controller.php", "");
        }

        $consult = $building->deleteBuilding($buildingid);
        if($consult){
            $flashMessageSuccess = sprintf($strings["Building \"%s\" successfully deleted."], $buildingEdit->getNameBuilding());
            $view->setFlashSuccess($flashMessageSuccess);
            $view->redirect("BUILDING_Controller.php", "");     
        } else {
            $view->setFlashDanger($strings[$consult]);
            $view->redirect("BUILDING_Controller.php", "");
        }
            	
    break;
    

    default:

        if(!checkRol('SHOWALL', $function)){
            $view->setFlashDanger($strings["No tienes los permisos necesarios"]);
            $view->redirect("BUILDING_Controller.php", "");
        }
        $building = new BUILDING_Model();
        $buildings = $building->showAllBuilding();
        new BUILDING_SHOWALL($buildings);
            
    break;
}

?>
