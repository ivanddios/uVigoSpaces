<?php

require_once("../core/ViewManager.php");
require_once("../model/FUNCTIONALITY_Model.php");
require_once("../model/ACTION_Model.php");
require_once("../model/USER_Model.php");
require_once("../model/GROUP_Model.php");
require_once("../view/GROUP_SHOWALL_View.php");
require_once("../view/GROUP_ADD_View.php");
require_once("../view/GROUP_EDIT_View.php");
require_once("../view/GROUP_SHOW_View.php");
require_once("../view/USER_SHOWALL_View.php");

$function = "GROUP";
$view = new ViewManager();

include '../view/locate/Strings_'.$_SESSION['LANGUAGE'].'.php';


/**
* Gets values from the forms
*
* @return Group with the form values
*/
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

    case 'Add':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add groups requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!$view->checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("GROUP_Controller.php");
        }

        if (isset($_POST["submit"])) {
            $groupAdd = get_data_form();
            $permissions = $groupAdd->convertArray($_POST["actions"]);
            $addAnswer = $groupAdd->addGroup($permissions);
            if($addAnswer === true){
                $flashMessageSuccess = sprintf($strings["Group \"%s\" successfully added."], $groupAdd->getNameGroup());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("GROUP_Controller.php");
            }else{
                $view->setFlashDanger($strings[$addAnswer]);
                $view->redirect("GROUP_Controller.php", 'Add');
            }
        }else{
            $function = new FUNCTIONALITY_Model();
            $functions = $function->getAllFunctions();

            $action = new ACTION_Model();
            $actions = $action->getAllActionsForFunction();

            new GROUP_ADD($functions, $actions);
        }
           	       
    break;


    case 'Edit':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit groups requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!$view->checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("GROUP_Controller.php");
        }

        if (!isset($_GET['group'])){
            $view->setFlashDanger($strings["Group id is mandatory"]);
            $view->redirect("GROUP_Controller.php");
        }
        $groupId = $_GET['group'];

        if (isset($_POST["submit"])) { 
            $groupEdit = get_data_form();
            $permissions = $groupEdit->convertArray($_POST["actions"]);
            $updateAnswer = $groupEdit->updateGroup($permissions);
            if($updateAnswer === true){
                $flashMessageSuccess = sprintf($strings["Group \"%s\" successfully updated."], $groupEdit->getNameGroup());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("GROUP_Controller.php");   
            }else{
                $view->setFlashDanger($strings[$updateAnswer]);
                $view->redirect("GROUP_Controller.php", 'Edit', 'group='.$groupId);
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



    case 'Users':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Show floors requires login."]);
            $view->redirect("LOGIN_Controller.php");
        }

        if(!$view->checkRol('SHOW ALL', 'USER')){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("GROUP_Controller.php");
        }

        if (!isset($_GET['group'])){
            $view->setFlashDanger($strings["Group id is mandatory"]);
            $view->redirect("GROUP_Controller.php");
        }
        $groupid = $_GET['group'];

        $user = new USER_Model('','','','','','','','', $groupid);
        $users = $user->getUsersForGroup();
        new USER_SHOWALL($users);

    break;

    case 'Show':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit groups requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!$view->checkRol('SHOW', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("GROUP_Controller.php");
        }

        if (!isset($_GET['group'])){
            $view->setFlashDanger($strings["Group id is mandatory"]);
            $view->redirect("GROUP_Controller.php");
        }
        $groupId = $_GET['group'];

        $group = new GROUP_Model($groupId);
        $groupValues = $group->getGroup();
        $permissions = $group->getPermissionForGroup();

        $function = new FUNCTIONALITY_Model();
        $functions = $function->getAllFunctions();

        $action = new ACTION_Model();
        $actions = $action->getAllActionsForFunction();

        new GROUP_SHOW($groupValues, $functions, $actions, $permissions);
            
    break;


    case  'Delete':

        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete groups requires login."]);
            $view->redirect("USER_Controller.php");
        }

        if(!$view->checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
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

        if(!$view->checkRol('SHOW ALL', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php");
        }

        $group = new GROUP_Model();
        $groups = $group->getAllGroups();
        new GROUP_SHOWALL($groups);
            
    break;
}

?>
