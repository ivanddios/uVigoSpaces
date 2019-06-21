<?php 

require_once("../model/FLOOR_Model.php");


//TESTS -> BUILDING ID
$tests['SM_FLOOR_DELETE_TEST1']=(['Functionality' => "SM_FLOOR_DELETE",
                'Description' => 'Test 1. Attempt to delete floor without values',
                'Expected' => 'Building identifier is mandatory',
                'Result' => 'Not executed']);

$floor = new FLOOR_Model();
$deleteAnswer = $floor->deleteFloor();
$tests['SM_FLOOR_DELETE_TEST1']["Result"] = $deleteAnswer;


$tests['SM_FLOOR_DELETE_TEST2']=(['Functionality' => "SM_FLOOR_DELETE",
                'Description' => "Test 2. Attempt to delete floor with building's identifier bigger than 5 characters",
                'Expected' => "Building identifier can't be larger than 5 characters",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('1234567');
$deleteAnswer = $floor->deleteFloor();
$tests['SM_FLOOR_DELETE_TEST2']["Result"] = $deleteAnswer;


$tests['SM_FLOOR_DELETE_TEST3']=(['Functionality' => "SM_FLOOR_DELETE",
                'Description' => "Test 3. Attempt to delete floor with building's identifier format invalid",
                'Expected' => 'Building identifier format is invalid',
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('¿?{');
$deleteAnswer = $floor->deleteFloor();
$tests['SM_FLOOR_DELETE_TEST3']["Result"] = $deleteAnswer;


$tests['SM_FLOOR_DELETE_TEST4']=(['Functionality' => "SM_FLOOR_DELETE",
                'Description' => "Test 4. Attempt to delete floor with floor identifier that not exists in DB",
                'Expected' => "There isn't a building with that identifier",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('0');
$deleteAnswer = $floor->deleteFloor();
$tests['SM_FLOOR_DELETE_TEST4']["Result"] = $deleteAnswer;


//TESTS -> FLOOR ID

$tests['SM_FLOOR_DELETE_TEST5']=(['Functionality' => "SM_FLOOR_DELETE",
                'Description' => "Test 5. Attempt to delete floor without floor identifier",
                'Expected' => 'Floor identifier is mandatory',
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0');
$deleteAnswer = $floor->deleteFloor();
$tests['SM_FLOOR_DELETE_TEST5']["Result"] = $deleteAnswer;


$tests['SM_FLOOR_DELETE_TEST5']=(['Functionality' => "SM_FLOOR_DELETE",
                'Description' => "Test 5. Attempt to delete floor with floor identifier bigger than 2 characters",
                'Expected' => "Floor identifier can't be larger than 2 characters",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0', '123');
$deleteAnswer = $floor->deleteFloor();
$tests['SM_FLOOR_DELETE_TEST5']["Result"] = $deleteAnswer;


$tests['SM_FLOOR_DELETE_TEST6']=(['Functionality' => "SM_FLOOR_DELETE",
                'Description' => "Test 6. Attempt to delete floor with floor identifier format invalid",
                'Expected' => 'Floor identifier format is invalid',
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0','!');
$deleteAnswer = $floor->deleteFloor();
$tests['SM_FLOOR_DELETE_TEST6']["Result"] = $deleteAnswer;


$tests['SM_FLOOR_DELETE_TEST7']=(['Functionality' => "SM_FLOOR_DELETE",
                'Description' => "Test 7. Attempt to delete floor with floor indentifer not exists in the building",
                'Expected' => "There isn't a floor with that identifier in the building",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0','98');
$deleteAnswer = $floor->deleteFloor();
$tests['SM_FLOOR_DELETE_TEST7']["Result"] = $deleteAnswer;




//FINAL TEST
$tests['SM_FLOOR_DELETE_TEST8']=(['Functionality' => "SM_FLOOR_EDIT",
                'Description' => "Test 8. Attempt to edit floor with correct values",
                'Expected' => 'Floor deleted successfully',
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0', '99');
$deleteAnswer = $floor->deleteFloor();
if($deleteAnswer === true){
    $tests['SM_FLOOR_DELETE_TEST8']["Result"] = 'Floor deleted successfully';
}else{
    $tests['SM_FLOOR_DELETE_TEST8']["Result"] = $deleteAnswer;
}





// if(isset($argv[1])){
//    echo "\t"."\t"."TESTING OVER FLOOR_DELETE" . "\n";
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