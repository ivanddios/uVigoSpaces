<?php 

require_once(__DIR__.'..\..\model\GROUP_Model.php');



//TEST GROUP NAME

$tests['SM_GROUP_ADD_TEST1']=(['Functionality' => "SM_GROUP_ADD",
                'Description' => 'Test 1. Attempt to add group without values',
                'Expected' => 'Group name and description are mandatory',
                'Result' => 'Not executed']);

$group = new GROUP_Model();
$addAnswer = $group->addGroup(null);
$tests['SM_GROUP_ADD_TEST1']["Result"] = $addAnswer;




$tests['SM_GROUP_ADD_TEST2']=(['Functionality' => "SM_GROUP_ADD",
                'Description' => 'Test 2. Attempt to add group without name',
                'Expected' => 'Group name is mandatory',
                'Result' => 'Not executed']);

$group= new GROUP_Model('','','descriptFunction');
$addAnswer = $group->addGroup(null);
$tests['SM_GROUP_ADD_TEST2']["Result"] = $addAnswer;





$tests['SM_GROUP_ADD_TEST3']=(['Functionality' => "SM_GROUP_ADD",
                'Description' => 'Test 3. Attempt to add group with name bigger than 255 characters',
                'Expected' => "Group name can't be larger than 255 characters",
                'Result' => 'Not executed']);

$group= new GROUP_Model('','uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
                            dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY','descriptFunction');
$addAnswer = $group->addGroup(null);
$tests['SM_GROUP_ADD_TEST3']["Result"] = $addAnswer;





$tests['SM_GROUP_ADD_TEST4']=(['Functionality' => "SM_GROUP_ADD",
                'Description' => "Test 4. Attempt to add group with name's format incorrect",
                'Expected' => 'Group name format is invalid',
                'Result' => 'Not executed']);

$group= new GROUP_Model('','111111','descriptFunction');
$addAnswer = $group->addGroup(null);
$tests['SM_GROUP_ADD_TEST4']["Result"] = $addAnswer;



//TEST GROUP DESCRIPTION

$tests['SM_GROUP_ADD_TEST5']=(['Functionality' => "SM_GROUP_ADD",
                'Description' => 'Test 5. Attempt to add group without description',
                'Expected' => 'Group description is mandatory',
                'Result' => 'Not executed']);

$group= new GROUP_Model('','nameGroup');
$addAnswer = $group->addGroup(null);
$tests['SM_GROUP_ADD_TEST5']["Result"] = $addAnswer;



$tests['SM_GROUP_ADD_TEST6']=(['Functionality' => "SM_GROUP_ADD",
                'Description' => 'Test 6. Attempt to add group with description bigger than 255 characters',
                'Expected' => "Group description can't be larger than 255 characters",
                'Result' => 'Not executed']);

$group= new GROUP_Model('','nameGroup','uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$addAnswer = $group->addGroup(null);
$tests['SM_GROUP_ADD_TEST6']["Result"] = $addAnswer;



$tests['SM_GROUP_ADD_TEST7']=(['Functionality' => "SM_GROUP_ADD",
                'Description' => "Test 7. Attempt to add group with description's format is incorrect",
                'Expected' => 'Group description format is invalid',
                'Result' => 'Not executed']);

$group= new GROUP_Model('','nameGroup','111111');
$addAnswer = $group->addGroup(null);
$tests['SM_GROUP_ADD_TEST7']["Result"] = $addAnswer;


//TEST GROUP ACTIONS_FUNCTIONALITY FOR GROUP

$tests['SM_GROUP_ADD_TEST8']=(['Functionality' => "SM_GROUP_ADD",
                'Description' => "Test 8. Attempt to add group without access to any functionality ",
                'Expected' => "Access to some functionality is mandatory",
                'Result' => 'Not executed']);

$group= new GROUP_Model('','nameGroup','descripGroup');
$addAnswer = $group->addGroup(null);
$tests['SM_GROUP_ADD_TEST8']["Result"] = $addAnswer;



$tests['SM_GROUP_ADD_TEST9']=(['Functionality' => "SM_GROUP_ADD",
                'Description' => "Test 9. Attempt to add group with functionality without actions associated",
                'Expected' => "Some action for functionality doesn't exist",
                'Result' => 'Not executed']);

$permissions = array(array('idFunction'=>1000,"idAction"=>1),array("idFunction"=>1,"idAction"=>2),array("idFunction"=>1,"idAction"=>3),array("idFunction"=>1,"idAction"=>4),array("idFunction"=>1,"idAction"=>5));
$permissions = json_encode($permissions);
$permissions = json_decode($permissions);

$group= new GROUP_Model('','nameGroup','descripGroup');
$addAnswer = $group->addGroup($permissions);
$tests['SM_GROUP_ADD_TEST9']["Result"] = $addAnswer;



//FINAL TEST

$tests['SM_GROUP_ADD_TEST10']=(['Functionality' => "SM_GROUP_ADD",
                'Description' => "Test 10. Attempt to add group with correct values",
                'Expected' => 'Group successfully added',
                'Result' => 'Not executed']);

$permissions = array(array('idFunction'=>1, "idAction"=>1),array("idFunction"=>1,"idAction"=>2),array("idFunction"=>1, "idAction"=>3),array("idFunction"=>1, "idAction"=>4),array("idFunction"=>1, "idAction"=>5));
$permissions = json_encode($permissions);
$permissions = json_decode($permissions);

$group= new GROUP_Model('','nameGroupAdded','descripGroupAdded');
$addAnswer = $group->addGroup($permissions);
if($addAnswer === true){
    $tests['SM_GROUP_ADD_TEST10']["Result"] = 'Group successfully added';
} else {
    $tests['SM_GROUP_ADD_TEST10']["Result"] = $addAnswer;
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