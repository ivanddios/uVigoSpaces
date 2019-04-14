<?php

$tests = array();

require_once(__DIR__.'..\..\test\TEST_View.php');
include  './USER_LOGIN_Test.php';
include  './ACTION_ADD_Test.php';
include  './ACTION_EDIT_Test.php';
include  './ACTION_DELETE_Test.php';
include  './BUILDING_ADD_Test.php';
include  './BUILDING_EDIT_Test.php';
include  './BUILDING_DELETE_Test.php';
include  './FLOOR_ADD_Test.php';
include  './FLOOR_EDIT_Test.php';
include  './FLOOR_DELETE_Test.php';
include  './FUNCTIONALITY_ADD_Test.php';
include  './FUNCTIONALITY_EDIT_Test.php';
include  './FUNCTIONALITY_DELETE_Test.php';
include  './GROUP_ADD_Test.php';
include  './GROUP_EDIT_Test.php';
include  './GROUP_DELETE_Test.php';



if(isset($argv[1])){
    echo "\t"."\t"."TESTING OVER LOGIN FUNCTIONALITY" . "\n";
     foreach($tests as $test){
         if($test['Expected'] == $test['Result']){
             echo "\e[32m".$test['Description'] . "\t" ." Expected: " .$test['Expected']. "\t" . " Result: ". $test['Result'] ."\e[0m" . "\n";
         } else {
             echo "\e[31m".$test['Description'] . "\t" ." Expected: " .$test['Expected']. "\t". " Result: ". $test['Result'] ."\e[0m" . "\n";
         }
     }
 } else {
     new TEST_View($tests);
 }

?>