<?php


function isAuthenticated(){
	if (isset($_SESSION['LOGIN'])){
		return true;
	}
	else{
		return false;
	}
}
?>

