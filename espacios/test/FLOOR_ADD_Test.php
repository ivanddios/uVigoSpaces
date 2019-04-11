<?php 

require_once(__DIR__.'..\..\model\FLOOR_Model.php');
// require_once(__DIR__.'..\..\test\TEST_View.php');


//TESTS -> BUILDING ID

// $tests['SM_FLOOR_ADD_TEST1']=(['Functionality' => "SM_FLOOR_ADD",
//                 'Description' => 'Test 1. Attempt to add floor without values',
//                 'Expected' => 'Building id is mandatory',
//                 'Result' => 'Not executed']);

// $floor = new FLOOR_Model();
// $addAnswer = $floor->addFloor();
// $tests['SM_FLOOR_ADD_TEST1']["Result"] = $addAnswer;


// $tests['SM_FLOOR_ADD_TEST2']=(['Functionality' => "SM_FLOOR_ADD",
//                 'Description' => "Test 2. Attempt to add floor with building's id bigget than 6 characters",
//                 'Expected' => 'Building id can not be that long',
//                 'Result' => 'Not executed']);

// $floor = new FLOOR_Model('1234567');
// $addAnswer = $floor->addFloor();
// $tests['SM_FLOOR_ADD_TEST2']["Result"] = $addAnswer;


// $tests['SM_FLOOR_ADD_TEST3']=(['Functionality' => "SM_FLOOR_ADD",
//                 'Description' => "Test 3. Attempt to add floor with building's id format invalid",
//                 'Expected' => 'Building id is invalid',
//                 'Result' => 'Not executed']);

// $floor = new FLOOR_Model('¡¿?{');
// $addAnswer = $floor->addFloor();
// $tests['SM_FLOOR_ADD_TEST3']["Result"] = $addAnswer;




// // //TESTS -> FLOOR ID

// $tests['SM_FLOOR_ADD_TEST4']=(['Functionality' => "SM_FLOOR_ADD",
//                 'Description' => "Test 4. Attempt to add floor without floor id",
//                 'Expected' => 'Floor id is mandatory',
//                 'Result' => 'Not executed']);

// $floor = new FLOOR_Model('OSBI0');
// $addAnswer = $floor->addFloor();
// $tests['SM_FLOOR_ADD_TEST4']["Result"] = $addAnswer;


// $tests['SM_FLOOR_ADD_TEST5']=(['Functionality' => "SM_FLOOR_ADD",
//                 'Description' => "Test 5. Attempt to add floor with floor id bigger than 2 characters",
//                 'Expected' => 'Floor id can not be that long',
//                 'Result' => 'Not executed']);

// $floor = new FLOOR_Model('OSBI1', '123');
// $addAnswer = $floor->addFloor();
// $tests['SM_FLOOR_ADD_TEST5']["Result"] = $addAnswer;


$tests['SM_FLOOR_ADD_TEST6']=(['Functionality' => "SM_FLOOR_ADD",
                'Description' => "Test 6. Attempt to add floor with floor id format invalid",
                'Expected' => 'Floor id is invalid',
                'Result' => 'Not executed']);

$floor = new FLOOR_Model('OSBI1','!');
$addAnswer = $floor->addFloor();
$tests['SM_FLOOR_ADD_TEST6']["Result"] = $addAnswer;



// //TESTS -> BUILDING ADDRESS

// $tests['SM_FLOOR_ADD_TEST7']=(['Functionality' => "SM_FLOOR_ADD",
//                 'Description' => "Test 7. Attempt to add building without building address",
//                 'Expected' => 'Building address is mandatory',
//                 'Result' => 'Not executed']);

// $floor = new FLOOR_Model('OSBI1','nameBuilding');
// $addAnswer = $floor->addFloor();
// $tests['SM_FLOOR_ADD_TEST7']["Result"] = $addAnswer;



// $tests['SM_FLOOR_ADD_TEST8']=(['Functionality' => "SM_FLOOR_ADD",
//                 'Description' => "Test 8. Attempt to add building with building address bigger than 255 characters",
//                 'Expected' => 'Building address can not be that long',
//                 'Result' => 'Not executed']);

// $floor = new FLOOR_Model('OSBI1', 'nameBuilding', 'uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
// dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
// $addAnswer = $floor->addFloor();
// $tests['SM_FLOOR_ADD_TEST8']["Result"] = $addAnswer;


// $tests['SM_FLOOR_ADD_TEST9']=(['Functionality' => "SM_FLOOR_ADD",
//                 'Description' => "Test 9. Attempt to add building with building address format invalid",
//                 'Expected' => 'Building address is invalid',
//                 'Result' => 'Not executed']);

// $floor = new FLOOR_Model('OSBI1','nameBuilding', '111111');
// $addAnswer = $floor->addFloor();
// $tests['SM_FLOOR_ADD_TEST9']["Result"] = $addAnswer;



// //TESTS BUILDING PHONE

// $tests['SM_FLOOR_ADD_TEST10']=(['Functionality' => "SM_FLOOR_ADD",
//                 'Description' => "Test 10. Attempt to add building without building phone",
//                 'Expected' => 'Building phone is incorrect. Example: 666777888',
//                 'Result' => 'Not executed']);

// $floor = new FLOOR_Model('OSBI1','nameBuilding','addressBuilding');
// $addAnswer = $floor->addFloor();
// $tests['SM_FLOOR_ADD_TEST10']["Result"] = $addAnswer;



// $tests['SM_FLOOR_ADD_TEST11']=(['Functionality' => "SM_FLOOR_ADD",
//                 'Description' => "Test 11. Attempt to add building with building phone bigger than 9 characters",
//                 'Expected' => 'Building phone is incorrect. Example: 666777888',
//                 'Result' => 'Not executed']);

// $floor = new FLOOR_Model('OSBI1', 'nameBuilding', 'addressBuilding', 1234567890);
// $addAnswer = $floor->addFloor();
// $tests['SM_FLOOR_ADD_TEST11']["Result"] = $addAnswer;


// $tests['SM_FLOOR_ADD_TEST12']=(['Functionality' => "SM_FLOOR_ADD",
//                 'Description' => "Test 12. Attempt to add building with building phone format invalid",
//                 'Expected' => 'Building phone format is invalid. Example: 666777888',
//                 'Result' => 'Not executed']);

// $floor = new FLOOR_Model('OSBI1','nameBuilding', 'addressBuilding', 101010101);
// $addAnswer = $floor->addFloor();
// $tests['SM_FLOOR_ADD_TEST12']["Result"] = $addAnswer;



// $tests['SM_FLOOR_ADD_TEST13']=(['Functionality' => "SM_FLOOR_ADD",
//                 'Description' => "Test 13. Attempt to add building with building's id that it already exists in BD",
//                 'Expected' => 'There is already a building with that id',
//                 'Result' => 'Not executed']);

// $floor = new FLOOR_Model('OSBI0', 'nameBuilding', 'addressBuilding', 666777888);
// $addAnswer = $floor->addFloor();
// $tests['SM_FLOOR_ADD_TEST13']["Result"] = $addAnswer;




// //FINAL TEST

// $tests['SM_FLOOR_ADD_TEST14']=(['Functionality' => "SM_FLOOR_ADD",
//                 'Description' => "Test 14. Attempt to add building with correct values",
//                 'Expected' => 'Building added successfully',
//                 'Result' => 'Not executed']);

// $randId = rand(10, 99);
// $floor = new FLOOR_Model('OSBI0', $randId,'nameFloor', 'planeFloor', 00.00,00.00);
// $addAnswer = $floor->addFloor();
// if($addAnswer === true){
//     $tests['SM_FLOOR_ADD_TEST14']["Result"] = 'Building added successfully';
// }else{
//     $tests['SM_FLOOR_ADD_TEST14']["Result"] = $addAnswer;
// }




if(isset($argv[1])){
   echo "\t"."\t"."TESTING OVER ACTION_ADD" . "\n";
    foreach($tests as $test){
        if($test['Expected'] == $test['Result']){
            echo "\e[32m".$test['Description'] . "\t" ." Expected: " .$test['Expected']. "\t" . " Result: ". $test['Result'] ."\e[0m" . "\n";
        } else {
            echo "\e[31m".$test['Description'] . "\t" ." Expected: " .$test['Expected']. "\t". " Result: ". $test['Result'] ."\e[0m" . "\n";
        }
    }
} else {
    new TEST_View($tests);
}



?>