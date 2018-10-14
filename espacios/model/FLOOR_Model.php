<?php

class FLOOR_Model {

    private $FLOOR_idBuilding;
	private $FLOOR_idFloor;
	private $FLOOR_nameFloor;
	private $FLOOR_planFloor;
	private $FLOOR_surfaceBuildingFloor;
    private $FLOOR_surfaceUsefulFloor;
	private $mysqli;


function __construct($FLOOR_idBuilding, $FLOOR_idFloor, $FLOOR_nameFloor, $FLOOR_planFloor, $FLOOR_surfaceBuildingFloor, $FLOOR_surfaceUsefulFloor)
{
    $this->FLOOR_idBuilding =  $FLOOR_idBuilding; 
    $this->FLOOR_idFloor = $FLOOR_idFloor;
	$this->FLOOR_nameFloor = $FLOOR_nameFloor;
	$this->FLOOR_planFloor = $FLOOR_planFloor;
	$this->FLOOR_surfaceBuildingFloor = $FLOOR_surfaceBuildingFloor;
	$this->FLOOR_surfaceUsefulFloor =  $FLOOR_surfaceUsefulFloor;
}

function ConectarBD() {
    $this->mysqli = new mysqli("localhost", "root", "", "espacios");
    if ($this->mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
    }
}

function showAllFloor() {
    $this->ConectarBD();
    $sql = "SELECT * FROM FLOOR WHERE idBuilding = '$this->FLOOR_idBuilding'" ;
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