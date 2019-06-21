<?php 

require_once("../model/FUNCTIONALITY_Model.php");
// require_once("../test/TEST_View.php");


//TESTS -> NAME FUNCTION

$tests['SM_FUNCTIONALITY_ADD_TEST1']=(['Functionality' => "SM_FUNCTIONALITY_ADD",
                'Description' => 'Test 1. Attempt to add functionality without values',
                'Expected' => 'Function name and description are mandatory',
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model();
$addAnswer = $function->addFunction();
$tests['SM_FUNCTIONALITY_ADD_TEST1']["Result"] = $addAnswer;




$tests['SM_FUNCTIONALITY_ADD_TEST2']=(['Functionality' => "SM_FUNCTIONALITY_ADD",
                'Description' => 'Test 2. Attempt to add functionality without name',
                'Expected' => 'Function name is mandatory',
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model('','','descriptFunction');
$addAnswer = $function->addFunction();
$tests['SM_FUNCTIONALITY_ADD_TEST2']["Result"] = $addAnswer;





$tests['SM_FUNCTIONALITY_ADD_TEST3']=(['Functionality' => "SM_FUNCTIONALITY_ADD",
                'Description' => 'Test 3. Attempt to add functionality with name bigger than 50 characters',
                'Expected' => "Function name can't be larger than 50 characters",
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model('','uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
                            dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY','descriptFunction');
$addAnswer = $function->addFunction();
$tests['SM_FUNCTIONALITY_ADD_TEST3']["Result"] = $addAnswer;





$tests['SM_FUNCTIONALITY_ADD_TEST4']=(['Functionality' => "SM_FUNCTIONALITY_ADD",
                'Description' => "Test 4. Attempt to add functionality with name's format incorrect",
                'Expected' => 'Function name format is invalid',
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model('','111111','descriptFunction');
$addAnswer = $function->addFunction();
$tests['SM_FUNCTIONALITY_ADD_TEST4']["Result"] = $addAnswer;




//TESTS -> DESCRIPTION FUNCTION

$tests['SM_FUNCTIONALITY_ADD_TEST5']=(['Functionality' => "SM_FUNCTIONALITY_ADD",
                'Description' => 'Test 5. Attempt to add functionality without description',
                'Expected' => 'Function description is mandatory',
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model('','nameFunction');
$addAnswer = $function->addFunction();
$tests['SM_FUNCTIONALITY_ADD_TEST5']["Result"] = $addAnswer;





$tests['SM_FUNCTIONALITY_ADD_TEST6']=(['Functionality' => "SM_FUNCTIONALITY_ADD",
                'Description' => 'Test 6. Attempt to add functionality with description bigger than 255 characters',
                'Expected' => "Function description can't be larger than 255 characters",
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model('','nameFunction','uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$addAnswer = $function->addFunction();
$tests['SM_FUNCTIONALITY_ADD_TEST6']["Result"] = $addAnswer;



$tests['SM_FUNCTIONALITY_ADD_TEST7']=(['Functionality' => "SM_FUNCTIONALITY_ADD",
                'Description' => "Test 7. Attempt to add functionality with description's format is incorrect",
                'Expected' => 'Function description format is invalid',
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model('','nameFunction','111111');
$addAnswer = $function->addFunction();
$tests['SM_FUNCTIONALITY_ADD_TEST7']["Result"] = $addAnswer;


//TESTS -> ACTIONS FOR FUNCTIONALITY

$tests['SM_FUNCTIONALITY_ADD_TEST8']=(['Functionality' => "SM_FUNCTIONALITY_ADD",
                'Description' => "Test 8. Attempt to add functionality without any action",
                'Expected' => 'Access to some functionality is mandatory',
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model('','nameFunction','descripFunction');
$addAnswer = $function->addFunction();
$tests['SM_FUNCTIONALITY_ADD_TEST8']["Result"] = $addAnswer;



$tests['SM_FUNCTIONALITY_ADD_TEST9']=(['Functionality' => "SM_FUNCTIONALITY_ADD",
                'Description' => "Test 9. Attempt to add functionality with action's where some action not exists",
                'Expected' => "Some action for functionality doesn't exist",
                'Result' => 'Not executed']);

$actions = array('1000','1', '2', '3');
$function = new FUNCTIONALITY_Model('','nameFunction','descripFunction', $actions);
$addAnswer = $function->addFunction();
$tests['SM_FUNCTIONALITY_ADD_TEST9']["Result"] = $addAnswer;



//FINAL TEST
$tests['SM_FUNCTIONALITY_ADD_TEST10']=(['Functionality' => "SM_FUNCTIONALITY_ADD",
                'Description' => "Test 10. Attempt to add functionality with correct values",
                'Expected' => 'Function successfully added',
                'Result' => 'Not executed']);

        
$actions = array('1', '2', '3');
$function = new FUNCTIONALITY_Model('','nameFunctionAdded','descripFunctionAdded', $actions);
$addAnswer = $function->addFunction();
if($addAnswer === true){
    $tests['SM_FUNCTIONALITY_ADD_TEST10']["Result"] = 'Function successfully added';
} else {
    $tests['SM_FUNCTIONALITY_ADD_TEST10']["Result"] = $addAnswer;
}




// if(isset($argv[1])){
//    echo "\t"."\t"."TESTING OVER FUNCTIONALITY_ADD" . "\n";
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