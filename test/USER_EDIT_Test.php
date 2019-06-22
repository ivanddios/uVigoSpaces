<?php 

require_once("../model/USER_Model.php");

//TEST-> EMAIL
$tests['SM_USER_EDIT_TEST1']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 1. Attempt to update user without email",
                'Expected' => "Email is mandatory",
                'Result' => 'Not executed']);

$user = new USER_Model();
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST1']["Result"] = $updateAnswer;


$tests['SM_USER_EDIT_TEST2']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 2. Attempt to update user with email size too long",
                'Expected' => "Email can't be larger than 50 characters",
                'Result' => 'Not executed']);

$user = new USER_Model('uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST2']["Result"] = $updateAnswer;


$tests['SM_USER_EDIT_TEST3']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 3. Attempt to update user with email format invalid",
                'Expected' => "Email format is invalid",
                'Result' => 'Not executed']);

$user = new USER_Model('ivanddf@.com');
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST3']["Result"] = $updateAnswer;


$tests['SM_USER_EDIT_TEST4']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 4. Attempt to update user with email that not exists in DB",
                'Expected' => "There is a user with that email",
                'Result' => 'Not executed']);

$user = new USER_Model('ivandd@hotmail.com');
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST4']["Result"] = $updateAnswer;


//TEST->CHANGE PASSWORD
$tests['SM_USER_EDIT_TEST5']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 5. Attempt to update user with password format invalid",
                'Expected' => 'Password format is invalid',
                'Result' => 'Not executed']);


$user = new USER_Model($email,'abd*¨Ç');
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST5']["Result"] = $updateAnswer;


//TEST -> USER NAME
$tests['SM_USER_EDIT_TEST6']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 6. Attempt to update user without name",
                'Expected' => "User name is mandatory",
                'Result' => 'Not executed']);

$user = new USER_Model($email, 'Aa98ygbgh');
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST6']["Result"] = $updateAnswer;


$tests['SM_USER_EDIT_TEST7']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 7. Attempt to update user with name bigger than 40 characters",
                'Expected' => "User name can't be larger than 40 characters",
                'Result' => 'Not executed']);

$user = new USER_Model($email, 'Aa98ygbgh', 'uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST7']["Result"] = $updateAnswer;


$tests['SM_USER_EDIT_TEST8']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 8. Attempt to update user with name format invalid",
                'Expected' => "User name format is invalid",
                'Result' => 'Not executed']);

$user = new USER_Model($email, 'Aa98ygbgh','112211');
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST8']["Result"] = $updateAnswer;


//TEST-> SURNAMES

$tests['SM_USER_EDIT_TEST9']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 9. Attempt to update user without surnames",
                'Expected' => "User surnames are mandatory",
                'Result' => 'Not executed']);

$user = new USER_Model($email, 'Aa98ygbgh','nameUser');
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST9']["Result"] = $updateAnswer;


$tests['SM_USER_EDIT_TEST10']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 10. Attempt to update user with surnames bigger than 100 characters",
                'Expected' => "User surnames can't be larger than 100 characters",
                'Result' => 'Not executed']);

$user = new USER_Model($email, 'Aa98ygbgh','nameUser','uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST10']["Result"] = $updateAnswer;



$tests['SM_USER_EDIT_TEST11']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 11. Attempt to update user with surnames format invalid",
                'Expected' => "User surnames format is invalid",
                'Result' => 'Not executed']);

$user = new USER_Model($email, 'Aa98ygbgh','nameUser', 112233);
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST11']["Result"] = $updateAnswer;



//TEST -> DNI

$tests['SM_USER_EDIT_TEST12']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 12. Attempt to update user without National Identity Document",
                'Expected' => "NID can't be different from 9 characters",
                'Result' => 'Not executed']);

$user = new USER_Model($email, 'Aa98ygbgh','nameUser', 'surnamesUser');
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST12']["Result"] = $updateAnswer;



$tests['SM_USER_EDIT_TEST13']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 13. Attempt to update user with a National Identity Document format invalid",
                'Expected' => "User NID format is invalid",
                'Result' => 'Not executed']);

$user = new USER_Model($email, 'Aa98ygbgh','nameUser', 'surnamesUser', '4448879OY');
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST13']["Result"] = $updateAnswer;


$tests['SM_USER_EDIT_TEST14']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 14. Attempt to update user with National Identity Document letter incorrect",
                'Expected' => "User NID letter is incorrect",
                'Result' => 'Not executed']);

$user = new USER_Model($email, 'Aa98ygbgh','nameUser', 'surnamesUser', '44488795Y');
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST14']["Result"] = $updateAnswer;



//TEST-> BIRTHDATE
$tests['SM_USER_EDIT_TEST15']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 15. Attempt to update user without birthdate",
                'Expected' => "Birthdate is mandatory",
                'Result' => 'Not executed']);

$dni = generateDNI();
$user = new USER_Model($email, 'Aa98ygbgh','nameUser', 'surnamesUser', $dni);
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST15']["Result"] = $updateAnswer;


$tests['SM_USER_EDIT_TEST16']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 16. Attempt to update user with birthdate size too long",
                'Expected' => "Birthdate can't be larger than 10 characters",
                'Result' => 'Not executed']);

$user = new USER_Model($email, 'Aa98ygbgh','nameUser', 'surnamesUser', $dni, '200/12/2000');
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST16']["Result"] = $updateAnswer;


$tests['SM_USER_EDIT_TEST17']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 17. Attempt to update user with birthdate format invalid",
                'Expected' => "Birthdate format is invalid",
                'Result' => 'Not executed']);

$user = new USER_Model($email, 'Aa98ygbgh','nameUser', 'surnamesUser', $dni, '3103/2000');
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST17']["Result"] = $updateAnswer;



//TEST->PHONE
$tests['SM_USER_EDIT_TEST18']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 21. Attempt to update user without phone",
                'Expected' => "User phone size is incorrect",
                'Result' => 'Not executed']);

$user = new USER_Model($email, 'Aa98ygbgh','nameUser', 'surnamesUser', $dni, '25/04/1999');
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST18']["Result"] = $updateAnswer;


$tests['SM_USER_EDIT_TEST19']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 22. Attempt to update user with phone size invalid",
                'Expected' => "User phone size is incorrect",
                'Result' => 'Not executed']);

$user = new USER_Model($email, 'Aa98ygbgh','nameUser', 'surnamesUser', $dni, '25/04/1999', 98822222);
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST19']["Result"] = $updateAnswer;


$tests['SM_USER_EDIT_TEST20']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 23. Attempt to update user with phone format invalid",
                'Expected' => "User phone format is invalid",
                'Result' => 'Not executed']);

$user = new USER_Model($email, 'Aa98ygbgh','nameUser', 'surnamesUser', $dni, '25/04/1999', 544444444);
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST20']["Result"] = $updateAnswer;


//TEST->GROUP
$tests['SM_USER_EDIT_TEST21']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 24. Attempt to update user with group format invalid",
                'Expected' => "The role format is invalid",
                'Result' => 'Not executed']);

$user = new USER_Model($email, 'Aa98ygbgh','nameUser', 'surnamesUser', $dni, '25/04/1999', 988252875, '', 'admin');
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST21']["Result"] = $updateAnswer;


$tests['SM_USER_EDIT_TEST22']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 25. Attempt to update user with a group that not exists in DB",
                'Expected' => "The role doesn't exist",
                'Result' => 'Not executed']);

$user = new USER_Model($email, 'Aa98ygbgh','nameUser', 'surnamesUser', $dni, '25/04/1999', 988252875, '', 999);
$updateAnswer = $user->updateUser($email);
$tests['SM_USER_EDIT_TEST22']["Result"] = $updateAnswer;





// //FINAL TEST

$tests['SM_USER_EDIT_TEST23']=(['Functionality' => "SM_USER_EDIT",
                'Description' => "Test 26. Attempt to update user with correct values",
                'Expected' => 'User updated successfully',
                'Result' => 'Not executed']);

$user = new USER_Model($email, 'Aa98ygbgh', 'nameUserUpdated', 'surnamesUserUpdated', $dni, '25/04/1999', 988252875, null, 1);
$updateAnswer = $user->updateUser($email);
if($updateAnswer === true){
    $tests['SM_USER_EDIT_TEST23']["Result"] = 'User updated successfully';
}else{
    $tests['SM_USER_EDIT_TEST23']["Result"] = $updateAnswer;
}




// if(isset($argv[1])){
//    echo "\t"."\t"."TESTING OVER USER_EDIT" . "\n";
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