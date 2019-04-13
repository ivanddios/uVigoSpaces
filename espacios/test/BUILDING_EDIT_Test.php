<?php 

require_once(__DIR__.'..\..\model\BUILDING_Model.php');


$tests['SN_BUILDING_EDIT_TEST1']=(['Functionality' => "SN_BUILDING_EDIT",
                                    'Description' => 'Test 1. Attempt to update building without values',
                                    'Expected' => 'Building id is mandatory',
                                    'Result' => 'Not executed']);

$building = new BUILDING_Model();
$editAnswer = $building->updateBuilding();
$tests['SN_BUILDING_EDIT_TEST1']["Result"] = $editAnswer;


//TESTS -> BUILDING ID

$tests['SN_BUILDING_EDIT_TEST2']=(['Functionality' => "SN_BUILDING_EDIT",
                                    'Description' => "Test 2. Attempt to update building with building's id bigget than 6 characters",
                                    'Expected' => 'Building id can not be that long',
                                    'Result' => 'Not executed']);

$building = new BUILDING_Model('1234567');
$editAnswer = $building->updateBuilding();
$tests['SN_BUILDING_EDIT_TEST2']["Result"] = $editAnswer;


$tests['SN_BUILDING_EDIT_TEST3']=(['Functionality' => "SN_BUILDING_EDIT",
                                    'Description' => "Test 3. Attempt to update building with building's id format invalid",
                                    'Expected' => 'Building id is invalid. Example: OSBI0',
                                    'Result' => 'Not executed']);

$building = new BUILDING_Model('¡¿?{');
$editAnswer = $building->updateBuilding();
$tests['SN_BUILDING_EDIT_TEST3']["Result"] = $editAnswer;




//TESTS -> BUILDING NAME

$tests['SN_BUILDING_EDIT_TEST4']=(['Functionality' => "SN_BUILDING_EDIT",
                                'Description' => "Test 4. Attempt to update building without building name",
                                'Expected' => 'Building name is mandatory',
                                'Result' => 'Not executed']);

$building = new BUILDING_Model('OSBI1');
$editAnswer = $building->updateBuilding();
$tests['SN_BUILDING_EDIT_TEST4']["Result"] = $editAnswer;


$tests['SN_BUILDING_EDIT_TEST5']=(['Functionality' => "SN_BUILDING_EDIT",
                                'Description' => "Test 5. Attempt to update building with building name bigger than 255 characters",
                                'Expected' => 'Building name can not be that long',
                                'Result' => 'Not executed']);

$building = new BUILDING_Model('OSBI1', 'uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
                                dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$editAnswer = $building->updateBuilding();
$tests['SN_BUILDING_EDIT_TEST5']["Result"] = $editAnswer;


$tests['SN_BUILDING_EDIT_TEST6']=(['Functionality' => "SN_BUILDING_EDIT",
                                'Description' => "Test 6. Attempt to update building with building name format invalid",
                                'Expected' => 'Building name is invalid',
                                'Result' => 'Not executed']);

$building = new BUILDING_Model('OSBI1','111111');
$editAnswer = $building->updateBuilding();
$tests['SN_BUILDING_EDIT_TEST6']["Result"] = $editAnswer;



//TESTS -> BUILDING ADDRESS

$tests['SN_BUILDING_EDIT_TEST7']=(['Functionality' => "SN_BUILDING_EDIT",
                                'Description' => "Test 7. Attempt to update building without building address",
                                'Expected' => 'Building address is mandatory',
                                'Result' => 'Not executed']);

$building = new BUILDING_Model('OSBI1','nameBuilding');
$editAnswer = $building->updateBuilding();
$tests['SN_BUILDING_EDIT_TEST7']["Result"] = $editAnswer;



$tests['SN_BUILDING_EDIT_TEST8']=(['Functionality' => "SN_BUILDING_EDIT",
                            'Description' => "Test 8. Attempt to update building with building address bigger than 255 characters",
                            'Expected' => 'Building address can not be that long',
                            'Result' => 'Not executed']);

$building = new BUILDING_Model('OSBI1', 'nameBuilding', 'uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
                            dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$editAnswer = $building->updateBuilding();
$tests['SN_BUILDING_EDIT_TEST8']["Result"] = $editAnswer;


$tests['SN_BUILDING_EDIT_TEST9']=(['Functionality' => "SN_BUILDING_EDIT",
                                    'Description' => "Test 9. Attempt to update building with building address format invalid",
                                    'Expected' => 'Building address is invalid',
                                    'Result' => 'Not executed']);

$building = new BUILDING_Model('OSBI1','nameBuilding', '111111');
$editAnswer = $building->updateBuilding();
$tests['SN_BUILDING_EDIT_TEST9']["Result"] = $editAnswer;



//TESTS BUILDING PHONE

$tests['SN_BUILDING_EDIT_TEST10']=(['Functionality' => "SN_BUILDING_EDIT",
                                'Description' => "Test 10. Attempt to update building without building phone",
                                'Expected' => 'Building phone is incorrect',
                                'Result' => 'Not executed']);

$building = new BUILDING_Model('OSBI1','nameBuilding','addressBuilding');
$editAnswer = $building->updateBuilding();
$tests['SN_BUILDING_EDIT_TEST10']["Result"] = $editAnswer;



$tests['SN_BUILDING_EDIT_TEST11']=(['Functionality' => "SN_BUILDING_EDIT",
                                'Description' => "Test 11. Attempt to update building with building phone bigger than 9 characters",
                                'Expected' => 'Building phone is incorrect',
                                'Result' => 'Not executed']);

$building = new BUILDING_Model('OSBI1', 'nameBuilding', 'addressBuilding', 1234567890);
$editAnswer = $building->updateBuilding();
$tests['SN_BUILDING_EDIT_TEST11']["Result"] = $editAnswer;


$tests['SN_BUILDING_EDIT_TEST12']=(['Functionality' => "SN_BUILDING_EDIT",
                                'Description' => "Test 12. Attempt to update building with building phone format invalid",
                                'Expected' => 'Building phone format is invalid',
                                'Result' => 'Not executed']);

$building = new BUILDING_Model('OSBI1','nameBuilding', 'addressBuilding', 101010101);
$editAnswer = $building->updateBuilding();
$tests['SN_BUILDING_EDIT_TEST12']["Result"] = $editAnswer;



$tests['SN_BUILDING_EDIT_TEST13']=(['Functionality' => "SN_BUILDING_EDIT",
                                'Description' => "Test 13. Attempt to update building with building's id that it does not exist in BD",
                                'Expected' => 'There is not a building with that id',
                                'Result' => 'Not executed']);

$building = new BUILDING_Model('OSVI0', 'nameBuilding', 'addressBuilding', 666777888);
$editAnswer = $building->updateBuilding();
$tests['SN_BUILDING_EDIT_TEST13']["Result"] = $editAnswer;




//FINAL TEST

$tests['SN_BUILDING_EDIT_TEST14']=(['Functionality' => "SN_BUILDING_EDIT",
                                'Description' => "Test 14. Attempt to update building with correct values",
                                'Expected' => 'Building updated successfully',
                                'Result' => 'Not executed']);


$building = new BUILDING_Model('OSBI0', 'nameBuilding', 'addressBuilding', 666777888);
$editAnswer = $building->updateBuilding();
if($editAnswer === true){
    $tests['SN_BUILDING_EDIT_TEST14']["Result"] = 'Building updated successfully';
}else{
    $tests['SN_BUILDING_EDIT_TEST14']["Result"] = $editAnswer;
}






// if(isset($argv[1])){
//    echo "\t"."\t"."TESTING OVER ACTION_update" . "\n";
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