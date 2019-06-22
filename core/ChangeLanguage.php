<?php

/**
* File: ChangeLanguage.php
*
* Change the language with the value that gets from GET
*
*/


session_start();
$idioma = $_GET['idioma'];
$_SESSION['LANGUAGE'] = $idioma;
header('Location:' . $_SERVER["HTTP_REFERER"]);

?>