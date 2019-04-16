<?php 

require_once(__DIR__.'..\..\model\USER_Model.php');

//TEST-> USERNAME
$tests['SM_USER_ADD_TEST1']=(['Functionality' => "SM_USER_ADD",
                'Description' => 'Test 1. Attempt to add user without values',
                'Expected' => 'Username is mandatory',
                'Result' => 'Not executed']);

$user = new USER_Model();
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST1']["Result"] = $addAnswer;


$tests['SM_USER_ADD_TEST2']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 2. Attempt to add user with username bigger than 25 characters",
                'Expected' => "Username can't be larger than 25 characters",
                'Result' => 'Not executed']);

$user = new USER_Model('012345678901234567890123456');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST2']["Result"] = $addAnswer;


$tests['SM_USER_ADD_TEST3']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 3. Attempt to add user with username format invalid",
                'Expected' => 'Username format is invalid',
                'Result' => 'Not executed']);

$user = new USER_Model('¿?{');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST3']["Result"] = $addAnswer;


$tests['SM_USER_ADD_TEST4']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 4. Attempt to add user with a username that already exists",
                'Expected' => 'There is already a user with that username',
                'Result' => 'Not executed']);

$user = new USER_Model('admin');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST4']["Result"] = $addAnswer;


// //TESTS -> PASSWORD
$tests['SM_USER_ADD_TEST5']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 5. Attempt to add user without password",
                'Expected' => "Password is mandatory",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST5']["Result"] = $addAnswer;


$tests['SM_USER_ADD_TEST6']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 6. Attempt to add user with password format invalid",
                'Expected' => 'Password format is invalid',
                'Result' => 'Not executed']);

$user = new USER_Model('prueba','abd*¨Ç');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST6']["Result"] = $addAnswer;


//TEST -> USER NAME
$tests['SM_USER_ADD_TEST7']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 7. Attempt to add user without name",
                'Expected' => "User name is mandatory",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST7']["Result"] = $addAnswer;


$tests['SM_USER_ADD_TEST8']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 8. Attempt to add user with name bigger than 40 characters",
                'Expected' => "User name can't be larger than 40 characters",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh', 'uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST8']["Result"] = $addAnswer;


$tests['SM_USER_ADD_TEST9']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 9. Attempt to add user with name format invalid",
                'Expected' => "User name format is invalid",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','112211');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST9']["Result"] = $addAnswer;


//TEST-> SURNAMES

$tests['SM_USER_ADD_TEST10']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 10. Attempt to add user without surnames",
                'Expected' => "User surnames are mandatory",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','nameUser');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST10']["Result"] = $addAnswer;


$tests['SM_USER_ADD_TEST11']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 11. Attempt to add user with surnames bigger than 100 characters",
                'Expected' => "User surnames can't be larger than 100 characters",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','nameUser','uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST11']["Result"] = $addAnswer;



$tests['SM_USER_ADD_TEST12']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 12. Attempt to add user with surnames format invalid",
                'Expected' => "User surnames format is invalid",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','nameUser', 112233);
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST12']["Result"] = $addAnswer;



//TEST -> DNI

$tests['SM_USER_ADD_TEST13']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 13. Attempt to add user without National Identity Document",
                'Expected' => "NID can't be different from 9 characters",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','nameUser', 'surnamesUser');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST13']["Result"] = $addAnswer;



$tests['SM_USER_ADD_TEST14']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 14. Attempt to add user with a National Identity Document format invalid",
                'Expected' => "User id format is invalid",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','nameUser', 'surnamesUser', '4448879OY');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST14']["Result"] = $addAnswer;


$tests['SM_USER_ADD_TEST15']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 15. Attempt to add user with National Identity Document letter incorrect",
                'Expected' => "User id letter is incorrect",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','nameUser', 'surnamesUser', '44488795Y');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST15']["Result"] = $addAnswer;



$tests['SM_USER_ADD_TEST16']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 16. Attempt to add user with National Identity Document that exists in DB",
                'Expected' => "There is already a user with that dni",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','nameUser', 'surnamesUser', '44488795X');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST16']["Result"] = $addAnswer;


//TEST-> BIRTHDATE
$tests['SM_USER_ADD_TEST17']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 17. Attempt to add user without birthdate",
                'Expected' => "Birthdate is mandatory",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','nameUser', 'surnamesUser', '34950154K');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST17']["Result"] = $addAnswer;


$tests['SM_USER_ADD_TEST18']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 18. Attempt to add user with birthdate size too long",
                'Expected' => "Birthdate can't be larger than 10 characters",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','nameUser', 'surnamesUser', '34950154K', '200/12/2000');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST18']["Result"] = $addAnswer;


$tests['SM_USER_ADD_TEST19']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 19. Attempt to add user with birthdate format invalid",
                'Expected' => "Birthdate format is invalid",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','nameUser', 'surnamesUser', '34950154K', '3103/2000');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST19']["Result"] = $addAnswer;




//TEST-> EMAIL
$tests['SM_USER_ADD_TEST20']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 20. Attempt to add user without email",
                'Expected' => "Email is mandatory",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','nameUser', 'surnamesUser', '34950154K', '25/04/1999');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST20']["Result"] = $addAnswer;


$tests['SM_USER_ADD_TEST21']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 21. Attempt to add user with email size too long",
                'Expected' => "Email can't be larger than 50 characters",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','nameUser', 'surnamesUser', '34950154K', '25/04/1999','uozVHX6zmr7jGxWom0fwnVFbPZUivUfoc5wXbMI6j4Bxv7Kc7u5nUHQ1z0VCqofRKUHqthXsjWS9vOp5x0xTryslgOo2E4OvoiB7PfTevseHFs8nG5oOCmksupGkU4kcB
dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST21']["Result"] = $addAnswer;


$tests['SM_USER_ADD_TEST22']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 22. Attempt to add user with email format invalid",
                'Expected' => "Email format is invalid",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','nameUser', 'surnamesUser', '34950154K', '25/04/1999', 'asdasd@');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST22']["Result"] = $addAnswer;


$tests['SM_USER_ADD_TEST23']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 23. Attempt to add user with email that exists in DB",
                'Expected' => "There is already a user with that email",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','nameUser', 'surnamesUser', '34950154K', '25/04/1999', 'ivanddf1994@hotmail.com');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST23']["Result"] = $addAnswer;



//TEST->PHONE
$tests['SM_USER_ADD_TEST24']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 24. Attempt to add user without phone",
                'Expected' => "User phone size is incorrect",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','nameUser', 'surnamesUser', '34950154K', '25/04/1999', 'ivanddf1994@gmail.com');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST24']["Result"] = $addAnswer;


$tests['SM_USER_ADD_TEST25']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 25. Attempt to add user with phone size invalid",
                'Expected' => "User phone size is incorrect",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','nameUser', 'surnamesUser', '34950154K', '25/04/1999','ivanddf1994@gmail.com', 98822222);
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST25']["Result"] = $addAnswer;


$tests['SM_USER_ADD_TEST26']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 26. Attempt to add user with phone format invalid",
                'Expected' => "User phone format is invalid",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','nameUser', 'surnamesUser', '34950154K', '25/04/1999', 'ivanddf1994@gmail.com', 544444444);
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST26']["Result"] = $addAnswer;


//TEST->GROUP
$tests['SM_USER_ADD_TEST27']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 27. Attempt to add user with group format invalid",
                'Expected' => "The role format is invalid",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','nameUser', 'surnamesUser', '34950154K', '25/04/1999', 'ivanddf1994@gmail.com', 988252875, '', 'admin');
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST27']["Result"] = $addAnswer;


$tests['SM_USER_ADD_TEST28']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 28. Attempt to add user with a group that not exists in DB",
                'Expected' => "The role doesn't exist",
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh','nameUser', 'surnamesUser', '34950154K', '25/04/1999', 'ivanddf1994@gmail.com', 988252875, '', 999);
$addAnswer = $user->addUser();
$tests['SM_USER_ADD_TEST28']["Result"] = $addAnswer;





// //FINAL TEST

$tests['SM_USER_ADD_TEST29']=(['Functionality' => "SM_USER_ADD",
                'Description' => "Test 29. Attempt to add user with correct values",
                'Expected' => 'User added successfully',
                'Result' => 'Not executed']);

$user = new USER_Model('prueba', 'Aa98ygbgh', 'nameUser', 'surnamesUser', '34950154K', '25/04/1999', 'ivanddf1994@gmail.com', 988252875, '', 1);
$addAnswer = $user->addUser();
if($addAnswer === true){
    $tests['SM_USER_ADD_TEST29']["Result"] = 'User added successfully';
}else{
    $tests['SM_USER_ADD_TEST29']["Result"] = $addAnswer;
}




// if(isset($argv[1])){
//    echo "\t"."\t"."TESTING OVER USER_ADD" . "\n";
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