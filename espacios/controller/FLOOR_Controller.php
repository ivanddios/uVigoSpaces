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
        $planeFloor = '../document/'.$idBuilding.'/'.$idBuilding.$idFloor.'/'.$_FILES['planeFloor']['name'];
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
                $consult = $floorAdd->addFloor();
                
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
                $buildingid = $_GET["building"];

                if (!isset($_GET['floor'])){
                    new MESSAGE("floor id is mandatory", $back );
                }
                $floorid = $_GET['floor'];

                if (!isset($_SESSION['LOGIN'])){
                    new MESSAGE("Not in session. Editing buildings requires login", $back );
                }
            
                if (isset($_POST["submit"])) { 
                    $floorEdit = get_data_form();
                    
                    ////////////////////////////////////////METER EN UNA FUNCIÓN////////////////////////////////////////////////////////////
                    $dirPlane = '../documents/'.$floorEdit->getIdBuilding().'/'.$floorEdit->getIdBuilding().$floorEdit->getIdFloor().'/';
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
                        $_SESSION['popMessage'] = (sprintf($strings["Floor \"%s\" successfully updated."], $floorid));
                        header("Location: FLOOR_Controller.php?building=$buildingid");
                    } else {
                        new MESSAGE($answer, $back);
                    }
                } else {
                    $floor = new FLOOR_Model($buildingid, $floorid,'','','','');
                    $values = $floor->fillInFloor();
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
                $buildingid = $_GET["building"];

                if (!isset($_GET['floor'])){
                    new MESSAGE("floor id is mandatory", $back );
                }
                $floorid = $_GET["floor"];

                if (!isset($_SESSION['LOGIN'])){
                    new MESSAGE("Not in session. Deleting floors requires login", $back );
                }

                $floor = new FLOOR_Model($buildingid, $floorid, "","","","");
                $floorDelete = $floor->findFloor();

                if ($floorDelete != 'true') {
                    new MESSAGE("No such floor with this id", $back );
                }

                $answer = $floor->deleteFloor($buildingid, $floorid);
                if($answer){ 
                    //$floors = $floor->showAllFloors();
                    //new FLOOR_SHOWALL($floors, '../index.php', $answer);
                    $_SESSION['popMessage'] = (sprintf($strings["Floor \"%s\" successfully deleted."], $floorid));
                    header("Location: FLOOR_Controller.php?building=$buildingid");
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
                new FLOOR_SHOWALL($floors);
                } else {
                    new MESSAGE("Building id is mandatory",'../index.php');
                }
            }else{
                new MESSAGE("No tienes los permisos necesarios",'../index.php');
            }
            
         break;
}



?>
