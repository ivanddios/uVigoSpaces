<?php
/**
* File: INDEX_Controller
*
* Script that present the welcome page
*
* @author ivanddios <ivanddios1994@gmail.com>
*/

require_once("../core/ViewManager.php");
require_once("../view/INDEX_View.php");

$view = new ViewManager();

include '../view/locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';


if (!isset($_GET['action'])){
	$_GET['action'] = '';
}
Switch ($_GET['action']){

    default:
        new INDEX();
    break;
						
}

?>