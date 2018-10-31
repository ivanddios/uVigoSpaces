<?php

require_once(__DIR__."..\..\core\ViewManager.php");
include '../model/SPACE_Model.php';
include '../model/BUILDING_Model.php';
include '../model/FLOOR_Model.php';
include '../view/SPACE_SHOWALL_View.php';
// include '../view/SPACE_EDIT_View.php';
// include '../view/SPACE_ADD_View.php';
// include '../view/SPACE_SHOW_View.php';
include '../core/ACL.php';

$function = "FLOOR";
$back = 'FLOOR_Controller.php';
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

    // case  $strings['Add']:

    //     if (!isset($_SESSION['LOGIN'])){
    //         $view->setFlashDanger($strings["Not in session. Add floors requires login."]);
    //         $view->redirect("USER_Controller.php", "index");
    //     }

    //     if(!checkRol('ADD', $function)){
    //         $view->setFlashDanger($strings["No tienes los permisos necesarios"]);
    //         $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
    //     }

    //     if (!isset($_GET['building'])){
    //         $view->setFlashDanger($strings["Building is mandatory"]);
    //         $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
    //     }
    //     $building = $_GET['building'];

    //     if (isset($_POST["submit"])) { 
    //         $floorAdd = get_data_form();

    //         ////////////////////////////////////////METER EN UNA FUNCIÓN////////////////////////////////////////////////////////////
    //         $dirPlane = '../document/'.$floorAdd->getIdBuilding().'/'.$floorAdd->getIdBuilding().$floorAdd->getIdFloor().'/';
    //         if ($_FILES['planeFloor']['name'] !== '') {
    //             if (!file_exists($dirPlane)) {
    //                 mkdir($dirPlane, 0777, true);
    //             }
    //             move_uploaded_file($_FILES['planeFloor']['tmp_name'],$floorAdd->getPlaneFloor());
    //         }
    //         //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //         $consult = $floorAdd->addFloor(); 
    //         if($consult){
    //             // $floors = $floorAdd->showAllFloors();
    //             // $message=(sprintf($strings["Floor \"%s\" successfully added."], $floorAdd->getNameFloor()));
    //             // new FLOOR_SHOWALL($floors, '', $message);
    //             $flashMessageSuccess = sprintf($strings["Floor \"%s\" successfully added."], $floorAdd->getNameFloor());
    //             $view->setFlashSuccess($flashMessageSuccess);
    //             $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
    //         } else {
    //             $view->setFlashDanger($strings[$consult]);
    //             $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
    //         }
    //     } else {
    //         new FLOOR_ADD($building);
    //     }
 
    // break;



    // case  $strings['Edit']:

    //     if (!isset($_SESSION['LOGIN'])){
    //         $view->setFlashDanger($strings["Not in session. Show the floors requires login"]);
    //         $view->redirect("USER_Controller.php", "index");
    //     }

	// 	if(!checkRol('EDIT', $function)){
    //         $view->setFlashDanger($strings["No tienes los permisos necesarios"]);
    //         $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
    //     }
                
    //     if (!isset($_GET['building'])){
    //         $view->setFlashDanger($strings["Building is mandatory"]);
    //         $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
    //     }
    //     $buildingid = $_GET["building"];

    //     if (!isset($_GET['floor'])){
    //         $view->setFlashDanger($strings["Floor is mandatory"]);
    //         $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
    //     }
    //     $floorid = $_GET['floor'];

    //     if (isset($_POST["submit"])) { 
    //         $floorEdit = get_data_form();
                    
    //         ////////////////////////////////////////METER EN UNA FUNCIÓN////////////////////////////////////////////////////////////
    //         $dirPlane = '../document/'.$floorEdit->getIdBuilding().'/'.$floorEdit->getIdBuilding().$floorEdit->getIdFloor().'/';
    //         if ($_FILES['planeFloor']['name'] !== '') {
    //             if (!file_exists($dirPlane)) {
    //                 mkdir($dirPlane, 0777, true);
    //             }
    //             move_uploaded_file($_FILES['planeFloor']['tmp_name'],$floorEdit->getPlaneFloor());
    //             $link = $floorEdit->findLinkPlane($buildingid, $floorid);
    //             unlink($link);
    //         }
    //         //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //         $consult = $floorEdit->updateFloor($buildingid, $floorid);
    //         if($consult){
    //             $flashMessageSuccess = sprintf($strings["Floor \"%s\" successfully updated."], $floorEdit->getNameFloor());
    //             $view->setFlashSuccess($flashMessageSuccess);
    //             $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
    //         } else {
    //             $view->setFlashDanger($strings[$consult]);
    //             $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
    //         }
    //     } else {
    //         $floor = new FLOOR_Model($buildingid, $floorid,'','','','');
    //         $values = $floor->fillInFloor();
    //         new FLOOR_EDIT($values);
    //     }

    // break;


    // case  $strings['Show']:

    //     if (!isset($_SESSION['LOGIN'])){
    //         $view->setFlashDanger($strings["Not in session. Show the floors requires login"]);
    //          $view->redirect("USER_Controller.php", "index");
    //     }

    //     if(!checkRol('EDIT', $function)){
    //         $view->setFlashDanger($strings["No tienes los permisos necesarios"]);
    //         $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
    //     }
             
    //     if (!isset($_GET['building'])){
    //         $view->setFlashDanger($strings["Building is mandatory"]);
    //         $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
    //     }
    //     $buildingid = $_GET["building"];

    //     if (!isset($_GET['floor'])){
    //         $view->setFlashDanger($strings["Floor is mandatory"]);
    //         $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
    //     }
    //     $floorid = $_GET['floor'];

    //     $floor = new FLOOR_Model($buildingid, $floorid,'','','','');
    //     $values = $floor->fillInFloor();
    //     new FLOOR_SHOW($values);
         
    // break;


    // case  $strings['Delete']:

    //     if (!isset($_SESSION['LOGIN'])){
    //         $view->setFlashDanger($strings["Not in session. Show the floors requires login"]);
    //         $view->redirect("USER_Controller.php", "index");
    //     }

    //     if(!checkRol('DELETE', $function)){
    //         $view->setFlashDanger($strings["No tienes los permisos necesarios"]);
    //         $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
    //     }

    //     if (!isset($_GET['building']) && !isset($_GET['floor'])){
    //         $view->setFlashDanger($strings["Building is mandatory"]);
    //         $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
    //     }
                
    //     $floor = new FLOOR_Model($_GET["building"], $_GET["floor"], "","","","");
                
    //     if (!$floor->existsFloor()) {
    //         $view->setFlashDanger($strings["No exist floor to delete"]);
    //         $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
    //     }

    //     //////////////////////////////////////////////////////////////////////////////////////
    //     $link = $floor->findLinkPlane($floor->getIdBuilding(), $floor->getIdFloor());
    //     unlink($link); 
    //     rmdir('../document/'.$floor->getIdBuilding().'/'.$floor->getIdBuilding().$floor->getIdFloor());
    //     /////////////////////////////////////////////////////////////////////////////////////

    //     $floorName = $floor->findNameFloor();
    //     $consult = $floor->deleteFloor();
    //     if($consult){
    //         $flashMessageSuccess = sprintf($strings["Floor \"%s\" successfully deleted."], $floorName);
    //         $view->setFlashSuccess($flashMessageSuccess);
    //         $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
    //     } else {
    //         $view->setFlashDanger($strings[$consult]);
    //         $view->redirect("FLOOR_Controller.php", "index&building=", $buildingid);
    //     }

    // break;
    

    default:
                    
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Show the floors requires login"]);
            $view->redirect("USER_Controller.php", "index");
        }

        if(!checkRol('SHOWALL', $function)){
            $view->setFlashDanger($strings["No tienes los permisos necesarios"]);
            $view->redirect("BUILDING_Controller.php", "");
        }

        if(isset($_GET['building']) && isset($_GET['floor'])){
            $spaces = new SPACE_Model($_GET['building'],$_GET['floor'],'','','','');
            $spaces = $spaces->showAllSpaces();

            $building = new BUILDING_Model($_GET['building']);
            $buildingName = $building->findBuildingName();

            $floor = new FLOOR_Model($_GET['building'], $_GET['floor']);
            $floorName = $floor->findFloorName();

            new SPACE_SHOWALL($spaces, $buildingName, $floorName);
        } else {
            $view->setFlashDanger($strings["Building and floor is mandatory"]);
            $view->redirect("BUILDING_Controller.php", "");
        }
               
    break;
}

?>
