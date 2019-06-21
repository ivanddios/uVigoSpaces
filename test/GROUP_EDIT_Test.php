<?php 

require_once("../model/GROUP_Model.php");

$lasIDGroup = GROUP_Model::findLastGroupID();


//TEST GROUP ID

$tests['SM_GROUP_EDIT_TEST1']=(['Functionality' => "SM_GROUP_EDIT",
                'Description' => 'Test 1. Attempt to update group without values',
                'Expected' => 'Group identifier is mandatory',
                'Result' => 'Not executed']);

$group = new GROUP_Model();
$editAnswer = $group->updateGroup(null);
$tests['SM_GROUP_EDIT_TEST1']["Result"] = $editAnswer;



$tests['SM_GROUP_EDIT_TEST2']=(['Functionality' => "SM_GROUP_EDIT",
                'Description' => 'Test 2. Attempt to update group with identifier format incorrect',
                'Expected' => 'Group identifier format is invalid',
                'Result' => 'Not executed']);

$group = new GROUP_Model('abc');
$editAnswer = $group->updateGroup(null);
$tests['SM_GROUP_EDIT_TEST2']["Result"] = $editAnswer;



$tests['SM_GROUP_EDIT_TEST3']=(['Functionality' => "SM_GROUP_EDIT",
                'Description' => "Test 3. Attempt to eupdatedit group with a identifier that is not in DB",
                'Expected' => "Group doesn't exist",
                'Result' => 'Not executed']);

$group = new GROUP_Model(999);
$editAnswer = $group->updateGroup(null);
$tests['SM_GROUP_EDIT_TEST3']["Result"] = $editAnswer;


//TEST GROUP NAME
$tests['SM_GROUP_EDIT_TEST4']=(['Functionality' => "SM_GROUP_EDIT",
                'Description' => 'Test 4. Attempt to update group without values',
                'Expected' => 'Group name and description are mandatory',
                'Result' => 'Not executed']);

$group = new GROUP_Model($lasIDGroup);
$editAnswer = $group->updateGroup(null);
$tests['SM_GROUP_EDIT_TEST4']["Result"] = $editAnswer;



$tests['SM_GROUP_EDIT_TEST5']=(['Functionality' => "SM_GROUP_EDIT",
                'Description' => 'Test 5. Attempt to update group without name',
                'Expected' => 'Group name is mandatory',
                'Result' => 'Not executed']);

$group= new GROUP_Model($lasIDGroup,'','descriptFunction');
$editAnswer = $group->updateGroup(null);
$tests['SM_GROUP_EDIT_TEST5']["Result"] = $editAnswer;



$tests['SM_GROUP_EDIT_TEST6']=(['Functionality' => "SM_GROUP_EDIT",
                'Description' => 'Test 6. Attempt to update group with name bigger than 50 characters',
                'Expected' => "Group name can't be larger than 50 characters",
                'Result' => 'Not executed']);

$group= new GROUP_Model($lasIDGroup,'uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
                            dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY','descriptFunction');
$editAnswer = $group->updateGroup(null);
$tests['SM_GROUP_EDIT_TEST6']["Result"] = $editAnswer;



$tests['SM_GROUP_EDIT_TEST7']=(['Functionality' => "SM_GROUP_EDIT",
                'Description' => "Test 7. Attempt to update group with name's format incorrect",
                'Expected' => 'Group name format is invalid',
                'Result' => 'Not executed']);

$group= new GROUP_Model($lasIDGroup,'111111','descriptFunction');
$editAnswer = $group->updateGroup(null);
$tests['SM_GROUP_EDIT_TEST7']["Result"] = $editAnswer;


//TEST GROUP DESCRIPTION
$tests['SM_GROUP_EDIT_TEST8']=(['Functionality' => "SM_GROUP_EDIT",
                'Description' => 'Test 8. Attempt to update group without description',
                'Expected' => 'Group description is mandatory',
                'Result' => 'Not executed']);

$group= new GROUP_Model($lasIDGroup,'nameGroup');
$editAnswer = $group->updateGroup(null);
$tests['SM_GROUP_EDIT_TEST8']["Result"] = $editAnswer;



$tests['SM_GROUP_EDIT_TEST9']=(['Functionality' => "SM_GROUP_EDIT",
                'Description' => 'Test 9. Attempt to update group with description bigger than 255 characters',
                'Expected' => "Group description can't be larger than 255 characters",
                'Result' => 'Not executed']);

$group= new GROUP_Model($lasIDGroup,'nameGroup','uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$editAnswer = $group->updateGroup(null);
$tests['SM_GROUP_EDIT_TEST9']["Result"] = $editAnswer;



$tests['SM_GROUP_EDIT_TEST10']=(['Functionality' => "SM_GROUP_EDIT",
                'Description' => "Test 10. Attempt to update group with description's format is incorrect",
                'Expected' => 'Group description format is invalid',
                'Result' => 'Not executed']);

$group= new GROUP_Model($lasIDGroup,'nameGroup','111111');
$editAnswer = $group->updateGroup(null);
$tests['SM_GROUP_EDIT_TEST10']["Result"] = $editAnswer;


//TEST GROUP ACTIONS_FUNCTIONALITY FOR GROUP
$tests['SM_GROUP_EDIT_TEST11']=(['Functionality' => "SM_GROUP_EDIT",
                'Description' => "Test 11. Attempt to update group without access to any functionality ",
                'Expected' => "Access to some functionality is mandatory",
                'Result' => 'Not executed']);

$group= new GROUP_Model($lasIDGroup,'nameGroup','descripGroup');
$editAnswer = $group->updateGroup(null);
$tests['SM_GROUP_EDIT_TEST11']["Result"] = $editAnswer;



$tests['SM_GROUP_EDIT_TEST12']=(['Functionality' => "SM_GROUP_EDIT",
                'Description' => "Test 12. Attempt to update group with functionality without actions associated",
                'Expected' => "Some action for functionality doesn't exist",
                'Result' => 'Not executed']);

$permissions = array(array('idFunction'=>1000,"idAction"=>1),array("idFunction"=>1,"idAction"=>2),array("idFunction"=>1,"idAction"=>3),array("idFunction"=>1,"idAction"=>4),array("idFunction"=>1,"idAction"=>5));
$group= new GROUP_Model($lasIDGroup,'nameGroup','descripGroup');
$editAnswer = $group->updateGroup($permissions);
$tests['SM_GROUP_EDIT_TEST12']["Result"] = $editAnswer;




//FINAL TEST
$tests['SM_GROUP_EDIT_TEST13']=(['Functionality' => "SM_GROUP_EDIT",
                'Description' => "Test 13. Attempt to update group with correct values",
                'Expected' => 'Group successfully updated',
                'Result' => 'Not executed']);

$permissions = array(array('idFunction'=>2, "idAction"=>1),array("idFunction"=>2,"idAction"=>2),array("idFunction"=>2, "idAction"=>3),array("idFunction"=>2, "idAction"=>4),array("idFunction"=>2,"idAction"=>5));
$group= new GROUP_Model($lasIDGroup,'nameGroupUpdated','descripGroupUpdated');
$editAnswer = $group->updateGroup($permissions);
if($editAnswer === true){
    $tests['SM_GROUP_EDIT_TEST13']["Result"] = 'Group successfully updated';
} else {
    $tests['SM_GROUP_EDIT_TEST13']["Result"] = $editAnswer;
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