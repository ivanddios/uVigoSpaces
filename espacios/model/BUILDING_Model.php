<?php

class BUILDING_Model {

	private $BUILDING_idBuilding;
	private $BUILDING_name;
	private $BUILDING_address;
	private $BUILDING_phone;
	private $BUILDING_responsible;
	private $mysqli;


function __construct($BUILDING_idBuilding, $BUILDING_name, $BUILDING_address, $BUILDING_phone, $BUILDING_responsible)
{
    $this->BUILDING_idBuilding =  $BUILDING_idBuilding; 
	$this->BUILDING_name = $BUILDING_name;
	$this->BUILDING_address = $BUILDING_address;
	$this->BUILDING_phone = $BUILDING_phone;
	$this->BUILDING_responsible =  $BUILDING_responsible;
}

public function getIdBuilding(){
    return $this->BUILDING_idBuilding;
}

function ConectarBD() {
    $this->mysqli = new mysqli("localhost", "root", "", "espacios");
    if ($this->mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
    }
}

function showAllBuilding() {
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



function findbyIdBuilding() {
	$this->ConectarBD();
	$sql = "SELECT * FROM BUILDING WHERE idBuilding = '$this->BUILDING_idBuilding'";
	$result = $this->mysqli->query($sql);
	if ($result->num_rows == 1) {
		return true;
	} else {
		return "No exist any building with this id";
	}
}

function deleteBuilding() {
    $this->ConectarBD();
    $sql = "DELETE FROM BUILDING WHERE idBuilding ='$this->BUILDING_idBuilding'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos.';
    } else {
        return true;
    }
}

function FillInBuilding() {
    $this->ConectarBD();
    $sql = "SELECT * FROM BUILDING WHERE idBuilding = '$this->BUILDING_idBuilding'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos';
    } else {
        $result = $resultado->fetch_array();
        return $result;
    }
}

function updateBuilding($idBuilding) {
    $this->ConectarBD();
    var_dump($this->BUILDING_idBuilding);
    $sql = "UPDATE BUILDING SET idBuilding = '$this->BUILDING_idBuilding', nameBuilding = '$this->BUILDING_name', addressBuilding = '$this->BUILDING_address', phoneBuilding = '$this->BUILDING_phone', responsibleBuilding = '$this->BUILDING_responsible' WHERE idBuilding = '$idBuilding'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos.';
    } else {
        return true;
    }
}

}