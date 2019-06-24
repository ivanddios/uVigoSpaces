<?php

/**
* File: FUNCTIONALITY_Controller
*
* Script that controller to add new function, edit function, delete function, show function
* and show all function
*
* @author ivanddios <ivanddios1994@gmail.com>
*/

require_once("../core/ViewManager.php");
require_once("../model/ACTION_Model.php");
require_once("../model/FUNCTIONALITY_Model.php");
require_once("../view/FUNCTIONALITY_SHOWALL_View.php");
require_once("../view/FUNCTIONALITY_ADD_View.php");
require_once("../view/FUNCTIONALITY_EDIT_View.php");
require_once("../view/FUNCTIONALITY_SHOW_View.php");


$function = "FUNCTIONALITY";
$view = new ViewManager();

include '../view/locate/Strings_'.$_SESSION['LANGUAGE'].'.php';

/**
* Gets values from the forms
*
* @return FUNCTIONALITY with the form values
*/
function get_data_form() {

    $nameFunction = $_POST['nameFunction'];
    $descripFunction = $_POST['descripFunction'];
    $actions = $_POST['actions'];
   
    $function = new FUNCTIONALITY_Model(null, $nameFunction, $descripFunction, $actions);
    return $function;
}


if (!isset($_GET['action'])){
	$_GET['action'] = '';
}


/**
 * Evaluates the 'action' parameter passed for URL
 * For each action, the controller checks if the user is logged and if the user has the permissions necessary.
 * 
 * The controller calls a view (with floor data or no, depending the action).
 * 
 * The controller gets the forms' data of the views and call the FUNCTIONALITY model to make the actions against the database.
 */
Switch ($_GET['action']){

    case  'Add':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add functionalities requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if the user can add a new function
        if(!$view->checkRol('ADD', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("FUNCTIONALITY_Controller.php");
        }

        /**
        * @if Checks if exists $_POST gets the form's data, instances a new object Functionality, 
        * checks if the data are valids and adds the functionality to database
        */
        if (isset($_POST["submit"])) { 
            $functionAdd = get_data_form();
            $addAnswer = $functionAdd->addFunction();
            /**
            * @if The controller notices the user if the operation was successfully
            * 
            * @else Returns the error message
            */
            if($addAnswer === true){
                $flashMessageSuccess = sprintf($strings["Functionality \"%s\" successfully added."], $functionAdd->getNameFunction());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("FUNCTIONALITY_Controller.php");
            }else{
                $view->setFlashDanger($strings[$addAsnwer]);
                $view->redirect("FUNCTIONALITY_Controller.php", 'Add');
            }
                
        } else {
            $function = new FUNCTIONALITY_Model();
            $action = new ACTION_Model();
            $actions = $action->getAllActions();
            new FUNCTIONALITY_ADD($actions);
        }
           	       
    break;


    case  'Edit':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Edit functionalities requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if the user can modify functionalities
        if(!$view->checkRol('EDIT', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("FUNCTIONALITY_Controller.php");
        }

        //@if Checks if exists the function parameter passed by GET
        if (!isset($_GET['function'])){
            $view->setFlashDanger($strings["Function id is mandatory"]);
            $view->redirect("FUNCTIONALITY_Controller.php");
        }
        $functionId = $_GET['function'];

        /**
        * @if Checks if exists $_POST gets the form's data, instances a new object Array, 
        * checks if the data are valids and modifies the functionality in database.
        *
        * @else Otherwise, checks if exists anything functionality with the identifier passed by GET
        * gets the functionalities values and shows it in FUNCTIONALITY_EDIT_View.
        */
        if (isset($_POST["submit"])) { 
            $functionEdit = get_data_form();
            $functionEdit->setIdFunction($functionId);
            $editAnswer = $functionEdit->updateFunction();
            if($editAnswer === true){
                $functionEdit->updateFunction($actions);
                $flashMessageSuccess = sprintf($strings["Function \"%s\" successfully updated."], $functionEdit->getNameFunction());
                $view->setFlashSuccess($flashMessageSuccess);
                $view->redirect("FUNCTIONALITY_Controller.php");   

            }else{
                $view->setFlashDanger($strings[$editAnswer]);
                $view->redirect("FUNCTIONALITY_Controller.php", 'Edit', 'function='.$functionId);
            }
        } else {
            $function = new FUNCTIONALITY_Model($functionId);
            if($function->existsFunction()){
                $functionValues = $function->getFunction();
                $action = new ACTION_Model();
                $actions = $action->getAllActions();
                $actionsForFunctionality = $function->getAllActionsForFunctionality();
                new FUNCTIONALITY_EDIT($functionValues, $actions, $actionsForFunctionality);
            }else{
                $view->setFlashDanger($strings["Function doesn't exist"]);
                $view->redirect("FUNCTIONALITY_Controller.php");  
            }
        }    
    break;



    case  'Show':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Show function requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if the user can modify functionalities
        if(!$view->checkRol('SHOW', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("FUNCTIONALITY_Controller.php");
        }

        //@if Checks if exists the function parameter passed by GET
        if (!isset($_GET['function'])){
            $view->setFlashDanger($strings["Function identifier is mandatory"]);
            $view->redirect("FUNCTIONALITY_Controller.php");
        }
        $functionId = $_GET['function'];

        /**
        * @if Checks if exists anythingfunctionality with the identifier passed by GET
        * gets the function values and shows it in FLOOR_SHOW_View.
        */
        $function = new FUNCTIONALITY_Model($functionId);
        if($function->existsFunction()){
            $functionValues = $function->getFunction();
            $action = new ACTION_Model();
            $actions = $action->getAllActions();
            $actionsForFunctionality = $function->getAllActionsForFunctionality();
            new FUNCTIONALITY_SHOW($functionValues, $actions, $actionsForFunctionality);
        }else{
            $view->setFlashDanger($strings["Function doesn't exist"]);
            $view->redirect("FUNCTIONALITY_Controller.php"); 
        }
       
    break;


    case  'Delete':

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Delete functionalities requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if the user can delete functionality
        if(!$view->checkRol('DELETE', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("FUNCTIONALITY_Controller.php");
        }

        //@if Checks if exists the function parameter passed by GET
        if (!isset($_POST['function'])){
            $view->setFlashDanger($strings["Function id is mandatory"]);
            $view->redirect("FUNCTIONALITY_Controller.php");
        }
        $functionId = $_POST['function'];
       
        //Try to delete a building's floor from the database
        $functionDelete = new FUNCTIONALITY_Model($functionId);
        $deleteAnswer =  $functionDelete->deleteFunction();
        if($deleteAnswer === true){
            $flashMessageSuccess = sprintf($strings["Function \"%s\" successfully deleted."], $functionId);
            $view->setFlashSuccess($flashMessageSuccess);
            $view->redirect("FUNCTIONALITY_Controller.php");     
        }else {
            $view->setFlashDanger($strings[$errors->getMessage()]);
            $view->redirect("FUNCTIONALITY_Controller.php");
        }          	
    break;
    

    default:

        //@if Checks if the user is logged
        if (!isset($_SESSION['LOGIN'])){
            $view->setFlashDanger($strings["Not in session. Add functionalities requires login."]);
            $view->redirect("USER_Controller.php");
        }

        //@if Checks if the user see all functionalities
        if(!$view->checkRol('SHOW ALL', $function)){
            $view->setFlashDanger($strings["You don't have the necessary permits"]);
            $view->redirect("BUILDING_Controller.php");
        }

        //Gets all functionalities from database and presents the results to the user
        $function = new FUNCTIONALITY_Model();
        $functions = $function->getAllFunctions();
        new FUNCTIONALITY_SHOWALL($functions);
            
    break;
}

?>
