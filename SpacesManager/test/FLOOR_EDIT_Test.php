<?php 

require_once(__DIR__.'..\..\model\FLOOR_Model.php');


//TESTS -> BUILDING ID
$tests['SM_FLOOR_EDIT_TEST1']=(['Functionality' => "SM_FLOOR_EDIT",
                'Description' => 'Test 1. Attempt to edit floor without values',
                'Expected' => 'Building identifier is mandatory',
                'Result' => 'Not executed']);

$floor = new FLOOR_Model();
$editAnswer = $floor->updateFloor();
$tests['SM_FLOOR_EDIT_TEST1']["Result"] = $editAnswer;


$tests['SM_FLOOR_EDIT_TEST2']=(['Functionality' => "SM_FLOOR_EDIT",
                'Description' => "Test 2. Attempt to edit floor with building's identifier bigger than 5 characters",
                'Expected' => "Building identifier can't be larger than 5 characters",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('1234567');
$editAnswer = $floor->updateFloor();
$tests['SM_FLOOR_EDIT_TEST2']["Result"] = $editAnswer;


$tests['SM_FLOOR_EDIT_TEST3']=(['Functionality' => "SM_FLOOR_EDIT",
                'Description' => "Test 3. Attempt to edit floor with building's identifier format invalid",
                'Expected' => 'Building identifier format is invalid',
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('¿?{');
$editAnswer = $floor->updateFloor();
$tests['SM_FLOOR_EDIT_TEST3']["Result"] = $editAnswer;


$tests['SM_FLOOR_EDIT_TEST4']=(['Functionality' => "SM_FLOOR_EDIT",
                'Description' => "Test 4. Attempt to edit floor with floor identifier that not exists in DB",
                'Expected' => "There isn't a building with that identifier",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('0');
$editAnswer = $floor->updateFloor();
$tests['SM_FLOOR_EDIT_TEST4']["Result"] = $editAnswer;


//TESTS -> FLOOR ID

$tests['SM_FLOOR_EDIT_TEST5']=(['Functionality' => "SM_FLOOR_EDIT",
                'Description' => "Test 5. Attempt to edit floor without floor identifier",
                'Expected' => 'Floor identifier is mandatory',
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0');
$editAnswer = $floor->updateFloor();
$tests['SM_FLOOR_EDIT_TEST5']["Result"] = $editAnswer;


$tests['SM_FLOOR_EDIT_TEST5']=(['Functionality' => "SM_FLOOR_EDIT",
                'Description' => "Test 5. Attempt to edit floor with floor identifier bigger than 2 characters",
                'Expected' => "Floor identifier can't be larger than 2 characters",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0', '123');
$editAnswer = $floor->updateFloor();
$tests['SM_FLOOR_EDIT_TEST5']["Result"] = $editAnswer;


$tests['SM_FLOOR_EDIT_TEST6']=(['Functionality' => "SM_FLOOR_EDIT",
                'Description' => "Test 6. Attempt to edit floor with floor identifier format invalid",
                'Expected' => 'Floor identifier format is invalid',
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0','!');
$editAnswer = $floor->updateFloor();
$tests['SM_FLOOR_EDIT_TEST6']["Result"] = $editAnswer;



//TESTS -> FLOOR NAME

$tests['SM_FLOOR_EDIT_TEST7']=(['Functionality' => "SM_FLOOR_EDIT",
                'Description' => "Test 7. Attempt to edit floor without floor name",
                'Expected' => 'Floor name is mandatory',
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0','99');
$editAnswer = $floor->updateFloor();
$tests['SM_FLOOR_EDIT_TEST7']["Result"] = $editAnswer;



$tests['SM_FLOOR_EDIT_TEST8']=(['Functionality' => "SM_FLOOR_EDIT",
                'Description' => "Test 8. Attempt to edit floor with floor name bigger than 255 characters",
                'Expected' => "Floor name can't be larger than 255 characters",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0', '99', 'uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$editAnswer = $floor->updateFloor();
$tests['SM_FLOOR_EDIT_TEST8']["Result"] = $editAnswer;


$tests['SM_FLOOR_EDIT_TEST9']=(['Functionality' => "SM_FLOOR_EDIT",
                'Description' => "Test 9. Attempt to edit floor with floor name format invalid",
                'Expected' => "Floor name format is invalid",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0', '99', '?#@$%&/()');
$editAnswer = $floor->updateFloor();
$tests['SM_FLOOR_EDIT_TEST9']["Result"] = $editAnswer;



// //TESTS FLOOR BUILDING SURFACE 

$tests['SM_FLOOR_EDIT_TEST10']=(['Functionality' => "SM_FLOOR_EDIT",
                'Description' => "Test 10. Attempt to edit floor with building surface bigger than 99999999.99",
                'Expected' => "Floor building surface can't be long than 99999999.99",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0', '99', 'nameFloor', '', 100000000.00);
$editAnswer = $floor->updateFloor();
$tests['SM_FLOOR_EDIT_TEST10']["Result"] = $editAnswer;


//TESTS FLOOR USEFUL SURFACE 

$tests['SM_FLOOR_EDIT_TEST11']=(['Functionality' => "SM_FLOOR_EDIT",
                'Description' => "Test 11. Attempt to edit floor with useful surface bigger than 99999999.99",
                'Expected' => "Floor useful surface can't be long than 99999999.99",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0', '99', 'nameFloor', '', 10000000.00, 100000000.00);
$editAnswer = $floor->updateFloor();
$tests['SM_FLOOR_EDIT_TEST11']["Result"] = $editAnswer;


$tests['SM_FLOOR_EDIT_TEST12']=(['Functionality' => "SM_FLOOR_EDIT",
                'Description' => "Test 12. Attempt to edit floor with useful surface bigger than building surface",
                'Expected' => "The usable surface can't be greater than the building surface",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0', '99', 'nameFloor', '', 10, 11);
$editAnswer = $floor->updateFloor();
$tests['SM_FLOOR_EDIT_TEST12']["Result"] = $editAnswer;



//TESTS FLOOR plan

$tests['SM_FLOOR_EDIT_TEST13']=(['Functionality' => "SM_FLOOR_EDIT",
                'Description' => "Test 13. Attempt to edit floor with plan file extension invalid",
                'Expected' => "Floor plan extension is invalid",
                'Result' => 'Not executed']);

$badplanFile = (["name"=> "Planta Baja.pdf"]); 
$floor = new FLOOR_Model('OSBI0', '99', 'nameFloor', $badplanFile, 10.05, 10.03);
$editAnswer = $floor->updateFloor();
$tests['SM_FLOOR_EDIT_TEST13']["Result"] = $editAnswer;



//MOIDY FLOOR THAT NO EXIST

$tests['SM_FLOOR_EDIT_TEST14']=(['Functionality' => "SM_FLOOR_EDIT",
                'Description' => "Test 14. Attempt to edit floor that not exists in the building",
                'Expected' => "There isn't a floor with that identifier in the building",
                'Result' => 'Not executed']);

$planFile = (["name"=> "Planta Baja.jpeg"]); 
$floor = new FLOOR_Model('OSBI0', 'SD', 'nameFloor', $planFile, 10.05, 10.03);
$editAnswer = $floor->updateFloor();
$tests['SM_FLOOR_EDIT_TEST14']["Result"] = $editAnswer;



//FINAL TEST

$tests['SM_FLOOR_EDIT_TEST15']=(['Functionality' => "SM_FLOOR_EDIT",
                'Description' => "Test 15. Attempt to edit floor with correct values",
                'Expected' => 'Floor updated successfully',
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0', '99', 'nameFloor', $planFile, 10.05, 10.03);
$editAnswer = $floor->updateFloor();
if($editAnswer === true){
    $tests['SM_FLOOR_EDIT_TEST15']["Result"] = 'Floor updated successfully';
}else{
    $tests['SM_FLOOR_EDIT_TEST15']["Result"] = $editAnswer;
}




// if(isset($argv[1])){
//    echo "\t"."\t"."TESTING OVER FLOOR_EDIT" . "\n";
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