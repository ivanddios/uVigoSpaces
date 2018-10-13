<?php

class BUILDING_Model {

	var $BUILDING_idBuilding;
	var $BUILDING_name;
	var $BUILDING_address;
	var $BUILDING_phone;
	var $BUILDING_responsible;
	var $mysqli;


function __construct($BUILDING_idBuilding, $BUILDING_name, $BUILDING_address, $BUILDING_phone, $BUILDING_responsible)
{
    $this->BUILDING_idBuilding =  $BUILDING_idBuilding; 
	$this->BUILDING_name = $BUILDING_name;
	$this->BUILDING_address = $BUILDING_address;
	$this->BUILDING_phone = $BUILDING_phone;
	$this->BUILDING_responsible =  $BUILDING_responsible;
}

function ConectarBD() {
    $this->mysqli = new mysqli("localhost", "root", "", "espacios");
    if ($this->mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
    }
}

function index() {
    $this->ConectarBD();
    $sql = "SELECT * FROM BUILDING";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos.';
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



function findbyId() {
	$this->ConectarBD();
	$sql = "SELECT * FROM BUILDING WHERE idBuilding = '" . $this->BUILDING_idBuilding . "'";
	$result = $this->mysqli->query($sql);
	if ($result->num_rows == 1) {
			return true;
	} else {
		return "No exist any building with this id";
	}
}

function delete() {
    $this->ConectarBD();
    $sql = "DELETE FROM BUILDING WHERE idBuilding ='$this->BUILDING_idBuilding'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos.';
    } else {
        return true;
    }
}

// public function findAll() {
//     $this->ConectarBD();
//     $stmt = $this->msqli->query("SELECT DISTINCT * FROM BUILDING");
//     $building_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     $buildings = array();

//     foreach ($building_db as $building) {
//         array_push($buildings, new Building($building["idBuilding"], $building["nameBuilding"],  $building["addressBuilding"], $building['phoneBuilding'],));
//     }

//     return $polls;
// }

}