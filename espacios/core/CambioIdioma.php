<?php

session_start();
$idioma = $_GET['idioma'];
$_SESSION['LANGUAGE'] = $idioma;
var_dump($_SERVER["HTTP_REFERER"]);
header('Location:' . $_SERVER["HTTP_REFERER"]);



?>