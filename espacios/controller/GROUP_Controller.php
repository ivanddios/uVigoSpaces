<?php

require_once(__DIR__."../../core/ViewManager.php");
require_once(__DIR__."../../core/ACL.php");
require_once(__DIR__."../../model/FUNCTIONALITY_Model.php");
require_once(__DIR__."../../model/ACTION_Model.php");
require_once(__DIR__."../../model/GROUP_Model.php");
require_once(__DIR__."../../view/GROUP_SHOWALL_View.php");
require_once(__DIR__."../../view/GROUP_ADD_View.php");
require_once(__DIR__."../../view/GROUP_EDIT_View.php");

$function = "GROUP";
$view = new ViewManager();

include '../locate/Strings_'.$_SESSION['LANGUAGE'].'.php';

function get_data_form() {

    $idGroup = $_GET['group'];
    $nameGroup = $_POST['nameGroup'];
    $descripGroup = $_POST['descripGroup'];
   
    $group = new GROUP_Model($idGroup, $nameGroup, $descripGroup);
    return $group;
}


if (!isset($_GET['action'])){
	$_GET['action'] = '';
}

Switch ($_GET['action']){

    case  $strings['Add']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add groups requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("GROUP_Controller.php");
        }

        if (isset($_POST["submit"])) {
            $groupAdd = get_data_form();
            $permissions = json_decode($_POST['permissions']);
            $addAnswer = $groupAdd->addGroup($permissions);
            if($addAnswer === true){
                $flashMessageSuccess = sprintf($strings["Group \"%s\" successfully added."], $groupAdd->getNameGroup());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("GROUP_Controller.php");
            }else{
                $view->setFlashDanger($strings[$addAnswer]);
                $view->redirect("GROUP_Controller.php", $strings['Add']);
            }
        }else{
            $function = new FUNCTIONALITY_Model();
            $functions = $function->getAllFunctions();

            $action = new ACTION_Model();
            $actions = $action->getAllActionsForFunction();

            new GROUP_ADD($functions, $actions);
        }
           	       
    break;


    case  $strings['Edit']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit groups requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("GROUP_Controller.php");
        }

        if (!isset($_GET['group'])){
            $view->setFlashDanger($strings["Group id is mandatory"]);
            $view->redirect("GROUP_Controller.php");
        }
        $groupId = $_GET['group'];

        if (isset($_POST["submit"])) { 
            $groupEdit = get_data_form();
            $permissions = json_decode($_POST['permissions']);
            $updateAnswer = $groupEdit->updateGroup($permissions);
            if($updateAnswer === true){
                $flashMessageSuccess = sprintf($strings["Group \"%s\" successfully updated."], $groupEdit->getNameGroup());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("GROUP_Controller.php");   
            }else{
                $view->setFlashDanger($strings[$updateAnswer]);
                $view->redirect("GROUP_Controller.php", $strings['Edit'], 'group='.$groupId);
            }
        } else {
            $group = new GROUP_Model($groupId);
            $groupValues = $group->getGroup();
            $permissions = $group->getPermissionForGroup();

            $function = new FUNCTIONALITY_Model();
            $functions = $function->getAllFunctions();

            $action = new ACTION_Model();
            $actions = $action->getAllActionsForFunction();

            new GROUP_EDIT($groupValues, $functions, $actions, $permissions);
        }
            
    break;



    // // case  $strings['Show']:

    // //     // if (!isset($_SESSION['LOGIN'])){
    // //     //     $view->setFlashDanger($strings["Not in session. Show floors requires login."]);
    // //     //     $view->redirect("USER_Controller.php", "");
    // //     // }

    // //     // if(!checkRol('SHOW', $function)){
    // //     //     $view->setFlashDanger($strings["You do not have the necessary permits"]);
    // //     //     $view->redirect("BUILDING_Controller.php", "");
    // //     // }

    // //     if (!isset($_GET['building'])){
    // //         $view->setFlashDanger($strings["Building id is mandatory"]);
    // //         $view->redirect("BUILDING_Controller.php", "");
    // //     }
    // //     $buildingid = $_GET['building'];

    // //     $building = new BUILDING_Model($buildingid);
    // //     $values = $building->getBuilding();
    // //     new BUILDING_SHOW($values);

    // // break;


    case  $strings['Delete']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete groups requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("GROUP_Controller.php");
        }

        if (!isset($_POST['group'])){
            $view->setFlashDanger($strings["Group id is mandatory"]);
            $view->redirect("GROUP_Controller.php");
        }

        $groupDelete = new GROUP_Model($_POST['group']);
        $groupName = $groupDelete->findNameGroup();
        $deleteAnswer = $groupDelete->deleteGroup();
        if($deleteAnswer === true){
            $flashMessageSuccess = sprintf($strings["Group \"%s\" successfully deleted."], $groupName);
            $view->setFlashSuccess($flashMessageSuccess);
            $view->redirect("GROUP_Controller.php");     
        }else{
            $view->setFlashDanger($strings[$deleteAnswer]);
            $view->redirect("GROUP_Controller.php");
        }
            	
    break;
    

    default:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add groups requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!checkRol('SHOW ALL', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $group = new GROUP_Model();
        $groups = $group->getAllGroups();
        new GROUP_SHOWALL($groups);
            
    break;
}

?>
