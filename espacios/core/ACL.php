<?php
include_once '../Model/USER_Model.php';


function getPermissions(){
	$sql ="SELECT DISTINCT action.nameAction, functionality.nameFunction FROM user_group, permission, functionality, action WHERE user_group.username = '$this->username' AND user_group.idGroup = permission.idGroup AND permission.idFunction = functionality.idFunction AND permission.idAction = action.idAction";
	$result = $this->mysqli->query($sql);  
	$j = 0;
	if (!($resultado = $this->mysqli->query($sql))) {
        throw new Exception('Error in the query on the database');
    } else {
        $toret = array();
        $i = 0;
        while ($fila = $resultado->fetch_array()) {
            $toret[$i] = $fila;
            $i++;
        }
        return $toret;
    }
}

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