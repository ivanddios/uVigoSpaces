<?php 

require_once(__DIR__.'..\..\model\SPACE_Model.php');


 //TESTS -> BUILDING ID
$tests['SM_SPACE_EDIT_TEST1']=(['Functionality' => "SM_SPACE_EDIT",
                'Description' => 'Test 1. Attempt to update space without values',
                'Expected' => 'Building identifier is mandatory',
                'Result' => 'Not executed']);

$space = new SPACE_Model();
$updateAnswer = $space->updateSpace('99999');
$tests['SM_SPACE_EDIT_TEST1']["Result"] = $updateAnswer;


$tests['SM_SPACE_EDIT_TEST2']=(['Functionality' => "SM_SPACE_EDIT",
                'Description' => "Test 2. Attempt to update space with building's identifier bigger than 5 characters",
                'Expected' => "Building identifier can't be larger than 5 characters",
                'Result' => 'Not executed']);

$space = new SPACE_Model('1234567');
$updateAnswer = $space->updateSpace('99999');
$tests['SM_SPACE_EDIT_TEST2']["Result"] = $updateAnswer;


$tests['SM_SPACE_EDIT_TEST3']=(['Functionality' => "SM_SPACE_EDIT",
                'Description' => "Test 3. Attempt to update space with building's identifier format invalid",
                'Expected' => 'Building identifier format is invalid',
                'Result' => 'Not executed']);

$space = new SPACE_Model('¿?{');
$updateAnswer = $space->updateSpace('99999');
$tests['SM_SPACE_EDIT_TEST3']["Result"] = $updateAnswer;


$tests['SM_SPACE_EDIT_TEST4']=(['Functionality' => "SM_SPACE_EDIT",
                'Description' => "Test 4. Attempt to update space with floor identifier that not exists in DB",
                'Expected' => "There isn't a building with that identifier",
                'Result' => 'Not executed']);

$space = new SPACE_Model('0');
$updateAnswer = $space->updateSpace('99999');
$tests['SM_SPACE_EDIT_TEST4']["Result"] = $updateAnswer;


//TESTS -> FLOOR ID

$tests['SM_SPACE_EDIT_TEST5']=(['Functionality' => "SM_SPACE_EDIT",
                'Description' => "Test 5. Attempt to update space without floor identifier",
                'Expected' => 'Floor identifier is mandatory',
                'Result' => 'Not executed']);

$space = new SPACE_Model('OSBI0');
$updateAnswer = $space->updateSpace('99999');
$tests['SM_SPACE_EDIT_TEST5']["Result"] = $updateAnswer;


$tests['SM_SPACE_EDIT_TEST5']=(['Functionality' => "SM_SPACE_EDIT",
                'Description' => "Test 5. Attempt to update space with floor identifier bigger than 2 characters",
                'Expected' => "Floor identifier can't be larger than 2 characters",
                'Result' => 'Not executed']);

$space = new SPACE_Model('OSBI0', '123');
$updateAnswer = $space->updateSpace('99999');
$tests['SM_SPACE_EDIT_TEST5']["Result"] = $updateAnswer;


$tests['SM_SPACE_EDIT_TEST6']=(['Functionality' => "SM_SPACE_EDIT",
                'Description' => "Test 6. Attempt to update space with floor identifier format invalid",
                'Expected' => 'Floor identifier format is invalid',
                'Result' => 'Not executed']);

$space = new SPACE_Model('OSBI0','!');
$updateAnswer = $space->updateSpace('99999');
$tests['SM_SPACE_EDIT_TEST6']["Result"] = $updateAnswer;



$tests['SM_SPACE_EDIT_TEST7']=(['Functionality' => "SM_SPACE_EDIT",
                'Description' => "Test 7. Attempt to update space with floor that no exists in the building",
                'Expected' => "There isn't a floor with that identifier in the building",
                'Result' => 'Not executed']);

$space = new SPACE_Model('OSBI0', 'SD');
$updateAnswer = $space->updateSpace('99999');
$tests['SM_SPACE_EDIT_TEST7']["Result"] = $updateAnswer;


//TEST-> SPACE ID
$tests['SM_SPACE_EDIT_TEST8']=(['Functionality' => "SM_SPACE_EDIT",
                'Description' => "Test 8. Attempt to update space without space identifier",
                'Expected' => "Space identifier is mandatory",
                'Result' => 'Not executed']);

$space = new SPACE_Model('OSBI0', '00');
$updateAnswer = $space->updateSpace('99999');
$tests['SM_SPACE_EDIT_TEST8']["Result"] = $updateAnswer;


$tests['SM_SPACE_EDIT_TEST9']=(['Functionality' => "SM_SPACE_EDIT",
                'Description' => "Test 9. Attempt to update space with space identifier bigger than 5 characters",
                'Expected' => "Space identifier can't be larger than 5 characters",
                'Result' => 'Not executed']);

$space = new SPACE_Model('OSBI0', '00', '123456');
$updateAnswer = $space->updateSpace('99999');
$tests['SM_SPACE_EDIT_TEST9']["Result"] = $updateAnswer;


$tests['SM_SPACE_EDIT_TEST10']=(['Functionality' => "SM_SPACE_EDIT",
                'Description' => "Test 10. Attempt to update space with space identifier format incorrect",
                'Expected' => "Space identifier is invalid",
                'Result' => 'Not executed']);

$space = new SPACE_Model('OSBI0', '00', 'abcd');
$updateAnswer = $space->updateSpace('99999');
$tests['SM_SPACE_EDIT_TEST10']["Result"] = $updateAnswer;



//TEST-> SPACE NAME
$tests['SM_SPACE_EDIT_TEST11']=(['Functionality' => "SM_SPACE_EDIT",
                'Description' => "Test 11. Attempt to update space without space name",
                'Expected' => "Space name is mandatory",
                'Result' => 'Not executed']);

$space = new SPACE_Model('OSBI0', '00', '12345');
$updateAnswer = $space->updateSpace('99999');
$tests['SM_SPACE_EDIT_TEST11']["Result"] = $updateAnswer;


$tests['SM_SPACE_EDIT_TEST12']=(['Functionality' => "SM_SPACE_EDIT",
                'Description' => "Test 12. Attempt to update space with space name bigger than 225 characters",
                'Expected' => "Space name can't be larger than 225 characters",
                'Result' => 'Not executed']);

$space = new SPACE_Model('OSBI0', '00', '12345', 'uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
                        dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$updateAnswer = $space->updateSpace('99999');
$tests['SM_SPACE_EDIT_TEST12']["Result"] = $updateAnswer;


$tests['SM_SPACE_EDIT_TEST13']=(['Functionality' => "SM_SPACE_EDIT",
                'Description' => "Test 13. Attempt to update space with space name format incorrect",
                'Expected' => "Space name format is invalid",
                'Result' => 'Not executed']);

$space = new SPACE_Model('OSBI0', '00', '12345', '111111');
$updateAnswer = $space->updateSpace('99999');
$tests['SM_SPACE_EDIT_TEST13']["Result"] = $updateAnswer;


//TEST-> SURFACE SPACE

$tests['SM_SPACE_EDIT_TEST14']=(['Functionality' => "SM_SPACE_EDIT",
                'Description' => "Test 14. Attempt to update space with space surface bigger than 99999999.99",
                'Expected' => "Space surface can't be larger than 99999999.99",
                'Result' => 'Not executed']);

$space = new SPACE_Model('OSBI0', '00', '12345', 'nameSpace', 100000000.00);
$updateAnswer = $space->updateSpace('99999');
$tests['SM_SPACE_EDIT_TEST14']["Result"] = $updateAnswer;


//TEST-> NUMBER INVENTORY

$tests['SM_SPACE_EDIT_TEST15']=(['Functionality' => "SM_SPACE_EDIT",
                'Description' => "Test 15. Attempt to update space with space number inventory bigger than 6 characters",
                'Expected' => "Number inventory can't be larger than 6 characters",
                'Result' => 'Not executed']);

$space = new SPACE_Model('OSBI0', '00', '12345', 'nameSpace', 99.9, '1234567');
$updateAnswer = $space->updateSpace('99999');
$tests['SM_SPACE_EDIT_TEST15']["Result"] = $updateAnswer;


$tests['SM_SPACE_EDIT_TEST16']=(['Functionality' => "SM_SPACE_EDIT",
                'Description' => "Test 16. Attempt to update the space id for another one that is associated with another space",
                'Expected' => "There is already a space with that identifier in this floor",
                'Result' => 'Not executed']);

$space = new SPACE_Model('OSBI0', '00', '00001', 'nameSpace', 99.9, '######');
$updateAnswer = $space->updateSpace('99999');
$tests['SM_SPACE_EDIT_TEST16']["Result"] = $updateAnswer;



//FINAL TEST
$tests['SM_SPACE_EDIT_TEST17']=(['Functionality' => "SM_SPACE_EDIT",
                'Description' => "Test 17. Attempt to update space with correct values",
                'Expected' => 'Space successfully updated',
                'Result' => 'Not executed']);

$space = new SPACE_Model('OSBI0', '00', '99999', 'nameSpaceUpdated', 88.8, '######');
$updateAnswer = $space->updateSpace('99999');
if($updateAnswer === true){
    $tests['SM_SPACE_EDIT_TEST17']["Result"] = 'Space successfully updated';
} else {
    $tests['SM_SPACE_EDIT_TEST17']["Result"] = $updateAnswer;
}



// if(isset($argv[1])){
//    echo "\t"."\t"."TESTING OVER SPACE_EDIT" . "\n";
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