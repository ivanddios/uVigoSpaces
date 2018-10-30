<?php

include '../model/BUILDING_Model.php';
include '../view/MESSAGE_View.php';
include '../view/BUILDING_SHOWALL_View.php';
include '../view/BUILDING_EDIT_View.php';
include '../view/BUILDING_SHOW_View.php';
include '../view/BUILDING_ADD_View.php';
include '../core/ACL.php';

if(!isset($_SESSION)){
    session_start();
}

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


$function = "BUILDING";
$back = 'BUILDING_Controller.php';

if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}

	Switch ($_REQUEST['action']){


        case  $strings['Add']:

			if(comprobarPermisos('ADD',$function)){

                if (!isset($_SESSION['LOGIN'])){
                    new MESSAGE("Not in session. Add building requires login", $back );
                }

                if (isset($_POST["submit"])) { 
                    $buildingAdd = get_data_form();
                    $consult = $buildingAdd->insertBuilding();
                    
                    if($consult){
                        $buildings = $buildingAdd->showAllBuilding();
                        $message=(sprintf($strings["Building \"%s\" successfully added."], $buildingAdd->getIdBuilding()));
                        new BUILDING_SHOWALL($buildings, '', $message);
                    } else {
                        new MESSAGE($answer, $back);
                    }
                } else {
                    new BUILDING_ADD();
                }
            }else{
                new MESSAGE("No tienes los permisos necesarios",'../index.php');
            }		
               
        break;


        case  $strings['Edit']:

			if(comprobarPermisos('EDIT',$function)){

                if (!isset($_GET['building'])){
                    new MESSAGE("building id is mandatory", $back );
                }

                $buildingid = $_GET['building'];

                if (!isset($_SESSION['LOGIN'])){
                    new MESSAGE("Not in session. Editing buildings requires login", $back );
                }

                if (isset($_POST["submit"])) { 
                    $buildingEdit = get_data_form();
                    $consult = $buildingEdit->updateBuilding($buildingid);
                    
                    if($consult){
                       // $buildings = $buildingEdit->showAllBuilding();
                       //new BUILDING_SHOWALL($buildings, '', $message);
                        $_SESSION['popMessage']=(sprintf($strings["Building \"%s\" successfully updated."], $buildingid));
                        header("Location: BUILDING_Controller.php");                     
                    } else {
                        new MESSAGE($answer, $back);
                    }
                } else {
                    $building = new BUILDING_Model($buildingid,'','','','');
                    $values = $building->FillInBuilding();
                    new BUILDING_EDIT($values);
                }
            }else{
                new MESSAGE("No tienes los permisos necesarios",'../index.php');
            }

        break;



        case  $strings['Show']:

        if(comprobarPermisos('SHOW',$function)){

            if (!isset($_GET['building'])){
                new MESSAGE("building id is mandatory", $back );
            }

            $buildingid = $_GET['building'];

            if (!isset($_SESSION['LOGIN'])){
                new MESSAGE("Not in session. Editing buildings requires login", $back );
            }

                $building = new BUILDING_Model($buildingid,'','','','');
                $values = $building->FillInBuilding();
                new BUILDING_SHOW($values);

        }else{
            new MESSAGE("No tienes los permisos necesarios",'../index.php');
        }

    break;




        case  $strings['Delete']:

            if(comprobarPermisos("DELETE", $function)){

                if (!isset($_POST['building'])){
                    new MESSAGE("building id is mandatory", $back );
                }

                $buildingid = $_POST["building"];

                if (!isset($_SESSION['LOGIN'])){
                    new MESSAGE("Not in session. Deleting buildings requires login", $back );
                }

                $building = new BUILDING_Model($buildingid,"","","","");
                $buildingDelete = $building->findBuilding();

                if ($buildingDelete != 'true') {
                    new MESSAGE("No such building with this id", $back );
                }

                $answer = $building->deleteBuilding($buildingid);
                if($answer){
                    //$buildings = $building->showAllBuilding();
                    //new BUILDING_SHOWALL($buildings, '../index.php');
                    $_SESSION['popMessage'] = (sprintf($strings["Building \"%s\" successfully deleted."], $buildingid));
                    header("Location: BUILDING_Controller.php");
                } else {
                    new MESSAGE($answer, $back);
                }
            }else{
                new MESSAGE("No tienes los permisos necesarios",'../index.php');
            }		
         break;
    

        default:

            if(comprobarPermisos('SHOWALL', $function)){
                $building = new BUILDING_Model('','','','','');
                $buildings = $building->showAllBuilding();
                new BUILDING_SHOWALL($buildings);
            }else{
                new MESSAGE("No tienes los permisos necesarios",'../index.php');
            }
            
        break;
}



?>
