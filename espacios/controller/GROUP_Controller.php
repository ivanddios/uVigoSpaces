<?php

require_once(__DIR__."../../core/ViewManager.php");
require_once(__DIR__."../../core/ACL.php");
require_once(__DIR__."../../model/FUNCTIONALITY_Model.php");
require_once(__DIR__."../../model/ACTION_Model.php");
require_once(__DIR__."../../model/GROUP_Model.php");
require_once(__DIR__."../../view/GROUP_SHOWALL_View.php");
require_once(__DIR__."../../view/GROUP_ADD_View.php");
require_once(__DIR__."../../view/GROUP_EDIT_View.php");
// require_once(__DIR__."../../view/BUILDING_SHOW_View.php");


$function = "GROUP";
$view = new ViewManager();

include '../locate/Strings_'.$_SESSION['LANGUAGE'].'.php';

function get_data_form() {

    if(isset($_GET['group'])){
        $idGroup = $_GET['group'];
    }else{
        $idGroup = null;
    }
    $nameGroup = $_POST['nameGroup'];
    $descripGroup = $_POST['descripGroup'];
    // $permissions = $_POST['permissions'];

    // var_dump($permissions);
   
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
            $view->redirect("USER_Controller.php", "index");
        }

        if(!checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("GROUP_Controller.php", "index");
        }

        if (isset($_POST["submit"])) { 
            $groupAdd = get_data_form();
            try{
                //$functionAdd->checkIsValidForAdd_Update(); 
                // $groupAdd->addGroup();
                // $flashMessageSuccess = sprintf($strings["Group \"%s\" successfully added."], $groupAdd->getNameGroup());
                // $view->setFlashSuccess($flashMessageSuccess);
                // $view->redirect("GROUP_Controller.php", "index");
                var_dump("JEJ");

            }catch(Exception $errors) {
                $view->setFlashDanger($strings[$errors->getMessage()]);
                $view->redirect("GROUP_Controller.php", $strings['Add']);
            }
                
        } else {
            $function = new FUNCTIONALITY_Model();
            $action = new ACTION_Model();
            
            $functions = $function->showAllFunctions();
            $actions = $action->showAllActions();
            new GROUP_ADD($functions, $actions);
        }
           	       
    break;


    case  $strings['Edit']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit groups requires login."]);
            $view->redirect("USER_Controller.php", "index");
        }

        if(!checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("GROUP_Controller.php", "index");
        }

        if (!isset($_GET['group'])){
            $view->setFlashDanger($strings["Group id is mandatory"]);
            $view->redirect("GROUP_Controller.php", "index");
        }
        $groupId = $_GET['group'];

        if (isset($_POST["submit"])) { 
            $groupEdit = get_data_form();
            try{
                //$functionEdit->checkIsValidForAdd_Update();
                $groupEdit->updateGroup();
                $flashMessageSuccess = sprintf($strings["Group \"%s\" successfully updated."], $groupEdit->getNameGroup());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("GROUP_Controller.php", "index");   

            }catch(Exception $errors) {
                $view->setFlashDanger($strings[$errors->getMessage()]);
                $view->redirect("GROUP_Controller.php", $strings['Edit'], 'group='.$groupId);
            }
        } else {
            $group = new GROUP_Model($groupId);
            $groupValues = $group->findGroup();
            new GROUP_EDIT($groupValues);
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
    // //     $values = $building->fillInBuilding();
    // //     new BUILDING_SHOW($values);

    // // break;


    case  $strings['Delete']:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete groups requires login."]);
            $view->redirect("USER_Controller.php", "index");
        }

        if(!checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("GROUP_Controller.php", "index");
        }

        if (!isset($_POST['group'])){
            $view->setFlashDanger($strings["Group id is mandatory"]);
            $view->redirect("GROUP_Controller.php", "index");
        }
        $groupid = $_POST['group'];
        $groupDelete = new GROUP_Model($groupid);

        if (!$groupDelete ->existsGroup()) {
            $view->setFlashDanger($strings["No such group with this id"]);
            $view->redirect("GROUP_Controller.php", "index");
        }

        try{
            $groupName = $groupDelete->findNameGroup();
            $groupDelete->deleteGroup();
            $flashMessageSuccess = sprintf($strings["Group \"%s\" successfully deleted."], $groupName);
            $view->setFlashSuccess($flashMessageSuccess);
            $view->redirect("GROUP_Controller.php", "index");     
        }catch(Exception $errors) {
            $view->setFlashDanger($strings[$errors->getMessage()]);
            $view->redirect("GROUP_Controller.php", "index");
        }
            	
    break;
    

    default:

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add groups requires login."]);
            $view->redirect("USER_Controller.php", "index");
        }

        if(!checkRol('SHOW ALL', $function)){
            $view->setFlashDanger($strings["You do not have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php", "index");
        }

        $group = new GROUP_Model();
        $groups = $group->showAllGroups();
        new GROUP_SHOWALL($groups);
            
    break;
}

?>
