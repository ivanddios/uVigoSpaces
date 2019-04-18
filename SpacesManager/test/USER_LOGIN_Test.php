
<?php 
require_once(__DIR__.'..\..\model\USER_Model.php');

$tests = array();


//TEST-> EMAIL
$tests['SM_USER_LOGIN_TEST1']=(['Functionality' => "SM_USER_LOGIN",
                'Description' => "Test 1. Attempt to login without email",
                'Expected' => "Email is mandatory",
                'Result' => 'Not executed']);

$user = new USER_Model();
$loginAnswer = $user->login();
$tests['SM_USER_LOGIN_TEST1']["Result"] = $loginAnswer;


$tests['SM_USER_LOGIN_TEST2']=(['Functionality' => "SM_USER_LOGIN",
                'Description' => "Test 2. Attempt to login with email size too long",
                'Expected' => "Email can't be larger than 50 characters",
                'Result' => 'Not executed']);

$user = new USER_Model('dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gVgWT4ffpW2y6zydJf6cU8EKC7Shi7PFlgynWFIZWdxsuiAJuA0jXgAe6IJgGtXH0lSfSYYCpmSXj3FnFMXDiYoDJCY');
$loginAnswer = $user->login();
$tests['SM_USER_LOGIN_TEST2']["Result"] = $loginAnswer;


$tests['SM_USER_LOGIN_TEST3']=(['Functionality' => "SM_USER_LOGIN",
                'Description' => "Test 3. Attempt to login with email format invalid",
                'Expected' => "Email format is invalid",
                'Result' => 'Not executed']);

$user = new USER_Model('ivanddf1994@.com');
$loginAnswer = $user->login();
$tests['SM_USER_LOGIN_TEST3']["Result"] = $loginAnswer;


$tests['SM_USER_LOGIN_TEST4']=(['Functionality' => "SM_USER_LOGIN",
                'Description' => "Test 4. Attempt to login with email that not exists in DB",
                'Expected' => "There isn't a user with that email",
                'Result' => 'Not executed']);

$randEmail = str_shuffle('dE89t27sFO18FUUsXBcJeFCVo3ZzXo1oo1T5gV');
$user = new USER_Model($randEmail."@gmail.com");
$loginAnswer = $user->login();
$tests['SM_USER_LOGIN_TEST4']["Result"] = $loginAnswer;


// //TESTS -> PASSWORD
$tests['SM_USER_LOGIN_TEST5']=(['Functionality' => "SM_USER_LOGIN",
                'Description' => "Test 5. Attempt to login without password",
                'Expected' => "Password is mandatory",
                'Result' => 'Not executed']);

$user = new USER_Model('ivanddf1994@hotmail.com');
$loginAnswer = $user->login();
$tests['SM_USER_LOGIN_TEST5']["Result"] = $loginAnswer;


$tests['SM_USER_LOGIN_TEST6']=(['Functionality' => "SM_USER_LOGIN",
                'Description' => "Test 6. Attempt to login with password format invalid",
                'Expected' => 'Password format is invalid',
                'Result' => 'Not executed']);

$user = new USER_Model('ivanddf1994@hotmail.com','abd*¨Ç');
$loginAnswer = $user->login();
$tests['SM_USER_LOGIN_TEST6']["Result"] = $loginAnswer;


$tests['SM_USER_LOGIN_TEST7']=(['Functionality' => "SM_USER_LOGIN",
                'Description' => "Test 7. Attempt to login with password incorrect",
                'Expected' => 'Password is incorrect',
                'Result' => 'Not executed']);

$user = new USER_Model('ivanddf1994@hotmail.com','ABCd1234');
$loginAnswer = $user->login();
$tests['SM_USER_LOGIN_TEST7']["Result"] = $loginAnswer;


//FINAL TEST
$tests['SM_USER_LOGIN_TEST8']=(['Functionality' => "SM_USER_LOGIN",
                'Description' => "Test 7. Attempt to login with password incorrect",
                'Expected' => 'Login successfully',
                'Result' => 'Not executed']);

$user = new USER_Model('ivanddf1994@hotmail.com','ABcd1234');
$loginAnswer = $user->login();
$tests['SM_USER_LOGIN_TEST8']["Result"] = $loginAnswer;
if($loginAnswer === true){
    $tests['SM_USER_LOGIN_TEST8']["Result"] = 'Login successfully';
}else{
    $tests['SM_USER_LOGIN_TEST8']["Result"] = $loginAnswer;
}



// if(isset($argv[1])){
//    echo "\t"."\t"."TESTING OVER LOGIN FUNCTIONALITY" . "\n";
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