<?php 

require_once(__DIR__.'..\..\model\BUILDING_Model.php');

//TEST BUILDING ID

$tests['SM_BUILDING_DELETE_TEST1']=(['Functionality' => "SM_BUILDING_DELETE",
                'Description' => 'Test 1. Attempt to delete building without identifier',
                'Expected' => 'Building identifier is mandatory',
                'Result' => 'Not executed']);

$building = new BUILDING_Model();
$deleteAnswer = $building->deleteBuilding();
$tests['SM_BUILDING_DELETE_TEST1']["Result"] = $deleteAnswer;


$tests['SM_BUILDING_DELETE_TEST2']=(['Functionality' => "SM_BUILDING_DELETE",
                'Description' => 'Test 2. Attempt to delete building with a identifier format invalid or incorrect',
                'Expected' => 'Building identifier format is invalid',
                'Result' => 'Not executed']);

$building = new BUILDING_Model('?!');
$deleteAnswer = $building->deleteBuilding();
$tests['SM_BUILDING_DELETE_TEST2']["Result"] = $deleteAnswer;



$tests['SM_BUILDING_DELETE_TEST3']=(['Functionality' => "SM_BUILDING_DELETE",
                'Description' => 'Test 3. Attempt to delete building with a identifier format invalid or incorrect',
                'Expected' => "Building identifier can't be larger than 5 characters",
                'Result' => 'Not executed']);

$building = new BUILDING_Model('badBuildingId');
$deleteAnswer = $building->deleteBuilding();
$tests['SM_BUILDING_DELETE_TEST3']["Result"] = $deleteAnswer;




$tests['SM_BUILDING_DELETE_TEST4']=(['Functionality' => "SM_BUILDING_DELETE",
                'Description' => "Test 4. Attempt to delete building with a identifier that not exists in the DB",
                'Expected' => "There isn't a building with that identifier",
                'Result' => 'Not executed']);

$building = new BUILDING_Model('0');
$deleteAnswer = $building->deleteBuilding();
$tests['SM_BUILDING_DELETE_TEST4']["Result"] = $deleteAnswer;


//FINAL TEST

$tests['SM_BUILDING_DELETE_TEST5']=(['Functionality' => "SM_BUILDING_DELETE",
                'Description' => "Test 5. Attempt to delete building with correct values",
                'Expected' => 'Building successfully deleted',
                'Result' => 'Not executed']);

$building = new BUILDING_Model($randId);
$deleteAnswer = $building->deleteBuilding();
if($deleteAnswer === true){
    $tests['SM_BUILDING_DELETE_TEST5']["Result"] = 'Building successfully deleted';
} else {
    $tests['SM_BUILDING_DELETE_TEST5']["Result"] = $deleteAnswer;
}




// if(isset($argv[1])){
//    echo "\t"."\t"."TESTING OVER BUILDING_DELETE" . "\n";
//     foreach($tests as $test){
//         if($test['Expected'] == $test['Result']){
//             echo "\e[32m".$test['Description'] . "\t" ." Expected: " .$test['Expected']. "\t" . " Result: ". $test['Result'] ."\e[0m" . "\n";
//         } else {
//             echo "\e[31m".$test['Description'] . "\t" ." Expected: " .$test['Expected']. "\t". " Result: ". $test['Result'] ."\e[0m" . "\n";
//         }
//     }
// } else {
//     new TEST_View($tests);
// }

?>