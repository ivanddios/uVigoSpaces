<?php

include '../model/BUILDING_Model.php';
include '../view/MESSAGE_View.php';
include '../view/BUILDING_SHOWALL_View.php';
include '../core/ACL.php';

if(!isset($_SESSION)){
    session_start();
}

include '../locate/Strings_'.$_SESSION['LANGUAGE'].'.php';


if (!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}

	Switch ($_REQUEST['action']){

        case  $strings['Edit']:
        
        $funcionalidad = "BUILDING";
       // if(comprobarPermisos("DELETE", $funcionalidad)){
			if (!isset($_GET['building'])){
                new MESSAGE("building id is mandatory", 'USUARIO_Controller.php');
            }

            if (!isset($_SESSION['LOGIN'])){
                new MESSAGE("Not in session. Deleting polls requires login", 'USUARIO_Controller.php');
            }

            $buildingid = $_GET["building"];
            $building = new BUILDING_Model($buildingid,"","","","");
            $buildingDelete = $building->findById();
            var_dump($buildingDelete);

            if ($buildingDelete != 'true') {
                new MESSAGE("No such building with this id", 'USUARIO_Controller.php');
            }

            $answer = $building->delete($buildingid);
            if($answer === 'true'){
            new BUILDING_SHOWALL($buildings, '../index.php');
            } else {
                new MESSAGE($answer, 'USUARIO_Controller.php');
            }
        // }else{
        //     new MESSAGE("No tienes los permisos necesarios",'../index.php');
        // }		
            break;
    

        default:

        $funcionalidad = "BUILDING";
        if(comprobarPermisos('SHOWALL', $funcionalidad)){
            $building = new BUILDING_Model('','','','','');
            $buildings = $building->index();
            new BUILDING_SHOWALL($buildings, '../index.php');

        }else{
            new MESSAGE("No tienes los permisos necesarios",'../index.php');
        }						
}



?>
