<?php 

require_once(__DIR__.'..\..\model\BUILDING_Model.php');


$tests['SM_BUILDING_ADD_TEST1']=(['Functionality' => "SM_BUILDING_ADD",
                'Description' => 'Test 1. Attempt to add building without values',
                'Expected' => 'Building identifier is mandatory',
                'Result' => 'Not executed']);

$building = new BUILDING_Model();
$addAnswer = $building->addBuilding();
$tests['SM_BUILDING_ADD_TEST1']["Result"] = $addAnswer;


//TESTS -> BUILDING ID

$tests['SM_BUILDING_ADD_TEST2']=(['Functionality' => "SM_BUILDING_ADD",
                'Description' => "Test 2. Attempt to add building with identifier bigger than 5 characters",
                'Expected' => "Building identifier can't be larger than 5 characters",
                'Result' => 'Not executed']);

$building = new BUILDING_Model('1234567');
$addAnswer = $building->addBuilding();
$tests['SM_BUILDING_ADD_TEST2']["Result"] = $addAnswer;


$tests['SM_BUILDING_ADD_TEST3']=(['Functionality' => "SM_BUILDING_ADD",
                'Description' => "Test 3. Attempt to add building with identifier format invalid",
                'Expected' => 'Building identifier format is invalid',
                'Result' => 'Not executed']);

$building = new BUILDING_Model('¿?{');
$addAnswer = $building->addBuilding();
$tests['SM_BUILDING_ADD_TEST3']["Result"] = $addAnswer;



//TESTS -> BUILDING NAME

$tests['SM_BUILDING_ADD_TEST4']=(['Functionality' => "SM_BUILDING_ADD",
                'Description' => "Test 4. Attempt to add building without name",
                'Expected' => 'Building name is mandatory',
                'Result' => 'Not executed']);

$building = new BUILDING_Model('OSBI1');
$addAnswer = $building->addBuilding();
$tests['SM_BUILDING_ADD_TEST4']["Result"] = $addAnswer;


$tests['SM_BUILDING_ADD_TEST5']=(['Functionality' => "SM_BUILDING_ADD",
                'Description' => "Test 5. Attempt to add building with name bigger than 255 characters",
                'Expected' => "Building name can't be larger than 255 characters",
                'Result' => 'Not executed']);

$building = new BUILDING_Model('OSBI1', 'uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$addAnswer = $building->addBuilding();
$tests['SM_BUILDING_ADD_TEST5']["Result"] = $addAnswer;


$tests['SM_BUILDING_ADD_TEST6']=(['Functionality' => "SM_BUILDING_ADD",
                'Description' => "Test 6. Attempt to add building with name format invalid",
                'Expected' => 'Building name format is invalid',
                'Result' => 'Not executed']);

$building = new BUILDING_Model('OSBI1','111111');
$addAnswer = $building->addBuilding();
$tests['SM_BUILDING_ADD_TEST6']["Result"] = $addAnswer;



//TESTS -> BUILDING ADDRESS

$tests['SM_BUILDING_ADD_TEST7']=(['Functionality' => "SM_BUILDING_ADD",
                'Description' => "Test 7. Attempt to add building without address",
                'Expected' => 'Building address is mandatory',
                'Result' => 'Not executed']);

$building = new BUILDING_Model('OSBI1','nameBuilding');
$addAnswer = $building->addBuilding();
$tests['SM_BUILDING_ADD_TEST7']["Result"] = $addAnswer;



$tests['SM_BUILDING_ADD_TEST8']=(['Functionality' => "SM_BUILDING_ADD",
                'Description' => "Test 8. Attempt to add building with address bigger than 255 characters",
                'Expected' => "Building address can't be larger than 255 characters",
                'Result' => 'Not executed']);

$building = new BUILDING_Model('OSBI1', 'nameBuilding', 'uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$addAnswer = $building->addBuilding();
$tests['SM_BUILDING_ADD_TEST8']["Result"] = $addAnswer;


$tests['SM_BUILDING_ADD_TEST9']=(['Functionality' => "SM_BUILDING_ADD",
                'Description' => "Test 9. Attempt to add building with address format invalid",
                'Expected' => 'Building address format is invalid',
                'Result' => 'Not executed']);

$building = new BUILDING_Model('OSBI1','nameBuilding', '111111');
$addAnswer = $building->addBuilding();
$tests['SM_BUILDING_ADD_TEST9']["Result"] = $addAnswer;



//TESTS BUILDING PHONE

$tests['SM_BUILDING_ADD_TEST10']=(['Functionality' => "SM_BUILDING_ADD",
                'Description' => "Test 10. Attempt to add building without phone",
                'Expected' => 'Building phone is incorrect',
                'Result' => 'Not executed']);

$building = new BUILDING_Model('OSBI1','nameBuilding','addressBuilding');
$addAnswer = $building->addBuilding();
$tests['SM_BUILDING_ADD_TEST10']["Result"] = $addAnswer;



$tests['SM_BUILDING_ADD_TEST11']=(['Functionality' => "SM_BUILDING_ADD",
                'Description' => "Test 11. Attempt to add building with phone bigger than 9 characters",
                'Expected' => 'Building phone is incorrect',
                'Result' => 'Not executed']);

$building = new BUILDING_Model('OSBI1', 'nameBuilding', 'addressBuilding', 1234567890);
$addAnswer = $building->addBuilding();
$tests['SM_BUILDING_ADD_TEST11']["Result"] = $addAnswer;


$tests['SM_BUILDING_ADD_TEST12']=(['Functionality' => "SM_BUILDING_ADD",
                'Description' => "Test 12. Attempt to add building with phone format invalid",
                'Expected' => 'Building phone format is invalid',
                'Result' => 'Not executed']);

$building = new BUILDING_Model('OSBI1','nameBuilding', 'addressBuilding', 101010101);
$addAnswer = $building->addBuilding();
$tests['SM_BUILDING_ADD_TEST12']["Result"] = $addAnswer;



$tests['SM_BUILDING_ADD_TEST13']=(['Functionality' => "SM_BUILDING_ADD",
                'Description' => "Test 13. Attempt to add building with identifier that it already exists in BD",
                'Expected' => 'There is already a building with that identifier',
                'Result' => 'Not executed']);

$building = new BUILDING_Model('OSBI0', 'nameBuilding', 'addressBuilding', 666777888);
$addAnswer = $building->addBuilding();
$tests['SM_BUILDING_ADD_TEST13']["Result"] = $addAnswer;




//FINAL TEST

$tests['SM_BUILDING_ADD_TEST14']=(['Functionality' => "SM_BUILDING_ADD",
                'Description' => "Test 14. Attempt to add building with correct values",
                'Expected' => 'Building added successfully',
                'Result' => 'Not executed']);

$randId = 'A'.rand(1000, 9999);
$building = new BUILDING_Model($randId, 'nameBuilding', 'addressBuilding', 666777888);
$addAnswer = $building->addBuilding();
if($addAnswer === true){
    $tests['SM_BUILDING_ADD_TEST14']["Result"] = 'Building added successfully';
}else{
    $tests['SM_BUILDING_ADD_TEST14']["Result"] = $addAnswer;
}




// if(isset($argv[1])){
//    echo "\t"."\t"."TESTING OVER BUILDNG_ADD" . "\n";
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