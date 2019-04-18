<?php

require_once(__DIR__.'..\..\test\TEST_View.php');
require_once(__DIR__.'\USER_LOGIN_Test.php');
require_once(__DIR__.'\ACTION_ADD_Test.php');
require_once(__DIR__.'\ACTION_EDIT_Test.php');
require_once(__DIR__.'\ACTION_DELETE_Test.php');
require_once(__DIR__.'\BUILDING_ADD_Test.php');
require_once(__DIR__.'\BUILDING_EDIT_Test.php');
require_once(__DIR__.'\BUILDING_DELETE_Test.php');
require_once(__DIR__.'\FLOOR_ADD_Test.php');
require_once(__DIR__.'\FLOOR_EDIT_Test.php');
require_once(__DIR__.'\FLOOR_DELETE_Test.php');
require_once(__DIR__.'\FUNCTIONALITY_ADD_Test.php');
require_once(__DIR__.'\FUNCTIONALITY_EDIT_Test.php');
require_once(__DIR__.'\FUNCTIONALITY_DELETE_Test.php');
require_once(__DIR__.'\GROUP_ADD_Test.php');
require_once(__DIR__.'\GROUP_EDIT_Test.php');
require_once(__DIR__.'\GROUP_DELETE_Test.php');
require_once(__DIR__.'\SPACE_ADD_Test.php');
require_once(__DIR__.'\SPACE_EDIT_Test.php');
require_once(__DIR__.'\SPACE_DELETE_Test.php');
require_once(__DIR__.'\USER_ADD_Test.php');
require_once(__DIR__.'\USER_EDIT_Test.php');
require_once(__DIR__.'\USER_DELETE_Test.php');


if(isset($argv[1])){
    echo "\t"."\t"."TESTING OVER SPACE MANAGER FUNCTIONALITIES" . "\n";
     foreach($tests as $test){
         if($test['Expected'] === $test['Result']){
             echo "\e[32m".$test['Description'] . "\t" ." Expected: " .$test['Expected']. "\t" . " Result: ". $test['Result'] ."\e[0m" . "\n";
         } else {
             echo "\e[31m".$test['Description'] . "\t" ." Expected: " .$test['Expected']. "\t". " Result: ". $test['Result'] ."\e[0m" . "\n";
         }
     }
 } else {
     new TEST_View($tests);
 }

?>