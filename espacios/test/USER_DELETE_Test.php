<?php 

require_once(__DIR__.'..\..\model\USER_Model.php');

//TEST-> USERNAME
$tests['SM_USER_DELETE_TEST1']=(['Functionality' => "SM_USER_DELETE",
                'Description' => 'Test 1. Attempt to delete user without values',
                'Expected' => 'Username is mandatory',
                'Result' => 'Not executed']);

$user = new USER_Model();
$deleteAnswer = $user->deleteUser();
$tests['SM_USER_DELETE_TEST1']["Result"] = $deleteAnswer;


$tests['SM_USER_DELETE_TEST2']=(['Functionality' => "SM_USER_DELETE",
                'Description' => "Test 2. Attempt to delete user with username bigger than 25 characters",
                'Expected' => "Username can't be larger than 25 characters",
                'Result' => 'Not executed']);

$user = new USER_Model('012345678901234567890123456');
$deleteAnswer = $user->deleteUser();
$tests['SM_USER_DELETE_TEST2']["Result"] = $deleteAnswer;


$tests['SM_USER_DELETE_TEST3']=(['Functionality' => "SM_USER_DELETE",
                'Description' => "Test 3. Attempt to delete user with username format invalid",
                'Expected' => 'Username format is invalid',
                'Result' => 'Not executed']);

$user = new USER_Model('¿?{');
$deleteAnswer = $user->deleteUser();
$tests['SM_USER_DELETE_TEST3']["Result"] = $deleteAnswer;


$tests['SM_USER_DELETE_TEST4']=(['Functionality' => "SM_USER_DELETE",
                'Description' => "Test 4. Attempt to delete user with a username that not exists",
                'Expected' => "There isn't a user with that username",
                'Result' => 'Not executed']);

$user = new USER_Model('admyn');
$deleteAnswer = $user->deleteUser();
$tests['SM_USER_DELETE_TEST4']["Result"] = $deleteAnswer;




// //FINAL TEST

$tests['SM_USER_DELETE_TEST5']=(['Functionality' => "SM_USER_DELETE",
                'Description' => "Test 5. Attempt to delete user with correct values",
                'Expected' => 'User deleted successfully',
                'Result' => 'Not executed']);

$user = new USER_Model('prueba');
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
