<?php

class BUILDING_Model {

	private $idBuilding;
	private $nameBuilding;
	private $addressBuilding;
	private $phoneBuilding;
	private $responsibleBuilding;
	private $mysqli;


function __construct($idBuilding=NULL, $nameBuilding=NULL, $addressBuilding=NULL, $phoneBuilding=NULL, $responsibleBuilding=NULL)
{
    $this->idBuilding =  $idBuilding; 
	$this->nameBuilding = $nameBuilding;
	$this->addressBuilding = $addressBuilding;
	$this->phoneBuilding = $phoneBuilding;
	$this->responsibleBuilding =  $responsibleBuilding;
}

public function getIdBuilding(){
    return $this->idBuilding;
}

public function getNameBuilding(){
    return $this->nameBuilding;
}


function ConectarBD() {
    $this->mysqli = new mysqli("localhost", "root", "", "espacios");
    $acentos = $this->mysqli->query("SET NAMES 'utf8'");
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

function findBuilding() {
	$this->ConectarBD();
	$sql = "SELECT * FROM BUILDING WHERE idBuilding = '$this->idBuilding'";
	$result = $this->mysqli->query($sql);
	if ($result->num_rows == 1) {
		return true;
	} else {
		return "No exist any building with this id";
	}
}

function addBuilding() {
    $this->ConectarBD();
    $sql = "INSERT INTO BUILDING (idBuilding, nameBuilding, addressBuilding, phoneBuilding, responsibleBuilding) VALUES ('$this->idBuilding', '$this->nameBuilding', '$this->addressBuilding', '$this->phoneBuilding', '$this->responsibleBuilding')";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos.';
    } else {
        return true;
    }
}


function deleteBuilding() {
    $this->ConectarBD();
    $sql = "DELETE FROM BUILDING WHERE idBuilding ='$this->idBuilding'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos.';
    } else {
        return true;
    }
}

function fillInBuilding() {
    $this->ConectarBD();
    $sql = "SELECT * FROM BUILDING WHERE idBuilding = '$this->idBuilding'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos';
    } else {
        $result = $resultado->fetch_array();
        return $result;
    }
}

function updateBuilding($idBuilding) {
    $this->ConectarBD();
    $sql = "UPDATE BUILDING SET idBuilding = '$this->idBuilding', nameBuilding = '$this->nameBuilding', addressBuilding = '$this->addressBuilding', phoneBuilding = '$this->phoneBuilding', responsibleBuilding = '$this->responsibleBuilding' WHERE idBuilding = '$idBuilding'";
    if (!($resultado = $this->mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos.';
    } else {
        return true;
    }
}


function findBuildingName() {
    $this->ConectarBD();
    $sql = "SELECT nameBuilding FROM BUILDING WHERE idBuilding='$this->idBuilding'";
    $result = $this->mysqli->query($sql)->fetch_array();
    return $result['nameBuilding'];
}

}