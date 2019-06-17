<?php

require_once("../core/ViewManager.php");
require_once("../core/ACL.php");
require_once("../view/TEST_View.php");
require_once("../test/USER_LOGIN_Test.php");
require_once("../test/ACTION_ADD_Test.php");
require_once("../test/ACTION_EDIT_Test.php");
require_once("../test/ACTION_DELETE_Test.php");
require_once("../test/BUILDING_ADD_Test.php");
require_once("../test/BUILDING_EDIT_Test.php");
require_once("../test/BUILDING_DELETE_Test.php");
require_once("../test/FLOOR_ADD_Test.php");
require_once("../test/FLOOR_EDIT_Test.php");
require_once("../test/FLOOR_DELETE_Test.php");
require_once("../test/FUNCTIONALITY_ADD_Test.php");
require_once("../test/FUNCTIONALITY_EDIT_Test.php");
require_once("../test/FUNCTIONALITY_DELETE_Test.php");
require_once("../test/GROUP_ADD_Test.php");
require_once("../test/GROUP_EDIT_Test.php");
require_once("../test/GROUP_DELETE_Test.php");
require_once("../test/SPACE_ADD_Test.php");
require_once("../test/SPACE_EDIT_Test.php");
require_once("../test/SPACE_DELETE_Test.php");
require_once("../test/USER_ADD_Test.php");
require_once("../test/USER_EDIT_Test.php");
require_once("../test/USER_DELETE_Test.php");

$view = new ViewManager();

include '../view/locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';


if (!isset($_GET['action'])){
	$_GET['action'] = '';
}

Switch ($_GET['action']){

    default:
        if(isset($argv[1])){
            echo "/t"."/t"."TESTING OVER SPACE MANAGER FUNCTIONALITIES" . "/n";
            foreach($tests as $test){
                if($test['Expected'] === $test['Result']){
                    echo "/e[32m".$test['Description'] . "/t" ." Expected: " .$test['Expected']. "/t" . " Result: ". $test['Result'] ."/e[0m" . "/n";
                } else {
                    echo "/e[31m".$test['Description'] . "/t" ." Expected: " .$test['Expected']. "/t". " Result: ". $test['Result'] ."/e[0m" . "/n";
                }
            }
        } else {
            $totalTests = count($tests);
            $tests_valids = 0; $tests_invalids = 0;
            foreach($tests as $test){
                if($test['Expected'] === $test['Result']){
                    $tests_valids +=1;
                } else {
                    $tests_invalids +=1;
                }
            }
            new TEST_View($tests, $totalTests, $tests_valids, $tests_invalids);
        }
    break;
						
}

?>