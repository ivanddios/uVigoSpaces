<?php 

require_once("../model/FUNCTIONALITY_Model.php");


//TESTS -> FUNCTIONALITY ID

$tests['SM_FUNCTIONALITY_DELETE_TEST1']=(['Functionality' => "SM_FUNCTIONALITY_DELETE",
                'Description' => 'Test 1. Attempt to delete functionality without values',
                'Expected' => 'Function identifier is mandatory',
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model();
$deleteAnswer = $function->deleteFunction();
$tests['SM_FUNCTIONALITY_DELETE_TEST1']["Result"] = $deleteAnswer;



$tests['SM_FUNCTIONALITY_DELETE_TEST2']=(['Functionality' => "SM_FUNCTIONALITY_DELETE",
                'Description' => 'Test 2. Attempt to delete functionality with identifier format incorrect',
                'Expected' => 'Function identifier format is invalid',
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model('abc');
$deleteAnswer = $function->deleteFunction();
$tests['SM_FUNCTIONALITY_DELETE_TEST2']["Result"] = $deleteAnswer;




$tests['SM_FUNCTIONALITY_DELETE_TEST3']=(['Functionality' => "SM_FUNCTIONALITY_DELETE",
                'Description' => "Test 3. Attempt to delete functionality with a identifier that isn't in DB",
                'Expected' => "Function doesn't exist",
                'Result' => 'Not executed']);

$function = new FUNCTIONALITY_Model(999);
$deleteAnswer = $function->deleteFunction();
$tests['SM_FUNCTIONALITY_DELETE_TEST3']["Result"] = $deleteAnswer;



//FINAL TEST

$tests['SM_FUNCTIONALITY_DELETE_TEST4']=(['Functionality' => "SM_FUNCTIONALITY_DELETE",
                'Description' => "Test 4. Attempt to delete functionality with correct values",
                'Expected' => 'Function successfully deleted',
                'Result' => 'Not executed']);

$lastFunctionID = FUNCTIONALITY_Model::findLastFunctionID();
$function = new FUNCTIONALITY_Model($lastFunctionID);
$deleteAnswer = $function->deleteFunction();
if($deleteAnswer === true){
    $tests['SM_FUNCTIONALITY_DELETE_TEST4']["Result"] = 'Function successfully deleted';
} else {
    $tests['SM_FUNCTIONALITY_DELETE_TEST4']["Result"] = $deleteAnswer;
}



// if(isset($argv[1])){
//    echo "\t"."\t"."TESTING OVER FUNCTIONALITY_DELETE" . "\n";
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
