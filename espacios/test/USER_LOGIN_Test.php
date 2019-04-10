
<?php 
// require_once(__DIR__.'..\..\model\USER_Model.php');
include '../model/USER_Model.php';

$errors = array();


$errors['TEST1']=(['Description' => 'Test 1. Attempt to login without username and password',
                'Expected' => 'Username and password are mandatory',
                'Result' => 'Not executed']);

$user = new USER_Model();
$loginAnswer = $user->login();
if($loginAnswer !== true){
    $errors["TEST1"]["Result"] = $loginAnswer;
} else {
    $errors["TEST1"]["Result"] = 'Login successfully';
}



$errors['TEST2']=(['Description' => 'Test 2. Attempt to login with username and without password',
                'Expected' => 'Username and password are mandatory',
                'Result' => 'Not executed']);

$user = new USER_Model('test2');
$loginAnswer = $user->login();
if($loginAnswer !== true){
    $errors["TEST2"]["Result"] = $loginAnswer;
} else {
    $errors["TEST2"]["Result"] = 'Login successfully';
}


$errors['TEST3']=(['Description' => 'Test 3. Attempt to login with password and without username',
                'Expected' => 'Username and password are mandatory',
                'Result' => 'Not executed']);

$user = new USER_Model(null,'test3');
$loginAnswer = $user->login();
if($loginAnswer !== true){
    $errors["TEST3"]["Result"] = $loginAnswer;
} else {
    $errors["TEST3"]["Result"] = 'Login successfully';
}



$errors['TEST4']=(['Description' => 'Test 4. Attempt to login with a correct username and incorrect password.',
                'Expected' => 'Password is incorrect',
                'Result' => 'Not executed']);

$user = new USER_Model('admin', '12345');
$loginAnswer = $user->login();
if($loginAnswer !== true){
    $errors["TEST4"]["Result"] = $loginAnswer;
} else {
    $errors["TEST4"]["Result"] = 'Login successfully';
}

$user = new USER_Model('admin', 'admin');
$loginAnswer = $user->login();
$errors['TEST5']=(['Description' => 'Test 5. Attempt to login with a correct username and correct password.',
                'Expected' => 'Login successfully',
                'Result' => 'Not executed']);

$user = new USER_Model('admin', '12345');
$loginAnswer = $user->login();
if($loginAnswer == true){
    $errors["TEST5"]["Result"] = 'Login successfully';
} else {
    $errors["TEST5"]["Result"] = $loginAnswer;
}



echo "\t"."\t"."TESTING ON LOGIN" . "\n";
foreach($errors as $error){

    if($error['Expected'] == $error['Result']){
        echo "\e[32m".$error['Description'] . "\t" ." Expected: " .$error['Expected']. "\t" . " Result: ". $error['Result'] ."\e[0m" . "\n";
    } else {
        echo "\e[31m".$error['Description'] . "\t" ." Expected: " .$error['Expected']. "\t". " Result: ". $error['Result'] ."\e[0m" . "\n";
    }
}


?>