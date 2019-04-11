
<?php 
require_once(__DIR__.'..\..\model\USER_Model.php');
require_once(__DIR__.'..\..\test\TEST_View.php');

$tests = array();


$tests['SM_LOGIN_TEST1']=(['Functionality' => "SM_LOGIN",
                'Description' => 'Test 1. Attempt to login without username and password',
                'Expected' => 'Username and password are mandatory',
                'Result' => 'Not executed']);
                

$user = new USER_Model();
$loginAnswer = $user->login();
if($loginAnswer !== 'true'){
    $tests['SM_LOGIN_TEST1']["Result"] = $loginAnswer;
} else {
    $tests['SM_LOGIN_TEST1']["Result"] = 'Login successfully';
}



$tests['SM_LOGIN_TEST2']=(['Functionality' => "SM_LOGIN",
                'Description' => 'Test 2. Attempt to login with username and without password',
                'Expected' => 'Username and password are mandatory',
                'Result' => 'Not executed']);

$user = new USER_Model('test2');
$loginAnswer = $user->login();
if($loginAnswer !== 'true'){
    $tests['SM_LOGIN_TEST2']["Result"] = $loginAnswer;
} else {
    $tests['SM_LOGIN_TEST2']["Result"] = 'Login successfully';
}


$tests['SM_LOGIN_TEST3']=(['Functionality' => "SM_LOGIN",
                'Description' => 'Test 3. Attempt to login with password and without username',
                'Expected' => 'Username and password are mandatory',
                'Result' => 'Not executed']);

$user = new USER_Model(null,'test3');
$loginAnswer = $user->login();
if($loginAnswer !== 'true'){
    $tests['SM_LOGIN_TEST3']["Result"] = $loginAnswer;
} else {
    $tests['SM_LOGIN_TEST3']["Result"] = 'Login successfully';
}



$tests['SM_LOGIN_TEST4']=(['Functionality' => "SM_LOGIN",
                'Description' => 'Test 4. Attempt to login with a correct username and incorrect password.',
                'Expected' => 'Password is incorrect',
                'Result' => 'Not executed']);

$user = new USER_Model('admin', '12345');
$loginAnswer = $user->login();
if($loginAnswer !== 'true'){
    $tests['SM_LOGIN_TEST4']["Result"] = $loginAnswer;
} else {
    $tests['SM_LOGIN_TEST4']["Result"] = 'Login successfully';
}




$tests['SM_LOGIN_TEST5']=(['Functionality' => "SM_LOGIN",
                'Description' => 'Test 5. Attempt to login with a correct username and correct password.',
                'Expected' => 'Login successfully',
                'Result' => 'Not executed']);

$user = new USER_Model('admin', 'admin');
$loginAnswer = $user->login();
if($loginAnswer === true){
    $tests['SM_LOGIN_TEST5']["Result"] = 'Login successfully';
} else {
    $tests['SM_LOGIN_TEST5']["Result"] = $loginAnswer;
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