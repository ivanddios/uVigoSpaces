<?php 

require_once(__DIR__.'..\..\model\SPACE_Model.php');


//TESTS -> BUILDING ID
$tests['SM_SPACE_DELETE_TEST1']=(['Functionality' => "SM_SPACE_DELETE",
                'Description' => 'Test 1. Attempt to delete space without values',
                'Expected' => 'Building identifier is mandatory',
                'Result' => 'Not executed']);

$floor = new SPACE_Model();
$deleteAnswer = $floor->deleteSpace();
$tests['SM_SPACE_DELETE_TEST1']["Result"] = $deleteAnswer;


$tests['SM_SPACE_DELETE_TEST2']=(['Functionality' => "SM_SPACE_DELETE",
                'Description' => "Test 2. Attempt to delete space with building's identifier bigger than 5 characters",
                'Expected' => "Building identifier can't be larger than 5 characters",
                'Result' => 'Not executed']);

$floor = new SPACE_Model('1234567');
$deleteAnswer = $floor->deleteSpace();
$tests['SM_SPACE_DELETE_TEST2']["Result"] = $deleteAnswer;


$tests['SM_SPACE_DELETE_TEST3']=(['Functionality' => "SM_SPACE_DELETE",
                'Description' => "Test 3. Attempt to delete space with building's identifier format invalid",
                'Expected' => 'Building identifier format is invalid',
                'Result' => 'Not executed']);

$floor = new SPACE_Model('¿?{');
$deleteAnswer = $floor->deleteSpace();
$tests['SM_SPACE_DELETE_TEST3']["Result"] = $deleteAnswer;


$tests['SM_SPACE_DELETE_TEST4']=(['Functionality' => "SM_SPACE_DELETE",
                'Description' => "Test 4. Attempt to delete space with floor identifier that not exists in DB",
                'Expected' => "There isn't a building with that identifier",
                'Result' => 'Not executed']);

$floor = new SPACE_Model('0');
$deleteAnswer = $floor->deleteSpace();
$tests['SM_SPACE_DELETE_TEST4']["Result"] = $deleteAnswer;


//TESTS -> FLOOR ID

$tests['SM_SPACE_DELETE_TEST5']=(['Functionality' => "SM_SPACE_DELETE",
                'Description' => "Test 5. Attempt to delete space without floor identifier",
                'Expected' => 'Floor identifier is mandatory',
                'Result' => 'Not executed']);

$floor = new SPACE_Model('OSBI0');
$deleteAnswer = $floor->deleteSpace();
$tests['SM_SPACE_DELETE_TEST5']["Result"] = $deleteAnswer;


$tests['SM_SPACE_DELETE_TEST5']=(['Functionality' => "SM_SPACE_DELETE",
                'Description' => "Test 5. Attempt to delete space with floor identifier bigger than 2 characters",
                'Expected' => "Floor identifier can't be larger than 2 characters",
                'Result' => 'Not executed']);

$floor = new SPACE_Model('OSBI0', '123');
$deleteAnswer = $floor->deleteSpace();
$tests['SM_SPACE_DELETE_TEST5']["Result"] = $deleteAnswer;


$tests['SM_SPACE_DELETE_TEST6']=(['Functionality' => "SM_SPACE_DELETE",
                'Description' => "Test 6. Attempt to delete space with floor identifier format invalid",
                'Expected' => 'Floor identifier format is invalid',
                'Result' => 'Not executed']);

$floor = new SPACE_Model('OSBI0','!');
$deleteAnswer = $floor->deleteSpace();
$tests['SM_SPACE_DELETE_TEST6']["Result"] = $deleteAnswer;


$tests['SM_SPACE_DELETE_TEST7']=(['Functionality' => "SM_SPACE_DELETE",
                'Description' => "Test 7. Attempt to delete space with floor indentifer no exists in that building",
                'Expected' => "There isn't a floor with that identifier in the building",
                'Result' => 'Not executed']);

$floor = new SPACE_Model('OSBI0','98');
$deleteAnswer = $floor->deleteSpace();
$tests['SM_SPACE_DELETE_TEST7']["Result"] = $deleteAnswer;


//TEST-> SPACE ID
$tests['SM_SPACE_DELETE_TEST8']=(['Functionality' => "SM_SPACE_DELETE",
                'Description' => "Test 8. Attempt to delete space without space identifier",
                'Expected' => "Space identifier is mandatory",
                'Result' => 'Not executed']);

$space = new SPACE_Model('OSBI0', '00');
$deleteAnswer = $space->deleteSpace();
$tests['SM_SPACE_DELETE_TEST8']["Result"] = $deleteAnswer;


$tests['SM_SPACE_DELETE_TEST9']=(['Functionality' => "SM_SPACE_DELETE",
                'Description' => "Test 9. Attempt to delete space with space identifier bigger than 5 characters",
                'Expected' => "Space identifier can't be larger than 5 characters",
                'Result' => 'Not executed']);

$space = new SPACE_Model('OSBI0', '00', '123456');
$deleteAnswer = $space->deleteSpace();
$tests['SM_SPACE_DELETE_TEST9']["Result"] = $deleteAnswer;


$tests['SM_SPACE_DELETE_TEST10']=(['Functionality' => "SM_SPACE_DELETE",
                'Description' => "Test 10. Attempt to delete space with space identifier format incorrect",
                'Expected' => "Space identifier is invalid",
                'Result' => 'Not executed']);

$space = new SPACE_Model('OSBI0', '00', 'abcd');
$deleteAnswer = $space->deleteSpace();
$tests['SM_SPACE_DELETE_TEST10']["Result"] = $deleteAnswer;


//TEST DELETE SPACE THAT NOT EXISTS
$tests['SM_SPACE_DELETE_TEST11']=(['Functionality' => "SM_SPACE_DELETE",
                'Description' => "Test 11. Attempt to delete space with space identifier that not exists in this floor's building",
                'Expected' => "There isn't a space with that identifier in the floor",
                'Result' => 'Not executed']);

$space = new SPACE_Model('OSBI0', '00', '12345');
$deleteAnswer = $space->deleteSpace();
$tests['SM_SPACE_DELETE_TEST11']["Result"] = $deleteAnswer;



//FINAL TEST
$tests['SM_SPACE_DELETE_TEST12']=(['Functionality' => "SM_SPACE_DELETE",
                'Description' => "Test 12. Attempt to delete space with correct values",
                'Expected' => 'Space deleted successfully',
                'Result' => 'Not executed']);

$space = new SPACE_Model('OSBI0', '00', '99999');
$deleteAnswer = $space->deleteSpace();
if($deleteAnswer === true){
    $tests['SM_SPACE_DELETE_TEST12']["Result"] = 'Space deleted successfully';
}else{
    $tests['SM_SPACE_DELETE_TEST12']["Result"] = $deleteAnswer;
}





// if(isset($argv[1])){
//    echo "\t"."\t"."TESTING OVER SPACE_DELETE" . "\n";
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