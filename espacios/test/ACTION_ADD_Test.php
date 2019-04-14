<?php 

require_once(__DIR__.'..\..\model\ACTION_Model.php');


$tests['SM_ACTION_ADD_TEST1']=(['Functionality' => "SM_ACTION_ADD",
                'Description' => 'Test 1. Attempt to add action without values',
                'Expected' => 'Action name and description are mandatory',
                'Result' => 'Not executed']);

$action = new ACTION_Model();
$addAnswer = $action->addAction();
$tests['SM_ACTION_ADD_TEST1']["Result"] = $addAnswer;




$tests['SM_ACTION_ADD_TEST2']=(['Functionality' => "SM_ACTION_ADD",
                'Description' => 'Test 2. Attempt to add action without action name',
                'Expected' => 'Action name is mandatory',
                'Result' => 'Not executed']);

$action = new ACTION_Model('','','descriptAction');
$addAnswer = $action->addAction();
$tests['SM_ACTION_ADD_TEST2']["Result"] = $addAnswer;





$tests['SM_ACTION_ADD_TEST3']=(['Functionality' => "SM_ACTION_ADD",
                'Description' => 'Test 3. Attempt to add action with action name bigger than 255 characters',
                'Expected' => "Action name can't be larger than 255 characters",
                'Result' => 'Not executed']);

$action = new ACTION_Model('','uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
                            dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY','descriptAction');
$addAnswer = $action->addAction();
$tests['SM_ACTION_ADD_TEST3']["Result"] = $addAnswer;





$tests['SM_ACTION_ADD_TEST4']=(['Functionality' => "SM_ACTION_ADD",
                'Description' => "Test 4. Attempt to add action with action name's format incorrect",
                'Expected' => 'Action name format is invalid',
                'Result' => 'Not executed']);

$action = new ACTION_Model('','111111','descriptAction');
$addAnswer = $action->addAction();
$tests['SM_ACTION_ADD_TEST4']["Result"] = $addAnswer;



$tests['SM_ACTION_ADD_TEST5']=(['Functionality' => "SM_ACTION_ADD",
                'Description' => 'Test 5. Attempt to add action without action description',
                'Expected' => 'Action description is mandatory',
                'Result' => 'Not executed']);

$action = new ACTION_Model('','nameAction');
$addAnswer = $action->addAction();
$tests['SM_ACTION_ADD_TEST5']["Result"] = $addAnswer;





$tests['SM_ACTION_ADD_TEST6']=(['Functionality' => "SM_ACTION_ADD",
                'Description' => 'Test 6. Attempt to add action with action description bigger than 255 characters',
                'Expected' => "Action description can't be larger than 255 characters",
                'Result' => 'Not executed']);

$action = new ACTION_Model('','nameAction','uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$addAnswer = $action->addAction();
$tests['SM_ACTION_ADD_TEST6']["Result"] = $addAnswer;



$tests['SM_ACTION_ADD_TEST7']=(['Functionality' => "SM_ACTION_ADD",
                'Description' => "Test 7. Attempt to add action with action description's format incorrect",
                'Expected' => 'Action description format is invalid',
                'Result' => 'Not executed']);

$action = new ACTION_Model('','nameAction','111111');
$addAnswer = $action->addAction();
$tests['SM_ACTION_ADD_TEST7']["Result"] = $addAnswer;




$tests['SM_ACTION_ADD_TEST8']=(['Functionality' => "SM_ACTION_ADD",
                'Description' => "Test 8. Attempt to add action with correct values",
                'Expected' => 'Action successfully added',
                'Result' => 'Not executed']);

$action = new ACTION_Model('','nameActionAdded','descriptActionAdded');
$addAnswer = $action->addAction();
if($addAnswer === true){
    $tests['SM_ACTION_ADD_TEST8']["Result"] = 'Action successfully added';
} else {
    $tests['SM_ACTION_ADD_TEST8']["Result"] = $addAnswer;
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



?>