<?php

function checkRol($action, $funcion){
	
	if(isset($_SESSION['PERMISSIONS'])){
		$permissions = $_SESSION['PERMISSIONS'];
		for($i=0; $i<count($permissions);$i++){
			if(($permissions[$i][0] == $action) && ($permissions[$i][1] == $funcion)){
				return true;
			}
		}
	} else {
		return false;
	}	
	return false;
}


?>