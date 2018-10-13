<?php
include_once '../Model/USER_Model.php';

function comprobarPermisos($action, $funcion){
	$permisos = $_SESSION['PERMISSIONS'];
	$band = false;
	for($i=0; $i<count($permisos);$i++){
		if($permisos[$i][0] == $action && $permisos[$i][1] == $funcion){
			$band = true;
		}
	}	
	return $band;
}
?>