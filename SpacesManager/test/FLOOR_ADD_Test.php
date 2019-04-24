<?php 

require_once(__DIR__.'..\..\model\FLOOR_Model.php');


 //TESTS -> BUILDING ID
$tests['SM_FLOOR_ADD_TEST1']=(['Functionality' => "SM_FLOOR_ADD",
                'Description' => 'Test 1. Attempt to add floor without values',
                'Expected' => 'Building identifier is mandatory',
                'Result' => 'Not executed']);

$floor = new FLOOR_Model();
$addAnswer = $floor->addFloor();
$tests['SM_FLOOR_ADD_TEST1']["Result"] = $addAnswer;


$tests['SM_FLOOR_ADD_TEST2']=(['Functionality' => "SM_FLOOR_ADD",
                'Description' => "Test 2. Attempt to add floor with building's identifier bigger than 5 characters",
                'Expected' => "Building identifier can't be larger than 5 characters",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('1234567');
$addAnswer = $floor->addFloor();
$tests['SM_FLOOR_ADD_TEST2']["Result"] = $addAnswer;


$tests['SM_FLOOR_ADD_TEST3']=(['Functionality' => "SM_FLOOR_ADD",
                'Description' => "Test 3. Attempt to add floor with building's identifier format invalid",
                'Expected' => 'Building identifier format is invalid',
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('¿?{');
$addAnswer = $floor->addFloor();
$tests['SM_FLOOR_ADD_TEST3']["Result"] = $addAnswer;


$tests['SM_FLOOR_ADD_TEST4']=(['Functionality' => "SM_FLOOR_ADD",
                'Description' => "Test 4. Attempt to add floor with floor identifier that not exists in DB",
                'Expected' => "There isn't a building with that identifier",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('0');
$addAnswer = $floor->addFloor();
$tests['SM_FLOOR_ADD_TEST4']["Result"] = $addAnswer;


//TESTS -> FLOOR ID

$tests['SM_FLOOR_ADD_TEST5']=(['Functionality' => "SM_FLOOR_ADD",
                'Description' => "Test 5. Attempt to add floor without floor identifier",
                'Expected' => 'Floor identifier is mandatory',
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0');
$addAnswer = $floor->addFloor();
$tests['SM_FLOOR_ADD_TEST5']["Result"] = $addAnswer;


$tests['SM_FLOOR_ADD_TEST5']=(['Functionality' => "SM_FLOOR_ADD",
                'Description' => "Test 5. Attempt to add floor with floor identifier bigger than 2 characters",
                'Expected' => "Floor identifier can't be larger than 2 characters",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0', '123');
$addAnswer = $floor->addFloor();
$tests['SM_FLOOR_ADD_TEST5']["Result"] = $addAnswer;


$tests['SM_FLOOR_ADD_TEST6']=(['Functionality' => "SM_FLOOR_ADD",
                'Description' => "Test 6. Attempt to add floor with floor identifier format invalid",
                'Expected' => 'Floor identifier format is invalid',
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0','!');
$addAnswer = $floor->addFloor();
$tests['SM_FLOOR_ADD_TEST6']["Result"] = $addAnswer;



//TESTS -> FLOOR NAME

$tests['SM_FLOOR_ADD_TEST7']=(['Functionality' => "SM_FLOOR_ADD",
                'Description' => "Test 7. Attempt to add floor without floor name",
                'Expected' => 'Floor name is mandatory',
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0','99');
$addAnswer = $floor->addFloor();
$tests['SM_FLOOR_ADD_TEST7']["Result"] = $addAnswer;



$tests['SM_FLOOR_ADD_TEST8']=(['Functionality' => "SM_FLOOR_ADD",
                'Description' => "Test 8. Attempt to add floor with floor name bigger than 255 characters",
                'Expected' => "Floor name can't be larger than 255 characters",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0', '99', 'uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$addAnswer = $floor->addFloor();
$tests['SM_FLOOR_ADD_TEST8']["Result"] = $addAnswer;


$tests['SM_FLOOR_ADD_TEST9']=(['Functionality' => "SM_FLOOR_ADD",
                'Description' => "Test 9. Attempt to add floor with floor name format invalid",
                'Expected' => "Floor name format is invalid",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0', '99', '?#@$%&/()');
$addAnswer = $floor->addFloor();
$tests['SM_FLOOR_ADD_TEST9']["Result"] = $addAnswer;



// //TESTS FLOOR BUILDING SURFACE 

$tests['SM_FLOOR_ADD_TEST10']=(['Functionality' => "SM_FLOOR_ADD",
                'Description' => "Test 10. Attempt to add floor with building surface bigger than 99999999.99",
                'Expected' => "Floor building surface can't be long than 99999999.99",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0', '99', 'nameFloor', '', 100000000.00);
$addAnswer = $floor->addFloor();
$tests['SM_FLOOR_ADD_TEST10']["Result"] = $addAnswer;


//TESTS FLOOR USEFUL SURFACE 

$tests['SM_FLOOR_ADD_TEST11']=(['Functionality' => "SM_FLOOR_ADD",
                'Description' => "Test 11. Attempt to add floor with useful surface bigger than 99999999.99",
                'Expected' => "Floor useful surface can't be long than 99999999.99",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0', '99', 'nameFloor', '', 10000000.00, 100000000.00);
$addAnswer = $floor->addFloor();
$tests['SM_FLOOR_ADD_TEST11']["Result"] = $addAnswer;


$tests['SM_FLOOR_ADD_TEST12']=(['Functionality' => "SM_FLOOR_ADD",
                'Description' => "Test 12. Attempt to add floor with useful surface bigger than building surface",
                'Expected' => "The usable surface can't be greater than the building surface",
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI0', '99', 'nameFloor', '', 10, 11);
$addAnswer = $floor->addFloor();
$tests['SM_FLOOR_ADD_TEST12']["Result"] = $addAnswer;



//TESTS FLOOR plan

$tests['SM_FLOOR_ADD_TEST13']=(['Functionality' => "SM_FLOOR_ADD",
                'Description' => "Test 13. Attempt to add floor with plan file extension invalid",
                'Expected' => "Floor plan extension is invalid",
                'Result' => 'Not executed']);

$badplanFile = (["name"=> "Planta Baja.pdf"]); 
$floor = new FLOOR_Model('OSBI0', '99', 'nameFloor', $badplanFile, 10.05, 10.03);
$addAnswer = $floor->addFloor();
$tests['SM_FLOOR_ADD_TEST13']["Result"] = $addAnswer;



//TESTS ALL FLOOR

$tests['SM_FLOOR_ADD_TEST14']=(['Functionality' => "SM_FLOOR_ADD",
                'Description' => "Test 14. Attempt to add floor that already exists in the building",
                'Expected' => "There is already a floor with that id in this building",
                'Result' => 'Not executed']);

$planFile = (["name"=> "Planta Baja.jpg", "type"=> "image/jpeg", "tmp_name"=> "C:\xampp\tmp\php8622.tmp", "error"=> 0, "size"=> 1392574]);
$floor = new FLOOR_Model('OSBI0', '00', 'nameFloor', $planFile, 10.05, 10.03);
$addAnswer = $floor->addFloor();
$tests['SM_FLOOR_ADD_TEST14']["Result"] = $addAnswer;



//FINAL TEST -> ADD FLOOR

$tests['SM_FLOOR_ADD_TEST15']=(['Functionality' => "SM_FLOOR_ADD",
                'Description' => "Test 15. Attempt to add floor with correct values",
                'Expected' => 'Floor added successfully',
                'Result' => 'Not executed']);


$floor = new FLOOR_Model('OSBI0', '99', 'nameFloor', '', 10.05, 10.03);
$addAnswer = $floor->addFloor();
if($addAnswer === true){
    $tests['SM_FLOOR_ADD_TEST15']["Result"] = 'Floor added successfully';
}else{
    $tests['SM_FLOOR_ADD_TEST15']["Result"] = $addAnswer;
}




// if(isset($argv[1])){
//    echo "\t"."\t"."TESTING OVER FLOOR_ADD" . "\n";
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