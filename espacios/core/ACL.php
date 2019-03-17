<?php
include_once '../Model/USER_Model.php';

function checkRol($action, $funcion){
	
	if(isset($_SESSION['PERMISSIONS'])){
		$permisos = $_SESSION['PERMISSIONS'];
		$band = false;
		for($i=0; $i<count($permisos);$i++){
			if($permisos[$i][0] == $action && $permisos[$i][1] == $funcion){
				$band = true;
			}
		}
	} else {
		return false;
	}	
	return $band;
}
?>