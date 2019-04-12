<?php

require_once(__DIR__."..\..\core\ViewManager.php");
require_once(__DIR__.'..\..\core\ACL.php');
require_once(__DIR__.'..\..\view\INDEX_View.php');

$view = new ViewManager();

include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';


if (!isset($_GET['action'])){
	$_GET['action'] = '';
}
Switch ($_GET['action']){

    default:
        new INDEX();
    break;
						
}