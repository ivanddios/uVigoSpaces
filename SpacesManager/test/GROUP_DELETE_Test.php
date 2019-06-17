<?php 

require_once("../model/GROUP_Model.php");


//TEST GROUP ID

$tests['SM_GROUP_DELETE_TEST1']=(['Functionality' => "SM_GROUP_DELETE",
                'Description' => 'Test 1. Attempt to delete group without values',
                'Expected' => 'Group identifier is mandatory',
                'Result' => 'Not executed']);

$group = new GROUP_Model();
$deleteAnswer = $group->deleteGroup();
$tests['SM_GROUP_DELETE_TEST1']["Result"] = $deleteAnswer;



$tests['SM_GROUP_DELETE_TEST2']=(['Functionality' => "SM_GROUP_DELETE",
                'Description' => 'Test 2. Attempt to delete group with identifier format incorrect',
                'Expected' => 'Group identifier format is invalid',
                'Result' => 'Not executed']);

$group = new GROUP_Model('abc');
$deleteAnswer = $group->deleteGroup();
$tests['SM_GROUP_DELETE_TEST2']["Result"] = $deleteAnswer;




$tests['SM_GROUP_DELETE_TEST3']=(['Functionality' => "SM_GROUP_DELETE",
                'Description' => "Test 3. Attempt to delete group with a identifier that isn't in DB",
                'Expected' => "Group doesn't exist",
                'Result' => 'Not executed']);

$group = new GROUP_Model(999);
$deleteAnswer = $group->deleteGroup();
$tests['SM_GROUP_DELETE_TEST3']["Result"] = $deleteAnswer;



$tests['SM_GROUP_DELETE_TEST4']=(['Functionality' => "SM_GROUP_DELETE",
                'Description' => "Test 4. Attempt to delete group with correct values",
                'Expected' => 'Group successfully deleted',
                'Result' => 'Not executed']);

$lastGroupID = GROUP_Model::findLastGroupID();
$group = new GROUP_Model($lastGroupID);
$deleteAnswer = $group->deleteGroup();
if($deleteAnswer === true){
    $tests['SM_GROUP_DELETE_TEST4']["Result"] = 'Group successfully deleted';
} else {
    $tests['SM_GROUP_DELETE_TEST4']["Result"] = $deleteAnswer;
}



// if(isset($argv[1])){
//    echo "\t"."\t"."TESTING OVER GROUP_DELETE" . "\n";
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
