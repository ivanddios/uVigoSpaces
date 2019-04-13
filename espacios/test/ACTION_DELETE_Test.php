<?php 

require_once(__DIR__.'..\..\model\ACTION_Model.php');


$tests['SM_ACTION_DELETE_TEST1']=(['Functionality' => "SM_ACTION_DELETE",
                'Description' => 'Test 1. Attempt to deletee action without identifier',
                'Expected' => 'Action id are mandatory',
                'Result' => 'Not executed']);

$action = new ACTION_Model();
$deleteAnswer = $action->deleteAction();
$tests['SM_ACTION_DELETE_TEST1']["Result"] = $deleteAnswer;


$tests['SM_ACTION_DELETE_TEST2']=(['Functionality' => "SM_ACTION_DELETE",
                'Description' => 'Test 2. Attempt to delete action with a identifier format invalid or incorrect',
                'Expected' => 'The action identifier format is invalid',
                'Result' => 'Not executed']);

$action = new ACTION_Model('badActionId');
$deleteAnswer = $action->$deleteAnswer = $action->deleteAction();
$tests['SM_ACTION_DELETE_TEST2']["Result"] = $deleteAnswer;



$tests['SM_ACTION_DELETE_TEST3']=(['Functionality' => "SM_ACTION_DELETE",
                'Description' => 'Test 3. Attempt to delete action with a identifier that does not exist in the DB',
                'Expected' => "Action doesn't exist",
                'Result' => 'Not executed']);

$action = new ACTION_Model(9999);
$deleteAnswer = $action->deleteAction();
$tests['SM_ACTION_DELETE_TEST3']["Result"] = $deleteAnswer;




// if(isset($argv[1])){
//    echo "\t"."\t"."TESTING OVER ACTION_DELETE" . "\n";
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