<?php 

require_once(__DIR__.'..\..\model\ACTION_Model.php');
require_once(__DIR__.'..\..\test\TEST_View.php');

// $tests = array();


$tests['SM_ACTION_EDIT_TEST1']=(['Functionality' => "SM_ACTION_EDIT",
                'Description' => 'Test 1. Attempt to edit action without id action',
                'Expected' => 'Action id are mandatory',
                'Result' => 'Not executed']);

$action = new ACTION_Model();
$editAnswer = $action->updateAction();
$tests['SM_ACTION_EDIT_TEST1']["Result"] = $editAnswer;


$tests['SM_ACTION_EDIT_TEST2']=(['Functionality' => "SM_ACTION_EDIT",
                'Description' => 'Test 2. Attempt to edit action with incorrect id',
                'Expected' => 'Action does not exists',
                'Result' => 'Not executed']);

$action = new ACTION_Model('id');
$editAnswer = $action->updateAction();
$tests['SM_ACTION_EDIT_TEST2']["Result"] = $editAnswer;


$tests['SM_ACTION_EDIT_TEST3']=(['Functionality' => "SM_ACTION_EDIT",
                'Description' => 'Test 3. Attempt to edit action without action name and description',
                'Expected' => 'Action name and description are mandatory',
                'Result' => 'Not executed']);

$action = new ACTION_Model(1);
$editAnswer = $action->updateAction();
$tests['SM_ACTION_EDIT_TEST3']["Result"] = $editAnswer;




$tests['SM_ACTION_EDIT_TEST4']=(['Functionality' => "SM_ACTION_EDIT",
                'Description' => 'Test 4. Attempt to edit action without action name',
                'Expected' => 'Action name is mandatory',
                'Result' => 'Not executed']);

$action = new ACTION_Model(1,'','descriptAction');
$editAnswer = $action->updateAction();
$tests['SM_ACTION_EDIT_TEST4']["Result"] = $editAnswer;





$tests['SM_ACTION_EDIT_TEST5']=(['Functionality' => "SM_ACTION_EDIT",
                'Description' => 'Test 5. Attempt to edit action with action name bigger than 255 characters',
                'Expected' => 'Action name can not be that long',
                'Result' => 'Not executed']);

$action = new ACTION_Model(1,'uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
                            dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY','descriptAction');
$editAnswer = $action->updateAction();
$tests['SM_ACTION_EDIT_TEST5']["Result"] = $editAnswer;





$tests['SM_ACTION_EDIT_TEST6']=(['Functionality' => "SM_ACTION_EDIT",
                'Description' => "Test 6. Attempt to edit action with action name's format incorrect",
                'Expected' => 'Action name is invalid. Try again!',
                'Result' => 'Not executed']);

$action = new ACTION_Model(1,'111111','descriptAction');
$editAnswer = $action->updateAction();
$tests['SM_ACTION_EDIT_TEST6']["Result"] = $editAnswer;



$tests['SM_ACTION_EDIT_TEST7']=(['Functionality' => "SM_ACTION_EDIT",
                'Description' => 'Test 7. Attempt to edit action without action description',
                'Expected' => 'Action description is mandatory',
                'Result' => 'Not executed']);

$action = new ACTION_Model(1,'nameAction');
$editAnswer = $action->updateAction();
$tests['SM_ACTION_EDIT_TEST7']["Result"] = $editAnswer;






$tests['SM_ACTION_EDIT_TEST8']=(['Functionality' => "SM_ACTION_EDIT",
                'Description' => 'Test 8. Attempt to edit action with action description bigger than 255 characters',
                'Expected' => 'Action description can not be that long',
                'Result' => 'Not executed']);

$action = new ACTION_Model(1,'nameAction','uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$editAnswer = $action->updateAction();
$tests['SM_ACTION_EDIT_TEST8']["Result"] = $editAnswer;






$tests['SM_ACTION_EDIT_TEST9']=(['Functionality' => "SM_ACTION_EDIT",
                'Description' => "Test 9. Attempt to edit action with action description's format incorrect",
                'Expected' => 'Action description is invalid. Try again!',
                'Result' => 'Not executed']);

$action = new ACTION_Model(1,'nameAction','111111');
$editAnswer = $action->updateAction();
$tests['SM_ACTION_EDIT_TEST9']["Result"] = $editAnswer;








$tests['SM_ACTION_EDIT_TEST10']=(['Functionality' => "SM_ACTION_EDIT",
                'Description' => "Test 10. Attempt to edit action with correct values",
                'Expected' => 'Action successfully updated',
                'Result' => 'Not executed']);

$action = new ACTION_Model(1,'nameAction','descriptAction');
$editAnswer = $action->updateAction();
if($editAnswer === true){
    $tests['SM_ACTION_EDIT_TEST10']["Result"] = 'Action successfully updated';
} else {
    $tests['SM_ACTION_EDIT_TEST10']["Result"] = $addAnswer;
}
























// if(isset($argv[1])){
//    echo "\t"."\t"."TESTING OVER ACTION_ADD" . "\n";
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
