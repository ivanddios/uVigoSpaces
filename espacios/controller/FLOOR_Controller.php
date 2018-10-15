<?php

include '../model/BUILDING_Model.php';
include '../model/FLOOR_Model.php';
include '../view/FLOOR_SHOWALL_View.php';
include '../view/FLOOR_EDIT_View.php';
include '../view/FLOOR_ADD_View.php';
include '../view/MESSAGE_View.php';
include '../core/ACL.php';

if(!isset($_SESSION)){
    session_start();
}

include '../locate/Strings_'.$_SESSION['LANGUAGE'].'.php';


function get_data_form() {

    $idBuilding = $_POST['idBuilding'];
    $idFloor = $_POST['idFloor'];
    $nameFloor = $_POST['nameFloor'];

    if (isset($_FILES['planeFloor']['name']) && ($_FILES['planeFloor']['name'] !== '')) {
        $planeFloor = '../Documents/Buildings/' . $POST['idBuilding'] . '/Plane/' . $_FILES['planeFloor']['name'];
    } else {
        $planeFloor = '';
    }

    $surfaceBuildingFloor = $_POST['surfaceBuildingFloor'];
    $surfaceUsefulFloor = $_POST['surfaceUsefulFloor'];
   
    $floor = new FLOOR_Model($idBuilding, $idFloor, $nameFloor, $planeFloor, $surfaceBuildingFloor, $surfaceUsefulFloor);
    return $floor;
}


$function = "FLOOR";
$back = 'FLOOR_Controller.php';

if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}

	Switch ($_REQUEST['action']){

        case  $strings['Add']:

        if(comprobarPermisos('ADD',$function)){

            if (!isset($_GET['building'])){
                new MESSAGE("building id is mandatory", $back );
            }
            
            $building = $_GET['building'];

            if (!isset($_SESSION['LOGIN'])){
                new MESSAGE("Not in session. Add floor requires login", $back );
            }

            if (isset($_POST["submit"])) { 
                $floorAdd = get_data_form();
                $consult = $floorAdd->insertFloor();
                
                if($consult){
                    $floors = $floorAdd->showAllFloors();
                    $message=(sprintf($strings["Floor \"%s\" successfully added."], $floorAdd->getIdBuilding().$floorAdd->getIdFloor()));
                    new FLOOR_SHOWALL($floors, '', $message);
                } else {
                    new MESSAGE($answer, $back);
                }
            } else {
                new FLOOR_ADD($building);
            }
        }else{
            new MESSAGE("No tienes los permisos necesarios",'../index.php');
        }		
           
        break;



        case  $strings['Edit']:

			if(comprobarPermisos('EDIT', $function)){

                if (!isset($_GET['building'])){
                    new MESSAGE("building id is mandatory", $back );
                }

                if (!isset($_GET['floor'])){
                    new MESSAGE("floor id is mandatory", $back );
                }

                if (!isset($_SESSION['LOGIN'])){
                    new MESSAGE("Not in session. Editing buildings requires login", $back );
                }

                $buildingid = $_GET["building"];
                $floorid = $_GET['floor'];

                if (isset($_POST["submit"])) { 
                    $floorEdit = get_data_form();
                    $consult = $floorEdit->updateFloor($buildingid, $floorid);
                    if($consult){
                        $floors = $floorEdit->showAllFloors();
                        $message=(sprintf($strings["Floor \"%s\" successfully updated."], $floorid));
                        new FLOOR_SHOWALL($floors, '', $message);
                    } else {
                        new MESSAGE($answer, $back);
                    }
                } else {
                    $floor = new FLOOR_Model($buildingid, $floorid,'','','','');
                    $values = $floor->FillInFloor();
                    new FLOOR_EDIT($values);
                }
            }else{
                new MESSAGE("No tienes los permisos necesarios",'../index.php');
            }		
                break;



        case  $strings['Delete']:

            if(comprobarPermisos("DELETE", $function)){

                if (!isset($_GET['building'])){
                    new MESSAGE("building id is mandatory", $back );
                }

                if (!isset($_SESSION['LOGIN'])){
                    new MESSAGE("Not in session. Deleting buildings requires login", $back );
                }

                $buildingid = $_GET["building"];
                $building = new BUILDING_Model($buildingid,"","","","");
                $buildingDelete = $building->findByIdBuilding();

                if ($buildingDelete != 'true') {
                    new MESSAGE("No such building with this id", $back );
                }

                $answer = $building->deleteBuilding($buildingid);
                if($answer === 'true'){
                new BUILDING_SHOWALL($buildings, '../index.php');
                } else {
                    new MESSAGE($answer, $back );
                }
            }else{
                new MESSAGE("No tienes los permisos necesarios",'../index.php');
            }		
         break;
    

        default:
                    
            if(comprobarPermisos('SHOWALL', $function)){
                if(isset($_GET['building'])){
                $floor = new FLOOR_Model($_GET['building'],'','','','','');
                $floors = $floor->showAllFloors();
                $message='';
                new FLOOR_SHOWALL($floors, '../index.php', $message);
                } else {
                    new MESSAGE("Building id is mandatory",'../index.php');
                }
            }else{
                new MESSAGE("No tienes los permisos necesarios",'../index.php');
            }
            
         break;
}



?>
