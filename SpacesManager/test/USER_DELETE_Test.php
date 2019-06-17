<?php 

require_once("../model/USER_Model.php");

//TEST-> EMAIL
$tests['SM_USER_DELETE_TEST1']=(['Functionality' => "SM_USER_DELETE",
                'Description' => "Test 1. Attempt to update user without email",
                'Expected' => "Email is mandatory",
                'Result' => 'Not executed']);

$user = new USER_Model();
$updateAnswer = $user->deleteUser();
$tests['SM_USER_DELETE_TEST1']["Result"] = $updateAnswer;


$tests['SM_USER_DELETE_TEST2']=(['Functionality' => "SM_USER_DELETE",
                'Description' => "Test 2. Attempt to update user with email size too long",
                'Expected' => "Email can't be larger than 50 characters",
                'Result' => 'Not executed']);

$user = new USER_Model('uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$updateAnswer = $user->deleteUser();
$tests['SM_USER_DELETE_TEST2']["Result"] = $updateAnswer;


$tests['SM_USER_DELETE_TEST3']=(['Functionality' => "SM_USER_DELETE",
                'Description' => "Test 3. Attempt to update user with email format invalid",
                'Expected' => "Email format is invalid",
                'Result' => 'Not executed']);

$user = new USER_Model('ivanddf@.com');
$updateAnswer = $user->deleteUser();
$tests['SM_USER_DELETE_TEST3']["Result"] = $updateAnswer;


$tests['SM_USER_DELETE_TEST4']=(['Functionality' => "SM_USER_DELETE",
                'Description' => "Test 4. Attempt to update user with email that not exists in DB",
                'Expected' => "There isn't a user with that email",
                'Result' => 'Not executed']);

$user = new USER_Model('ivanddf@yahoo.com');
$updateAnswer = $user->deleteUser();
$tests['SM_USER_DELETE_TEST4']["Result"] = $updateAnswer;




// //FINAL TEST

$tests['SM_USER_DELETE_TEST5']=(['Functionality' => "SM_USER_DELETE",
                'Description' => "Test 5. Attempt to delete user with correct values",
                'Expected' => 'User deleted successfully',
                'Result' => 'Not executed']);

$user = new USER_Model($email);
$deleteAnswer = $user->deleteUser();
if($deleteAnswer === true){
    $tests['SM_USER_DELETE_TEST5']["Result"] = 'User deleted successfully';
}else{
    $tests['SM_USER_DELETE_TEST5']["Result"] = $deleteAnswer;
}




// if(isset($argv[1])){
//    echo "\t"."\t"."TESTING OVER USER_DELETE" . "\n";
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
