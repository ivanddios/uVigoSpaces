<?php
//file: index.php
include './core/Authentication.php';
session_start();

// if (isAuthenticated()){
// 	header('Location:./controller/BUILDING_Controller.php');
// }
// else{
// 	header('Location:./controller/USER_Controller.php');
// 	}
	

header('Location:./controller/BUILDING_Controller.php');

?>