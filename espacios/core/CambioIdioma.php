
<?php
session_start();
$idioma = $_GET['idioma'];
$_SESSION['LANGUAGE'] = $idioma;
header('Location:' . $_SERVER["HTTP_REFERER"]);
?>