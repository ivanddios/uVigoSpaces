<?php 

require_once("../model/FUNCTIONALITY_Model.php");

$lastFunctionID = FUNCTIONALITY_Model::findLastFunctionID();


//TEST-> FUNCTION ID

$tests['SM_FUNCTIONALITY_EDIT_TEST1']=(['Functionality' => "SM_FUNCTIONALITY_EDIT",
                'Description' => 'Test 1. Attempt to edit functionality without values',
                'Expected' => 'Function identifier is mandatory',
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model();
$editAnswer = $function->updateFunction();
$tests['SM_FUNCTIONALITY_EDIT_TEST1']["Result"] = $editAnswer;




$tests['SM_FUNCTIONALITY_EDIT_TEST2']=(['Functionality' => "SM_FUNCTIONALITY_EDIT",
                'Description' => 'Test 2. Attempt to edit functionality with identifier format incorrect',
                'Expected' => 'Function identifier format is invalid',
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model('abc');
$editAnswer = $function->updateFunction();
$tests['SM_FUNCTIONALITY_EDIT_TEST2']["Result"] = $editAnswer;



$tests['SM_FUNCTIONALITY_EDIT_TEST3']=(['Functionality' => "SM_FUNCTIONALITY_EDIT",
                'Description' => "Test 3. Attempt to edit functionality with a identifier that is not in DB",
                'Expected' => "Function doesn't exist",
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model(999);
$editAnswer = $function->updateFunction();
$tests['SM_FUNCTIONALITY_EDIT_TEST3']["Result"] = $editAnswer;


//TEST-> FUNCTION NAME

$tests['SM_FUNCTIONALITY_EDIT_TEST4']=(['Functionality' => "SM_FUNCTIONALITY_EDIT",
                'Description' => 'Test 4. Attempt to edit functionality without name and description',
                'Expected' => 'Function name and description are mandatory',
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model($lastFunctionID);
$editAnswer = $function->updateFunction();
$tests['SM_FUNCTIONALITY_EDIT_TEST4']["Result"] = $editAnswer;




$tests['SM_FUNCTIONALITY_EDIT_TEST5']=(['Functionality' => "SM_FUNCTIONALITY_EDIT",
                'Description' => 'Test 5. Attempt to edit functionality without name',
                'Expected' => 'Function name is mandatory',
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model($lastFunctionID,'','descriptFunction');
$editAnswer = $function->updateFunction();
$tests['SM_FUNCTIONALITY_EDIT_TEST5']["Result"] = $editAnswer;



$tests['SM_FUNCTIONALITY_EDIT_TEST6']=(['Functionality' => "SM_FUNCTIONALITY_EDIT",
                'Description' => 'Test 6. Attempt to edit functionality with name bigger than 50 characters',
                'Expected' => "Function name can't be larger than 50 characters",
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model($lastFunctionID,'uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
                            dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY','descriptFunction');
$editAnswer = $function->updateFunction();
$tests['SM_FUNCTIONALITY_EDIT_TEST6']["Result"] = $editAnswer;



$tests['SM_FUNCTIONALITY_EDIT_TEST7']=(['Functionality' => "SM_FUNCTIONALITY_EDIT",
                'Description' => "Test 7. Attempt to edit functionality with name's format incorrect",
                'Expected' => 'Function name format is invalid',
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model($lastFunctionID,'111111','descriptFunction');
$editAnswer = $function->updateFunction();
$tests['SM_FUNCTIONALITY_EDIT_TEST7']["Result"] = $editAnswer;



//TEST-> FUNCTION DESCRIPTION

$tests['SM_FUNCTIONALITY_EDIT_TEST8']=(['Functionality' => "SM_FUNCTIONALITY_EDIT",
                'Description' => 'Test 8. Attempt to edit functionality without description',
                'Expected' => 'Function description is mandatory',
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model($lastFunctionID,'nameFunction');
$editAnswer = $function->updateFunction();
$tests['SM_FUNCTIONALITY_EDIT_TEST8']["Result"] = $editAnswer;



$tests['SM_FUNCTIONALITY_EDIT_TEST9']=(['Functionality' => "SM_FUNCTIONALITY_EDIT",
                'Description' => 'Test 9. Attempt to edit functionality with description bigger than 255 characters',
                'Expected' => "Function description can't be larger than 255 characters",
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model($lastFunctionID,'nameFunction','uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$editAnswer = $function->updateFunction();
$tests['SM_FUNCTIONALITY_EDIT_TEST9']["Result"] = $editAnswer;



$tests['SM_FUNCTIONALITY_EDIT_TEST10']=(['Functionality' => "SM_FUNCTIONALITY_EDIT",
                'Description' => "Test 10. Attempt to edit functionality with description's format is incorrect",
                'Expected' => 'Function description format is invalid',
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model($lastFunctionID,'nameFunction','111111');
$editAnswer = $function->updateFunction();
$tests['SM_FUNCTIONALITY_EDIT_TEST10']["Result"] = $editAnswer;



//TEST-> ACTIONS FOR FUNCTIONALITY

$tests['SM_FUNCTIONALITY_EDIT_TEST11']=(['Functionality' => "SM_FUNCTIONALITY_EDIT",
                'Description' => "Test 11. Attempt to add functionality without any action",
                'Expected' => 'Some action for functionality is mandatory',
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model($lastFunctionID,'nameFunction','descripFunction');
$editAnswer = $function->updateFunction();
$tests['SM_FUNCTIONALITY_EDIT_TEST11']["Result"] = $editAnswer;



$tests['SM_FUNCTIONALITY_EDIT_TEST12']=(['Functionality' => "SM_FUNCTIONALITY_EDIT",
                'Description' => "Test 12. Attempt to add functionality with action's where some action not exists",
                'Expected' => "Some action for functionality doesn't exist",
                'Result' => 'Not executed']);

$actions = array('1000', '3', '1');
$function = new FUNCTIONALITY_Model($lastFunctionID,'nameFunction','descripFunction', $actions);
$editAnswer = $function->updateFunction();
$tests['SM_FUNCTIONALITY_EDIT_TEST12']["Result"] = $editAnswer;



//FINAL TEST
$tests['SM_FUNCTIONALITY_EDIT_TEST13']=(['Functionality' => "SM_FUNCTIONALITY_EDIT",
                'Description' => "Test 13. Attempt to edit functionality with correct values",
                'Expected' => 'Function successfully updated',
                'Result' => 'Not executed']);

        
$actions = array('4', '3', '1');
$function = new FUNCTIONALITY_Model($lastFunctionID,'nameFunctionUpdated','descriptFunctionUpdated', $actions);
$editAnswer = $function->updateFunction();
if($editAnswer === true){
    $tests['SM_FUNCTIONALITY_EDIT_TEST13']["Result"] = 'Function successfully updated';
} else {
    $tests['SM_FUNCTIONALITY_EDIT_TEST13']["Result"] = $editAnswer;
}




// if(isset($argv[1])){
//    echo "\t"."\t"."TESTING OVER FUNCTIONALITY_EDIT" . "\n";
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